<?php
require_once 'fonction.php';

// Récupére la liste des utilisateurs, du plus recent au plus ancien
function listeUtilisateurs(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs ORDER BY id_utilisateur DESC');
    $req->execute();
    return $req->fetchAll();
}

// Récupére les informations d'un utilisateur a partir de son identifiant
function infoUtilisateur($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
    return $req->fetch();
}

// Modifie le pseudo d'un utilisateur
function modifierPseudo($id_utilisateur, $pseudo){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET pseudo = :pseudo WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'pseudo' => $pseudo
    ]);
}

// Modifie l'adresse e-mail d'un utilisateur
function modifierEmail($id_utilisateur, $email){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET email = :email WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'email' => $email
    ]);
}

// Modifie le mot de passe d'un utilisateur
function modifierMdp($id_utilisateur, $mdp){
    $mysqlClient = connectDatabase();
    $modifMdp = 0; // Réinitialise le flag de modification du mot de passe
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET mdp = :mdp, modif_mdp = :modifMdp WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'mdp' => $mdp,
        'modifMdp' => $modifMdp
    ]);
    $_SESSION['user']['modif_mdp'] = $modifMdp; // Met à jour la session pour refléter le changement
}

// Modifie l'ensemble des informations administrables d'un utilisateur
function modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp, $role, $modifMdp){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET pseudo = :pseudo, email = :email, mdp = :mdp, role = :role, modif_mdp = :modifMdp WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'pseudo' => $pseudo,
        'email' => $email,
        'mdp' => $mdp,
        'role' => $role,
        'modifMdp' => $modifMdp
    ]);
}

// Supprime un utilisateur a partir de son identifiant
function supprimerUtilisateur($id_utilisateur){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur
    ]);
}

// Enregistre une nouvelle photo de profil et retourne son nom de fichier
function uploadPp(){
    $uid = uniqid();
    $image = $uid . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $uid . $_FILES['photo']['name']);
    $mysqlClient = connectDatabase();
    // Conserve le nom de l'image en base pour pouvoir la retrouver ensuite.
    $req = $mysqlClient->prepare('INSERT INTO photo_profil(nom_image) VALUES (:nom_image)');
    $req->execute([
        'nom_image' => $image
    ]);
    return $image;
}

// Récupére l'identifiant en base correspondant au nom d'une image.
function getImageId($nom_image){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT id_image FROM photo_profil WHERE nom_image = :nom_image');
    $req->execute([
        'nom_image' => $nom_image
    ]);
    $id_image = $req->fetch();
    return $id_image['id_image'];
}

// Associe une photo de profil existante a un utilisateur
function modifierPp($id_utilisateur, $id_image){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE utilisateurs SET id_image = :id_image WHERE id_utilisateur = :id_utilisateur');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'id_image' => $id_image
    ]);
}

function insertDB($filename){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('LOAD DATA INFILE :filename INTO TABLE utilisateurs FIELDS TERMINATED BY "," LINES TERMINATED BY "\n" IGNORE 1 ROWS ( pseudo, email, mdp, role, date_creation)');
    $req->execute([
        'filename' => $filename
    ]);
}
?>