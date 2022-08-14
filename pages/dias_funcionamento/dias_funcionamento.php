<?php 
    require_once "components/head.php";
?>
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Dias funcionamento CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/dias_funcionamento/dias_funcionamento.css?v=<?php echo uniqid(); ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" type="text/css" href="../components/sidebar/sidebar.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
            class="hb-bg-black"
        >
            <?php 
                require_once "components/sidebar/sidebar.php";
                require_once "pages/dias_funcionamento/content/dias_funcionamento_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Dias funcionamento JS -->
        <script src="../pages/dias_funcionamento/dias_funcionamento.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Sidebar JS -->
        <script src="../components/sidebar/sidebar.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Datatable -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    </body>
<html>
