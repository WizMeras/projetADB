<?php
require_once 'fonction.php';

function connexion($email, $mdp){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE email = :email AND mdp = :mdp');
    $req->execute(array(
        'email' => $email,
        'mdp' => $mdp
    ));
    return $req->fetch();
} 

function inscription($pseudo, $email, $mdp, $role){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('INSERT INTO utilisateurs(pseudo, email, mdp, role, date_creation, id_image) VALUES (:pseudo, :email, :mdp, :role, :date_creation, :id_image)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'email' => $email,
        'mdp' => $mdp,
        'role' => $role,
        'date_creation' => date('Y-m-d'),
        'id_image' => "1"
    ));
}

function emailExistant($email){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE email = :email');
    $req->execute(array(
        'email' => $email
    ));
    if($req->fetch()){
        return true;
    } else {
        return false;
    }
}
?>