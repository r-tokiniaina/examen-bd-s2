<?php

include("../inc/functions.php");

$id_objet = $_POST["id_objet"];
$image = $_FILES["image"];

add_object_image($id_objet, $image);

header("Location: modele2.php?p=fiche_objet&id_objet=" . $id_objet);

?>
