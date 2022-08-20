<?php 
    require_once "components/head.php";
?>
    <!-- Barbearia CSS -->
    <link rel="stylesheet" type="text/css" href="pages/barbearia/barbearia.css?v=<?php echo uniqid(); ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" type="text/css" href="components/sidebar/sidebar.css?v=<?php echo uniqid(); ?>">
    <!-- Charts -->
    <link rel="stylesheet" type="text/css" href="assets/charts/Chart.min.css">

    <body
        class="hb-bg-black"
    >
        <div 
            id="root" 
        >
            <?php 
                require_once "components/sidebar/sidebar.php";
                require_once "pages/barbearia/content/barbearia_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Barbearia JS -->
        <script src="pages/barbearia/barbearia.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Sidebar JS -->
        <script src="components/sidebar/sidebar.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Charts -->
        <script src="assets/charts/Chart.min.js"></script>
        <script src="assets/charts/Chart.bundle.min.js"></script>
    </body>
<html>
