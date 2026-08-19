<?php
// Ouvre une connexion PDO vers la base de données
function connectDatabase(){
    try{
        $mysqlClient = new PDO(
            'mysql:host=localhost;dbname=projetadb;charset=utf8',
            'root',
            ''
        );
        return $mysqlClient;
    } catch(Exception $e){
        // Interrompt l'execution et affiche l'erreur si la connexion échoue
        die('Erreur : '. $e->getMessage());
    }
}
?>