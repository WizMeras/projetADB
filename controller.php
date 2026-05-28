<?php
session_start();
require_once 'fonction_connexion.php';
require_once 'fonction_rapport.php';
require_once 'fonction_admin.php';
require_once 'fonction_profil.php';

function esc($v){ return htmlspecialchars(trim($v)); }

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

switch($action){
    case 'login':
        $email = isset($_POST['email']) ? esc($_POST['email']) : '';
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
        $user = connexion($email, $mdp);
        if($user){
            $_SESSION['user'] = $user;
            header('Location: accueil.php');
            exit();
        } else {
            header('Location: connexion.php?error=1');
            exit();
        }
        break;

    case 'logout':
        session_destroy();
        header('Location: accueil.php');
        exit();
        break;

    case 'inscription':
    case 'register':
        $pseudo = isset($_POST['pseudo']) ? esc($_POST['pseudo']) : '';
        $email = isset($_POST['email']) ? esc($_POST['email']) : '';
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
        $confirm = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : '';
        if(emailExistant($email)){
            header('Location: inscription.php?error=2');
            exit();
        }
        if($mdp !== $confirm){
            header('Location: inscription.php?error=1');
            exit();
        }
        $role = isset($_POST['role']) ? intval($_POST['role']) : 1;
        inscription($pseudo, $email, $mdp, $role);
        header('Location: connexion.php');
        exit();
        break;

    case 'publier':
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $titre = isset($_POST['titre']) ? esc($_POST['titre']) : '';
        $contenu = isset($_POST['rapport']) ? nl2br(esc($_POST['rapport'])) : '';
        $localisation = isset($_POST['localisation']) ? esc($_POST['localisation']) : '';
        creerRapport($id_utilisateur, $titre, $contenu, $localisation);
        header('Location: accueil.php');
        exit();
        break;

    case 'modifierRapport':
        $id_rapport = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $contenu = isset($_POST['rapport']) ? nl2br(esc($_POST['rapport'])) : '';
        if($id_rapport){ modifierContenuRapport($id_rapport, $contenu); }
        header('Location: rapport.php?id=' . $id_rapport);
        exit();
        break;

    case 'supprimerRapport':
        $id_rapport = isset($_POST['id_rapport']) ? intval($_POST['id_rapport']) : (isset($_GET['id'])?intval($_GET['id']):0);
        if($id_rapport){ supprimerRapport($id_rapport); }
        header('Location: accueil.php');
        exit();
        break;

    case 'commenter':
        $id_rapport = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $contenu = isset($_POST['commentaire']) ? esc($_POST['commentaire']) : '';
        creerCommentaire($id_utilisateur, $id_rapport, $contenu);
        header('Location: rapport.php?id=' . $id_rapport);
        exit();
        break;

    case 'creerUser':
        $pseudo = isset($_POST['pseudo']) ? esc($_POST['pseudo']) : '';
        $email = isset($_POST['email']) ? esc($_POST['email']) : '';
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
        $confirm = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : '';
        $role = isset($_POST['role']) ? intval($_POST['role']) : 1;
        if($mdp !== $confirm){
            header('Location: inscription.php?special=admin&error=1');
            exit();
        }
        inscription($pseudo, $email, $mdp, $role);
        header('Location: espace_admin.php');
        exit();
        break;

    case 'modifierUtilisateur':
        $id_utilisateur = isset($_POST['id_utilisateur']) ? intval($_POST['id_utilisateur']) : 0;
        $pseudo = isset($_POST['pseudo']) ? esc($_POST['pseudo']) : '';
        $email = isset($_POST['email']) ? esc($_POST['email']) : '';
        $mdp = isset($_POST['mdp']) && $_POST['mdp'] !== '' ? $_POST['mdp'] : null;
        $role = isset($_POST['role']) ? intval($_POST['role']) : 1;
        if($mdp === null){
            $utilisateur = infoUtilisateur($id_utilisateur);
            $mdp = $utilisateur['mdp'];
        }
        modifierUtilisateur($id_utilisateur, $pseudo, $email, $mdp);
        header('Location: espace_admin.php');
        exit();
        break;

    case 'supprimerUtilisateur':
        $id_utilisateur = isset($_POST['id_utilisateur']) ? intval($_POST['id_utilisateur']) : 0;
        if($id_utilisateur) supprimerUtilisateur($id_utilisateur);
        header('Location: espace_admin.php');
        exit();
        break;

    case 'modifierPp':
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $image = uploadPp();
        $id_image = getImageId($image);
        modifierPp($id_utilisateur, $id_image);
        $user = infoUtilisateur($id_utilisateur);
        $_SESSION['user'] = $user;
        header('Location: profil.php');
        exit();
        break;

    case 'modifierPseudo':
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $nouveauPseudo = isset($_POST['pseudo']) ? esc($_POST['pseudo']) : '';
        modifierPseudo($id_utilisateur, $nouveauPseudo);
        $user = infoUtilisateur($id_utilisateur);
        $_SESSION['user'] = $user;
        header('Location: profil.php');
        exit();
        break;

    case 'modifierEmail':
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $nouvelEmail = isset($_POST['email']) ? esc($_POST['email']) : '';
        modifierEmail($id_utilisateur, $nouvelEmail);
        $user = infoUtilisateur($id_utilisateur);
        $_SESSION['user'] = $user;
        header('Location: profil.php');
        exit();
        break;

    case 'modifierMdp':
        if(!isset($_SESSION['user'])){ header('Location: connexion.php'); exit(); }
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $nouveauMdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
        $confMdp = isset($_POST['confMdp']) ? $_POST['confMdp'] : '';
        if($nouveauMdp === $confMdp){
            modifierMdp($id_utilisateur, $nouveauMdp);
        }
        header('Location: profil.php');
        exit();
        break;

    default:
        header('Location: accueil.php');
        exit();
}
