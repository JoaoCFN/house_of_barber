<?php 
    require_once "components/head.php";
?>
    <!-- Área cliente CSS -->
    <link rel="stylesheet" type="text/css" href="pages/area_cliente/area_cliente.css?v=<?php echo uniqid(); ?>">
    <!-- Menu cliente CSS -->
    <link rel="stylesheet" type="text/css" href="components/menu_cliente/menu_cliente.css?v=<?php echo uniqid(); ?>">
    <!-- Footer CSS -->
    <link rel="stylesheet" type="text/css" href="components/footer/footer.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
            class="index hb-bg-black"
        >
            <?php 
                require_once "components/menu_cliente/menu_cliente.php"; 
                require_once "pages/area_cliente/content/area_cliente_content.php"; 
                require_once "components/footer/footer.php";
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Cliente JS -->
        <script src="pages/area_cliente/area_cliente.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Menu cliente JS -->
        <script src="components/menu_cliente/menu_cliente.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Footer JS -->
        <script src="components/footer/footer.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
