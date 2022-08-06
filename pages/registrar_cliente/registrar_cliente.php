<?php 
    require_once "components/head.php";
?>
    <!-- Registrar cliente page CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/registrar_cliente/registrar_cliente.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
        >
            <?php 
                require_once "pages/registrar_cliente/content/registrar_cliente_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Registrar cliente page JS -->
        <script src="../pages/registrar_cliente/registrar_cliente.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>