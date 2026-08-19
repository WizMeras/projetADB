<?php
require_once 'fonction.php';

// Récupére le nom de la photo de profil associée à un utilisateur
function fetchPhotoProfil($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT nom_image FROM photo_profil pp JOIN utilisateurs u ON pp.id_image = u.id_image WHERE u.id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetch();
}

// Compte le nombre de rapports publiés par un utilisateur
function nbrePostes($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT COUNT(*) AS nbre_postes FROM rapports WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetch();
}

// Compte le nombre de commentaires publiés par un utilisateur
function nbreCommentaires($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT COUNT(*) AS nbre_commentaires FROM commentaires WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetch();
}

// Récupére tous les rapports publiés par un utilisateur
function fetchRapports($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM rapports WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetchAll();
}

?>