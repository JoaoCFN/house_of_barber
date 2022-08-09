<?php 
    require_once "components/head.php";
?>
    <!-- Landing page CSS -->
    <link rel="stylesheet" type="text/css" href="pages/landing_page/landing_page.css?v=<?php echo uniqid(); ?>">
    <!-- Footer CSS -->
    <link rel="stylesheet" type="text/css" href="components/footer/footer.css?v=<?php echo uniqid(); ?>">

    <body>
        <div 
            id="root" 
            class="index hb-bg-black"
        >
            <?php 
                require_once "pages/landing_page/content/landing_page_content.php"; 
                require_once "components/footer/footer.php";
                require_once "components/scripts.php";
            ?>
        </div>

        <!-- Landing page JS -->
        <script src="pages/landing_page/landing_page.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Footer JS -->
        <script src="components/footer/footer.js?v=<?php echo uniqid(); ?>"></script>
        <!-- Anima rolagem JS -->
        <script src="js/anima_rolagem.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
