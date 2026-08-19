<?php
require_once("models/fonction_rapport.php");

// Traite la soumission du formulaire de creation d'un rapport
if(isset($_POST['publier'])){
    $id_utilisateur = $_SESSION['user']['id_utilisateur'];
    $titre = htmlspecialchars(trim($_POST['titre']));
    // Conserve les retours a la ligne tout en echappant le contenu saisi
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    $localisation = htmlspecialchars(trim($_POST['localisation']));

    creerRapport($id_utilisateur, $titre, $contenu, $localisation);
    // Retourne a l'accueil apres la creation du rapport
    header('Location: index.php?page=accueil');
}

// Traite la soumission du formulaire de modification d'un rapport existant
if(isset($_POST['modifier'])){
    $id_rapport = htmlspecialchars($_GET['id']);
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    modifierContenuRapport($id_rapport, $contenu);
    // Retourne vers le rapport modifié pour afficher son nouveau contenu
    header('Location: index.php?page=rapport&id=' . $id_rapport);
}

// Affiche le formulaire de creation ou de modification
include("vue/creation_rapport.php");
?>