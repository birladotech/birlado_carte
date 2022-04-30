<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style/main.css">
    <title>Rechercher</title>
</head>

<body>
    <?php require "../../includes/header.php"; ?>
    <div class="title-container">
        <h1 class="title">It's all about context.</h1>
        <h1 class="title-down">Ajax'ing something...</h1>
    </div>

    <fieldset class="field-container">
        <input type="text" placeholder="Search..." class="field" />
        <div class="icons-container">
            <div class="icon-search"></div>
            <div class="icon-close">
                <div class="x-up"></div>
                <div class="x-down"></div>
            </div>
        </div>
    </fieldset>
</body>

</html>