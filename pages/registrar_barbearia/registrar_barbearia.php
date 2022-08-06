<?php 
    require_once "components/head.php";
?>
    <!-- Registrar barbearia page CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/registrar_barbearia/registrar_barbearia.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
        >
            <?php 
                require_once "pages/registrar_barbearia/content/registrar_barbearia_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Registrar barbearia page JS -->
        <script src="../pages/registrar_barbearia/registrar_barbearia.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
