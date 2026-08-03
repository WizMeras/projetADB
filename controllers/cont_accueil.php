<?php
require_once("models/fonction_accueil.php");

if(isset($_POST['deconnexion'])){
    session_destroy();
    header('Location: index.php?page=accueil');
}

include("vue/accueil.php");
?>