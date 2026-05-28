<?php
require_once 'fonction.php';

function fetchPhotoProfil($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT nom_image FROM photo_profil pp JOIN utilisateurs u ON pp.id_image = u.id_image WHERE u.id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $id_utilisateur
    ));
    return $req->fetch();
}

function nbrePostes($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT COUNT(*) AS nbre_postes FROM rapports WHERE id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $id_utilisateur
    ));
    return $req->fetch();
}

function nbreCommentaires($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT COUNT(*) AS nbre_commentaires FROM commentaires WHERE id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $id_utilisateur
    ));
    return $req->fetch();
}

function fetchRapports($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM rapports WHERE id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $id_utilisateur
    ));
    return $req->fetchAll();
}

?>