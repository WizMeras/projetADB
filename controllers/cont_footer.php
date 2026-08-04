<?php
if(isset($action)){
    switch($action){
        case 'contact':
            include("vue/contact.php");
            break;
        case 'vie_privee':
            include("vue/vie_privee.php");
            break;
        case 'conditions':
            include("vue/conditions_generales.php");
            break;
        default:
            include("vue/404.php");
    }
}


?>