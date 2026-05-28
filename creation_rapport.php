<?php
include ("header.php");
require("fonction_rapport.php");

/*if(isset($_POST['publier'])){
    $id_utilisateur = $_SESSION['user']['id_utilisateur'];
    $titre = htmlspecialchars(trim($_POST['titre']));
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    $localisation = htmlspecialchars(trim($_POST['localisation']));

    creerRapport($id_utilisateur, $titre, $contenu, $localisation);
    header('Location: accueil.php');
}

if(isset($_POST['modifier'])){
    $id_rapport = htmlspecialchars($_GET['id']);
    $contenu = nl2br(htmlspecialchars(trim($_POST['rapport'])));
    modifierContenuRapport($id_rapport, $contenu);
    header('Location: rapport.php?id=' . $id_rapport);
}*/

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    if(isset($_GET['modif']) && $_GET['modif'] == 1){
        $id_rapport = htmlspecialchars($_GET['id']);
        $rapport = afficherRapport($id_rapport);
        if($rapport['id_utilisateur'] != $user['id_utilisateur']){
            header('Location: accueil.php');
            exit();
        }
        else{
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier un rapport - PenguinWatch</title>
            </head>
            <body>
                <div class="container d-flex justify-content-center align-items-center flex-column">
                    <div class="container d-flex justify-content-start align-items-center flex-column col-5 p-3 my-2">
                        <h1>Modifier un rapport</h1>
                    </div>

                    <div class="container d-flex justify-content-center align-items-center flex-row col-10 p-3 my-2">
                        <FORM class="form d-flex flex-row" style="width: 100%;" action="controller.php?action=modifierRapport&id=<?php echo $id_rapport; ?>" method="POST" enctype="multipart/form-data">
                            <div class="container d-flex justify-content-center flex-column col-5 p-3 my-2 bg-white rounded">
                                <LABEL class="form-label" for="rapport">Corps du rapport:</LABEL>
                                <TEXTAREA class="form-control" name="rapport" cols="30" rows="12" required><?php echo $rapport['contenu'];?></TEXTAREA> <br>
                                <INPUT class="btn btn-primary" style="width: 100%;" type="submit" name="modifier" value="Modifier Rapport"></INPUT>
                            </div>
                        </FORM>
                    </div>
                </div>
            </body>
            </html>
            <?php
        }
    }
    else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un rapport - PenguinWatch</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <div class="container d-flex justify-content-start align-items-center flex-column col-5 p-3 my-2">
            <h1>Écrire un nouveau rapport</h1>
        </div>

        <div class="container d-flex justify-content-center align-items-center flex-row col-10 p-3 my-2">
            <FORM class="form d-flex flex-row" style="width: 100%;" action="controller.php?action=publier" method="POST" enctype="multipart/form-data">
                <div class="container d-flex justify-content-center flex-column col-5 p-3 my-2 bg-white rounded">
                    <LABEL class="form-label" for="titre">Titre:</LABEL>
                    <INPUT class="form-control" type="text" name="titre" required></INPUT> <br>
                    <LABEL class="form-label" for="rapport">Corps du rapport:</LABEL>
                    <TEXTAREA class="form-control" name="rapport" cols="30" rows="12" required></TEXTAREA> <br>
                </div>
                <div class="container d-flex flex-column col-5 p-3 my-2">
                    <div class="bg-white p-3 rounded mb-3">
                        <LABEL class="form-label" for="photo">Ajouter une photo:</LABEL> <br>
                        <INPUT class="form-control" type="file" name="photo"></INPUT>
                    </div>
                    <div class="bg-white p-3 rounded">
                        <LABEL class="form-label" for="localisation">Localisation:</LABEL> <br>
                        <SELECT class="form-select" name="localisation" required>
                            <OPTION value="">Selectionnez une localisation</OPTION>
                            <OPTION value="antarctique">Antarctique</OPTION>
                            <OPTION value="australie">Australie</OPTION>
                            <OPTION value="argentine">Argentine</OPTION>
                            <OPTION value="malouines">Îles Malouines</OPTION>
                            <OPTION value="galapagos">Îles Galapagos</OPTION>
                            <OPTION value="zelande">Nouvelle-Zélande</OPTION>
                            <OPTION value="afrique">Afrique du Sud</OPTION>
                            <OPTION value="autre">Autres</OPTION>
                        </SELECT>
                    </div>
                    <div class="mb-3 mt-3">
                        <INPUT class="btn btn-primary" style="width: 100%;" type="submit" name="publier" value="Publier Rapport"></INPUT>
                    </div>
                </div>
            </FORM>
        </div>
    </div>
</body>
</html>

<?php
    }
}
else{
    header('Location: connexion.php');
}
include ("footer.php");
?>