<?php 
    require_once "components/head.php";
?>
    <!-- Interna barbearia CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/interna_barbearia/interna_barbearia.css?v=<?php echo uniqid(); ?>">
    <!-- Menu cliente CSS -->
    <link rel="stylesheet" type="text/css" href="../components/menu_cliente/menu_cliente.css?v=<?php echo uniqid(); ?>">
    <!-- Footer CSS -->
    <link rel="stylesheet" type="text/css" href="../components/footer/footer.css?v=<?php echo uniqid(); ?>">
    <!-- DATE PICKER -->
    <link rel="stylesheet" href="../assets/datepicker/themes/default.css">
    <link rel="stylesheet" href="../assets/datepicker/themes/default.date.css">
    <link rel="stylesheet" href="../assets/datepicker/themes/default.time.css">

    <body>
        <div 
            id="root" 
            class="index hb-bg-black"
        >
            <?php 
                require_once "components/menu_cliente/menu_cliente.php"; 
                require_once "pages/interna_barbearia/content/interna_barbearia_content.php"; 
                require_once "components/footer/footer.php";
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- DATE PICKER -->
        <script src="../assets/datepicker/picker.js"></script>
        <script src="../assets/datepicker/picker.time.js"></script>
        <script src="../assets/datepicker/picker.date.js"></script>
        <script src="../assets/datepicker/translate/pt_BR.js"></script>
        <!-- Interna barbearia JS -->
        <script src="../pages/interna_barbearia/interna_barbearia.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Interna barbearia Steps -->
        <script src="../pages/interna_barbearia/interna_barbearia_steps.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Menu cliente JS -->
        <script src="../components/menu_cliente/menu_cliente.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Footer JS -->
        <script src="../components/footer/footer.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
