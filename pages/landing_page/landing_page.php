<?php 
    require_once "components/head.php";
?>
    <!-- Landing page CSS -->
    <link rel="stylesheet" type="text/css" href="pages/landing_page/landing_page.css?v=<?php echo uniqid(); ?>">

    <body>
        <?php 
            require_once "pages/landing_page/content/landing_page_content.php"; 
            require_once "components/scripts.php";
        ?>

        <!-- Landing page JS -->
        <script src="pages/Landing page/Landing page.js?v=<?php echo uniqid(); ?>"></script>
    </body>
<html>
