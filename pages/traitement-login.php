<?php

include("../inc/functions.php");

session_start();

$email = $_POST["email"];
$mdp = $_POST["mdp"];

$result = login($email, $mdp);

if ($result['error'] != null) {
    header("Location: modele1.php?p=login&erreur=" . $result['error']);
}
else {
    $_SESSION["id_membre_connecte"] = $result['id'];
    header("Location: modele2.php?p=home");
}

?>
