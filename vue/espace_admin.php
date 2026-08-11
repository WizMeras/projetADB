<?php
include ("header.php");

if(isset($_SESSION['user']) && $_SESSION['user']['role'] == '2'){
    $utilisateurs = listeUtilisateurs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <div class="container d-flex justify-content-between align-items-center flex-row col-12 p-3 my-2">
            <h1>Liste d'utilisateurs</h1>
            <FORM action="index.php?page=inscription&special=admin" method="POST">
                <button class="btn btn-primary" type="submit">Créer Utilisateur</button>
            </FORM>
        </div>
        <table class="table">
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Adresse mail</th>
                <th>Rôle</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
            <?php foreach($utilisateurs as $utilisateur){ ?>
            <tr class="align-middle">
                <td><?php echo $utilisateur['pseudo']; ?></td>
                <td><?php echo $utilisateur['email']; ?></td>
                <td><?php echo $utilisateur['role'] == '2' ? 'Administrateur' : 'Utilisateur'; ?></td>
                <td><?php echo $utilisateur['date_creation']; ?></td>
                <td>
                    <?php if($utilisateur['id_utilisateur'] != $_SESSION['user']['id_utilisateur']) { ?>
                        <FORM action="index.php?page=admin" method="POST">
                            <INPUT type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur']; ?>" readonly></INPUT>
                            <button class="btn btn-secondary" type="submit" name="modifier" id="modifier">Modifier</button>
                            <button class="btn btn-danger" type="submit" name="supprimer" id="supprimer">Supprimer</button>
                        </FORM>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php if(isset($error)){
            echo "Une erreur est survenue lors de la création de l'utilisateur";
        } ?>
    </div>

<?php
    if(isset($modif) && isset($id_utilisateur)){
        unset($modif);
        $utilisateur = infoUtilisateur($id_utilisateur);
        ?>
        <div class="container d-flex justify-content-center align-items-center flex-column col-6 p-3 my-2 bg-light rounded">
            <h1>Modifier l'utilisateur <?php echo $utilisateur['pseudo']; ?></h1>
            <FORM class="form-group" method="POST" action="index.php?page=admin">
                <INPUT type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur']; ?>" readonly></INPUT>
                <LABEL class="form-label" for="pseudo">Nom d'utilisateur:</LABEL> <br>
                <INPUT class="form-control" type="text" name="pseudo" value="<?php echo $utilisateur['pseudo']; ?>" required></INPUT> <br>
                <LABEL class="form-label" for="email">Email:</LABEL> <br>
                <INPUT class="form-control" type="email" name="email" id="email" value="<?php echo $utilisateur['email']; ?>" required></INPUT>
                <div class="errorMessage" id="errorEmail"></div> <br>
                <LABEL class="form-label" for="mdp">Mot de passe:</LABEL> <br>
                <INPUT class="form-control" type="password" name="mdp" placeholder="Nouveau mot de passe"></INPUT> <br>
                <LABEL class="form-label" for="role">Rôle:</LABEL> <br>
                <SELECT class="form-select" name="role" required>
                    <option value="1" <?php if($utilisateur['role'] == '1') echo 'selected'; ?>>Utilisateur</option>
                    <option value="2" <?php if($utilisateur['role'] == '2') echo 'selected'; ?>>Administrateur</option>
                </SELECT> <br>
                <INPUT class="btn btn-primary" type="submit" name="modifierUtilisateur" value="Modifier Utilisateur"></INPUT>
            </FORM>
        </div>
    <?php }
?>
</body>
<script src="js/connexion.js"></script>
</html>
<?php

}
else{
    header('Location: index.php?page=accueil');
}

?>