<?php

include("../inc/functions.php");

$page_a_afficher = $_GET["p"];

$title_page = "";
switch ($page_a_afficher) {
    case 'login':
        $title_page = "Connexion";
        break;
    case 'signup':
        $title_page = "Inscription";
        break;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" href="../assets/icons/favicon.svg" type="image/svg">
    <title><?= $title_page ?></title>
</head>
<body>
    <header>
    <nav class="bg-body-tertiary navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Marche</a>

            <div class="collapse navbar-collapse" id="pages">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="fiche_membre.php?id_membre=1">Fiche Membre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $page_a_afficher ?>.php">Autre Page</a>
                    </li>
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pages">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>


    <main class="container">
        <?php include($page_a_afficher . ".php"); ?>
    </main>


    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
