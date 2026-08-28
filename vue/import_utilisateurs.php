<?php
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importer Utilisateurs - PenguinWatch</title>
</head>
<body>
    <div class="container-fluid d-flex flex-column" style="height: 90vh;">
        <div class="d-flex justify-content-center">
            <h1>Importer Utilisateurs</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-column" style="height:80%;">
            <form class="form-group" action="index.php?page=import" method="POST" enctype="multipart/form-data">
                <label class="form-label" for="csvFile">Choisir un fichier CSV :</label>
                <input class="form-control" type="file" name="csvFile" accept=".csv" required> </br>
                <button class="btn btn-primary" type="submit" name="importer">Importer</button>
            </form>
        </div>
    </div>
</body>
</html>