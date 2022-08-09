<nav class="hb-navbar navbar navbar-expand-lg hb-bg-black fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/house_of_barber/cliente">
            <img 
                src="assets/images/logo-invertida.png" 
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
                        href="#"
                    >
                        MEUS AGENDAMENTOS
                    </a>
                </li>
                <li class="nav-item align-self-center">                   
                    <a 
                        class="nav-link" 
                        data-toggle="modal"
                        data-target="#modal-favoritos"
                        href="#"
                    >
                        MEUS FAVORITOS
                    </a>
                </li>
                <li class="nav-item align-self-center">                   
                    <a 
                        class="nav-link" 
                        data-toggle="modal"
                        data-target="#modal-perfil"
                        href="#"
                    >
                        PERFIL
                    </a>
                </li>
                <li class="nav-item align-self-center">
                    <a class="nav-link hb-btn-outline-secondary hb-w-700 pr-3 pl-3" href="logout.php">
                        SAIR 
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>