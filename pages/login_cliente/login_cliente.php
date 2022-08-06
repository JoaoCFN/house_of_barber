<?php 
    require_once "components/head.php";
?>
    <!-- Login page CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/login_cliente/login_cliente.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
        >
            <?php 
                require_once "pages/login_cliente/content/login_cliente_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Login page JS -->
        <script src="../pages/login_cliente/login_cliente.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
