<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?page=accueil">PenguinWatch</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarHeader">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=profil">Profil</a>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            <ul class="navbar-nav collapse navbar-collapse" id="navbarNav">
                <?php // Affiche les options de navigation selon l'état de connexion ?>
                <?php if(isset($_SESSION['user'])){ ?>
                    <li class="nav-item">
                        <FORM action="index.php?page=accueil" method="post">
<!-- Inclure le nom d'utilisateur et/ou sa photo de profil -->
                            <button class="nav-link" type="submit" name="deconnexion">Déconnexion</button>
                        </FORM>
                    </li>
                <?php }
                else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=connexion">Connexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</body>
</html>