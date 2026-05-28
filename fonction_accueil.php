<?php
require_once("fonction.php");

function listeRapports(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY r.id_rapport DESC');
    $req->execute();
    return $req->fetchAll();
}

function listeRapportsRecents(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY date_ecriture DESC');
    $req->execute();
    return $req->fetchAll();
}

function listeRapportsPopulaires(){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport GROUP BY r.id_rapport ORDER BY nbre_commentaires DESC');
    $req->execute();
    return $req->fetchAll();
}

function listeRapportsParLocalisation($localisation){
    $mysqlClient = connectDatabase();
    $req = $mysqlClient->prepare('SELECT *, COUNT(c.id_commentaire) AS nbre_commentaires FROM rapports r JOIN utilisateurs u ON u.id_utilisateur=r.id_utilisateur LEFT JOIN commentaires c ON c.id_rapport=r.id_rapport WHERE r.localisation LIKE :localisation GROUP BY r.id_rapport ORDER BY r.id_rapport DESC');
    $req->execute(array('localisation' => '%' . $localisation . '%'));
    return $req->fetchAll();
}
?>