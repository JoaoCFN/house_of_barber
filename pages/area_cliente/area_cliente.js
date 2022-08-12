function buildClienteArea(){
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request('./api/estabelecimentos', headers, 'GET', '', (data) => {
        const cardsBarbeariaWrapper = document.querySelector("#cards-barbearias");

        if(data.error == "true"){
            msgWithRedirect("error", "Ooops!", "Estamos passando por algum problema. Aguarde alguns instantes e tente novamente.", "/house_of_barber")
        }
        else{
            if(data && data.length > 0){
                data.forEach(establishment => {
                    const {
                        estabelecimento_id,
                        nome,
                        horario_abertura,
                        horario_fechamento,
                        telefone,
                        cidade,
                        status_funcionamento
                    } = establishment;

                    cardsBarbeariaWrapper.innerHTML += `
                        <div class='col-md-3 col-sm-12 mb-4'>
                            <div class='card area-cliente-card'>
                                <img 
                                    class='card-img-top' 
                                    src='assets/images/cliente-sem-ft.png' 
                                    alt='Imagem de capa do card'
                                />
                                <div class='status-${status_funcionamento == "ABERTO" ? "aberto" : "fechado"} hb-txt-black hb-w-700'>
                                    ${status_funcionamento}
                                </div>
                                <div class='card-body hb-txt-white'>
                                    <h5 class='card-title hb-w-700 hb-txt-secondary'>
                                        ${nome}
                                    </h5>
                                    <div class='card-text'>
                                        <p>
                                            <i class='fa fa-clock-o'></i>
                                            <span class='ml-1'>
                                                ${horario_abertura ? `${horario_abertura}H -`: 'Não informado'} 
                                                ${horario_fechamento ? `${horario_fechamento}H`: ''}
                                            </span>
                                        </p>    
                                        <p>
                                            <i class='fa fa-phone'></i>
                                            <span class='ml-1'>${telefone}</span>
                                        </p>        
                                        <p>
                                            <i class='fa fa-map-marker'></i>
                                            <span class='ml-1'>${cidade}</span>
                                        </p>            
                                    </div>
                                    <a 
                                        href='/house_of_barber/barbearia/${estabelecimento_id}' 
                                        class='btn hb-btn-secondary hb-w-700 hb-full-width'
                                    >
                                        Agendar
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                });

                closeLoading();
            }
        }
    });
}

buildClienteArea();
