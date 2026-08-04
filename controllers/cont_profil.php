<?php
if(isset($action)){
    switch($action){
        case 'profil':
            include("vue/profil.php");
            break;
        case 'modif_profil':
            require_once("models/fonction_admin.php");
            include("vue/modifier_profil.php");
            break;
        default:
            include("vue/404.php");
    }
}
?>