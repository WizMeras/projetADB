<?php
include ("header.php");
require("fonction_admin.php");
require("fonction_connexion.php");

if(isset($_POST['creer'])){
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirmMdp = htmlspecialchars($_POST['confirmMdp']);
    $role = htmlspecialchars($_POST['role']);
    if($mdp == $confirmMdp){
        inscription($pseudo, $email, $mdp, $role);
        header('Location: espace_admin.php');
    }
    else{
        $error = 1;
    }
}

if(isset($_GET['modifier']) && isset($_GET['id_utilisateur'])){
    $id_utilisateur = htmlspecialchars($_GET['id_utilisateur']);
    $modif = true;
}

if(isset($_POST['modifierUtilisateur'])){
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    if(!empty($_POST['mdp'])){
        $mdp = htmlspecialchars($_POST['mdp']);
    } else {
        $utilisateur = infoUtilisateur($id_utilisateur);
        $mdp = $utilisateur['mdp'];
    }
    $role = htmlspecialchars($_POST['role']);
    modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp);
    header('Location: espace_admin.php');
}

if(isset($_POST['supprimer'])){
    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
    supprimerUtilisateur($id_utilisateur);
    header('Location: espace_admin.php');
}

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
            <a class="btn btn-primary" href="inscription.php?special=admin">Créer Utilisateur</a>
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
            <tr>
                <td><?php echo $utilisateur['pseudo']; ?></td>
                <td><?php echo $utilisateur['email']; ?></td>
                <td><?php echo $utilisateur['role'] == '2' ? 'Administrateur' : 'Utilisateur'; ?></td>
                <td><?php echo $utilisateur['date_creation']; ?></td>
                <td>
                    <a class="btn btn-secondary" href="espace_admin.php?modifier=1&id_utilisateur=<?php echo $utilisateur['id_utilisateur']; ?>">Modifier</a>
                    <FORM action="controller.php?action=supprimerUtilisateur" method="POST" style="display:inline">
                        <INPUT type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur']; ?>" readonly></INPUT>
                        <button class="btn btn-danger" type="submit" name="supprimer" id="supprimer">Supprimer</button>
                    </FORM>
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
            <FORM class="form-group" method="POST" action="controller.php?action=modifierUtilisateur">
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
<script src="connexion.js"></script>
</html>
<?php

}
else{
    header('Location: accueil.php');
}

?>