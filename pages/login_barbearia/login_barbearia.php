<?php 
    require_once "components/head.php";
?>
    <!-- Login page CSS -->
    <link rel="stylesheet" type="text/css" href="../pages/login_barbearia/login_barbearia.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
        >
            <?php 
                require_once "pages/login_barbearia/content/login_barbearia_content.php"; 
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Login page JS -->
        <script src="../pages/login_barbearia/login_barbearia.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
