<?php
include("header.php");
require_once("fonction_connexion.php");

if(isset($_GET['special']) && $_GET['special'] == 'admin'){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouvel utilisateur - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
        <h1>Créer un nouvel utilisateur</h1>
        <div class="container d-flex justify-content-center align-items-center flex-column col-4 my-2">
            <FORM class="form" style="width: 100%;" method="POST" action="controller.php?action=creerUser">
                <LABEL class="form-label" for="pseudo">Nom d'utilisateur:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="text" name="pseudo" required></INPUT> <br>
                <LABEL class="form-label" for="email">Email:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="email" name="email" id="email" required></INPUT>
                <div class="errorMessage" id="errorEmail"></div> <br>
                <LABEL class="form-label" for="mdp">Mot de passe:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="password" name="mdp" required></INPUT> <br>
                <LABEL class="form-label" for="confirmMdp">Confirmer mot de passe:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="password" name="confirmMdp" required></INPUT> <br>
                <LABEL class="form-label" for="role">Rôle:</LABEL> <br>
                <SELECT class="form-select" name="role" required>
                    <option value="1">Utilisateur</option>
                    <option value="2">Administrateur</option>
                </SELECT> <br>
                <INPUT class="btn btn-primary" style="width: 100%;" type="submit" name="creer" value="Créer Utilisateur"></INPUT>
            </FORM>
        </div>
    </div>
</body>
<script src="connexion.js"></script>
</html>

<?php
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
        <h1>Inscription</h1>
        <div class="container d-flex justify-content-center align-items-center flex-column col-4 my-2">
            <FORM class="form" style="width: 100%;" method="POST" action="controller.php?action=inscription">
                <LABEL class="form-label" for="pseudo">Nom d'utilisateur:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="text" name="pseudo" required></INPUT> <br>
                <LABEL class="form-label" for="email">Email:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="email" name="email" id="email" required></INPUT>
                <div class="errorMessage" id="errorEmail"></div> <br>
                <LABEL class="form-label" for="mdp">Mot de passe:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="password" name="mdp" required></INPUT> <br>
                <LABEL class="form-label" for="confirmMdp">Confirmer mot de passe:</LABEL> <br>
                <INPUT class="form-control" style="width: 100%;" type="password" name="confirmMdp" required></INPUT> <br>
                <INPUT class="btn btn-primary" style="width: 100%;" type="submit" name="inscription" value="S'inscrire"></INPUT>
            </FORM>
        </div>

        <?php
        if(isset($error)){
            if($error == 1){
                echo "Les mots de passe ne correspondent pas";
            }
            else if($error == 2){
                echo "Un compte avec cet email existe déjà";
            }
        }
        ?>

        <div class="container d-flex justify-content-center align-items-center flex-column col-4 my-2">
            <p>Déjà membre?</p>
            <a class="btn btn-secondary" style="width: 100%;" href="connexion.php">Se connecter</a>
        </div>
    </div>
</body>
<script src="connexion.js"></script>
</html>

<?php
}
?>