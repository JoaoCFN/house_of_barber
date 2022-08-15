const apiPath = "/house_of_barber/api";
const id = location.href.split("/")[5];

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
                        ${horario_abertura}H - ${horario_fechamento}H
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
                             
                            $('#dia-agendamento').pickadate({
                                formatSubmit: 'yyyy/mm/dd',
                                disable: daysClosed
                            });

                            $('#horario-agendamento').pickatime({
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
            console.log(data);

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

loadBarbeariaData();

