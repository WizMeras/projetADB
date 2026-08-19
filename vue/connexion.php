<?php
include ("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
        <h1>Connexion</h1>
        <div class="container d-flex justify-content-center align-items-center flex-column col-4 my-2">
            <FORM class="form" style="width: 100%;" method="POST" action="index.php?page=connexion">
                <LABEL class="form-label" for="email">Email:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="email" name="email" id="email" required></INPUT>
                <div class="errorMessage" id="errorEmail"></div> <br>
                <div class="d-flex justify-content-between">
                    <LABEL class="form-label" for="mdp">Mot de passe:</LABEL>
                </div>
                <INPUT class="form-control" style="width: 100%;" type="password" name="mdp" required></INPUT> <br>
                <INPUT class="btn btn-primary" style="width: 100%;" type="submit" name="connexion" value="Se connecter"></INPUT>
            </FORM>
        </div>
    

        <?php
        // Affiche un message si les identifiants de connexion sont invalides
        if(isset($error)){
            echo "<p class='errorMessage'>Email ou mot de passe incorrect</p>";
        }
        ?>

        <div class="container d-flex justify-content-center align-items-center flex-column col-4 my-2">
            <p>Nouveau?</p>
            <a class="btn btn-secondary" style="width: 100%;" href="index.php?page=inscription">S'inscrire</a>
        </div>
    </div>
</body>
<script src="js/connexion.js"></script>
</html>