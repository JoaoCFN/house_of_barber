const menuCliente = () => {
    const buttonLogout = document.querySelector("#btn_logout");

    if(buttonLogout){
        buttonLogout.addEventListener("click", function(){
            logout('CLIENTE');
        })
    }
}

const loadAgendamentos = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    let userId = "";
    let agendamentosContent = document.querySelector("#agendamentos-content");
    agendamentosContent.innerHTML = ``;

    request(`${apiPath}/clientes/token`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
        }
        else{
            if(data && data.length > 0){
                data.forEach(userData => {
                    userId = userData.id;
                });

                request(`${apiPath}/agendamentos_cliente/${userId}`, headers, 'GET', '', (data) => {
                    if(data.error == "true"){
                        msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
                    }
                    else{
                        if(data && data.length > 0){
                            data.forEach(scheduling => {
                                const {
                                    agendamento_id,
                                    nome,
                                    data_agendamento_format,
                                    horario_agendamento_format,
                                    valor,
                                    telefone,
                                    rua,
                                    numero,
                                    bairro,
                                    cidade,
                                    status_agendamento
                                } = scheduling;

                                let statusAgendamentoClass = "";

                                if(status_agendamento == "PENDENTE"){
                                    statusAgendamentoClass = "pending";
                                }
                                else if(status_agendamento == "FINALIZADO"){
                                    statusAgendamentoClass = "finished";
                                }
                                else if(status_agendamento.includes("CANCELADO")){
                                    statusAgendamentoClass = "canceled";
                                }

                                request(`${apiPath}/agendamentos_servico/${agendamento_id}`, headers, 'GET', '', (data) => {
                                    if(data.error == "true"){
                                        msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
                                    }
                                    else{
                                        if(data && data.length > 0){
                                            let servicosAgendamento = "";

                                            data.forEach((services, index) => {
                                                const { nome } = services;

                                                if(index == 0){
                                                    servicosAgendamento += `${nome}`;
                                                }
                                                else{
                                                    servicosAgendamento += ` | ${nome}`;
                                                }
                                            });

                                            agendamentosContent.innerHTML += `
                                                <div class="row">
                                                    <div class="col-sm-12 mt-1 mb-1">
                                                        <div class="card shadow-sm hb-bg-black">
                                                            <div class="card-body">
                                                                <h5 class="hb-txt-secondary hb-w-700 mb-2">
                                                                    ${nome}
                                                                </h5>
                                                                <div 
                                                                    class="hb-w-700 status-box"
                                                                    data-status="${statusAgendamentoClass}"
                                                                >
                                                                    ${status_agendamento}
                                                                </div>
                                                                <h6 class="hb-txt-white hb-w-500">
                                                                    <i class="fa fa-calendar"></i>
                                                                    <span class="ml-1">
                                                                        Data: ${data_agendamento_format}
                                                                    </span>
                                                                </h6>
                                                                <h6 class="hb-txt-white hb-w-500">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    <span class="ml-1">
                                                                        Horário: ${horario_agendamento_format}
                                                                    </span>
                                                                </h6>
                                                                <h6 class="hb-txt-white hb-w-500">
                                                                    <i class="fa fa-cut"></i>
                                                                    <span class="ml-1" id="">
                                                                        Serviço: ${servicosAgendamento}
                                                                    </span>
                                                                </h6>
                                                                <h6 class="hb-txt-white hb-w-500">
                                                                    <i class="fa fa-money"></i>
                                                                    <span class="ml-1">
                                                                        Valor: R$ ${valor}
                                                                    </span>
                                                                </h6>
                                                                <h6 class="hb-w-500 hb-txt-white">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <span class="ml-1">
                                                                        Endereço:
                                                                        ${rua} | 
                                                                        ${numero} | 
                                                                        ${bairro} | 
                                                                        ${cidade}  
                                                                    </span>
                                                                </h6>
                                                                <h6 class="hb-txt-white hb-w-500">
                                                                    <i class="fa fa-phone"></i>
                                                                    <span class="ml-1">Telefone: 
                                                                        ${telefone}
                                                                    </span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        }
                                    }
                                });
                            });

                            closeLoading();
                        }
                        else{
                            agendamentosContent.innerHTML = `
                                <h5 class="hb-txt-white hb-w-500">
                                    Não há agendamentos feitos
                                </h5>
                            `;

                            closeLoading();
                        }
                    }
                });
            }
        }
    });
};

menuCliente();
document.querySelector("#btn-meus-agendamentos").addEventListener("click", loadAgendamentos);