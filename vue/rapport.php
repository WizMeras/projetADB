<?php
include ("header.php");

$id_rapport = htmlspecialchars($_GET['id']);
$rapport = afficherRapport($id_rapport);
$image_couverture = $rapport['image_couverture'];
$commentaires = fetchCommentaires($id_rapport);
$nombre_commentaires = countCommentaires($id_rapport);

if(isset($_POST['commenter'])){
    if(!isset($_SESSION['user'])){
        header('Location: index.php?page=connexion');
        exit();
    }
    else{
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $contenu = htmlspecialchars(nl2br(trim($_POST['commentaire'])));
        creerCommentaire($id_utilisateur, $id_rapport, $contenu);
        header('Location: index.php?page=rapport&id=' . $id_rapport);
        exit();
    }
}

if(isset($_POST['Modifier'])){
    header('Location: index.php?page=creation&modif=1&id=' . $id_rapport);
    exit();
}

if(isset($_POST['Supprimer'])){
    supprimerRapport($id_rapport);
    header('Location: index.php?page=accueil');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $rapport['titre']; ?> - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <h1><?php echo $rapport['titre']; ?></h1>
        <div class="container d-flex justify-content-start align-items-start flex-column col-8 p-3 my-2">
            <div class="container d-flex flex-column col-12 p-3 my-2">
                <hr>
                <p>Publié par: <?php echo $rapport['pseudo']; ?></p>
                <p>Date de publication: <?php echo $rapport['date_ecriture']; ?></p>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['id_utilisateur'] == $rapport['id_utilisateur']){ ?>
                    
                    <FORM action="index.php?page=rapport&id=<?php echo $id_rapport; ?>" method="POST" style="display:inline">
                        <button class="btn btn-primary" type="submit" name="Modifier">Modifier</button>
                        <button class="btn btn-danger" type="submit" name="Supprimer">Supprimer</button>
                    </FORM>
                <?php } ?>
                <hr>
            </div>
            <div class="container d-flex justify-content-start align-items-start flex-column col-12 p-3 my-2">
                <img class="thumbnail img-fluid" style="width: 850px; height: 480px;" src="images/<?php echo $image_couverture; ?>" alt="Image de couverture">
            </div>
            <div class="container d-flex justify-content-start align-items-start flex-column col-12 p-3 my-2">
                <p><?php echo $rapport['contenu']; ?></p>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-start flex-column col-8 p-3 my-2">
        <h2>Commentaires (<?php echo $nombre_commentaires['nbre_commentaires']; ?>)</h2>
        <div class="container d-flex justify-content-start align-items-start flex-column col-12 p-3 my-2">
            <div class="container d-flex justify-content-start align-items-start flex-column col-12 p-3 my-2 bg-white rounded">
                <br>
                    <FORM action="index.php?page=rapport&id=<?php echo $id_rapport; ?>" method="POST">
                        <textarea class="form-control" name="commentaire" id="commentaire" placeholder="Commentaire" cols="100" rows="5"></textarea>
                        <input class="btn btn-primary" type="submit" name="commenter" value="Envoyer">
                    </FORM>
            </div>
            <div>
                <?php foreach($commentaires as $commentaire){ ?>
                    <div class="container d-flex justify-content-start align-items-start flex-column col-12 p-3 my-2">
                        <img class="thumbnail small" src="images/<?php echo $commentaire['nom_image']; ?>" alt="Photo de profil">
                        <p><?php echo $commentaire['pseudo']; ?></p>
                        <p><?php echo date('d/m/Y', strtotime($commentaire['date_publication'])); ?></p>
                        <p><?php echo $commentaire['texte_commentaire']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include ("footer.php");
?>