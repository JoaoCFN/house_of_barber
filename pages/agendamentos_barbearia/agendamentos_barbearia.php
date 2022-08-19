<?php 
    require_once "components/head.php";
?>
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Agendamento barbearia CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/agendamentos_barbearia/agendamentos_barbearia.css?v=<?php echo uniqid(); ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" type="text/css" href="../components/sidebar/sidebar.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
            class="hb-bg-black"
        >
            <?php 
                require_once "components/sidebar/sidebar.php";
                require_once "pages/agendamentos_barbearia/content/agendamentos_barbearia_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Agendamento barbearia JS -->
        <script src="../pages/agendamentos_barbearia/agendamentos_barbearia.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Sidebar JS -->
        <script src="../components/sidebar/sidebar.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Datatable -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    </body>
<html>
