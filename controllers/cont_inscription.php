<?php
require_once("models/fonction_connexion.php");

// Traite la soumission du formulaire d'inscription
if(isset($_POST['inscription'])){
    // Nettoie les valeurs saisies avant de les transmettre au modele
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirmMdp = htmlspecialchars($_POST['confirmMdp']);

    // Signale une erreur si l'adresse e-mail est deja utilisée
    if(emailExistant($email)){
        $error = 2;
    }
    else{
        // Verifie que les deux mots de passe correspondent
        if($mdp == $confirmMdp){
            $role = 1;
            inscription($pseudo, $email, $mdp, $role);
            // Redirige vers la page de connexion apres l'inscription
            header('Location: index.php?page=connexion');
        }
        else{
            // Signale une erreur lorsque les mots de passe sont differents
            $error = 1;
        }
    }
}

// Affiche le formulaire d'inscription et les eventuels messages d'erreur
include("vue/inscription.php");
?>