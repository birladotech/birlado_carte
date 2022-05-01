<?php
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/birlado_carte/";

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
            <a class="navbar-brand" href="<?= $baseUrl ?>"><?= isset($_SESSION['user']) ? 'Adresse' : 'Accueil' ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex" style="display:flex; justify-content:space-between;" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $baseUrl . 'src/contact/contact.php' ?>"></a>
                    </li>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?= $baseUrl . 'src/Search/search.php' ?>">Rechercher</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl . 'src/Contact/contact.php' ?>">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl . 'src/About/about.php' ?>">A Propos</a>
                    </li>

                </ul>
                <?php if (isset($_SESSION['user'])) : ?>
                    <form class="d-flex" action="" method="POST">
                        <button name="logout" class="btn btn-outline-success" type="submit">
                            Logout
                        </button>
                    </form>
                <?php else : ?>
                    <form class="d-flex" action="<?= $baseUrl . 'login.php' ?>" method="POST">
                        <button class="btn btn-outline-success" type="submit">
                            Connexion
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>