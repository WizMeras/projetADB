<?php
require_once("models/fonction_rapport.php");

if(isset($_POST['publier'])){
    $id_utilisateur = $_SESSION['user']['id_utilisateur'];
    $titre = htmlspecialchars(trim($_POST['titre']));
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    $localisation = htmlspecialchars(trim($_POST['localisation']));

    creerRapport($id_utilisateur, $titre, $contenu, $localisation);
    header('Location: index.php?page=accueil');
}

if(isset($_POST['modifier'])){
    $id_rapport = htmlspecialchars($_GET['id']);
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    modifierContenuRapport($id_rapport, $contenu);
    header('Location: index.php?page=rapport&id=' . $id_rapport);
}

include("vue/creation_rapport.php");
?>