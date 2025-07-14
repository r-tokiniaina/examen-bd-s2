<?php

include("../inc/functions.php");

$nom = $_POST["nom"];
$date_de_naissance = $_POST["date_de_naissance"];
$genre = $_POST["genre"];
$email = $_POST["email"];
$ville = $_POST["ville"];
$mdp = $_POST["mdp"];
$image_profil = $_POST["image_profil"];

sign_up($nom, $date_de_naissance, $genre, $email, $ville, $mdp, $image_profil); 

header("Location: modele1.php?p=login");

?>
