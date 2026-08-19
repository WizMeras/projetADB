<?php
// Inclusion du fichier modèle contenant les fonctions de connexion
require_once("models/fonction_connexion.php");

// Vérification si le formulaire de connexion a été soumis
if(isset($_POST['connexion'])){
    // Récupération et nettoyage des données du formulaire
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    
    // Appel de la fonction connexion pour vérifier les identifiants
    $user = connexion($email, $mdp);
    
    // Vérification si la connexion a réussi
    if($user){
        // Stockage des informations de l'utilisateur en session
        $_SESSION['user'] = $user;
        
        // Vérification si l'utilisateur doit modifier son mot de passe
        if($user['modif_mdp'] == 1){
            // Redirection vers la page de modification du profil
            header('Location: index.php?page=modif_profil&modifMdp=obligatoire');
            exit();
        }
        else{
            // Redirection vers la page d'accueil après connexion réussie
            header('Location: index.php?page=accueil');
            exit();
        }
    }
    else{
        // Définition d'une variable d'erreur si la connexion a échoué
        $error = 1;
    }
}

// Inclusion de la vue (affichage) de la page de connexion
include("vue/connexion.php");
?>