<?php

include("../inc/functions.php");

session_start();

$id_membre = $_SESSION["id_membre_connecte"];

$id_objet = $_POST["id_objet"];
$nb_jours_emprunt = $_POST["nb_jours_emprunt"];

emprunter_object($id_objet, $id_membre, $nb_jours_emprunt);

header("Location: modele2.php?p=home");

?>
