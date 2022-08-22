const apiPath = "/house_of_barber/api";

let nomeAdminInput = "";
let telefoneAdminInput = "";
let cpfAdminInput = "";
let emailInput = "";
let nomeBarbeariaInput = "";
let telefoneBarbeariaInput = "";
let cepInput = "";
let cnpjInput = "";
let ruaInput = "";
let numeroEnderecoBarbeariaInput = "";
let bairroInput = "";
let cidadeInput = "";
let estadoInput = "";
let uploadFile = document.querySelector("#upload_file");

const loadUserInfos = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/estabelecimentos/perfil`, headers, 'GET', '', (data) => {
        if(data.error == "true"){
            msg("error", "Ooops!", data.message);
        }
        else{
            const fotoPerfil = document.querySelector("#img-foto-perfil");

            const {
                nome_admin,
                telefone_admin,
                cpf_admin,
                email,
                nome,
                telefone,
                cep,
                cnpj,
                rua,
                numero,
                bairro,
                cidade,
                estado,
                foto_perfil
            } = data[0];

            const {
                nome_admin_input,
                telefone_admin_input,
                cpf_admin_input,
                email_input,
                nome_barbearia_input,
                telefone_barbearia_input,
                cep_input,
                cnpj_input,
                rua_input,
                numero_endereco_barbearia,
                bairro_input,
                cidade_input,
                estado_input
            } = document.forms.perfil_estabelecimento;

            nome_admin_input.value = nome_admin;
            telefone_admin_input.value = telefone_admin;
            cpf_admin_input.value = cpf_admin;
            email_input.value = email;
            nome_barbearia_input.value = nome;
            telefone_barbearia_input.value = telefone;
            cep_input.value = cep;
            cnpj_input.value = cnpj;
            rua_input.value = rua;
            numero_endereco_barbearia.value = numero;
            bairro_input.value = bairro;
            cidade_input.value = cidade;
            estado_input.value = estado;

            if(foto_perfil == null || foto_perfil == ""){
                fotoPerfil.src = `../assets/images/cliente-sem-ft.png`;
            }
            else{
                fotoPerfil.src = `../uploads/barbearia/${foto_perfil}`;
            }

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

    nomeAdminInput = document.forms.perfil_estabelecimento.nome_admin_input.value;
    telefoneAdminInput = document.forms.perfil_estabelecimento.telefone_admin_input.value;
    cpfAdminInput = document.forms.perfil_estabelecimento.cpf_admin_input.value;
    emailInput = document.forms.perfil_estabelecimento.email_input.value;
    nomeBarbeariaInput = document.forms.perfil_estabelecimento.nome_barbearia_input.value;
    telefoneBarbeariaInput = document.forms.perfil_estabelecimento.telefone_barbearia_input.value;
    cepInput = document.forms.perfil_estabelecimento.cep_input.value;
    cnpjInput = document.forms.perfil_estabelecimento.cnpj_input.value;
    ruaInput = document.forms.perfil_estabelecimento.rua_input.value;
    numeroEnderecoBarbeariaInput = document.forms.perfil_estabelecimento.numero_endereco_barbearia.value;
    bairroInput = document.forms.perfil_estabelecimento.bairro_input.value;
    cidadeInput = document.forms.perfil_estabelecimento.cidade_input.value;
    estadoInput = document.forms.perfil_estabelecimento.estado_input.value;

    uploadFile.classList.remove("hb-d-none");

    const inputs = Array.from(document.forms.perfil_estabelecimento.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name != "email_input"){
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

    document.forms.perfil_estabelecimento.nome_admin_input.value = nomeAdminInput;
    document.forms.perfil_estabelecimento.telefone_admin_input.value = telefoneAdminInput;
    document.forms.perfil_estabelecimento.cpf_admin_input.value = cpfAdminInput;
    document.forms.perfil_estabelecimento.email_input.value = emailInput;
    document.forms.perfil_estabelecimento.nome_barbearia_input.value = nomeBarbeariaInput;
    document.forms.perfil_estabelecimento.telefone_barbearia_input.value = telefoneBarbeariaInput;
    document.forms.perfil_estabelecimento.cep_input.value = cepInput;
    document.forms.perfil_estabelecimento.cnpj_input.value = cnpjInput;
    document.forms.perfil_estabelecimento.rua_input.value = ruaInput;
    document.forms.perfil_estabelecimento.numero_endereco_barbearia.value = numeroEnderecoBarbeariaInput;
    document.forms.perfil_estabelecimento.bairro_input.value = bairroInput;
    document.forms.perfil_estabelecimento.cidade_input.value = cidadeInput;
    document.forms.perfil_estabelecimento.estado_input.value = estadoInput;

    uploadFile.classList.add("hb-d-none");

    const inputs = Array.from(document.forms.perfil_estabelecimento.elements);

    inputs.forEach((input) => {
        const { name } = input;

        if(name != "email_input"){
            input.removeAttribute("disabled");
        }
    });
};

const saveProfileChanges = (e) => {
    msgWithConfirm('info', 'Atenção', 'Deseja editar os dados da sua barbearia?', 'Sim', (event) => {
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
                    nome_admin_input,
                    telefone_admin_input,
                    cpf_admin_input,
                    nome_barbearia_input,
                    telefone_barbearia_input,
                    cep_input,
                    cnpj_input,
                    rua_input,
                    numero_endereco_barbearia_input,
                    bairro_input,
                    cidade_input,
                    estado_input
                } = document.forms.perfil_estabelecimento;
    
                body = {
                    nome_admin: nome_admin_input.value,
                    telefone_admin: telefone_admin_input.value,
                    cpf_admin: cpf_admin_input.value,
                    nome: nome_barbearia_input.value,
                    telefone: telefone_barbearia_input.value,
                    cnpj: cnpj_input.value
                };
    
                request(`${apiPath}/estabelecimento`, headers, 'PUT', body, (data) => {
                    if(data.error == "false"){
                        const { establishment_id, message } = data;
    
                        body = {
                            estabelecimento_id: establishment_id,
                            cep: cep_input.value,
                            estado: estado_input.value,
                            cidade: cidade_input.value,
                            bairro: bairro_input.value,
                            rua: rua_input.value,
                            numero: numero_endereco_barbearia_input.value
                        };
    
                        request(`${apiPath}/endereco`, headers, 'PUT', body, (data) => {
                            if(data.error == "false"){
                                const fileUploaded = document.getElementById('upload_file');

                                if(fileUploaded.value != ""){
                                    const formData = new FormData();
                                    formData.append('file', fileUploaded.files[0]);

                                    fetch(`${apiPath}/estabelecimento/foto_perfil`, {
                                        headers: {
                                            token: token
                                        },
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data.error == "false"){
                                            msgWithRedirect("success", "Sucesso", message, "/house_of_barber/barbearia/perfil");
                                        }
                                        else{
                                            msgWithRedirect("error", "Erro!", data.message, "/house_of_barber/barbearia/perfil");
                                        }
                                    });
                                }
                                else{
                                    msgWithRedirect("success", "Sucesso", message, "/house_of_barber/barbearia/perfil");
                                }
                            }
                            else{
                                msg("info", "Atenção", data.message);
                            }
                        });
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

uploadFile.addEventListener("change", function(){
    const imagePreview = document.querySelector("#img-foto-perfil");

    if(imagePreview){
        const imageSource = URL.createObjectURL(this.files[0]);
        imagePreview.src = imageSource;
    }
})

