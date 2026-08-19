<?php
// Oriente la requete vers la page de profil demandee
if(isset($action)){
    switch($action){
        // Affiche le profil de l'utilisateur.
        case 'profil':
            include("vue/profil.php");
            break;
        // Charge les fonctions necessaires et affiche la page du formulaire de modification
        case 'modif_profil':
            require_once("models/fonction_admin.php");
            include("vue/modifier_profil.php");
            break;
        // Affiche une page 404 si l'action demandee est inconnue
        default:
            include("vue/404.php");
    }
}
?>