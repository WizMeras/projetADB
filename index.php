<?php
session_start();
date_default_timezone_set('Europe/Brussels');
require_once("models/fonction_profil.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 'accueil';
}

switch($page){
    case 'accueil':
        require_once("controllers/cont_accueil.php");
        break;
    case 'connexion':
        require_once("controllers/cont_connexion.php");
        break;
    case 'inscription':
        require_once("controllers/cont_inscription.php");
        break;
    case 'profil':
        require_once("controllers/cont_profil.php");
        break;
    case 'creation':
        require_once("controllers/cont_creation.php");
        break;
    case 'rapport':
        require_once("controllers/cont_rapport.php");
        break;
    case 'admin':
        require_once("controllers/cont_admin.php");
        break;
    default:
        include("vue/404.php");
}
?>