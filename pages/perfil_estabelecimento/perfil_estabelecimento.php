<?php 
    require_once "components/head.php";
?>
    <!-- Perfil estabelecimento CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/perfil_estabelecimento/perfil_estabelecimento.css?v=<?php echo uniqid(); ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" type="text/css" href="../components/sidebar/sidebar.css?v=<?php echo uniqid(); ?>">

    <body
        class="hb-bg-black"
    >
        <div 
            id="root" 
        >
            <?php 
                require_once "components/sidebar/sidebar.php";
                require_once "pages/perfil_estabelecimento/content/perfil_estabelecimento_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Perfil estabelecimento JS -->
        <script src="../pages/perfil_estabelecimento/perfil_estabelecimento.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Sidebar JS -->
        <script src="../components/sidebar/sidebar.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
