<?php
require_once("models/fonction_admin.php");

if(isset($_POST['importer']) && isset($_FILES['csvFile'])){
    $csvFile = htmlspecialchars($_FILES['csvFile']['tmp_name']);
    insertDB($csvFile);
    header("Location: index.php?page=admin");
}

include("vue/import_utilisateurs.php");
?>