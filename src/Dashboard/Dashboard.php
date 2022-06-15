<?php
session_start();

require_once "../DB/DB.php";
require_once "../Models/Adresse.php";
$a = new Adresse(loadDB());
$allData = $a->getAllAdresse();

if (isset($_POST['addAdresse'])) {
    if (!is_numeric($_POST['adresse'])) {
        if (!empty($_POST['adresse']) and isset($_POST['adresse'])) {
            $adresse = strip_tags($_POST['adresse']);
        } else {
            $errors['A'] = 'Le champ adresse ne doit pas etre vide';
        }
    } else {
        $errors['A'] = 'Le champ adresse ne doit pas etre un chiffre';
    }
    if (!is_numeric($_POST['adresse'])) {
        if (!empty($_POST['ville']) and isset($_POST['ville']) && !is_numeric($_POST['ville'])) {
            $ville = htmlspecialchars(htmlentities(trim(strip_tags($_POST['ville']))));
        } else {
            $errors['V'] = 'La ville  ne doit pas etre vide';
        }
    } else {
        $errors['V'] = 'Le champ ville ne doit pas etre un chiffre';
    }
    if (!empty($_POST['pays']) and isset($_POST['pays']) && !is_numeric($_POST['pays'])) {
        $pays = htmlspecialchars(htmlentities(trim(strip_tags($_POST['pays']))));
    } else {
        $errors['P'] = 'Le pays  ne doit pas etre vide';
    }
    if (!empty($_POST['codePostal']) and isset($_POST['codePostal'])) {
        $codePostal = htmlspecialchars(htmlentities(trim(strip_tags($_POST['codePostal']))));
    } else {
        $errors['C'] = 'Le code postal  ne doit pas etre vide';
    }

    if (!isset($errors)) {
        if ($_POST['addAdresse'] == "modif") {
            $adresseData = [
                "adresse" => $adresse,
                "codePostal" => $codePostal,
                "pays" => $pays,
                "ville" => $ville,
                "id" => intval($_POST['id'])
            ];
            if ($a->updateAdresse($adresseData)) {
                $sucess = 'Adresse update sucessfuly';
                $reload = true;
                header("Location: ./dashboard.php?sucess=$sucess");
            }
        } else {
            $adresseData = [
                "adresse" => $adresse,
                "codePostal" => $codePostal,
                "pays" => $pays,
                "ville" => $ville,
            ];
            if ($a->addAdress($adresseData)) {
                $sucess = 'Adresse add sucessfuly';
                $reload = true;
                header("Location: ./dashboard.php?sucess=$sucess");
            }
        }
    } else {
        $reload = false;
    }
}
if (isset($_POST['edit'])) {
    $id = strip_tags(trim(intval($_POST['id'])));
    $adresseId = $a->getAdresseById(intval(strip_tags($id)));
    $data = $adresseId->fetchObject();
    $_POST['adresse'] = $data->adresse;
    $_POST['ville'] = $data->ville;
    $_POST['pays'] = $data->pays;
    $_POST['codePostal'] = $data->code_postal;
    $reload = false;
    $modif = true;
}
if (isset($_POST['delete'])) {
    $id = strip_tags(trim(intval($_POST['id'])));
    if ($a->removeAdresse($id)) {
        $sucess = 'Adresse remove sucessfuly';
        $reload = true;
        header("Location: ./dashboard.php?sucess=$sucess");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/table.css">
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style/main.css">
    <title>Adresse</title>
</head>

<body>
    <?php include "../../includes/header.php";
    ?>
    <?php if (isset($_GET["sucess"])) : ?>
        <div class=" w-50 p-3 mx-auto mt-3 mb-2 bg-success text-white text-center"><?= $_GET['sucess'] ?></div>
    <?php endif; ?>
    <form action="" method="POST" class="w-50 mx-auto mt-8">
        <div class="form-group mt-5">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adresse" value="<?= isset($_POST['adresse']) && !$reload  ? $_POST['adresse'] : '' ?>">
            <p class="text-danger"><?= isset($errors['A']) ? $errors['A'] : '' ?></p>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Ville</label>
                <input type="text" class="form-control" id="inputCity" name="ville" value="<?= isset($_POST['ville']) && !$reload ? $_POST['ville']  : '' ?>">
                <p class="text-danger"><?= isset($errors['V']) ? $errors['V'] : '' ?></p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Pays</label>
                <select id="inputState" class="form-control" name="pays">
                    <option value="Afghanistan">Afghanistan </option>
                    <?php if (isset($pays) && !$reload) : ?>
                        <option value=<?= $pays ?> selected="selected"><?= $pays ?> </option>
                    <?php else : ?>
                        <option value="Haiti" selected="selected">Haiti</option>
                    <?php endif; ?>
                    <!-- inclusion des pays -->
                    <?php include "./country.php"; ?>

                </select>
                <p class="text-danger"><?= isset($errors['P']) && !$reload ? $errors['P'] : '' ?></p>
            </div>
            <input type="hidden" name="id" value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>">
            <div class="form-group col-md-2">
                <label for="inputZip">Code Postal</label>
                <input type="text" class="form-control" id="inputZip" name="codePostal" value="<?= isset($_POST['codePostal']) ? $_POST['codePostal']  : '' ?>">
                <p class="text-danger"><?= isset($errors['C']) && !$reload ? $errors['C'] : '' ?></p>
            </div>

        </div>
        <button type="submit" value="<?= isset($modif) ? 'modif' : 'add' ?>" name="addAdresse" class="btn btn-primary"><?= isset($modif) ? 'Modifier' : 'Ajouter' ?></button>
    </form>
    <?php if (($a->getAllAdresse())->rowCount() > 0) : ?>
        <div id="demo" class="position-sticky" style="height: 300px; overflow-y: scroll;">
            <!-- Responsive table starts here -->
            <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
            <div class="table-responsive-vertical shadow-z-1 mt-5 w-70 mx-auto " style="width: 70%; margin:auto; height: 300px;">
                <!-- Table starts here -->
                <table id="table" class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Pays</th>
                            <th>Code Postal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = $allData->fetchObject()) : ?>
                            <tr>
                                <td data-title="Adresse"><?= $data->adresse ?></td>
                                <td data-title="Ville"><?= $data->ville ?></td>
                                <td data-title="Pays">
                                    <?= $data->pays ?>
                                </td>
                                <td data-title="Code Postal"><?= $data->code_postal ?></td>
                                <td data-title="Status">
                                    <form action="" method="POST" class="d-flex aligns-items-center form-action">
                                        <button type="submit" name="edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="svg-edit">
                                                <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path>
                                                <path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                                            </svg>
                                        </button>
                                        <input type="hidden" name="id" value="<?= $data->id ?>">
                                        <button type="submit" name="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="svg-delete">
                                                <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        <?php endif; ?>
</body>

</html>