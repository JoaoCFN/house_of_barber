(function loginBarbearia(){
    const btnLoginBarbearia = document.querySelector("#btn_login_barbearia");

    btnLoginBarbearia.addEventListener("click", () => {
        loading();

        let dataIsValid = validateData();

        if(dataIsValid){
            let body = {};
            
            const headers = {'Content-Type': 'application/json'};
            const {
                email_input,
                senha_input
            } = document.forms.login_barbearia;

            if(!validateEmail(email_input.value)){
                msg("error", "Atenção", "Informe um email válido");

                return;
            }
            else if(senha_input.value.length < 8){
                msg("error", "Atenção", "Informe uma senha com no mínimo 8 caracteres");

                return;
            }

            body = {
                perfil: "ESTABELECIMENTO",
                email: email_input.value,
                senha: senha_input.value
            };

            request(`../api/autenticar`, headers, 'POST', body, (data) => {
                if(data.error == "false"){
                    Cookies.set("user_token",  data.token, { path: '/' });

                    location.href = "/house_of_barber/barbearia";
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
