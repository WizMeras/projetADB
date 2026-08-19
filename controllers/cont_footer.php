<?php
// Oriente la requete vers la page secondaire demandee
if(isset($action)){
    switch($action){
        // Affiche la page de contact
        case 'contact':
            include("vue/contact.php");
            break;
        // Affiche la page relative a la vie privee
        case 'vie_privee':
            include("vue/vie_privee.php");
            break;
        // Affiche les conditions generales d'utilisation
        case 'conditions':
            include("vue/conditions_generales.php");
            break;
        // Affiche une page 404 si l'action demandée est inconnue
        default:
            include("vue/404.php");
    }
}


?>