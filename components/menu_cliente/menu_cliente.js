const menuCliente = () => {
    const buttonLogout = document.querySelector("#btn_logout");

    if(buttonLogout){
        buttonLogout.addEventListener("click", function(){
            logout('CLIENTE');
        })
    }
}

menuCliente();