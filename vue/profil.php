<?php
include ("header.php");

// Vérfie que l'utilisateur est connecté
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    // Récupére la photo, les rapports et les statistiques du profil.
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
    <div class="container align-items-center d-flex justify-content-between flex-wrap">
        <div class="d-flex flex-column justify-content-start col-3 col-lg-1">
            <img class="img-thumbnail" src="images/<?php echo $pfp['nom_image']; ?>" alt="Photo de profil">
        </div>
        <div class="d-flex justify-content-between col-11">
            <div class="d-flex flex-column justify-content-start pt-3">
                <h2><?php echo $user['pseudo']; ?></h2>
                <p>Membre depuis <?php echo $user['date_creation']; ?></p>
            </div>
            <div class="d-flex flex-column justify-content-start">
                <?php // Affiche le bouton de l'espace admin uniquement pour les admins ?>
                <?php if($user['role'] == '2'){ ?>
                    <a class="btn btn-primary my-2" href="index.php?page=admin">Accéder Dashboard Admin</a>
                <?php } ?>
                <a class="btn btn-secondary my-2" href="index.php?page=modif_profil">Modifier profil</a>
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
        <?php // Parcourt les rapports publiés par l'utilisateur ?>
        <?php foreach($rapports as $rapport){
            // Limite la longueur de la description affichée dans chaque aperçu.
            if(strlen($rapport['contenu']) > 100){
                $description = substr($rapport['contenu'], 0, 100) . '...';
            } else {
                $description = $rapport['contenu'];
            }
        ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <p><?php echo ucfirst($rapport['localisation']); ?></p>
            <a href="index.php?page=rapport&id=<?php echo $rapport[0]; ?>">
                <img class="img-thumbnail img-fluid" style="min-width: 360px; min-height: 280px; max-width: 360px; max-height: 280px;" src="images/<?php echo $rapport['image_couverture']; ?>" alt="Photo de couverture">
            </a>
            <a href="index.php?page=rapport&id=<?php echo $rapport[0]; ?>" class="card-link nav-link" style="color: #003366"><h4><?php echo ucfirst($rapport['titre']); ?></h4></a>
            <p><?php echo $description; ?></p>
            <p><?php echo date('d/m/Y', strtotime($rapport['date_ecriture'])); ?></p>
        </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
}
else{
    // Redirige les visiteurs non connectés vers la page de connexion.
    header('Location: index.php?page=connexion');
}
include ("footer.php");
?>