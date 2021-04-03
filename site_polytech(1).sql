-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 03 avr. 2021 à 15:30
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site_polytech`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_stage` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `duree` int(11) NOT NULL,
  `fk_localisation` varchar(100) NOT NULL,
  `adresse` varchar(500) NOT NULL,
  `salaire` int(11) NOT NULL,
  `fk_domaine` varchar(100) NOT NULL,
  `date_depot` date NOT NULL,
  `note_localisation` int(11) NOT NULL,
  `note_accueil` int(11) NOT NULL,
  `note_encadrement` int(11) NOT NULL,
  `note_interet` int(11) NOT NULL,
  `avis` text NOT NULL,
  `note_globale` int(11) NOT NULL,
  `fk_num_siret` varchar(15) NOT NULL,
  `fk_mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id_stage`),
  KEY `fk_num_siret` (`fk_num_siret`),
  KEY `fk_mail` (`fk_mail`),
  KEY `fk_localisation` (`fk_localisation`),
  KEY `fk_domaine` (`fk_domaine`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_stage`, `titre`, `duree`, `fk_localisation`, `adresse`, `salaire`, `fk_domaine`, `date_depot`, `note_localisation`, `note_accueil`, `note_encadrement`, `note_interet`, `avis`, `note_globale`, `fk_num_siret`, `fk_mail`) VALUES
(1, 'Titre de stage n°1', 8, '14 - Calvados', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr\" width=\"400\" height=\"300\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', 1200, 'Eau, environnement, aménagement', '2021-03-09', 10, 2, 5, 4, 'Souvent, la tâche des étudiants est facilitée car beaucoup d’entreprises bénéficient d’une forte notoriété et d’une belle image qui les rendent naturellement attractives. Mais il ne faut pas pour autant hésiter à aller chercher des informations et à les vérifier. On peut aussi se fier au bouche-à-oreille. Prudence cependant sur les stages proposés par les petites structures unipersonnelles, gérées par une ou deux personnes seulement qui n’ont pas finalement pas de temps disponible pour le stagiaire voire, dans le pire des cas, cherche une main d’œuvre à bas coût. Chez Digital Campus, nous sommes vigilants sur ce point.\\r\\n\\r\\nPar ailleurs, un bon stage ne doit pas être un stage fourre-tout  : il doit permettre à l’étudiant de remplir une mission bien définie. Les stages métier  sont en général de bons stages. Le cas échéant, la mission doit bien identifiée au sein de l’entreprise et bien accompagnée : vous devez avoir un référent pendant votre stage qui vous aidera à monter en compétence. ', 21, '55212022200013', 'ezzefh@gmail.com'),
(2, 'Titre de stage 2', 12, '07 - Ardèche', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8768.00714757224!2d2.3213247184080616!3d48.86836483962397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fccbee4456b%3A0x2e34b0ff808ac06a!2sTesla!5e0!3m2!1sfr!2sfr!4v1616855141386!5m2!1sfr!2sfr\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1400, 'Eau, environnement, aménagement', '2021-03-03', 3, 5, 7, 10, 'rgergergegerg erg ege e erg er erg eg erg er g er ge g e g eg e g e g eg e g eeee  ergeg erg ergerg erg er g er gerg erg e r ge g egege g erg', 25, '85095123700013', 'adresse@mail'),
(3, 'Titre de stage 3', 6, '75 - Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9508.996379979799!2d-0.5406837830637089!3d44.8818036295758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5528dfc3af92df%3A0xb86c663b296b5f78!2zU29jacOpdMOpIEfDqW7DqXJhbGUgZGVzIEJvaXM!5e0!3m2!1sfr!2sfr!4v1613683502141!5m2!1sfr!2sfr\" width=\"400\" height=\"300\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', 1100, 'Eau, environnement, aménagement', '2021-02-01', 7, 6, 6, 2, 'Le Parcours des écoles d\'ingénieurs Polytech D s\'adresse\r\naux bacheliers STI2D et STL spécialité sciences physiques et chimiques\r\nen laboratoire. Il permet d’intégrer, en cas de réussite, les spécialités accessibles\r\nau DUT suivi.', 21, '55212022200013', 'adresse@mail'),
(5, 'Développer le système de fermeture des portes', 6, '07 - Ardèche', '124 avenue de la République Privas', 250, 'Informatique', '2021-04-02', 4, 10, 8, 10, 'C\\\'était vraiment super, les gens étaient gentils et j\\\'ai pu développer une fonction importante pour le dernier modèle de la marque ! ', 28, '85095123700013', 'lea.verdier-2@etu.univ-tours.fr');

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE IF NOT EXISTS `domaine` (
  `nom_domaine` varchar(100) NOT NULL,
  `abr_domaine` varchar(50) NOT NULL,
  PRIMARY KEY (`nom_domaine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`nom_domaine`, `abr_domaine`) VALUES
