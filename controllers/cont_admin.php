<?php
// Inclusion des fichiers modèles contenant les fonctions d'administration et de connexion
require_once("models/fonction_admin.php");
require_once("models/fonction_connexion.php");

// Création d'un nouvel utilisateur
if(isset($_POST['creer'])){
    // Récupération et nettoyage des données du formulaire
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirmMdp = htmlspecialchars($_POST['confirmMdp']);
    $role = htmlspecialchars($_POST['role']);
    
    // Vérification que les deux mots de passe correspondent
    if($mdp == $confirmMdp){
        // Appel de la fonction d'inscription avec le rôle
        inscription($pseudo, $email, $mdp, $role);
        // Redirection vers la page admin après création
        header('Location: index.php?page=admin');
    }
    else{
        // Définition d'une variable d'erreur si les mots de passe ne correspondent pas
        $error = 1;
    }
}

// Condition pour afficher le formulaire de modification d'un utilisateur
if(isset($_POST['modifier'])){
    // Récupération de l'ID de l'utilisateur à modifier
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    // Flag indiquant que le formulaire de modification doit être affiché
    $modif = true;
}

// Modification d'un utilisateur existant
if(isset($_POST['modifierUtilisateur'])){
    // Récupération et nettoyage des données du formulaire
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    
    // Vérification si le mot de passe a été modifié
    if(!empty($_POST['mdp'])){
        // Si un nouveau mot de passe est fourni
        $mdp = htmlspecialchars($_POST['mdp']);
        $modifMdp = 1; // Flag pour indiquer une modification du mot de passe
    } else {
        // Si aucun mot de passe n'est fourni, on récupère l'ancien mot de passe
        $utilisateur = infoUtilisateur($id_utilisateur);
        $mdp = $utilisateur['mdp'];
        $modifMdp = 0; // Flag pour indiquer qu'il n'y a pas de modification du mot de passe
    }
    
    // Récupération du rôle
    $role = htmlspecialchars($_POST['role']);
    
    // Appel de la fonction de modification avec les paramètres
    modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp, $role, $modifMdp);
    // Redirection vers la page admin après modification
    header('Location: index.php?page=admin');
}

// Suppression d'un utilisateur
if(isset($_POST['supprimer'])){
    // Récupération de l'ID de l'utilisateur à supprimer
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    // Appel de la fonction de suppression
    supprimerUtilisateur($id_utilisateur);
    // Redirection vers la page admin après suppression
    header('Location: index.php?page=admin');
}

// Inclusion de la vue (affichage) de l'espace administrateur
include("vue/espace_admin.php");
?>