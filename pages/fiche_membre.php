<?php
    $id_membre = $_GET['id_membre'];
    $id_categorie = $_GET['id_categorie'];
    $member_infos = get_member_infos($id_membre);
    $member_objects = get_member_object($id_membre, $id_categorie);
    
?>