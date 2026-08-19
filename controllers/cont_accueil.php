<?php
// Inclusion du fichier modèle contenant les fonctions de la page d'accueil
require_once("models/fonction_accueil.php");

// Vérification si l'utilisateur a cliqué sur le bouton de déconnexion
if(isset($_POST['deconnexion'])){
    // Destruction de la session utilisateur
    session_destroy();
    // Redirection vers la page d'accueil
    header('Location: index.php?page=accueil');
}

// Inclusion de la vue (affichage) de la page d'accueil
include("vue/accueil.php");
?>