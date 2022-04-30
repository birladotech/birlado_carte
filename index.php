<?php
session_start();

require_once "./src/DB/DB.php";
require_once "./src/Models/User.php";




if (isset($_SESSION["user"])) {
  header("Location: $baseUrl src/Dashboard/dashboard.php");
}

$u = new User(loadDB());

if (isset($_POST["register"])) {

  if (!empty($_POST['firstname']) and isset($_POST['firstname'])) {
    $firstname = htmlspecialchars(htmlentities(trim(strip_tags($_POST['firstname']))));
  } else {
    $errors["F"] = "Le prenom ne doit pas etre vide";
  }

  if (!empty($_POST['lastname']) and isset($_POST['lastname'])) {
    $lastname = htmlspecialchars(htmlentities(trim(strip_tags($_POST['lastname']))));
  } else {
    $errors["L"] = "Le nom ne doit pas etre vide";
  }

  if (!empty($_POST['email']) and isset($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = htmlspecialchars(htmlentities(trim(strip_tags($_POST['email']))));
    } else {
      $errors["E"] = "Email invalide";
    }
  } else {
    $errors["E"] = "L'email ne doit pas etre vide";
  }

  if (!empty($_POST['adresse']) and isset($_POST['adresse'])) {
    $adresse = htmlspecialchars(htmlentities(trim(strip_tags($_POST['adresse']))));
  } else {
    $errors["P"] = "L'adresse ne doit pas etre vide";
  }

  if (!empty($_POST['password']) and isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  } else {
    $errors["PA"] = "password ne doit pas etre vide";
  }

  if (!empty($_POST['cfPassword']) and isset($_POST['cfPassword'])) {
    if ($_POST['cfPassword'] == $_POST['password']) {
      $cfPassword = $_POST['cfPassword'];
    } else {
      $errors['CP'] = "Mot passe non identique";
    }
  } else {
    $errors["CP"] = "la confirmation du password ne doit pas etre vide";
  }


  if (!isset($errors)) {
    $user = [
      "nom" => $firstname,
      "prenom" => $lastname,
      "email" => $email,
      "adresse" => $adresse,
      "password" => $password
    ];

    if ($u->register($user)) {
      header("Location: $baseUrl login.php");
    } else {
      $errors['E'] = "L'email existe déjà";
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">
  <title>Accueil</title>
</head>

<body>
  <?php require_once "./includes/header.php";
  ?>

  <!-- Section: Design Block -->
  <section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight">
              The best offer <br />
              <span class="text-primary">for your business</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Eveniet, itaque accusantium odio, soluta, corrupti aliquam
              quibusdam tempora at cupiditate quis eum maiores libero
              veritatis? Dicta facilis sint aliquid ipsum atque?
            </p>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                <form action="" method="POST">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1" class="form-control" name="firstname" value="<?= isset($firstname) ? $firstname : '' ?>" />
                        <label class="form-label" for="form3Example1">First name</label>
                      </div>
                      <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['F']) ? $errors['F'] : '' ?></p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example2" class="form-control" name="lastname" value="<?= isset($lastname) ? $lastname : '' ?>" />
                        <label class="form-label" for="form3Example2">Last name</label>
                      </div>
                      <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['L']) ? $errors['L'] : '' ?></p>
                    </div>
                  </div>

                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="form3Example3" class="form-control" name="email" value="<?= isset($email) ? $email : '' ?>" />
                    <label class="form-label" for="form3Example3">Email address</label>
                    <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['E']) ? $errors['E'] : '' ?></p>
                  </div>

                  <!-- adresse input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="form79Example79" class="form-control" name="adresse" value="<?= isset($adresse) ? $adresse : '' ?>" />
                    <label class="form-label" for="form79Example79">Adresse</label>
                    <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['A']) ? $errors['A'] : '' ?></p>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="form3Example4" class="form-control" name="password" />
                    <label class="form-label" for="form3Example4">Password</label>
                    <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['PA']) ? $errors['PA'] : '' ?></p>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="form3Example4" class="form-control" name="cfPassword" />
                    <label class="form-label" for="form3Example4">Confirmation de mot de passe</label>
                    <p style="color:red;" class="d-flex justify-content-center"><?= isset($errors['CP']) ? $errors['CP'] : '' ?></p>

                  </div>

                  <!-- Checkbox -->
                  <div class="form-check text-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" required />
                    <label class="form-check-label" for="form2Example33">
                      Terms et conditions
                    </label>
                  </div>

                  <!-- Submit button -->
                  <div class="d-flex">
                    <button type="submit" name="register" style="width: 200px; margin-right:auto;" class="btn btn-primary btn-block mb-4 ">
                      S'enregistrer
                    </button>

                    <a style="text-decoration:none; color:white;" href="./login.php">
                      <div class="btn btn-primary btn-block mb-4  " style="width: 200px;">Connection</div>
                    </a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->
</body>

</html>