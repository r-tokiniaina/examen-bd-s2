<?php

include("sql_database.php");

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
    $query = query_db_and_get_result_array($query);                 
}

function get_objects_list($id_categorie){
    $query = "SELECT marche_objet.nom_objet AS nom_objet,
                     marche_emprunt.date_retour AS date_retour
                 FROM marche_objet 
                 JOIN marche_emprunt
                    ON marche_objet.id_objet = marche_emprunt.id_objet
                 JOIN marche_categorie_objet
                    ON marche_objet.id_categorie = marche_categorie_objet.id_categorie    
              WHERE marche_categorie_objet.id_categorie = %s";
              
}
?>
