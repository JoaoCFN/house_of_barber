const apiPath = "/house_of_barber/api";
const id = location.href.split("/")[5];

const data = new Date();
const currentMonth = data.getMonth();
const invalidMonth = currentMonth == 0 ? 12: currentMonth;
const currentDay = data.getDate();
const currentYear = data.getFullYear();

let dataAgendamentoFormat = "";
let valorServico = 0;
let servicosSelecionados = [];

let establishmentId = "";

const loadBarbeariaData = () => {
    loading();

    let daysClosed = [1, 2, 3, 4, 5, 6, 7];

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/estabelecimento/${id}`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
        }
        else{
            if(data && data.length > 0){
                data.forEach(establishment => {
                    const {
                        estabelecimento_id,
                        nome,
                        horario_abertura,
                        horario_fechamento,
                        telefone,
                        status_funcionamento,
                        rua,
                        numero,
                        bairro,
                        cidade
                    } = establishment;

                    establishmentId = estabelecimento_id;

                    const nomeBarbearia = document.querySelector("#nome-barbearia");
                    const statusBarbearia = document.querySelector("#status");
                    const telefoneBarbearia = document.querySelector("#telefone");
                    const enderecoBarbearia = document.querySelector("#endereco");
                    const horarioFuncionamentoBarbearia = document.querySelector("#horario");

                    nomeBarbearia.innerHTML = nome;
                    statusBarbearia.classList.add(`${status_funcionamento == "ABERTO" ? "status-aberto": "status-fechado"}`)
                    statusBarbearia.innerHTML = status_funcionamento;
                    telefoneBarbearia.innerHTML = telefone;
                    enderecoBarbearia.innerHTML = `
                        ${rua} | N°${numero} | ${bairro} | ${cidade}
                    `;
                    horarioFuncionamentoBarbearia.innerHTML = `
                        ${horario_abertura != "FECHADO" ? `${horario_abertura}H - ` : "FECHADO"}
                        ${horario_fechamento != "FECHADO" ? `${horario_abertura}H - ` : ""}
                    `;
                });

                request(`${apiPath}/dias_funcionamento_estab/${id}`, headers, 'GET', '', (data) => {
                    if(data.error == "true"){
                        msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
                    }
                    else{
                        if(data && data.length > 0){
                            let horarioAbertura = "";
                            let horarioFechamento = "";

                            data.forEach(dayData => {
                                let openDay = Number(dayData.dia);
                                horarioAbertura = dayData.horario_abertura;
                                horarioFechamento = dayData.horario_fechamento;

                                if((openDay + 1) >= 7){
                                    daysClosed.splice(0, 1);
                                }
                                else{
                                    openDay += 1;

                                    daysClosed.splice(openDay, 1);
                                }
                            });
                             
                            dataAgendamentoInput = $('#dia-agendamento').pickadate({
                                formatSubmit: 'yyyy-mm-dd',
                                disable: daysClosed,
                                hiddenName: true,
                                hiddenPrefix: 'prefix__',
                                hiddenSuffix: '__suffix',
                                min: new Date(currentYear, invalidMonth, currentDay),
                                onSet: function(context) {
                                    const dataAgendamento = new Date(context.select);

                                    dataAgendamentoFormat = `${dataAgendamento.getFullYear()}-${dataAgendamento.getUTCMonth() + 1}-${dataAgendamento.getUTCDate()}`;
                                    dataAgendamentoFormat = dataAgendamentoFormat.trim();
                                }
                            });

                            horarioAgendamentoInput = $('#horario-agendamento').pickatime({
                                format: 'H:i',
                                // Delimitador de horas
                                min: [horarioAbertura.split(":")[0], horarioAbertura.split(":")[1]],
                                max: [horarioFechamento.split(":")[0], horarioFechamento.split(":")[1]]
                            })
                        }

                        closeLoading();
                    }
                });
            }
        }
    });
};

const loadServices = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/servicos_estab/${id}`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
        }
        else{
            const servicos = document.querySelector(".servicos");
            servicos.innerHTML = ``;

            if(data && data.length > 0){
                data.forEach(service => {
                    const { id, nome, valor } = service;

                    const inputContainer = document.createElement("div");
                    inputContainer.classList.add("input-container");
                    inputContainer.innerHTML = `
                        <input 
                            id="${id}" 
                            type="checkbox" 
                            value="${nome}"
                            data-value="${valor}"
                            name="servico-${id}"
                            data-target-title="btn-servico"
                            onChange="handleCheck(this);"
                        >
                        <label for="${id}">
                            <span>
                                ${nome}
                                <br>
                                <span>
                                    R$ ${valor}
                                </span>
                            </span>
                        </label>
                    `;

                    servicos.appendChild(inputContainer);
                });

                setFormHeight();
            }
            else{
                servicos.innerHTML = `
                    <h5 class="hb-txt-white hb-w-500">
                        Não há serviços cadastrados pelo estabelecimento                              
                    </h5>
                `;
            }

            closeLoading();
        }
    });
};

