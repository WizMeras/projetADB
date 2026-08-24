<?php
// Initialise la session et le fuseau horaire utilisés par l'application
session_start();
date_default_timezone_set('Europe/Brussels');
require_once("models/fonction_profil.php");

// Récupére la page demandée ou utilise l'accueil par defaut
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 'accueil';
}

if(isset($_SESSION['user']) && $_SESSION['user']['modif_mdp'] == 1){
    // Redirection vers la page de modification du profil si l'utilisateur doit modifier son mot de passe
    $page = 'modif_profil';
    $modifMdp = 'obligatoire';
}

// Oriente la requéte vers le controleur correspondant a la page
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
        $action = 'profil';
        require_once("controllers/cont_profil.php");
        break;
    case 'modif_profil':
        $action = 'modif_profil';
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
    case 'contact':
        $action = 'contact';
        require_once("controllers/cont_footer.php");
        break;
    case 'vie_privee':
        $action = 'vie_privee';
        require_once("controllers/cont_footer.php");
        break;
    case 'conditions':
        $action = 'conditions';
        require_once("controllers/cont_footer.php");
        break;
    case 'import':
        require_once("controllers/cont_import.php");
        break;
    default:
        include("vue/404.php");
}
?>