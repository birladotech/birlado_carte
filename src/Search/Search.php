<?php
session_start();

require_once "../DB/DB.php";
require_once "../Models/Adresse.php";
$a = new Adresse(loadDB());
if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php ");
}
if (isset($_POST['search'])) {
    $adresse = strip_tags($_POST['adresse']);
    $adresseParse = str_replace(" ", "+", $adresse);
    $countAdresse = $a->searchAdresseByAdresse($adresse);

    if ($countAdresse->rowCount() > 0) {
        $reload = true;
    } else {
        $errors = "Adresse Introuvable dans la basse de donnée";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style/search.css">
    <title>Rechercher</title>
    </script>

</head>

<body>
    <?php require "../../includes/header.php"; ?>

    <div class="container-search">
        <form action="" class="search" method="post">
            <input type="search" placeholder="Rechercher une adresse..." name="adresse" value="<?= isset($adresse) ? $adresse : '' ?>">
            <button type="submit" name="search">
                <img src="../../assets/icons/search.png" alt="">
            </button>
        </form>
        <p class="text-center text-danger"><?= isset($errors) ? $errors : '' ?></p>
        <?php if (isset($reload)) : ?>
            <iframe width="100%" style="margin-top: 30px;" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDMXoJyL6TlggHntTEO-hG3SjXoozQwTmQ&q=<?= $adresse ?>">
            </iframe>
        <?php endif; ?>
    </div>
</body>

</html>