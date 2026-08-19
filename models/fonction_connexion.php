<?php
require_once 'fonction.php';

// Vérifie qu'il existe un utilisateur correspondant aux identifiants fournis
function connexion($email, $mdp){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE email = :email AND mdp = :mdp');
    $req->execute([
        'email' => $email,
        'mdp' => $mdp
    ]);
    return $req->fetch();
} 

// Crée un compte utilisateur avec une date et une image de profil par défaut
function inscription($pseudo, $email, $mdp, $role){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('INSERT INTO utilisateurs(pseudo, email, mdp, role, date_creation, id_image) VALUES (:pseudo, :email, :mdp, :role, :date_creation, :id_image)');
    $req->execute([
        'pseudo' => $pseudo,
        'email' => $email,
        'mdp' => $mdp,
        'role' => $role,
        'date_creation' => date('Y-m-d'),
        // L'image 1 correspond à la photo de profil par défaut
        'id_image' => "1"
    ]);
}

// Vérifie si une adresse e-mail est déjà associée à un compte.
function emailExistant($email){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE email = :email');
    $req->execute([
        'email' => $email
    ]);
    if($req->fetch()){
        return true;
    } else {
        return false;
    }
}
?>