<?php

include("../inc/functions.php");

$id_objet = $_GET["id_objet"];
$id_image = $_GET["id_image"];

remove_object_image($id_image);

header("Location: modele2.php?p=fiche_objet&id_objet=" . $id_objet);

?>
