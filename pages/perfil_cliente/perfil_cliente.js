const apiPath = "/house_of_barber/api";

let nomeInput = "";
let telefoneInput = "";
let dataNascimentoInput = "";

const loadUserInfos = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/clientes/token`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            const {
                nome,
                telefone,
                data_nascimento,
                cpf,
                email
            } = data[0];

            const {
                nome_input,
                telefone_input,
                data_nascimento_input,
                cpf_input,
                email_input
            } = document.forms.perfil_cliente;

            nome_input.value = nome;
            telefone_input.value = telefone;
            data_nascimento_input.value = data_nascimento;
            cpf_input.value = cpf;
            email_input.value = email;

            closeLoading();
        }
    });
}

const editUserProfile = (e) => {
    const btnEditar = e.target;

    btnEditar.classList.toggle("d-none");

    const editButtons = document.querySelector("#edit-buttons");

    if(editButtons){
        editButtons.classList.toggle("d-none");
    }

    nomeInput = document.forms.perfil_cliente.nome_input.value;
    telefoneInput = document.forms.perfil_cliente.telefone_input.value;
    dataNascimentoInput = document.forms.perfil_cliente.data_nascimento_input.value;

    const inputs = Array.from(document.forms.perfil_cliente.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "nome_input" || name == "telefone_input" || name == "data_nascimento_input"){
            input.removeAttribute("disabled");
        }
    });
};

const cancelEdition = (e) => {
    const btnEditar = document.querySelector("#btn_editar");

    if(btnEditar){
        btnEditar.classList.toggle("d-none");
    }

    const editButtons = document.querySelector("#edit-buttons");

    if(editButtons){
        editButtons.classList.toggle("d-none");
    }

    document.forms.perfil_cliente.nome_input.value = nomeInput;
    document.forms.perfil_cliente.telefone_input.value = telefoneInput;
    document.forms.perfil_cliente.data_nascimento_input.value = dataNascimentoInput;

    const inputs = Array.from(document.forms.perfil_cliente.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name == "nome_input" || name == "telefone_input" || name == "data_nascimento_input"){
            input.setAttribute("disabled", "disabled");
        }
    });
};

const saveProfileChanges = (e) => {
    msgWithConfirm('info', 'Atenção', 'Deseja editar seus dados?', 'Deletar', (event) => {
        if(event.isConfirmed){
            let dataIsValid = validateData();

            if(dataIsValid){
                loading();
    
                const token = Cookies.get('user_token');
    
                const headers = {
                    'Content-Type': 'application/json',
                    'token': token
                };
    
                const {
                    nome_input,
                    telefone_input,
                    data_nascimento_input
                } = document.forms.perfil_cliente;
    
                let body = {
                    nome: nome_input.value,
                    telefone: telefone_input.value,
                    data_nascimento: data_nascimento_input.value
                }
    
                request(`${apiPath}/cliente`, headers, 'PUT', body, (data) => {
                    if(data.error == "false"){
                        msgWithRedirect("success", "Sucesso", data.message, "/house_of_barber/cliente/perfil");
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

loadUserInfos();

document.querySelector("#btn_editar").addEventListener("click", editUserProfile);
document.querySelector("#btn_cancelar").addEventListener("click", cancelEdition);
document.querySelector("#btn_salvar").addEventListener("click", saveProfileChanges);

