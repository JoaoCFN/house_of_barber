<section class="gap-to-menu container">
    <div class="area-cliente">
        <div class="row" id="cards-barbearias">
            <div class='col-md-3 col-sm-12 mb-4'>
                <div class='card area-cliente-card'>
                    <img 
                        class='card-img-top' 
                        src='assets/images/cliente-sem-ft.png' 
                        alt='Imagem de capa do card'
                    />
                    <div class='status-aberto hb-txt-black hb-w-700'>
                        ABERTO
                    </div>
                    <div class='card-body hb-txt-white'>
                        <h5 class='card-title hb-w-700 hb-txt-secondary'>
                            Nome barbearia
                        </h5>
                        <div class='card-text'>
                            <p>
                                <i class='fa fa-clock-o'></i>
                                <span class='ml-1'>
                                    8H - 
                                    18H
                                </span>
                            </p>    
                            <p>
                                <i class='fa fa-phone'></i>
                                <span class='ml-1'>Telefone</span>
                            </p>        
                            <p>
                                <i class='fa fa-map-marker'></i>
                                <span class='ml-1'>Cidade</span>
                            </p>            
                        </div>
                        <a href='barbearia.php?id=$idBarbearia' class='btn hb-btn-secondary hb-w-700 hb-full-width'>
                            Agendar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn-pesquisa btn-position-fixed" data-toggle="modal" data-target="#modal-pesquisa">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>
</section>
