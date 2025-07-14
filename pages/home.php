<?php

$id_categorie = isset($_GET["id_categorie"]) ? $_GET["id_categorie"] : "*";
$categories = get_categories();
$objects = get_objects_list($id_categorie);

?>


<h3>Ajouter un objet...</h3>
<form action="traitement-add_object.php" method="post" enctype="multipart/form-data">
    <label>Nom</label>
    <input type="text" name="nom_objet">
    <label>Categorie</label>
    <select name="id_categorie">
        <?php foreach ($categories as $cat) { ?>
            <option value="<?= $cat["id_categorie"] ?>"><?= $cat["nom_categorie"] ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Ajouter">
</form>

<h3>Filtrer les objets</h3>
<form action="modele2.php" method="get">
    <input type="hidden" name="p" value="home">

    <label>Categorie</label>

    <select name="id_categorie">
        <option value="*">Tous</option>
        <?php foreach ($categories as $cat) { ?>
            <option value="<?= $cat["id_categorie"] ?>"><?= $cat["nom_categorie"] ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Filtrer">
</form>

<h1>Liste des objets</h1>
<table class="table table-striped table-hover">
    <tr>
        <th>Objet</th>
        <th>Categorie</th>
        <th>Disponibilite</th>
    </tr>
    <?php foreach ($objects as $obj) { ?>
        <tr>
            <td>
                <a href="modele2.php?p=fiche_objet&id_objet=<?= $obj["id_objet"] ?>"><?= $obj["nom_objet"] ?></a>
            </td>
            <!-- <td><?= $obj["nom_objet"] ?></td> -->
            <td><?= $obj["nom_categorie"] ?></td>
            <td>
                <?php if ($obj["date_retour"] != "0000-00-00") { ?>
                    Disponible le <?= $obj["date_retour"] ?>
                <?php } else { ?>
                    Disponible
                    <form action="traitement-emprunt.php" method="post">
                        <input type="hidden" name="id_objet" value="<?= $obj["id_objet"] ?>">
                        <label>Emprunter pour </label>
                        <input type="number" name="nb_jours_emprunt">
                        <label>jours</label>
                        <input type="submit" value="Emprunter">
                    </form>
                <?php } ?>
        </tr>
    <?php } ?>
</table>
