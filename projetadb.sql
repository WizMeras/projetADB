-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 28 mai 2026 à 18:41
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetadb`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `texte_commentaire` text NOT NULL,
  `id_rapport` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_publication` datetime NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `texte_commentaire`, `id_rapport`, `id_utilisateur`, `date_publication`) VALUES
(2, 'Le début de nidification anticipé est vraiment notable. Les conditions de glace stables jouent clairement un rôle. Merci pour les précisions sur les vocalisations, c’est un bon indicateur comportemental.', 2, 1, '2026-05-28 20:03:35'),
(4, 'Le déplacement des trajets de nourrissage est assez marqué. Les données GPS renforcent bien l’analyse. À suivre de près si le courant chaud persiste.', 3, 1, '2026-05-28 20:04:58'),
(5, 'Très intéressant de voir une hausse aussi nette de la densité. La corrélation avec la nouvelle zone de glace semble plausible. Curieux de voir si la tendance se maintient sur les prochains relevés.', 1, 2, '2026-05-28 20:05:28'),
(6, 'Intéressant de voir une avance aussi marquée sur le calendrier habituel. Si la banquise reste stable, on pourrait avoir une saison de reproduction plus réussie que prévu. Hâte de voir les prochains relevés.', 2, 3, '2026-05-28 20:06:23');

-- --------------------------------------------------------

--
-- Structure de la table `photo_profil`
--

DROP TABLE IF EXISTS `photo_profil`;
CREATE TABLE IF NOT EXISTS `photo_profil` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `nom_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `photo_profil`
--

INSERT INTO `photo_profil` (`id_image`, `nom_image`) VALUES
(1, 'default_pfp.jpg'),
(2, '6a188514269f920240617_104622.jpg'),
(3, '6a18856194ec0GU7G28lagAAjdxP.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

DROP TABLE IF EXISTS `rapports`;
CREATE TABLE IF NOT EXISTS `rapports` (
  `id_rapport` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `image_couverture` varchar(255) NOT NULL,
  `localisation` varchar(12) NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id_rapport`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rapports`
--

INSERT INTO `rapports` (`id_rapport`, `titre`, `contenu`, `image_couverture`, `localisation`, `id_utilisateur`, `date_ecriture`) VALUES
(1, 'Regroupement inhabituel de manchots empereurs sur ', 'Lors du relevé hebdomadaire du Secteur Sud-Delta, une augmentation notable de la densité de manchots empereurs a été enregistrée. Les comptages préliminaires indiquent une hausse d’environ 12 % par rapport aux données de décembre 2023. Cette variation semble corrélée à la formation récente d’une zone de glace stable, offrant un accès facilité aux zones de nourrissage.<br />\r\n<br />\r\nLes vérifications ont été effectuées via imagerie thermique et comptage manuel sur deux transects principaux. Les comportements observés incluent des regroupements serrés (huddling) plus précoces que prévu, probablement en réponse à une baisse soudaine du vent ressenti.<br />\r\n<br />\r\nConditions météo au moment du relevé : -21°C, vent 22 nœuds secteur Sud-Ouest, visibilité réduite mais stable.<br />\r\nAucun signe de prédation par les pétrels géants n’a été constaté durant la fenêtre d’observation de 3 h 20.', '6a1879094413eSEI_292509435.webp', 'antarctique', 1, '2026-05-28 19:19:05'),
(2, 'Activité de nidification précoce dans la Zone Nord', 'Au cours du suivi de routine de la Zone Nord-Est, plusieurs couples de manchots Adélie ont été observés transportant des cailloux, indiquant un début de nidification environ 10 jours plus tôt que la moyenne des cinq dernières années. Cette avance pourrait être liée à la stabilité inhabituelle de la banquise depuis la mi-saison.<br />\r\n<br />\r\nLes comptages ont été réalisés sur trois sous-secteurs, combinant observations directes et analyse de drones à basse altitude. Les comportements relevés incluent des vocalisations de reconnaissance fréquentes et une territorialité modérée autour des premiers nids.<br />\r\n<br />\r\nConditions météo : -11°C, vent 10 nœuds d’Est, ciel dégagé.<br />\r\nAucun skua observé dans le périmètre immédiat durant les 2 h 45 d’observation.', '6a187983614d8c0150519-800px-wm.jpg', 'antarctique', 2, '2026-05-28 19:21:07'),
(3, 'Modification des zones de nourrissage des manchots', 'Les relevés du Secteur Ouest montrent un déplacement significatif des zones de nourrissage des manchots papous. Les individus observés parcourent en moyenne 1,8 km de plus que les données de référence de 2021. Ce changement suggère une redistribution du krill dans la colonne d’eau, possiblement liée à un courant plus chaud détecté en surface.<br />\r\n<br />\r\nLes données ont été collectées via balises GPS sur 14 individus et vérifiées par observation directe lors des retours au rivage. Les comportements alimentaires restent efficaces, mais les durées de plongée sont légèrement plus longues que la normale.<br />\r\n<br />\r\nConditions météo : -7°C, vent 12 nœuds du Nord, visibilité excellente.<br />\r\nAucun signe de stress ou de compétition interspécifique observé.', '6a187ac58b4c3manchots-papous-plage-antarctique.jpg', 'antarctique', 3, '2026-05-28 19:26:29'),
(4, 'Concentration inhabituelle de manchots des Galápag', 'Lors du relevé matinal du littoral nord de l’île Fernandina, une augmentation notable de l’activité des manchots des Galápagos (Spheniscus mendiculus) a été enregistrée. Les estimations indiquent une hausse d’environ 15 % du nombre d’individus présents par rapport au relevé d’avril 2024. Cette variation semble liée à une remontée d’eaux froides plus marquée que prévue, favorisant l’abondance locale de poissons.<br />\r\n<br />\r\nLes comptages ont été réalisés via observation directe depuis trois points fixes et vérification par séquences vidéo à courte distance. Plusieurs comportements de chasse coopérative ont été observés, ainsi qu’un début de rassemblement autour de zones rocheuses propices à la nidification.<br />\r\n<br />\r\nConditions météo au moment du relevé : 23°C, vent 8 nœuds d’Ouest, mer calme, visibilité excellente.<br />\r\nAucun signe de prédation par les otaries ou les frégates n’a été relevé durant les 2 h 10 d’observation.', '6a1884a53201fnationalgeographic_1436729.webp', 'galapagos', 3, '2026-05-28 20:08:37');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `date_creation` date NOT NULL,
  `id_image` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `pseudo`, `mdp`, `email`, `role`, `date_creation`, `id_image`) VALUES
(1, 'David Vermersch', 'admin', 'david.vermersch63@gmail.com', 2, '2026-05-18', 1),
(2, 'Léo Marchand', 'utilisateur1', 'leo.marchand@gmail.com', 1, '2026-05-28', 2),
(3, 'Julie Renard', 'utilisateur2', 'julie.renard@yahoo.com', 1, '2026-05-28', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
