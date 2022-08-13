<?php 
    require_once "components/head.php";
?>
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Serviços Barbearia CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/servicos_barbearia/servicos_barbearia.css?v=<?php echo uniqid(); ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" type="text/css" href="../components/sidebar/sidebar.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
            class="hb-bg-black"
        >
            <?php 
                require_once "components/sidebar/sidebar.php";
                require_once "pages/servicos_barbearia/content/servicos_barbearia_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Serviços Barbearia JS -->
        <script src="../pages/servicos_barbearia/servicos_barbearia.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Sidebar JS -->
        <script src="../components/sidebar/sidebar.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Datatable -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    </body>
<html>
