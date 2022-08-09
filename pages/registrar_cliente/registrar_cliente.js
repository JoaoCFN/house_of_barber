(function registrarCliente(){
    const btnRegisterCliente = document.querySelector("#btn_registar_cliente");

    btnRegisterCliente.addEventListener("click", () => {
        loading();

        let dataIsValid = validateData();

        if(dataIsValid){
            let body = {};
            
            const headers = {'Content-Type': 'application/json'};
            const {
                nome_input,
                telefone_input,
                data_nascimento_input,
                cpf_input,
                email_input,
                senha_input,
                confirmar_senha_input
            } = document.forms.registrar_cliente;

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
                nome: nome_input.value,
                telefone: telefone_input.value,
                data_nascimento: data_nascimento_input.value,
                cpf: cpf_input.value,
                email: email_input.value,
                senha: senha_input.value
            };

            request(`../api/cliente`, headers, 'POST', body, (data) => {
                if(data.error == "false"){
                    msgWithRedirect("success", "Sucesso", data.message, "./login");
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
})();
