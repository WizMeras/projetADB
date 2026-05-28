<?php
include ("header.php");
require("fonction_accueil.php");

if(isset($_POST['deconnexion'])){
    session_destroy();
    header('Location: accueil.php');
}

if(isset($_GET['tri']) && $_GET['tri'] === 'populaires'){
    $rapports = listeRapportsPopulaires();
}
elseif(isset($_GET['tri']) && $_GET['tri'] === 'recents'){
    $rapports = listeRapportsRecents();
}
elseif(isset($_GET['localisation'])){
    $localisation = htmlspecialchars(trim($_GET['localisation']));
    $rapports = listeRapportsParLocalisation($localisation);
}
else{
    $rapports = listeRapports();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fil d'observation - PenguinWatch</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-start flex-row col-12">
<!-- Sidebar pour filtres -->
        <div class="container d-flex justify-content-center flex-row col-2 bg-light p-3 my-2">
            <div class="d-flex flex-column justify-content-start">
                <a class="btn btn-primary" href="creation_rapport.php">Créer un rapport</a>
                <div class="d-flex flex-column justify-content-start">
                    <p style="margin-bottom: 0; margin-top: 1rem;">Trier par</p>
                    <a class="btn btn-secondary" href="accueil.php?tri=recents">Récents</a>
                    <a class="btn btn-secondary" href="accueil.php?tri=populaires">Plus populaires</a>
                </div>
                <div class="d-flex flex-column justify-content-start">
                    <p style="margin-bottom: 0; margin-top: 1rem;">Localisation</p>
                    <a class="btn btn-secondary" href="accueil.php?localisation=antarctique">Antarctique</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=australie">Australie</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=argentine">Argentine</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=malouines">Îles Malouines</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=galapagos">Îles Galapagos</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=zelande">Nouvelle-Zélande</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=afrique">Afrique du Sud</a>
                    <a class="btn btn-secondary" href="accueil.php?localisation=autres">Autres</a>
                </div>
            </div>
        </div>

<!-- Contenu principal -->
        <div class="container d-flex justify-content-evenly flex-row flex-wrap col-10">
            <div class="container d-flex justify-content-start align-items-start flex-column col-12 ps-0 py-3">
                <h1>Fil d'observation</h1>
            </div>
            <?php foreach($rapports as $rapport){ 
                if(strlen($rapport['contenu']) > 200){
                    $description = substr($rapport['contenu'], 0, 200) . '...';
                }
                else {
                    $description = $rapport['contenu'];
                }
            ?>
            <div class="card mb-3 col-12">
                <div class="row g-0">
                    <div class="col-md-2">
                        <a href="rapport.php?id=<?php echo $rapport[0]; ?>"><img class="card-img-top img-fluid" style="width: 300px; height: 230px;" src="images/<?php echo $rapport['image_couverture'];?>" alt="Image de couverture"></a>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex flex-column justify-content-start align-items-start" style="height: 80%;">
                                <p class="card-text"><?php echo ucfirst($rapport['localisation']); ?> - <?php echo date('d/m/Y', strtotime($rapport['date_ecriture'])); ?></p>
                                <a href="rapport.php?id=<?php echo $rapport[0]; ?>" class="card-link nav-link" style="color: #003366"><h4><?php echo ucfirst($rapport['titre']); ?></h4></a>
                                <p><?php echo $description; ?></p>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-end">
                                <p style="margin-bottom: 0;">Par <?php echo $rapport['pseudo']; ?></p>
                                <p style="margin-bottom: 0;">Commentaires: <?php echo $rapport['nbre_commentaires']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
include ("footer.php");
?>