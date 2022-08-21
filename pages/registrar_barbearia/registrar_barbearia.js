(function registrarBarbearia(){
    const btnRegisterBarbearia = document.querySelector("#btn_registar_barbearia");

    btnRegisterBarbearia.addEventListener("click", () => {
        loading();

        let dataIsValid = validateData();

        if(dataIsValid){
            let body = {};

            const headers = {'Content-Type': 'application/json'};
            const {
                nome_admin_input,
                telefone_admin_input,
                cpf_admin_input,
                email_input,
                senha_input,
                confirmar_senha_input,
                nome_barbearia_input,
                telefone_barbearia_input,
                cep_input,
                cnpj_input,
                rua_input,
                numero_endereco_barbearia_input,
                bairro_input,
                cidade_input,
                estado_input
            } = document.forms.registrar_barbearia;

            if(!validateEmail(email_input.value)){
                msg("error", "Atenção", "Informe um email válido");

                return;
            }
            else if(senha_input.value != confirmar_senha_input.value){
                msg("error", "Atenção", "As senhas não coincidem");

                return;
            }
            else if(senha_input.value.length < 8){
                msg("error", "Atenção", "Informe uma senha com no mínimo 8 caracteres");

                return;
            }

            body = {
                nome_admin: nome_admin_input.value,
                telefone_admin: telefone_admin_input.value,
                cpf_admin: cpf_admin_input.value,
                email: email_input.value,
                senha: senha_input.value,
                nome: nome_barbearia_input.value,
                telefone: telefone_barbearia_input.value,
                cnpj: cnpj_input.value
            };

            request(`../api/estabelecimento`, headers, 'POST', body, (data) => {
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

                    request('../api/endereco', headers, 'POST', body, (data) => {
                        if(data.error == "false"){
                            msgWithRedirect("success", "Sucesso", message, "./login");
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

            return;
        }
    });

    const btnCep = document.querySelector("#button_cep");

    btnCep.addEventListener("click", (event) => {
        event.preventDefault();

        loading();

        const { 
            cep_input,
            rua_input,
            bairro_input,
            cidade_input,
            estado_input
        } = document.forms.registrar_barbearia;

        const headers = {};
        const cep = String(cep_input.value).replace("-", "");

        if(cep.length == 8){
            request(`https://viacep.com.br/ws/${cep}/json/`, headers, 'GET', '', (data) => {
                if(data.erro == "true"){
                    msg("info", "Atenção", "CEP não encontrado. Por favor, informe os dados manualmente");
                }
                else{
                    const { 
                        logradouro,
                        bairro,
                        localidade,
                        uf 
                    } = data;

                    rua_input.value = logradouro;
                    bairro_input.value = bairro;
                    cidade_input.value = localidade;
                    estado_input.value = uf;

                    closeLoading();
                }
            });
        }
        else{
            msg("info", "Atenção", "Informe o CEP completo");
        }
    });
})();
