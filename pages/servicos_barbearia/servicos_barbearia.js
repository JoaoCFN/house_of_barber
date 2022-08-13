const apiPath = "/house_of_barber/api";

let nomeInput = "";
let valorInput = "";

const buildDataTable = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/servicos/estabelecimento`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            let dataTableData = [];

            const servicos = data;

            if(servicos.length > 0){
                servicos.forEach(servico => {
                    const { id, nome, valor  } = servico;
    
                    const editButton = `
                        <button 
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="edit_button"
                            data-toggle="modal"
                            data-target="#modal-editar-servico"
                            onclick="loadServicesInfo('${id}')"
                        >
                            Editar
                        </button
                    `;
    
                    const deleteButton = `
                        <button 
                            class="btn hb-btn-red hb-w-700"
                            id="delete_button"
                            onclick="deleteService('${id}')"
                        >
                            Deletar
                        </button
                    `;
    
                    dataTableData.push([
                        nome,
                        valor,
                        editButton,
                        deleteButton
                    ]);
                });

                $('#table-servicos-barbearia').DataTable({
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
            else{
                $('#table-servicos-barbearia').DataTable({
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

const insertService = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    const { 
        nome_input, 
        valor_input 
    } = document.forms.inserir_servico;

    let body = {
        nome: nome_input.value,
        valor: valor_input.value
    };

    request(`${apiPath}/servico`, headers, 'POST', body, (data) => {
        if(data.error == "false"){
            msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/servicos");
        }
        else{
            msg("error", "Ooops!", data.message);
        }
    });
}

const loadServicesInfo = (id) => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/servico/${id}`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            const {
                id,
                nome,
                valor
            } = data[0];

            const {
                nome_input,
                valor_input
            } = document.forms.editar_servico;

            const modalBtnSalvar = document.querySelector("#modal_btn_salvar");

            if(modalBtnSalvar){
                modalBtnSalvar.setAttribute("data-id", id);
            }

            nome_input.value = nome;
            valor_input.value = valor;

            closeLoading();
        }
    });
}

const editService = (e) => {
    const btnEditar = e.target;

    btnEditar.classList.toggle("d-none");

    const editButtons = document.querySelector("#edit-buttons");

    if(editButtons){
        editButtons.classList.toggle("d-none");
    }

    nomeInput = document.forms.editar_servico.nome_input.value;
    valorInput = document.forms.editar_servico.valor_input.value;

    const inputs = Array.from(document.forms.editar_servico.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "nome_input" || name == "valor_input"){
            input.removeAttribute("disabled");
        }
    });
};

const cancelEdition = (e) => {
    const btnEditar = document.querySelector("#modal_btn_editar");

    if(btnEditar){
        btnEditar.classList.toggle("d-none");
    }

    const editButtons = document.querySelector("#edit-buttons");

    if(editButtons){
        editButtons.classList.toggle("d-none");
    }

    document.forms.editar_servico.nome_input.value = nomeInput;
    document.forms.editar_servico.valor_input.value = valorInput;

    const inputs = Array.from(document.forms.editar_servico.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "nome_input" || name == "valor_input"){
            input.setAttribute("disabled", "disabled");
        }
    });
};

const saveServiceEditions = (e) => {
    msgWithConfirm('info', 'Atenção', 'Deseja editar este serviço?', 'Deletar', (event) => {
        if(event.isConfirmed){
            loading();

            const token = Cookies.get('user_token');

            const headers = {
                'Content-Type': 'application/json',
                'token': token
            };

            let id = "";
            const modalBtnSalvar = document.querySelector("#modal_btn_salvar");

            if(modalBtnSalvar){
                id = modalBtnSalvar.getAttribute("data-id");
            }

            const {
                nome_input,
                valor_input,
            } = document.forms.editar_servico;

            let body = {
                nome: nome_input.value,
                valor: valor_input.value,
                id: id
            }

            request(`${apiPath}/servico`, headers, 'PUT', body, (data) => {
                if(data.error == "false"){
                    msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/servicos");
                }
                else{
                    msg("info", "Atenção", data.message);
                }
            });
        }
    });
};

const deleteService = (id) => {
    msgWithConfirm('info', 'Atenção', 'Deseja deletar este serviço?', 'Deletar', (event) => {
        if(event.isConfirmed){
            loading();
        
            const token = Cookies.get('user_token');
        
            const headers = {
                'Content-Type': 'application/json',
                'token': token
            };
        
            let body = {
                id: id
            };
        
            request(`${apiPath}/servico`, headers, 'DELETE', body, (data) => {
                if(data.error == "false"){
                    msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/servicos");
                }
                else{
                    msg("error", "Ooops!", data.message);
                }
            });
        }
    });
}

buildDataTable();

document.querySelector("#modal_btn_editar").addEventListener("click", editService);
document.querySelector("#modal_btn_cancelar").addEventListener("click", cancelEdition);
document.querySelector("#modal_btn_salvar").addEventListener("click", saveServiceEditions);