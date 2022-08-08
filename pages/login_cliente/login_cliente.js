(function loginCliente(){
    const btnLoginCliente = document.querySelector("#btn_login_cliente");

    btnLoginCliente.addEventListener("click", () => {
        loading();

        let dataIsValid = validateData();

        if(dataIsValid){
            let body = {};
            let headers = {'Content-Type': 'application/json'};

            const {
                email_input,
                senha_input
            } = document.forms.login_cliente;

            if(!validateEmail(email_input.value)){
                msg("error", "Atenção", "Informe um email válido");

                return;
            }
            else if(senha_input.value.length < 8){
                msg("error", "Atenção", "Informe uma senha com no mínimo 8 caracteres");

                return;
            }

            body = {
                perfil: "CLIENTE",
                email: email_input.value,
                senha: senha_input.value
            };

            request(`../api/autenticar`, headers, 'POST', body, (data) => {
                if(data.error == "false"){
                    location.href = "../cliente";
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
