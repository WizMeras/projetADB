<?php
require_once("models/fonction_connexion.php");

if(isset($_POST['connexion'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $user = connexion($email, $mdp);
    if($user){
        $_SESSION['user'] = $user;
        header('Location: index.php?page=accueil');
    }
    else{
        $error = 1;
    }
}

include("vue/connexion.php");
?>