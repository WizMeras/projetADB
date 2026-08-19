<?php
require_once 'fonction.php';

// Enregistre l'image envoyée et retourne son nom de fichier unique
function uploadImage(){
    $uid = uniqid();
    $image = $uid . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $uid . $_FILES['photo']['name']);
    return $image;
}

// Crée un rapport avec son image de couverture et sa date de publication
function creerRapport($id_utilisateur, $titre, $contenu, $localisation){
    $mysqlClient = connectDatabase();
    $image_couverture = uploadImage();
    $req = $mysqlClient->prepare('INSERT INTO rapports(id_utilisateur, titre, contenu, image_couverture, localisation, date_ecriture) VALUES (:id_utilisateur, :titre, :contenu, :image_couverture, :localisation, :date_ecriture)');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'titre' => $titre,
        'contenu' => $contenu,
        'image_couverture' => $image_couverture,
        'localisation' => $localisation,
        'date_ecriture' => date('Y-m-d H:i:s')
    ]);
}

// Récupére un rapport ainsi que les informations de son auteur
function afficherRapport($id_rapport){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur WHERE id_rapport=:id_rapport');
    $req->execute(['id_rapport' => $id_rapport]);
    return $req->fetch();
}

// Ajoute un commentaire a un rapport avec sa date d'écriture
function creerCommentaire($id_utilisateur, $id_rapport, $contenu){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('INSERT INTO commentaires(id_utilisateur, id_rapport, texte_commentaire, date_publication) VALUES (:id_utilisateur, :id_rapport, :contenu, :date_ecriture)');
    $req->execute([
        'id_utilisateur' => $id_utilisateur,
        'id_rapport' => $id_rapport,
        'contenu' => $contenu,
        'date_ecriture' => date('Y-m-d H:i:s')
    ]);
}

// Récupére les commentaires d'un rapport, du plus recent au plus ancien
function fetchCommentaires($id_rapport){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT * FROM commentaires c JOIN utilisateurs u ON u.id_utilisateur=c.id_utilisateur JOIN photo_profil p ON p.id_image=u.id_image WHERE id_rapport=:id_rapport ORDER BY date_publication DESC');
    $req->execute(['id_rapport' => $id_rapport]);
    return $req->fetchAll();
}

// Compte le nombre de commentaires associés à un rapport
function countCommentaires($id_rapport){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT COUNT(*) AS nbre_commentaires FROM commentaires WHERE id_rapport=:id_rapport');
    $req->execute(['id_rapport' => $id_rapport]);
    return $req->fetch();
}

// Supprime un rapport a partir de son identifiant
function supprimerRapport($id_rapport){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('DELETE FROM rapports WHERE id_rapport=:id_rapport');
    $req->execute(['id_rapport' => $id_rapport]);
}

// Modifie uniquement le contenu d'un rapport existant
function modifierContenuRapport($id_rapport, $contenu){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('UPDATE rapports SET contenu=:contenu WHERE id_rapport=:id_rapport');
    $req->execute([
        'contenu' => $contenu,
        'id_rapport' => $id_rapport
    ]);
}
?>