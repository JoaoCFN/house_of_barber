<?php 
    $logoSrc = "";
    $pathRoutes = "/house_of_barber/barbearia";

    if(substr_count($_SERVER["REQUEST_URI"], "/") == 3){
        $logoSrc = "../assets/images/logo-invertida.png";
    }
    else{
        $logoSrc = "assets/images/logo-invertida.png";
    }
?>

<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <div class="logo_name">
                <img 
                    src="<?php echo $logoSrc; ?>" 
                />
            </div>
        </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>

    <ul class="nav_list">
        <?php
            createSidebarItem('Dashboard', 'Dashboard', "$pathRoutes", 'bx bx-grid-alt', 'dashboard');
            createSidebarItem('Agendamentos', 'Agendamentos', "$pathRoutes/agendamentos", 'bx bx-calendar', 'agendamentos');
            createSidebarItem('Horários', 'Horários', "$pathRoutes/dias_funcionamento", 'bx bx-time-five', 'horarios');
            createSidebarItem('Serviços', 'Serviços', "$pathRoutes/servicos", 'bx bx-list-ul', 'servicos');
            // createSidebarItem('Avaliações', 'Avaliações', '#', 'bx bx-star', 'avaliacoes');
            createSidebarItem('Estabelecimento', 'Estabelecimento', "$pathRoutes/perfil", 'bx bx-user', 'estabelecimento');
        ?>

        <div class="profile_content">
            <li class="profile">
                <a href="javascript:void(0)" onclick="logout('ESTABELECIMENTO')">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
                <span class="tooltip">Sair</span>
            </li>
        </div>
    </ul>      
</div>
