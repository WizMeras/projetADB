<?php
require_once("models/fonction_admin.php");
require_once("models/fonction_connexion.php");

if(isset($_POST['creer'])){
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirmMdp = htmlspecialchars($_POST['confirmMdp']);
    $role = htmlspecialchars($_POST['role']);
    if($mdp == $confirmMdp){
        inscription($pseudo, $email, $mdp, $role);
        header('Location: index.php?page=admin');
    }
    else{
        $error = 1;
    }
}

if(isset($_POST['modifier'])){
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    $modif = true;
}

if(isset($_POST['modifierUtilisateur'])){
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    if(!empty($_POST['mdp'])){
        $mdp = htmlspecialchars($_POST['mdp']);
    } else {
        $utilisateur = infoUtilisateur($id_utilisateur);
        $mdp = $utilisateur['mdp'];
    }
    $role = htmlspecialchars($_POST['role']);
    modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp, $role);
    header('Location: index.php?page=admin');
}

if(isset($_POST['supprimer'])){
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    supprimerUtilisateur($id_utilisateur);
    header('Location: index.php?page=admin');
}

include("vue/espace_admin.php");
?>