<?php
require_once 'fonction.php';

function listeUtilisateurs(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs ORDER BY id_utilisateur DESC');
    $req->execute();
    return $req->fetchAll();
}

function infoUtilisateur($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetch();
}

function modifierPseudo($id_utilisateur, $pseudo){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET pseudo = :pseudo WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'pseudo' => $pseudo
    ]);
}

function modifierEmail($id_utilisateur, $email){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET email = :email WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'email' => $email
    ]);
}

function modifierMdp($id_utilisateur, $mdp){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET mdp = :mdp WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'mdp' => $mdp
    ]);
}

function modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp, $role){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET pseudo = :pseudo, email = :email, mdp = :mdp, role = :role WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'pseudo' => $pseudo,
        'email' => $email,
        'mdp' => $mdp,
        'role' => $role
    ]);
}

function supprimerUtilisateur($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
}

function uploadPp(){
    $uid = uniqid();
    $image = $uid . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $uid . $_FILES['photo']['name']);
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('INSERT INTO photo_profil(nom_image) VALUES (:nom_image)');
    $req->execute([
        'nom_image' => $image
    ]);
    return $image;
}

function getImageId($nom_image){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT id_image FROM photo_profil WHERE nom_image = :nom_image');
    $req->execute([
        'nom_image' => $nom_image
    ]);
    $id_image = $req->fetch();
    return $id_image['id_image'];
}

function modifierPp($id_utilisateur, $id_image){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET id_image = :id_image WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'id_image' => $id_image
    ]);
}
?>