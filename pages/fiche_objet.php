<?

session_start();

$id_objet = $_GET["id_objet"];

$prop = false;
$id_membre_connecte = $_SESSION["id_membre_connecte"];

$info_objet = get_object_infos($id_objet);
$images = get_object_images($id_objet);
$emprunts = get_object_emprunts($id_objet);

$prop = ($id_membre_connecte == $info_objet["id_membre"]);

?>

<?php if ($prop) { ?>
    <form action="traitement-add_object_image.php" method="post" enctype="multipart/form-data">
        <label>Ajouter une image</label>
        <input type="file" name="image">

        <input type="submit" value="Ajouter l'image">
    </form>
<?php } ?>

<div>
    <p>Objet: <?= $info_objet["nom_objet"] ?></p>
    <p>Categorie: <?= $info_objet["nom_categorie"] ?></p>
    <p>Proprietaire: <?= $info_objet["nom_membre"] ?></p>
</div>

<div>
    <?php foreach ($images as $img) { ?>
        <img src="../assets/images/<?= $img["nom_image"] ?>">
        <?php if ($prop) { ?>
            <a href="traitement-remove_object_image.php?id_image=<?= $img["id_image"] ?>">
                Supprimer l'image
            </a>
        <?php } ?>
    <?php } ?>
</div>

<h3>Historique des emprunts</h3>
<table>
    <tr>
        <th>Membre</th>
        <th>Depuis</th>
        <th>Jusqu'a</th>
    </tr>
    <?php foreach ($emprunts as $emp) { ?>
        <tr>
            <td><?= $emp["nom_membre"] ?></td>
            <td><?= $emp["date_emprunt"] ?></td>
            <td><?= $emp["date_retour"] ?></td>
        </tr>
    <?php } ?>
</div>
