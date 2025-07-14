<?php

include("../inc/functions.php"); 

session_start();

$id_membre = $_GET["id_membre"];
$infos = get_member_infos($id_membre)[0]; 
$objets = get_member_objects_ordered_by_category($id_membre);
?>

<h2>Fiche Membre</h2>

<div>
    <img src="../assets/images/<?= $infos["member_pdp"] ?>" width="120">
    <p>Nom: <?= $infos["member_name"] ?></p>
    <p>Date de naissance: <?= $infos["member_dtn"] ?></p>
    <p>Genre: <?= $infos["member_gender"] ?></p>
    <p>Email: <?= $infos["member_email"] ?></p>
    <p>Ville: <?= $infos["member_city"] ?></p>
</div>

<h3>Objets du membre regroupes par categorie</h3>
<?php
$categorie_actuelle = "";

foreach ($objets as $obj) {
    if ($obj["categorie_name"] != $categorie_actuelle) {
        $categorie_actuelle = $obj["categorie_name"];
        echo "<h4>" . $categorie_actuelle . "</h4>";
    }
    echo "<p> - " . $obj["object_name"] . "</p>";
}
?>
