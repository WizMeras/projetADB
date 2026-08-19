<?php
require_once("fonction.php");

// Récupére tous les rapports, du plus récent au plus ancien
function listeRapports(){
    $mysqlClient = connectDatabase();
    // Compte les commentaires associés a chaque rapport pour l'affichage
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY r.id_rapport DESC');
    $req->execute();
    return $req->fetchAll();
}

// Récupére les rapports classés par date de publication récente
function listeRapportsRecents(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY date_ecriture DESC');
    $req->execute();
    return $req->fetchAll();
}

// Récupére les rapports classés selon leur nombre de commentaires
function listeRapportsPopulaires(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY nbre_commentaires DESC');
    $req->execute();
    return $req->fetchAll();
}

// Récupére les rapports dont la localisation contient le texte recherché.
function listeRapportsParLocalisation($localisation){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport WHERE r.localisation LIKE :localisation GROUP BY r.id_rapport ORDER BY r.id_rapport DESC');
    // Les caracteres % permettent une recherche partielle dans la localisation.
    $req->execute(['localisation' => '%' . $localisation . '%']);
    return $req->fetchAll();
}
?>