<?php

include("sql_database.php");

function upload($file, $nouveau_nom)
{
    $mimes_images = ["image/jpeg", "image/png"];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $mimes_images)) {
        die('Type de fichier non autorisé : ' . $mime); 
    } 

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $nom_fichier = $nouveau_nom . "." . $extension;
    $path = __DIR__ . "/../assets/images/" . $nom_fichier;

    move_uploaded_file($file['tmp_name'], $path);

    return $nom_fichier;
}

function login($email, $mdp)
{
    $query = "SELECT id_membre
                FROM marche_membre
               WHERE email = '%s'
                     AND mdp = '%s'";
    $query = sprintf($query, $email, $mdp);
    $result = query_db_and_get_result_array($query);

    $returned_result = array();
    if (count($result) == 0) {
        $returned_result['error'] = "error";
    }
    else {
        $returned_result['error'] = null;
        $returned_result['id'] = $result[0]['id_membre'];
    }

    return $returned_result;
}

function sign_up($nom, $date_naisssance, $genre, $email, $ville,$mdp, $pdp){
    $query = " INSERT INTO marche_membre 
                    (nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
                    ('%s' , '%s', '%s', '%s', '%s', '%s', '%s' )";
    $query = sprintf($query, $nom, $date_naisssance, $genre, $email, $ville,$mdp, $pdp);
    query_db_without_result($query);
}

function get_categories()
{
    $query = "SELECT id_categorie,
                     nom_categorie
                FROM marche_categorie_objet
             ";
    $result = query_db_and_get_result_array($query);
    return $result;
}

function get_objects_list($id_categorie, $object_name, $selection)
{
    $query = "SELECT o.nom_objet AS nom_objet,
                     e.date_retour AS date_retour,
                     co.nom_categorie AS nom_categorie
                FROM marche_objet AS o
                JOIN marche_emprunt AS e
                     ON o.id_objet = e.id_objet
                        AND NOW() BETWEEN e.date_emprunt AND e.date_retour
                JOIN marche_categorie_objet AS co
                     ON o.id_categorie = co.id_categorie
                        AND (o.id_categorie = %s)
               UNION
              SELECT o.nom_objet,
                     '0000-00-00',
                     co.nom_categorie AS nom_categorie
                FROM marche_objet AS o
                JOIN marche_categorie_objet AS co
                     ON o.id_categorie = co.id_categorie
                        AND (o.id_categorie = %s)
                WHERE o.nom_objet = '%s' AND co.id_categorie IN (%s)          
             ";

    if ($id_categorie == "*") {
        $id_categorie = "0 OR 0=0";
    }

    $query = sprintf($query, $id_categorie, $id_categorie);

    $result = query_db_and_get_result_array($query);
    return $result;
}

function get_member_infos($id_membre){
    $query = "SELECT marche_membre.nom AS member_name, 
                     marche_membre.date_de_naissance AS member_dtn, 
                     marche_membre.genre AS member_gender, 
                     marche_membre.email AS member_email, 
                     marche_membre.ville AS member_city, 
                     marche_membre.image_profil AS member_pdp
                 FROM marche_membre
                 WHERE marche_membre.id_membre = %s";
    $query = sprintf($query, $id_membre);
    $result = query_db_and_get_result_array($query);
    return $result;
}

function get_member_object($id_membre, $id_categorie){
    $query = "SELECT marche_membre.nom AS member_name,
                     marche_objet.nom_objet AS object_name,
                     marche_categorie_objet.nom_categorie AS categorie_name
                 FROM marche_membre
                    JOIN marche_objet
                        ON marche_membre.id_membre = marche_objet.id_membre
                    JOIN marche_categorie_objet
                        ON marche_objet.id_categorie = marche_categorie_objet.id_categorie
                WHERE marche_membre.id_membre = %s 
                    AND marche_categorie_objet.id_categorie = %s";
    $query = sprintf($query, $id_membre, $id_categorie);
    $result = query_db_and_get_result_array($query);
    return $result;
}

function add_object($nom_objet, $id_categorie, $id_membre)
{
    $query = "INSERT INTO marche_objet(nom_objet, id_categorie, id_membre)
              VALUES ('%s', %s, %s)";
    $query = sprintf($query, $nom_objet, $id_categorie, $id_membre);
    $id_objet = query_db_and_get_inserted_id($query);
    return $id_objet;
}

function add_object_image($id_objet, $image)
{
    $nom_image = uniqid();
    $nom_image = upload($image, $nom_image);

    $query = "INSERT INTO marche_images_objet(id_objet, nom_image)
              VALUES (%s, '%s')";
    $query = sprintf($query, $id_objet, $nom_image);
    query_db_without_result($query);
}

function remove_object_image($id_image)
{
    $query = "DELETE FROM marche_images_objet
               WHERE id_image = %s";
    $query = sprintf($query, $id_image);
    query_db_without_result($query);
}

?>
