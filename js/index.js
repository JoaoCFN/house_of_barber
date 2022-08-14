function logout(profile){
    Cookies.remove('user_token', { path: '/' });

    if(profile == "CLIENTE"){
        location.href = "/house_of_barber/cliente/login";
    }
    else if(profile == "ESTABELECIMENTO"){
        location.href = "/house_of_barber/barbearia/login";
    }
}

function loading() {
    Swal.fire({
        title: "<div class='spinner-border hb-txt-secondary' role='status'><span class='sr-only'>Loading...</span></div>",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });
}

function closeLoading(){
    swal.close();
}

function msg(icon, title, text){
    Swal.fire({
        icon: `${icon}`,
        title: `${title}`,
        text: `${text}`
    });
}

function msgWithRedirect(icon, title, text, url){
    Swal.fire({
        icon: `${icon}`,
        title: `${title}`,
        text: `${text}`
    }).then((result) => {
        if(result.isConfirmed){
            location.href = url;
        }
    });
}

function msgWithConfirm(icon, title, text, buttonText, callback){
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonColor: '#176086',
        cancelButtonColor: '#e30017',
        confirmButtonText: buttonText,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        callback(result);
    })
}

function msgWithCallback(icon, title, text, callback){
    Swal.fire({
        icon: `${icon}`,
        title: `${title}`,
        text: `${text}`
    }).then((result) => {
        callback(result);
    });
}

function validateData(){
    let fields = document.querySelectorAll(".form-control");
    let valid = true;

    fields.forEach(field => {
        if(field.value == ""){
            msg("error", "Erro!", "Preencha todos os campos");
            valid = false;

            return false;
        }
    });

    return valid;
}

function validateDataForm(fieldsForm){
    let fields = document.querySelectorAll(fieldsForm);
    let valid = true;

    fields.forEach(field => {
        if(field.id != "login_operador"){
            if(field.value == ""){
                msg("error", "Erro!", "Preencha todos os campos");
                valid = false;

                return false;
            }
        }
    });

    return valid;
}

function validateEmail(email) {
    var emailRegex = /\S+@\S+\.\S+/;
    return emailRegex.test(email);
  }

function toastrAlertSuccess(msg){
    toastr.success(`${msg}`);
}

function toastrAlertInfo(msg){
    toastr.info(`${msg}`);
}

function toastrAlertError(msg){
    toastr.error(`${msg}`);
}

function request(url, headers, method, body = '', callback){
    if(body == ''){
        fetch(url, {
            headers: headers,
            method: method
        })
        .then(response => response.json())
        .then(data => {
            callback(data);
        });
    }
    else{
        fetch(url, {
            headers: headers,
            method: method,
            body: JSON.stringify(body)
        })
        .then(response => response.json())
        .then(data => {
            callback(data);
        });
    }
}

function verificaSessaoUsuario(callback) {
    let headers = {
        token: accessToken,
        'Content-Type': 'application/json'
    };

    request(`api/sessao/usuario`, headers, 'GET', (data) => {
        callback(data);
    });
}