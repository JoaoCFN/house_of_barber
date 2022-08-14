const apiPath = "/house_of_barber/api";

let diaInput = "";
let horarioAberturaInput = "";
let horarioFechamentoInput = "";

const daysOfWeek = [
    "Segunda-feira",
    "Terça-feira",
    "Quarta-feira",
    "Quinta-feira",
    "Sexta-feira",
    "Sábado",
    "Domingo"
]

const buildDataTable = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/dias_funcionamento/estabelecimento`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            let dataTableData = [];

            const diasFuncionamento = data;

            if(diasFuncionamento.length > 0){
                diasFuncionamento.forEach(diaFuncionamento => {
                    const { id, dia, horario_abertura, horario_fechamento } = diaFuncionamento;
    
                    const editButton = `
                        <button 
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="edit_button"
                            data-toggle="modal"
                            data-target="#modal-editar-dia-funcionamento"
                            onclick="loadOperatingDayInfo('${id}')"
                        >
                            Editar
                        </button
                    `;
    
                    const deleteButton = `
                        <button 
                            class="btn hb-btn-red hb-w-700"
                            id="delete_button"
                            onclick="deleteOperatingDay('${id}')"
                        >
                            Deletar
                        </button
                    `;
    
                    dataTableData.push([
                        daysOfWeek[dia],
                        horario_abertura,
                        horario_fechamento,
                        editButton,
                        deleteButton
                    ]);
                });

                $('#table-dias-funcionamento-barbearia').DataTable({
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
                $('#table-dias-funcionamento-barbearia').DataTable({
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

const insertOperatingDay = () => {
    let dataIsValid = validateDataForm("#inserir_dia_funcionamento .form-control");

    if(dataIsValid){
        loading();
    
        const token = Cookies.get('user_token');
    
        const headers = {
            'Content-Type': 'application/json',
            'token': token
        };
    
        const { 
            dia_input, 
            horario_abertura_input, 
            horario_fechamento_input
        } = document.forms.inserir_dia_funcionamento;
    
        let body = {
            dia: dia_input.value,
            horario_abertura: horario_abertura_input.value,
            horario_fechamento: horario_fechamento_input.value
        };
    
        request(`${apiPath}/dia_funcionamento`, headers, 'POST', body, (data) => {
            if(data.error == "false"){
                msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/dias_funcionamento");
            }
            else{
                msg("error", "Ooops!", data.message);
            }
        });
    }
    else{
        msg("info", "Atenção", "Preencha todos os campos");

        return;
    }
}

const loadOperatingDayInfo = (id) => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/dia_funcionamento/${id}`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            const {
                id,
                dia,
                horario_abertura,
                horario_fechamento
            } = data[0];

            const {
                dia_input,
                horario_abertura_input,
                horario_fechamento_input,
            } = document.forms.editar_dia_funcionamento;

            const modalBtnSalvar = document.querySelector("#modal_btn_salvar");

            if(modalBtnSalvar){
                modalBtnSalvar.setAttribute("data-id", id);
            }

            dia_input.value = dia;
            horario_abertura_input.value = horario_abertura;
            horario_fechamento_input.value = horario_fechamento;

            closeLoading();
        }
    });
}

const editOperatingDay = (e) => {
    const btnEditar = e.target;

    btnEditar.classList.toggle("d-none");

    const editButtons = document.querySelector("#edit-buttons");

    if(editButtons){
        editButtons.classList.toggle("d-none");
    }

    diaInput = document.forms.editar_dia_funcionamento.dia_input.value;
    horarioAberturaInput = document.forms.editar_dia_funcionamento.horario_abertura.value;
    horarioFechamentoInput = document.forms.editar_dia_funcionamento.horario_fechamento.value;

    const inputs = Array.from(document.forms.editar_dia_funcionamento.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "dia_input" || name == "horario_abertura_input" || name == "horario_fechamento_input"){
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

    document.forms.editar_dia_funcionamento.dia_input.value = diaInput;
    document.forms.editar_dia_funcionamento.horario_abertura.value = horarioAberturaInput;
    document.forms.editar_dia_funcionamento.horario_fechamento.value = horarioFechamentoInput;

    const inputs = Array.from(document.forms.editar_dia_funcionamento.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "dia_input" || name == "horario_abertura_input" || name == "horario_fechamento_input"){
            input.removeAttribute("disabled");
        }
    });
};

const saveServiceEditions = (e) => {
    msgWithConfirm('info', 'Atenção', 'Deseja editar este dia de funcionamento?', 'Sim', (event) => {
        if(event.isConfirmed){
            let dataIsValid = validateDataForm("#editar_dia_funcionamento .form-control");

            if(dataIsValid){
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
                    dia_input,
                    horario_abertura_input,
                    horario_fechamento_input,
                } = document.forms.editar_dia_funcionamento;
    
                let body = {
                    dia: dia_input.value,
                    horario_abertura: horario_abertura_input.value,
                    horario_fechamento: horario_fechamento_input.value,
                    id: id
                }
    
                request(`${apiPath}/dia_funcionamento`, headers, 'PUT', body, (data) => {
                    if(data.error == "false"){
                        msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/dias_funcionamento");
                    }
                    else{
                        msg("info", "Atenção", data.message);
                    }
                });
            }
            else{
                msg("info", "Atenção", "Preencha todos os campos");

                return
            }
        }
    });
};

const deleteOperatingDay = (id) => {
    msgWithConfirm('info', 'Atenção', 'Deseja deletar este dia de funcionamento?', 'Deletar', (event) => {
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
        
            request(`${apiPath}/dia_funcionamento`, headers, 'DELETE', body, (data) => {
                if(data.error == "false"){
                    msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/barbearia/dias_funcionamento");
                }
                else{
                    msg("error", "Ooops!", data.message);
                }
            });
        }
    });
}

buildDataTable();

document.querySelector("#modal_btn_editar").addEventListener("click", editOperatingDay);
document.querySelector("#modal_btn_cancelar").addEventListener("click", cancelEdition);
document.querySelector("#modal_btn_salvar").addEventListener("click", saveServiceEditions);