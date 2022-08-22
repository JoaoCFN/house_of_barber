const apiPath = "/house_of_barber/api";

const loadAgendamentos = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    const initDataTable = (dataTableData) => {
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
                            let itemsProcessed = 0;
                            let schedulingData = data;

                            schedulingData.forEach(scheduling => {
                                const {
                                    agendamento_id,
                                    nome_cliente,
                                    data_agendamento_format,
                                    horario_agendamento_format,
                                    valor,
                                    status_agendamento
                                } = scheduling;

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

                                            const finishButton = `
                                                <button 
                                                    class="btn hb-btn-secondary-default hb-w-700"
                                                    onclick="updateAgendamento('FINALIZADO', '${agendamento_id}')"
                                                >
                                                    Finalizar
                                                </button
                                            `;
                            
                                            const cancelButton = `
                                                <button 
                                                    class="btn hb-btn-red hb-w-700"
                                                    onclick="updateAgendamento('CANCELADO ESTABELECIMENTO', '${agendamento_id}')"
                                                >
                                                    Cancelar
                                                </button
                                            `;

                                            dataTableData.push([
                                                nome_cliente,
                                                data_agendamento_format,
                                                horario_agendamento_format,
                                                valor,
                                                status_agendamento,
                                                servicosAgendamento,
                                                status_agendamento == "PENDENTE" ? finishButton : '-',
                                                status_agendamento == "PENDENTE" ? cancelButton : '-'
                                            ]);

                                            itemsProcessed++;


                                            if(itemsProcessed == schedulingData.length){
                                                initDataTable(dataTableData);
                                            }
                                        }
                                    }
                                });
                            });

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

const updateAgendamento = (status, id) => {
    const action = status == "FINALIZADO" ? "finalizar" : "cancelar";

    msgWithConfirm('info', 'Atenção', `Deseja ${action} esse agendamento?`, 'Sim', (event) => {
        if(event.isConfirmed){
            loading();

            const token = Cookies.get('user_token');

            const headers = {
                'Content-Type': 'application/json',
                'token': token
            };

            const body = {
                status: status,
                id: id
            };

            request(`${apiPath}/agendamento/status`, headers, 'PUT', body, (data) => {
                if(data.error == "false"){
                    msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/agendamentos");
                }
                else{
                    msg("error", "Ooops!", data.message);
                }
            });
        }
    });
};

loadAgendamentos();