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

?>
