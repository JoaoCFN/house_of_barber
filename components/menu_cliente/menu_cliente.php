<?php 
    $logoSrc = "";

    if(substr_count($_SERVER["REQUEST_URI"], "/") == 3){
        $logoSrc = "../assets/images/logo-invertida.png";
    }
    else{
        $logoSrc = "assets/images/logo-invertida.png";
    }
?>

<nav class="hb-navbar navbar navbar-expand-lg hb-bg-black fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/house_of_barber/cliente">
            
            <img 
                src="<?php echo $logoSrc; ?>" 
                alt="logo"
                class="logo"
            />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <i class="fa fa-times icon-close"></i>
            <i class="fa fa-bars icon-open"></i>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ml-auto hb-w-700">
                <li class="nav-item align-self-center">                   
                    <a 
                        class="nav-link" 
                        data-toggle="modal"
                        data-target="#modal-agendamentos"
                        id="btn-meus-agendamentos"
                        href="#"
                    >
                        MEUS AGENDAMENTOS
                    </a>
                </li>
                <!-- <li class="nav-item align-self-center">                   
                    <a 
                        class="nav-link" 
                        data-toggle="modal"
                        data-target="#modal-favoritos"
                        href="#"
                    >
                        MEUS FAVORITOS
                    </a>
                </li> -->
                <li class="nav-item align-self-center">                   
                    <a 
                        class="nav-link" 
                        href="/house_of_barber/cliente/perfil"
                    >
                        PERFIL
                    </a>
                </li>
                <li class="nav-item align-self-center">
                    <button
                        class="nav-link hb-btn-outline-secondary hb-w-700 pr-3 pl-3" id="btn_logout"
                    >
                        SAIR 
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Agendamentos -->
<div class="modal fade" id="modal-agendamentos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title hb-txt-secondary hb-w-700">
                    Agendamentos
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true" class="hb-txt-white">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body" id="agendamentos-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary hb-w-700" data-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>