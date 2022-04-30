<?php
session_start();
// Envoi d'email
if (isset($_POST['contact_post'])) {

    if (isset($_POST['userName']) && !empty($_POST['userName'])) {
        $userName = htmlspecialchars(strip_tags($_POST['userName']));
    } else {
        $erreurs['U'] = "Username  obligatoire";
    }

    if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars(strip_tags($_POST['email']));
    } else {
        $erreurs['E'] = "Email Invalide!";
    }

    if (isset($_POST['subject']) && !empty($_POST['subject'])) {
        $subject = htmlspecialchars(strip_tags($_POST['subject']));
    } else {
        $erreurs['S'] = "sujet obligatoire";
    }

    if (isset($_POST['message']) && !empty($_POST['message'])) {
        $message = htmlspecialchars(strip_tags($_POST['message']));
    } else {
        $erreurs['M'] = "Message   obligatoire";
    }



    if (!(isset($erreurs))) {
        echo '<script>';
        echo 'alert("email envoyez")';
        echo '</script>';
        mail($email, 'Merci de nous avoir envoyer un message a birlado', $message);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../style/style.css" />
    <link rel="stylesheet" href="../../style/contact.css" />
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <title>Birlado - Contact</title>
</head>

<body>
    <!-- header -->
    <?php require "../../includes/header.php"; ?>


    <!-- ligne apres les banners -->
    <div class="row-line" style="margin-top:100px;">
        <div class="right_line"></div>
        <div class="left_line"></div>
    </div>

    <!-- card contact -->
    <div class="card_contact">
        <div>
            <p><img src="./images/icons/location.png" alt="" /></p>
            <h2>Adresse</h2>
            <p>Pétion-ville , ouest , Haïti</p>
        </div>
        <div>
            <p><img src="./images/icons/email.png" alt="" /></p>
            <h2><a href="mailto:birlado4840@gmail.com">Email</a></h2>
            <p>birlado4840@gmail.com</p>
        </div>
        <div>
            <p><img src="./images/icons/phone.png" alt="" /></p>
            <h2>Telephone</h2>
            <p><a href="tel:(509)48403716">(509)48403716</a></p>
        </div>
    </div>
    <!-- main and Formulaire de Contact -->
    <main>
        <div class="text_form">
            <p>Vous avez des questions ?</p>
            <h2>Entrer en contact <span>maintenant </span> ?</h2>
        </div>

        <form action="" method="post" class="form_contact">
            <input type="text" placeholder="Pseudo" name="userName" />
            <input type="email" placeholder="birlado4840@gmail.com" name="email" />
            <input type="text" placeholder="Sujet" class="form_sujet" name="subject" />
            <input type="text" placeholder="Écrivez votre message" name="message" class="form_message" />
            <div class="terms">
                <input type="checkbox" /><label>Termes et conditions</label>
            </div>
            <div class="btn_form">
                <button class="btn_p" type="submit" name="contact_post">Envoyer votre Message</button>
            </div>
        </form>

        <?php if (isset($erreurs)) : ?>
            <?php foreach ($erreurs as $erreur) : ?>
                <div class="erreur">
                    <p><?= $erreur ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <!-- map haiti -->


</body>

</html>