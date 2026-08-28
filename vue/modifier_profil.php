<?php
include ("header.php");

// Réserve la modification du profil aux utilisateurs connectés
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];

    if(isset($_GET['modifMdp']) && $_GET['modifMdp'] === 'obligatoire'){
        echo "<div class='alert alert-warning' role='alert'>Vous devez modifier votre mot de passe avant de continuer.</div>";
    }

    // Traite le remplacement de la photo de profil
    if(isset($_POST['modifierPp'])){
        $image = uploadPp();
        $id_image = getImageId($image);
        modifierPp($id_utilisateur, $id_image);
        header("Location: index.php?page=profil");
    }

    // Traite la modification du pseudo
    if(isset($_POST['modifierPseudo'])){
        $nouveauPseudo = $_POST['pseudo'];
        modifierPseudo($id_utilisateur, $nouveauPseudo);
        header("Location: index.php?page=profil");
    }

    // Traite la modification de l'adresse e-mail
    if(isset($_POST['modifierEmail'])){
        $nouvelEmail = $_POST['email'];
        modifierEmail($id_utilisateur, $nouvelEmail);
        header("Location: index.php?page=profil");
    }

    // Modifie le mot de passe uniquement si les deux saisies correspondent
    if(isset($_POST['modifierMdp'])){
        $nouveauMdp = $_POST['mdp'];
        $confMdp = $_POST['confMdp'];
        if($nouveauMdp === $confMdp){
            modifierMdp($id_utilisateur, $nouveauMdp);
            header("Location: index.php?page=profil");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profil - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex align-items-center flex-column" style="height: 90vh;">
        <div>
            <h1>Modifier profil de <?php echo $user['pseudo']; ?></h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center flex-row flex-wrap gap-3 col-12 my-2" style="height: 80%;">
            <div class="container d-flex justify-content-center align-items-center flex-column col-12 col-lg-3 my-2 border border-dark p-3 rounded">
                <FORM class="form-group" action="index.php?page=modif_profil" method="POST" enctype="multipart/form-data">
                    <LABEL class="form-label" for="photo">Changer photo de profil:</LABEL> <br>
                    <INPUT class="form-control" type="file" accept=".jpg,.jpeg,.png,.webp" name="photo" required></INPUT>
                    <INPUT class="btn btn-primary mt-2" type="submit" name="modifierPp" value="Modifier"></INPUT>
                </FORM>
            </div>

            <div class="container d-flex justify-content-center align-items-center flex-column col-12 col-lg-3 my-2 border border-dark  p-3 rounded">
                <FORM class="form-group" action="index.php?page=modif_profil" method="POST">
                    <LABEL class="form-label" for="pseudo">Pseudo:</LABEL> <br>
                    <INPUT class="form-control" type="text" name="pseudo" value="<?php echo $user['pseudo']; ?>"></INPUT>
                    <INPUT class="btn btn-primary mt-2" type="submit" name="modifierPseudo" value="Modifier pseudo"></INPUT> <br>
                    <LABEL class="form-label mt-2" for="email">Email:</LABEL>
                    <INPUT class="form-control" type="email" name="email" value="<?php echo $user['email']; ?>"></INPUT>
                    <INPUT class="btn btn-primary mt-2" type="submit" name="modifierEmail" value="Modifier email"></INPUT>
                </FORM>
            </div>

            <div class="container d-flex justify-content-center align-items-center flex-column col-12 col-lg-3 my-2 border border-dark  p-3 rounded">
                <FORM class="form-group" action="index.php?page=modif_profil" method="POST">
                    <LABEL class="form-label" for="mdp">Mot de passe:</LABEL> <br>
                    <INPUT class="form-control" type="password" name="mdp" id="mdp" required></INPUT>
                    <div class="errorMessage" id="errorMdp"></div> <br>
                    <LABEL class="form-label" for="mdp">Confirmer mot de passe:</LABEL> <br>
                    <INPUT class="form-control" type="password" name="confMdp" required></INPUT>
                    <INPUT class="btn btn-primary mt-2" type="submit" name="modifierMdp" value="Modifier mot de passe"></INPUT>
                </FORM>
            </div>
        </div>
    </div>
</body>
<script src="js/profil.js"></script>
</html>
<?php
}
else{
    // Redirige les visiteurs non connectés vers la page de connexion
    header("Location: index.php?page=connexion");
}
?>