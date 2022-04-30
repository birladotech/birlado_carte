<?php
session_start();

include "./src/DB/DB.php";
include "./src/Models/User.php";


$u = new User(loadDB());

if (isset($_POST['login'])) {

    if (!empty($_POST['email']) and isset($_POST['email'])) {
        $email = htmlspecialchars(htmlentities((trim(strip_tags($_POST['email'])))));
    } else {
        $errors = "Le champ email ne doit pas etre vide";
    }
    if (!empty($_POST['password']) and isset($_POST['password'])) {
        $password = htmlspecialchars(htmlentities((trim(strip_tags($_POST['password'])))));
    } else {
        $errors = "Le champ mot de passe ne doit pas etre vide";
    }

    if (!isset($errors)) {
        if ($data = $u->getUserEmail($email)->fetchObject()) {
            if (password_verify($password, $data->password)) {
                $_SESSION['user'] = [
                    "id" => $data->id,
                    "nom" => $data->nom,
                    "prenom" => $data->prenom,
                    "email" => $data->email,
                ];
                header("Location: ./src/Dashboard/dashboard.php");
            } else {
                $errors = 'Email/password incorrect';
            }
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">
    <title>Login</title>


    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php include_once "./includes/header.php";
    ?>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h1 style="text-align: center;">Connection</h1>
                    <form action="" method="POST">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" value="<?= isset($email) ? $email : '' ?>" />
                            <label class="form-label" for="form1Example13">Addresse Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" />
                            <label class="form-label" for="form1Example23">Mot de passe</label>
                        </div>
                        <p class="text-center text-danger "><?= isset($errors) ? $errors : '' ?></p>

                        <!-- Submit button -->
                        <div class="d-flex">
                            <button type="submit" name="login" style="width: 200px; margin-right:auto;" class="btn btn-primary btn-block mb-4 ">
                                Se Connecter
                            </button>

                            <a style="text-decoration:none; color:white;" href="./index.php">
                                <div class="btn btn-primary btn-block mb-4  " style="width: 200px;">S'enregistrer</div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>