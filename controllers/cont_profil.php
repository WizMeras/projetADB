<?php
if(isset($action) && $action == 'profil'){
    include("vue/profil.php");
}
elseif(isset($action) && $action == 'modif_profil'){
    require_once("models/fonction_admin.php");
    include("vue/modifier_profil.php");
}
else{
    include("vue/404.php");
}
?>