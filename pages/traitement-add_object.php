<?php

include("../inc/functions.php");

session_start();

$id_membre = $_SESSION["id_membre_connecte"];

$nom_objet = $_POST["nom_objet"];
$id_categorie = $_POST["id_categorie"];

$id_objet = add_object($nom_objet, $id_categorie, $id_membre);
if ($image != null) {
    add_object_image($id_objet, $image);
}

header("Location: modele2.php?p=fiche_objet&id_objet=" . $id_objet);

?>