const handleButton = (target) => {
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.value.length > 0){
        btn.removeAttribute("disabled");
    } 
    else{
        btn.setAttribute("disabled", "disabled");
    }
}

const handleCheck = (target) => {
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.checked){
        btn.removeAttribute("disabled");
    } 
    else{
        const checkeds = document.querySelectorAll("input:checked");
        const InputChecked = Array.from(checkeds);
        InputChecked.length == 0 ? btn.setAttribute("disabled", "disabled"): ""
    }
}

const confirmService = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    const preInfos = [
        {text: "Data:"},
        {text: "Horário:"},
        {text: "Serviço:"}
    ] 

    const posInfos = []
    
    // Inputs
    const dia = document.querySelector("#dia-agendamento").value;
    const horario = document.querySelector("#horario-agendamento").value;
    let servicos = ``;
    // Pegandos os serviços escolhidos
    const checkeds = document.querySelectorAll("input:checked");
    const servicosEscolhidos = Array.from(checkeds);
    servicosEscolhidos.forEach((servico, index) =>{
        valorServico = Number(servico.getAttribute("data-value"));
        servicosSelecionados.push(servico.name.split("servico-")[1]);

        servicos += `${servico.value}`;
        const ultimoItem = (servicosEscolhidos.length) - 1;
        ultimoItem != index ? servicos += " | ": ""
    });

    posInfos.push(dia, horario, servicos);

    let confirmarServico = document.querySelector("#confirmar-servico-content");
    confirmarServico.innerHTML = ``;

    const finalInfos = preInfos.map((info, index) => {
        const textContainer = document.createElement("h5");

        textContainer.setAttribute("class", "multisteps-form__title hb-txt-white hb-w-500");
        textContainer.innerHTML = `${info.text} ${posInfos[index]}`;

        return textContainer.outerHTML;
    });

    const nomeClienteWrapper = document.querySelector("#nome-cliente");

    request(`${apiPath}/clientes/token`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
        }
        else{
            if(data && data.length > 0){
                data.forEach(userData => {
                    const { nome } = userData;

                    nomeClienteWrapper.innerHTML = `Nome: ${nome}`;     
                });

                closeLoading();
                setFormHeight();
            }
        }
    });

    // Inserindo os valores dinamicamente
    finalInfos.forEach(info => {
        confirmarServico.innerHTML += info;
    })
}

const insertServices = (servicosSelecionados, headers, callback) => {
    servicosSelecionados.forEach(servicoSelecionado => {
        body = {
            agendamento_id: establishmentId,
            servico_id: servicoSelecionado
        }

        request(`${apiPath}/agendamento/servico`, headers, 'POST', body, (data) => {
            if(data.error == "false"){
                callback(true);
            }
            else{
                callback(false);
            }
        }); 
    });
}

const sendScheduling = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    const {
        horario_input
    } = document.forms.agendamento;

    let body = {
        estabelecimento_id: establishmentId,
        data_agendamento: dataAgendamentoFormat,
        horario_agendamento: horario_input.value,
        valor: valorServico,
        status: "PENDENTE"
    };

    request(`${apiPath}/agendamento`, headers, 'POST', body, (data) => {
        if(data.error == "false"){
            const sheculingMessage = data.message;
            const sheculingId = data.scheduling_id;

            servicosSelecionados.forEach(servicoSelecionado => {
                body = {
                    agendamento_id: sheculingId,
                    servico_id: servicoSelecionado
                }

                request(`${apiPath}/agendamento/servico`, headers, 'POST', body, (data) => {
                    if(data.error == "true"){
                        msg("info", "Atenção", data.message);
                    }
                }); 
            });

            msgWithRedirect("success", "Sucesso", sheculingMessage, "/house_of_barber/cliente");
        }
        else{
            msg("info", "Atenção", data.message);
        }
    });
};

const btnService = document.querySelector("#btn-servico");
btnService.addEventListener("click", confirmService);

loadBarbeariaData();

