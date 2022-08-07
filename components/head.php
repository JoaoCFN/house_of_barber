<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House of Barber</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php 
        if(substr_count($_SERVER["REQUEST_URI"], "/") == 3){
            ?>
                <!-- CSS -->
                <link rel="stylesheet" href="../css/index.css?v=<?php echo uniqid(); ?>">
            <?php
        }
        else{
            ?>
                <!-- CSS -->
                <link rel="stylesheet" href="css/index.css?v=<?php echo uniqid(); ?>">
            <?php
        }
    ?>
</head>