('Eau, environnement, aménagement', 'Environement'),
('Électronique et systèmes numériques', 'Électronique'),
('Énergétique, génie des procédés', 'Énergie'),
('Génie biologique et alimentaire', 'Génie biologique'),
('Génie biomédical, instrumentation', 'Génie biomédical'),
('Génie civil', 'Génie civil'),
('Génie industriel', 'Génie industriel'),
('Informatique', 'Informatique'),
('Matériaux', 'Matériaux'),
('Mathématiques appliquées et modélisation', 'Mathématiques'),
('Mécanique', 'Mécanique'),
('Systèmes électriques', 'Systèmes électriques');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `num_siret` varchar(15) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `nom` varchar(40) NOT NULL,
  PRIMARY KEY (`num_siret`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`num_siret`, `logo`, `nom`) VALUES
('55212022200013', 'generale.png', 'Société Générale'),
('85095123700013', 'tesla.webp', 'Tesla');

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `lieu` varchar(100) NOT NULL,
  PRIMARY KEY (`lieu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`lieu`) VALUES
('01 - Ain'),
('02 - Aisne'),
('03 - Allier'),
('04 - Alpes-de-Haute-Provence'),
('05 - Hautes-Alpes'),
('06 - Alpes Maritimes'),
('07 - Ardèche'),
('08 - Ardennes'),
('09 - Ariège'),
('10 - Aube'),
('11 - Aude'),
('12 - Aveyron'),
('13 - Bouches-du-Rhône\r\n'),
('14 - Calvados'),
('15 - Cantal'),
('16 - Charente'),
('17 - Charente-Maritime'),
('18 - Cher'),
('19 - Corrèze'),
('21 - Côte-d\'Or'),
('22 - Côtes d\'Armor'),
('23 - Creuse'),
('24 - Dordogne'),
('25 - Doubs'),
('26 - Drôme\r\n'),
('27 - Eure'),
('28 - Eure-et-Loir'),
('29 - Finistère'),
('2A - Corse-du-Sud'),
('2B - Haute Corse'),
('30 - Gard'),
('31 - Haute Garonne'),
('32 - Gers'),
('33 - Gironde'),
('34 - Hérault'),
('35 - Ille-et-Vilaine'),
('36 - Indre'),
('37 - Indre-et-Loire'),
('38 - Isère'),
('39 - Jura'),
('40 - Landes'),
('41 - Loir-et-Cher'),
('42 - Loire'),
('43 - Haute Loire'),
('44 - Loire Atlantique'),
('45 - Loiret'),
('46 - Lot'),
('47 - Lot-et-Garonne'),
('48 - Lozère'),
('49 - Maine-et-Loire'),
('50 - Manche'),
('51 - Marne'),
('52 - Haute Marne'),
('53 - Mayenne'),
('54 - Meurthe-et-Moselle'),
('55 - Meuse'),
('56 - Morbihan'),
('57 - Moselle'),
('58 - Nièvre'),
('59 - Nord'),
('60 - Oise'),
('61 - Orne'),
('62 - Pas-de-Calais'),
('63 - Puy-de-Dôme\r\n'),
('64 - Pyrénées Atlantiques'),
('65 - Hautes Pyrénées'),
('66 - Pyrénées Orientales'),
('67 - Bas-Rhin'),
('68 - Haut-Rhin'),
('69 - Rhône\r\n'),
('70 - Haute Saône\r\n'),
('71 - Saïne-et-Loire'),
('72 - Sarthe'),
('73 - Savoie'),
('74 - Haute Savoie'),
('75 - Paris'),
('76 - Seine Maritime'),
('77 - Seine-et-Marne'),
('78 - Yvelines'),
('79 - Deux-Sèvres'),
('80 - Somme'),
('81 - Tarn'),
('82 - Tarn-et-Garonne'),
('83 - Var'),
('84 - Vaucluse'),
('85 - Vendée\r\n'),
('86 - Vienne'),
('87 - Haute Vienne'),
('88 - Vosges'),
('89 - Yonne'),
('90 - Territoire de Belfort'),
('91 - Essonne'),
('92 - Hauts-de-Seine'),
('93 - Seine-St-Denis'),
('94 - Val-de-Marne'),
('95 - Val-D\'Oise'),
('971 - Guadeloupe'),
('972 - Martinique'),
('973 - Guyane'),
('974 - La Réunion'),
('976 - Mayotte'),
('Afghanistan'),
('Afrique du Sud'),
('Albanie'),
('Algérie'),
('Allemagne'),
('Angola'),
('Arabie saoudite'),
('Argentine'),
('Arménie'),
('Australie'),
('Autriche'),
('Azerbaïdjan'),
('Bangladesh'),
('Belgique'),
('Bénin'),
('Bhoutan'),
('Biélorussie'),
('Birmanie'),
('Bolivie'),
('Bosnie-Herzégovine'),
('Botswana'),
('Brésil'),
('Bulgarie'),
('Burkina'),
('Burundi'),
('Cambodge'),
('Cameroun'),
('Canada'),
('Chili'),
('Chine'),
('Chypre'),
('Colombie'),
('Congo'),
('Corée du Nord'),
('Corée du Sud'),
('Costa Rica'),
('Côte d\'Ivoire'),
('Croatie'),
('Cuba'),
('Danemark'),
('Djibouti'),
('Egypte'),
('Emirats arabes unis'),
('Equateur'),
('Erythrée\r\n'),
('Espagne'),
('Estonie'),
('Estwatini'),
('Etats-Unis'),
('Ethiopie'),
('Finlande'),
('Gabon'),
('Gambie'),
('Géorgie'),
('Ghana'),
('Gréce'),
('Guatemala'),
('Guinée\r\n'),
('Guinée équatoriale'),
('Guinée-Bissau'),
('Guyana'),
('Haïti'),
('Honduras'),
('Hongrie'),
('Inde'),
('Indonésie'),
('Irak'),
('Iran'),
('Irlande'),
('Islande'),
('Israël\r\n'),
('Italie'),
('Jamaïque'),
('Japon'),
('Jordanie'),
('Kazakhstan'),
('Kenya'),
('Kirghistan'),
('Koweït\r\n'),
('Laos'),
('Lesotho'),
('Lettonie'),
('Liban'),
('Liberia'),
('Libye'),
('Lituanie'),
('Macédoine'),
('Madagascar'),
('Malaisie'),
('Malawi'),
('Mali'),
('Maroc'),
('Mauritanie'),
('Mexique'),
('Moldavie'),
('Mongolie'),
('Monténégro'),
('Mozambique'),
('Namibie'),
('Népal'),
('Nicaragua'),
('Niger'),
('Nigeria'),
('Norvège'),
('Nouvelle-Zélande'),
('Oman'),
('Ouganda'),
('Ouzbékistan'),
('Pakistan'),
('Panama'),
('Papouasie-Nouvelle-Guinée\r\n'),
('Paraguay'),
('Pays-Bas'),
('Pérou'),
('Philippines'),
('Pologne'),
('Portugal'),
('Qatar'),
('République centrafricaine'),
('République démocratique du Congo'),
('République dominicaine'),
('Roumanie'),
('Royaume-Uni'),
('Russie'),
('Rwanda'),
('Salvador'),
('Sénégal'),
('Serbie'),
('Sierra Leone'),
('Slovaquie'),
('Slovénie'),
('Somalie'),
('Soudan'),
('Soudan du Sud'),
('Sri Lanka'),
('Suède'),
('Suisse'),
('Suriname'),
('Syrie'),
('Tadjikistan'),
('Tanzanie'),
('Tchad'),
('Tchèquie'),
('Thaïlande'),
('Togo'),
('Tunisie'),
('Turkménistan'),
('Turquie'),
('Ukraine'),
('Uruguay'),
('Venezuela'),
('Vietnam'),
('Yémen'),
('Zambie'),
('Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `mail` varchar(50) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `authentification` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`mail`, `nom`, `prenom`, `mdp`, `authentification`) VALUES
('adresse@mail', 'Nom', 'Prénom', 'motdepasse', 1),
('ezzefh@gmail.com', 'Nererofe', 'Ofnenfn', 'mdpmdpmdpmdp', 1),
('lea.verdier-2@etu.univ-tours.fr', 'Verdier', 'Lea', '$2y$10$fL1gbJFQckni43SzeoQ12Ofq2XK4DunhPNRoA5AT85FvNkSvi3//m', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_domaine` FOREIGN KEY (`fk_domaine`) REFERENCES `domaine` (`nom_domaine`),
  ADD CONSTRAINT `fk_localisation` FOREIGN KEY (`fk_localisation`) REFERENCES `localisation` (`lieu`),
  ADD CONSTRAINT `fk_mail` FOREIGN KEY (`fk_mail`) REFERENCES `utilisateurs` (`mail`),
  ADD CONSTRAINT `fk_num_siret` FOREIGN KEY (`fk_num_siret`) REFERENCES `entreprises` (`num_siret`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
