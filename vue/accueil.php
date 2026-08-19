<?php
include ("header.php");

// Sélectionne la liste des rapports selon le filtre choisi par l'utilisateur
if(isset($_GET['tri']) && $_GET['tri'] === 'populaires'){
    $rapports = listeRapportsPopulaires();
}
elseif(isset($_GET['tri']) && $_GET['tri'] === 'recents'){
    $rapports = listeRapportsRecents();
}
elseif(isset($_GET['localisation'])){
    // Nettoie la localisation avant de l'utiliser comme critére de recherche
    $localisation = htmlspecialchars(trim($_GET['localisation']));
    $rapports = listeRapportsParLocalisation($localisation);
}
else{
    // Affiche tous les rapports lorsqu'aucun filtre n'est selectionné
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
                <a class="btn btn-primary" href="index.php?page=creation">Créer un rapport</a>
                <div class="d-flex flex-column justify-content-start">
                    <p style="margin-bottom: 0; margin-top: 1rem;">Trier par</p>
                    <a class="btn btn-secondary" href="index.php?page=accueil&tri=recents">Récents</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&tri=populaires">Plus populaires</a>
                </div>
                <div class="d-flex flex-column justify-content-start">
                    <p style="margin-bottom: 0; margin-top: 1rem;">Localisation</p>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=antarctique">Antarctique</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=australie">Australie</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=argentine">Argentine</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=malouines">Îles Malouines</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=galapagos">Îles Galapagos</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=zelande">Nouvelle-Zélande</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=afrique">Afrique du Sud</a>
                    <a class="btn btn-secondary" href="index.php?page=accueil&localisation=autres">Autres</a>
                </div>
            </div>
        </div>

<!-- Contenu principal -->
        <div class="container d-flex justify-content-evenly flex-row flex-wrap col-10">
            <div class="container d-flex justify-content-start align-items-start flex-column col-12 ps-0 py-3">
                <h1>Fil d'observation</h1>
            </div>
            <?php foreach($rapports as $rapport){ 
                // Limite la description affichée
                if(strlen($rapport['contenu']) > 200){
                    $description = substr($rapport['contenu'], 0, 200) . '...';
                }
                else {
                    $description = $rapport['contenu'];
                }
            //Afficher un message si aucun rapport a afficher
            ?>
            <div class="card mb-3 col-12">
                <div class="row g-0">
                    <div class="col-md-2">
                        <a href="index.php?page=rapport&id=<?php echo $rapport[0]; ?>"><img class="card-img-top img-fluid" style="width: 300px; height: 230px;" src="images/<?php echo $rapport['image_couverture'];?>" alt="Image de couverture"></a>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex flex-column justify-content-start align-items-start" style="height: 80%;">
                                <p class="card-text"><?php echo ucfirst($rapport['localisation']); ?> - <?php echo date('d/m/Y', strtotime($rapport['date_ecriture'])); ?></p>
                                <a href="index.php?page=rapport&id=<?php echo $rapport[0]; ?>" class="card-link nav-link" style="color: #003366"><h4><?php echo ucfirst($rapport['titre']); ?></h4></a>
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