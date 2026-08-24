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
    <form action="index.php?page=import" method="POST" enctype="multipart/form-data">
        <label for="csvFile">Choisir un fichier CSV :</label>
        <input type="file" name="csvFile" accept=".csv" required>
        <button type="submit" name="importer">Importer</button>
    </form>
</body>
</html>