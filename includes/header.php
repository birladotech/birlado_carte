<?php

$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/rithler_news/";

if (isset($_POST["logout"])) {
    session_start();
    session_destroy();
    session_unset();
    header("Location: $baseUrl ");
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $baseUrl ?>">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $baseUrl . 'src/articles/articles.php' ?>">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Commentaires</a>
                    </li>
                </ul>
                <form class="d-flex" action="" method="POST">
                    <input class="form-control me-2" type="submit" placeholder="logout" aria-label="logout" name="logout" />
                    <button name="logout" class="btn btn-outline-success" type="submit">
                        <?= isset($_SESSION["user"]) ? "Logout" : "Connexion" ?>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>