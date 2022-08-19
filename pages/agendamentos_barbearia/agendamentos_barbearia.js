const apiPath = "/house_of_barber/api";

const loadAgendamentos = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    let userId = "";

    request(`${apiPath}/estabelecimentos/token`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", data.message, "/house_of_barber");
        }
        else{
            if(data && data.length > 0){
                data.forEach(userData => {
                    userId = userData.estabelecimento_id;
                });

                let dataTableData = [];

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

                                console.log(scheduling);

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
                                                    servicosAgendamento += `${nome} |`;
                                                }
                                            });

                                            const finishButton = `
                                                <button 
                                                    class="btn hb-btn-secondary-default hb-w-700"
                                                    id="edit_button"
                                                    data-toggle="modal"
                                                    data-target="#modal-editar-servico"
                                                    onclick="loadServicesInfo('${userId}')"
                                                >
                                                    Finalizar
                                                </button
                                            `;
                            
                                            const cancelButton = `
                                                <button 
                                                    class="btn hb-btn-red hb-w-700"
                                                    id="delete_button"
                                                    onclick="deleteService('${userId}')"
                                                >
                                                    Cancelar
                                                </button
                                            `;

                                            dataTableData.push([
                                                nome,
                                                data_agendamento_format,
                                                horario_agendamento_format,
                                                valor,
                                                status_agendamento,
                                                servicosAgendamento,
                                                finishButton,
                                                cancelButton
                                            ]);

                                            $('#table-agendamentos-barbearia').DataTable({
                                                data: dataTableData,
                                                pageLength: 10,
                                                oLanguage: {
                                                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                                                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                                                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                                                    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                                                    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                                                    "sInfoFiltered": "",
                                                    "sSearch": "Procurar",
                                                    "oPaginate": {
                                                        "sFirst": "Primeiro",
                                                        "sPrevious": "Anterior",
                                                        "sNext": "Próximo",
                                                        "sLast": "Último"
                                                    }
                                                },
                                                initComplete: (settings, json) => {
                                                    closeLoading();
                                                }
                                            });
                                        }
                                    }
                                });
                            });

                            closeLoading();
                        }
                        else{
                            $('#table-agendamentos-barbearia').DataTable({
                                data: dataTableData,
                                pageLength: 10,
                                oLanguage: {
                                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                                    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                                    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                                    "sInfoFiltered": "",
                                    "sSearch": "Procurar",
                                    "oPaginate": {
                                        "sFirst": "Primeiro",
                                        "sPrevious": "Anterior",
                                        "sNext": "Próximo",
                                        "sLast": "Último"
                                    }
                                },
                                initComplete: (settings, json) => {
                                    closeLoading();
                                }
                            });
                        }
                    }
                });
            }
        }
    });
};

loadAgendamentos();