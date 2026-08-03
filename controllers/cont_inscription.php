<?php
require_once("models/fonction_connexion.php");

if(isset($_POST['inscription'])){
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirmMdp = htmlspecialchars($_POST['confirmMdp']);
    if(emailExistant($email)){
        $error = 2;
    }
    else{
        if($mdp == $confirmMdp){
            $role = 1;
            inscription($pseudo, $email, $mdp, $role);
            header('Location: index.php?page=connexion');
        }
        else{
            $error = 1;
        }
    }
}

include("vue/inscription.php");
?>