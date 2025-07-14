<?

session_start();

$id_objet = $_GET["id_objet"];

$prop = false;
$id_membre_connecte = $_SESSION["id_membre_connecte"];

$info_objet = get_object_info($id_objet);
$images = get_objects_images($id_objet);

$prop = ($id_membre_connecte == $info_objet["id_membre"]);

?>

<form action="traitement-add_object_image.php" method="post" enctype="multipart/form-data">
    <label>Ajouter une image</label>
    <input type="file" name="image">

    <input type="submit" value="Ajouter l'image">
</form>

todo: afficher info objet

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
