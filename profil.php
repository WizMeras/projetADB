<?php
include ("header.php");

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    $pfp = fetchPhotoProfil($id_utilisateur);
    $rapports = fetchRapports($id_utilisateur);
    $nbre_postes = nbrePostes($id_utilisateur);
    $nbre_commentaires = nbreCommentaires($id_utilisateur);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - PenguinWatch</title>
</head>
<body>
    <div class="container align-items-center d-flex justify-content-between">
        <div class="d-flex flex-column justify-content-start col-1">
            <img class="img-thumbnail" src="images/<?php echo $pfp['nom_image']; ?>" alt="Photo de profil">
        </div>
        <div class="d-flex justify-content-between col-11">
            <div class="d-flex flex-column justify-content-start pt-3">
                <h2><?php echo $user['pseudo']; ?></h2>
                <p>Membre depuis <?php echo $user['date_creation']; ?></p>
            </div>
            <div class="d-flex flex-column justify-content-start">
                <?php if($user['role'] == '2'){ ?>
                    <a class="btn btn-primary my-2" href="espace_admin.php">Accéder Dashboard Admin</a>
                <?php } ?>
                <a class="btn btn-secondary my-2" href="modifier_profil.php">Modifier profil</a>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-evenly flex-row">
        <div class="container bg-light p-3 my-2 rounded col-5">
            <p>Nombre de posts</p>
            <h2><?php echo $nbre_postes['nbre_postes']; ?></h2>
        </div>
        <div class="container bg-light p-3 my-2 rounded col-5">
            <p>Nombre de commentaires</p>
            <h2><?php echo $nbre_commentaires['nbre_commentaires']; ?></h2>
        </div>
    </div>

    <div class="container">
        <h2>Rapports publiés</h2>
    </div>
    <div class="container d-flex justify-content-evenly flex-row flex-wrap">
        <?php foreach($rapports as $rapport){
            if(strlen($rapport['contenu']) > 100){
                $description = substr($rapport['contenu'], 0, 100) . '...';
            } else {
                $description = $rapport['contenu'];
            }
        ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <p><?php echo ucfirst($rapport['localisation']); ?></p>
            <img class="img-thumbnail img-fluid" style="min-width: 380px; min-height: 280px; max-width: 380px; max-height: 280px;" src="images/<?php echo $rapport['image_couverture']; ?>" alt="Photo de couverture">
            <p><?php echo $rapport['titre']; ?></p>
            <p><?php echo $description; ?></p>
            <p><?php echo date('d/m/Y', strtotime($rapport['date_ecriture'])); ?> - Nombre commentaires</p>
        </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
}
else{
    header('Location: connexion.php');
}
include ("footer.php");
?>