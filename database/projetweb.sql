-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 03 avr. 2024 à 09:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(11) NOT NULL,
  `login` text NOT NULL,
  `mot_de_passe` text NOT NULL,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `login`, `mot_de_passe`, `nom`, `prenom`) VALUES
(1, 'Dieu', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Joseph', 'Hugo'),
(2, 'Leetram', '74572bc37ba51e3a17e5799c245ad695a96cf94031a889fb30dc2d161588e8d2', 'Marteel', 'Théo'),
(3, 'Jr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Cyusa', 'Adnan');

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `id_utilisateur` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`id_utilisateur`, `id_promo`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(9, 2),
(9, 501),
(10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom` text NOT NULL,
  `secteur_d_activite` int(11) DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `addresse_siege` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom`, `secteur_d_activite`, `mail`, `addresse_siege`, `description`, `logo`) VALUES
(1, 'WebDev Solutions', 1, 'contact@webdevsolutions.com', '123 Rue de la République, Paris,France', 'Entreprise spécialisée dans le développement web offrant des solutions innovantes aux entreprises.', ''),
(2, 'Digital Marketing Experts', 2, 'info@digitalmarketingexperts.com', '456 Avenue des Champs-Élysées,Paris,France', 'Agence de marketing digital proposant des stratégies efficaces pour maximiser la visibilité en ligne.', ''),
(3, 'Graphic Design Creations', 3, 'hello@graphicdesigncreations.com', '123 Main Street,New York,États-Unis', 'Studio de design graphique offrant des services créatifs et uniques pour aider les entreprises à se démarquer.', ''),
(4, 'Finance Solutions Inc.', 4, 'info@financesolutions.com', '789 Broadway,New York,États-Unis', 'Cabinet de conseil financier offrant des solutions personnalisées pour optimiser la gestion des ressources financières.', ''),
(5, 'Software Development Innovations', 1, 'contact@softwaredevinnovations.com', '10 Downing Street,London,Royaume-Uni', 'Entreprise spécialisée dans le développement logiciel proposant des solutions technologiques avancées.', ''),
(6, 'HR Excellence Agency', 5, 'info@hrexcellence.com', '456 Rue de la Liberté,Paris,France', 'Cabinet de conseil en ressources humaines offrant des services de recrutement et de gestion du personnel.', ''),
(7, 'Civil Engineering Solutions', 6, 'info@civilengineeringsolutions.com', '789 Avenue des Canadiens,Montreal,Canada', '**Présentation de l\'Entreprise:**\r\nCivil Engineering Solutions est une entreprise d\'ingénierie civile basée à Montréal, au Canada, offrant des solutions complètes pour la réalisation de projets de construction. Nous sommes fiers de notre engagement envers l\'excellence technique, l\'innovation et la satisfaction du client, et nous nous efforçons de fournir des services de haute qualité dans tous les aspects de l\'ingénierie civile.\r\n\r\n**Domaines d\'Expertise:**\r\nNous offrons une gamme complète de services d\'ingénierie civile couvrant divers domaines, notamment :\r\n- Conception et construction de routes et d\'autoroutes\r\n- Conception et construction de ponts et de structures de génie civil\r\n- Planification et aménagement urbain\r\n- Gestion des eaux et des ressources hydriques\r\n- Conception et construction d\'infrastructures de transport en commun\r\n- Études géotechniques et analyse des sols\r\n- Services de consultation en développement durable et en gestion de projet\r\n\r\n**Engagement envers l\'Excellence:**\r\nChez Civil Engineering Solutions, nous nous engageons à fournir des solutions d\'ingénierie de pointe qui répondent aux besoins de nos clients tout en respectant les normes les plus élevées de qualité, de durabilité et de sécurité. Notre équipe d\'ingénieurs expérimentés et de professionnels qualifiés travaille en étroite collaboration avec nos clients pour comprendre leurs objectifs et concevoir des solutions sur mesure qui surpassent leurs attentes.\r\n\r\n**Approche Collaborative:**\r\nNous croyons en une approche collaborative et transparente dans tous nos projets, en favorisant une communication ouverte et un partenariat solide avec nos clients, nos partenaires et les parties prenantes concernées. Cette approche nous permet de garantir la réussite de chaque projet, en assurant une coordination efficace, une gestion proactive des risques et une livraison dans les délais et le budget prévus.\r\n\r\n**Coordonnées:**\r\n- Adresse: 789 Avenue des Canadiens, Montréal, Canada\r\n- Adresse e-mail: info@civilengineeringsolutions.com\r\n\r\n**Opportunités de Carrière:**\r\nCivil Engineering Solutions offre un environnement de travail dynamique et stimulant, propice à la croissance professionnelle et à l\'épanouissement personnel. Nous recherchons constamment des talents passionnés et talentueux pour rejoindre notre équipe et contribuer à notre succès commun. Si vous êtes intéressé par une carrière enrichissante dans le domaine de l\'ingénierie civile, veuillez nous contacter à l\'adresse e-mail indiquée ci-dessus pour en savoir plus sur les opportunités actuelles.\r\n\r\nChez Civil Engineering Solutions, nous sommes déterminés à façonner un avenir meilleur grâce à des solutions d\'ingénierie novatrices et durables. Rejoignez-nous dans cette mission passionnante et contribuez à la construction d\'un monde meilleur pour les générations futures.\r\n                \r\n                \r\n                \r\n                ', ''),
(8, 'Communication Strategies Inc.', 7, 'info@communicationstrategies.com', '1010 Market Street,San Francisco,États-Unis', 'Agence de communication proposant des stratégies créatives et efficaces pour améliorer la visibilité des entreprises.', ''),
(9, 'Molecular Biology Research Lab', 8, 'contact@molecularbiologylab.com', '123 Rue du Faubourg,Saint-Denis,France', 'Laboratoire de recherche en biologie moléculaire se concentrant sur l\'innovation et la découverte scientifique.', ''),
(10, 'Industrial Design Innovations', 3, 'info@industrialdesigninnovations.com', '456 Rue de la République,Lyon,France', 'Studio de design industriel spécialisé dans la création de produits novateurs et fonctionnels.', ''),
(11, 'Vitality', 11, 'theo.marteel@viacesi.fr', '6 Rue Gustave Delory', '**Présentation de l\'Équipe:**\r\nVitality E-Sport est une équipe de sport électronique de renommée mondiale, basée à 6 Rue Gustave Delory. Nous sommes fiers de notre engagement envers l\'excellence dans l\'e-sport, l\'innovation et le développement des talents. Depuis notre création, nous avons forgé une réputation solide en tant que l\'une des équipes les plus compétitives et les plus respectées de l\'industrie.\r\n\r\n**Disciplines et Compétitions:**\r\nNous sommes actifs dans plusieurs disciplines de l\'e-sport, notamment :\r\n- Counter-Strike: Global Offensive (CS:GO)\r\n- League of Legends (LoL)\r\n- Fortnite\r\n- Rainbow Six Siege\r\n- Rocket League\r\n- FIFA\r\net bien d\'autres.\r\n\r\nNous participons régulièrement à des compétitions nationales et internationales, notamment des tournois majeurs et des ligues professionnelles, où nous visons à atteindre les plus hauts niveaux de performance et à remporter des titres prestigieux.\r\n\r\n**Approche de l\'Entraînement:**\r\nChez Vitality E-Sport, nous adoptons une approche professionnelle de l\'entraînement et du développement des compétences. Notre équipe d\'entraîneurs et de staff technique travaille en étroite collaboration avec nos joueurs pour créer des programmes d\'entraînement personnalisés, visant à maximiser leur potentiel et à améliorer leurs performances sur le long terme. Nous mettons également l\'accent sur le bien-être mental et physique de nos joueurs, en leur fournissant un soutien complet pour maintenir un équilibre sain entre la compétition et la vie quotidienne.\r\n\r\n**Engagement envers la Communauté:**\r\nEn tant que membres de la communauté e-sportive, nous sommes déterminés à inspirer et à motiver les futurs talents en partageant notre passion pour l\'e-sport et en encourageant la croissance de la scène e-sportive à travers le monde. Nous organisons régulièrement des événements communautaires, des séances de rencontre avec les fans et des programmes de développement de jeunes talents pour soutenir et encourager la prochaine génération de joueurs.\r\n\r\n**Coordonnées:**\r\n- Adresse: 6 Rue Gustave Delory\r\n- Contact: theo.marteel@viacesi.fr\r\n\r\n**Opportunités:**\r\nVitality E-Sport offre un environnement dynamique et stimulant pour les joueurs talentueux et passionnés qui aspirent à une carrière professionnelle dans l\'e-sport. Si vous souhaitez rejoindre notre équipe ou en savoir plus sur nos programmes de recrutement et nos opportunités de développement, veuillez contacter Theo Marteel à l\'adresse e-mail indiquée ci-dessus.\r\n\r\nChez Vitality E-Sport, nous sommes animés par la passion pour l\'e-sport et la volonté de repousser les limites de l\'excellence. Rejoignez-nous dans notre quête de domination compétitive et de succès sur la scène e-sportive mondiale.', '');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promo` int(11) NOT NULL,
  `promo` text NOT NULL,
  `displayName` text NOT NULL,
  `centre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `promo`, `displayName`, `centre`) VALUES
(1, 'LI3JP201', 'A2 Informatique', 'Lille'),
(2, 'LI1JP115', 'A3 Généraliste', 'Lille'),
(3, 'phantom blood', 'A1 Jonathan', 'Angleterre'),
(500, 'Unused', 'Unused', 'Unused'),
(501, 'AR3JP201', 'A2 Généraliste', 'Arras'),
(502, 'AR2JP201', 'A3 Généraliste', 'Arras'),
(503, 'AR1JP102', 'A1 Généraliste', 'Arras');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_utilisateur` int(11) NOT NULL,
  `id_stage` int(11) NOT NULL,
  `wish_listed` tinyint(1) DEFAULT NULL,
  `status_offre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id_utilisateur`, `id_stage`, `wish_listed`, `status_offre`) VALUES
(1, 1, 1, NULL),
(2, 7, 1, NULL),
(4, 2, NULL, NULL),
(4, 3, NULL, NULL),
(4, 7, 0, NULL),
(4, 9, 1, NULL),
(4, 10, 0, NULL),
(4, 11, 0, NULL),
(7, 1, 1, NULL),
(7, 3, 0, NULL),
(7, 7, 0, NULL),
(7, 9, 0, NULL),
(7, 10, 0, NULL),
(7, 12, 1, NULL),
(8, 9, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `secteur_activite`
--

CREATE TABLE `secteur_activite` (
  `id_secteur` int(11) NOT NULL,
  `secteur` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `secteur_activite`
--

INSERT INTO `secteur_activite` (`id_secteur`, `secteur`) VALUES
(1, 'Informatique'),
(2, 'Web'),
(3, 'Finance'),
(4, 'Santé'),
(5, 'Éducation'),
(6, 'Transport'),
(7, 'Immobilier'),
(8, 'Commerce'),
(11, 'E-Sport');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id_stage` int(11) NOT NULL,
  `titre` text DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `domaine_activite` text DEFAULT NULL,
  `duree` text DEFAULT NULL,
  `remuneration` decimal(15,2) DEFAULT NULL,
  `date_offre` datetime DEFAULT NULL,
  `places_disponibles` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `promo_concernees` varchar(10) DEFAULT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id_stage`, `titre`, `competences`, `adresse`, `domaine_activite`, `duree`, `remuneration`, `date_offre`, `places_disponibles`, `description`, `promo_concernees`, `id_entreprise`) VALUES
(1, 'Stage en développement web', 'HTML, CSS, JavaScript, PHP, MongoDB', '123 Rue de la République, Paris,France', 'Informatique', '4 mois', 1000.00, '2024-03-31 15:42:10', 3, '**Résumé du Poste:**\r\nNous proposons une opportunité stimulante pour un stagiaire en développement web de rejoindre notre équipe dynamique. Ce stage offre une expérience pratique dans le développement web utilisant des technologies telles que HTML, CSS, JavaScript, PHP et MongoDB. Le stagiaire travaillera sous la supervision de nos développeurs expérimentés pour contribuer à la conception, au développement et à la maintenance de nos applications web.\r\n\r\n**Responsabilités:**\r\n1. Participer activement à toutes les phases du développement web, y compris la conception, la programmation, les tests et la maintenance.\r\n2. Collaborer avec les membres de l\'équipe pour comprendre les exigences du projet et proposer des solutions techniques appropriées.\r\n3. Développer des interfaces utilisateur interactives et conviviales en utilisant HTML, CSS et JavaScript.\r\n4. Intégrer des fonctionnalités côté serveur en utilisant PHP et des bases de données MongoDB.\r\n5. Assurer la compatibilité multiplateforme et la réactivité des applications web.\r\n6. Tester et déboguer les applications pour garantir leur qualité, leur performance et leur sécurité.\r\n7. Documenter le code développé et les processus associés pour faciliter la maintenance et le transfert des connaissances.\r\n\r\n**Compétences Requises:**\r\n1. Étudiant en informatique, génie logiciel ou domaine connexe (niveau Bac+3 minimum).\r\n2. Solide compréhension des langages et des technologies web, notamment HTML, CSS, JavaScript, PHP et MongoDB.\r\n3. Capacité à travailler de manière autonome et en équipe, avec d\'excellentes compétences en communication.\r\n4. Aptitude à résoudre des problèmes de manière créative et à apprendre rapidement de nouvelles technologies.\r\n5. Passion pour le développement web et désir de contribuer à des projets innovants.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique dans un environnement professionnel dynamique.\r\n2. Encadrement et mentorat par des experts du développement web.\r\n3. Opportunité de travailler sur des projets concrets et de développer des compétences précieuses.\r\n4. Possibilité de collaborer avec une équipe multiculturelle et diversifiée.\r\n5. Flexibilité et soutien pour l\'équilibre travail-vie personnelle.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+3', 1),
(2, 'Stage en marketing digital', 'Marketing, Analyse de données, SEO, SEA', '456 Avenue des Champs-Élysées,Paris,France', 'Marketing', '3 mois', 1200.00, '2024-03-15 00:00:00', 2, 'Découvrez le monde fascinant du marketing digital avec notre entreprise innovante.', 'bac+3', 2),
(3, 'Stage en design graphique', 'Adobe Photoshop, Adobe Illustrator', '123 Main Street,New York,États-Unis', 'Design', '4 mois', 1800.00, '2024-04-01 13:04:45', 1, '**Résumé du Poste:**\r\nNous proposons une opportunité passionnante pour un stagiaire en design graphique de rejoindre notre équipe créative. Ce stage offre une expérience pratique dans le domaine du design graphique, en mettant l\'accent sur l\'utilisation des logiciels Adobe Photoshop et Adobe Illustrator. Le stagiaire travaillera en étroite collaboration avec nos graphistes expérimentés pour contribuer à la création de supports visuels attrayants et efficaces pour nos projets et nos campagnes.\r\n\r\n**Responsabilités:**\r\n1. Participer à la conception et à la création de supports graphiques pour diverses applications, y compris des affiches, des brochures, des logos, des bannières web, etc.\r\n2. Utiliser Adobe Photoshop pour retoucher des images, créer des compositions visuelles et réaliser des montages photo.\r\n3. Utiliser Adobe Illustrator pour créer des illustrations vectorielles, des logos et des graphiques.\r\n4. Collaborer avec l\'équipe marketing pour comprendre les besoins du projet et proposer des concepts de design innovants.\r\n5. Contribuer à l\'élaboration de chartes graphiques et à la création de maquettes pour des projets de design.\r\n6. Assister à la création de présentations visuelles et à la préparation de fichiers pour l\'impression ou le web.\r\n7. Participer à des séances de brainstorming et à des réunions d\'équipe pour discuter des idées de design et des stratégies créatives.\r\n\r\n**Compétences Requises:**\r\n1. Étudiant en design graphique, en arts visuels ou domaine connexe (niveau Bac+4 minimum).\r\n2. Excellente maîtrise des logiciels Adobe Photoshop et Adobe Illustrator.\r\n3. Créativité, sens esthétique développé et capacité à penser de manière innovante.\r\n4. Compétences en communication visuelle et capacité à traduire des concepts en éléments graphiques attrayants.\r\n5. Capacité à travailler de manière autonome et en équipe, avec une attention particulière aux détails.\r\n6. Passion pour le design graphique et désir de contribuer à des projets créatifs et impactants.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique au sein d\'une équipe de design créative et dynamique.\r\n2. Encadrement et mentorat par des graphistes expérimentés.\r\n3. Opportunité de travailler sur des projets concrets et de développer des compétences avancées en design graphique.\r\n4. Accès à des outils et des ressources de pointe pour la création graphique.\r\n5. Flexibilité pour explorer différents aspects du design graphique et pour développer des compétences spécialisées.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+4', 10),
(4, 'Stage en finance d\'entreprise', 'Analyse financière, Gestion de portefeuille', '789 Broadway,New York,États-Unis', 'Finance', '6 mois', 2000.00, '2024-03-30 11:28:57', 2, ' Rejoindre notre équipe représente une opportunité unique d\'acquérir une expérience précieuse dans le domaine de la finance d\'entreprise. Travailler aux côtés de professionnels chevronnés offre un environnement propice à l\'apprentissage et au développement des compétences essentielles dans ce domaine en constante évolution. Que vous soyez un étudiant en finance cherchant à mettre en pratique vos connaissances théoriques ou un professionnel en transition de carrière désireux d\'explorer de nouveaux horizons, notre équipe vous offre les outils et les ressources nécessaires pour réussir.\r\n\r\nAu sein de notre équipe, vous aurez l\'occasion de participer à des projets variés et stimulants, couvrant un large éventail de domaines de la finance d\'entreprise. De l\'analyse des états financiers à la modélisation financière en passant par la gestion des risques, vous serez exposé à des aspects cruciaux de la finance d\'entreprise et aurez la possibilité d\'approfondir votre compréhension de ces concepts. De plus, travailler dans un environnement collaboratif vous permettra de développer vos compétences interpersonnelles et votre capacité à travailler en équipe, des qualités essentielles dans le monde professionnel moderne.\r\n\r\nEnfin, rejoindre notre équipe va au-delà de l\'acquisition de compétences techniques. C\'est également une occasion de faire partie d\'une communauté professionnelle dynamique, où le partage des connaissances et le mentorat sont valorisés. En collaborant avec des collègues passionnés et engagés, vous aurez l\'opportunité de développer des relations professionnelles précieuses et de construire un réseau solide dans le domaine de la finance d\'entreprise. En somme, joindre notre équipe représente un pas important vers une carrière réussie dans le monde passionnant de la finance d\'entreprise. ', 'bac+4', 4),
(5, 'Stage en développement logiciel', 'Java, C, Python, AngularJS, React', '10 Downing Street,London,Royaume-Uni', 'Informatique', '6 mois', 1241.68, '2024-03-31 13:09:46', 2, '**Résumé du Poste:**\r\nNous offrons une opportunité passionnante pour un stagiaire en développement logiciel afin de rejoindre notre équipe dynamique et collaborative. Ce stage offre une expérience pratique dans le développement de logiciels utilisant des technologies telles que Java, C, React et Python. Le stagiaire travaillera sous la supervision de nos experts en développement pour contribuer à la conception, au développement et à la maintenance de nos solutions logicielles.\r\n\r\n**Responsabilités:**\r\n1. Participer activement à toutes les phases du cycle de vie du développement logiciel, y compris la conception, le développement, les tests et la maintenance.\r\n2. Collaborer avec les membres de l\'équipe pour comprendre les besoins du projet et proposer des solutions techniques appropriées.\r\n3. Développer des fonctionnalités robustes et efficaces en utilisant les langages de programmation Java, C, React et Python.\r\n4. Contribuer à l\'amélioration continue de la qualité du code en suivant les meilleures pratiques de développement et en participant à des revues de code.\r\n5. Tester et déboguer les applications pour garantir leur performance, leur sécurité et leur fiabilité.\r\n6. Documenter le code développé et les processus associés pour faciliter la maintenance et le transfert des connaissances.\r\n\r\n**Compétences Requises:**\r\n1. Maîtrise ou en cours de formation en informatique, génie logiciel ou domaine connexe (niveau Bac+3 minimum).\r\n2. Solide compréhension des principes de programmation orientée objet.\r\n3. Connaissance pratique de Java, C, React et Python.\r\n4. Capacité à travailler de manière autonome et en équipe, avec d\'excellentes compétences en communication.\r\n5. Aptitude à résoudre des problèmes de manière créative et à apprendre rapidement de nouvelles technologies.\r\n6. Passion pour le développement logiciel et désir de contribuer à des projets innovants.\r\n\r\n**Avantages du Stage:**\r\n1. Une expérience enrichissante dans un environnement professionnel stimulant.\r\n2. Mentorat et encadrement par des experts du domaine.\r\n3. Opportunité de travailler sur des projets concrets et de développer des compétences précieuses.\r\n4. Possibilité de collaborer avec une équipe multiculturelle et diversifiée.\r\n5. Flexibilité et soutien pour l\'équilibre travail-vie personnelle.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont invités à postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+3', 5),
(7, 'Stage en génie civil', 'Calcul de structures, Autocad', '789 Avenue des Canadiens,Montreal,Canada', 'Ingénierie', '6 mois', 1900.00, '2024-04-02 11:26:33', 2, '**Résumé du Poste:**\r\nNous vous proposons une opportunité exceptionnelle de participer à la réalisation de projets d\'ingénierie civile d\'envergure, offrant ainsi une contribution significative à l\'infrastructure de notre société. En rejoignant notre équipe, vous aurez l\'occasion de travailler sur une variété de projets ambitieux, allant de la conception de ponts et de routes à la planification de grands projets d\'aménagement urbain. En tant que membre de notre équipe, vous serez impliqué à toutes les étapes du processus, ce qui vous permettra d\'acquérir une expérience pratique précieuse dans le domaine de l\'ingénierie civile.\r\n\r\n**Responsabilités:**\r\n1. Participer à la conception et à la planification de projets d\'ingénierie civile, en étroite collaboration avec des ingénieurs expérimentés.\r\n2. Assister à l\'analyse des besoins du projet et à l\'évaluation des contraintes techniques et économiques.\r\n3. Contribuer à l\'élaboration de plans et de dessins techniques, en utilisant des logiciels spécialisés tels que AutoCAD ou Civil 3D.\r\n4. Collaborer à la coordination des activités sur le chantier et à la supervision des travaux de construction.\r\n5. Assister à la réalisation d\'études de faisabilité, d\'évaluations environnementales et d\'analyses de risques.\r\n6. Participer à l\'élaboration de rapports techniques et à la documentation des processus de conception et de construction.\r\n\r\n**Compétences Requises:**\r\n1. Étudiant en génie civil, en génie des infrastructures ou domaine connexe (niveau Bac+5 minimum).\r\n2. Solides connaissances théoriques en génie civil et en conception d\'infrastructures.\r\n3. Capacité à travailler de manière autonome et en équipe, avec d\'excellentes compétences en communication.\r\n4. Maîtrise des logiciels de conception assistée par ordinateur (CAO) tels que AutoCAD, Civil 3D, etc.\r\n5. Capacité à comprendre et à interpréter des plans et des dessins techniques.\r\n6. Intérêt pour les grands projets d\'infrastructure et désir de contribuer à leur réalisation.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique au sein d\'une équipe de professionnels expérimentés en ingénierie civile.\r\n2. Participation à des projets d\'envergure et à toutes les phases du processus, de la conception à la réalisation.\r\n3. Opportunité d\'acquérir des compétences techniques et professionnelles précieuses dans le domaine de l\'ingénierie civile.\r\n4. Encadrement et mentorat par des ingénieurs expérimentés et des experts du domaine.\r\n5. Contribution significative à l\'infrastructure de la société et à l\'amélioration de la qualité de vie des communautés.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+5', 3),
(9, 'Stage en biologie moléculaire', 'PCR, Clonage, Microscopie', '123 Rue du Faubourg,Saint-Denis,France', 'Sciences', '5 mois', 1800.00, '2024-04-02 23:25:03', 2, '**Résumé du Poste:**\r\nNous offrons une opportunité passionnante pour un stagiaire en biologie moléculaire de rejoindre notre équipe dédiée à la recherche scientifique. Ce stage offre une expérience pratique dans des techniques de pointe en biologie moléculaire, notamment la PCR (Réaction en Chaîne par Polymérase), le clonage et la microscopie. Le stagiaire travaillera sous la supervision de nos chercheurs expérimentés pour contribuer à la conception, à la réalisation et à l\'analyse d\'expériences visant à mieux comprendre les processus biologiques fondamentaux.\r\n\r\n**Responsabilités:**\r\n1. Participer à la planification et à la conception d\'expériences en biologie moléculaire, en utilisant des techniques telles que la PCR et le clonage.\r\n2. Effectuer des expériences de laboratoire, y compris la manipulation d\'ADN, la préparation d\'échantillons, et l\'exécution de protocoles de PCR.\r\n3. Effectuer des techniques de clonage pour la construction de vecteurs et la manipulation génétique.\r\n4. Préparer des échantillons pour l\'observation microscopique et réaliser des analyses d\'imagerie.\r\n5. Analyser les données expérimentales, interpréter les résultats et présenter les conclusions de manière claire et concise.\r\n6. Contribuer à la documentation des procédures expérimentales et des résultats obtenus.\r\n\r\n**Compétences Requises:**\r\n1. Diplôme universitaire en biologie, biotechnologie, biochimie ou domaine connexe (niveau Bac+5 minimum).\r\n2. Solides connaissances théoriques et pratiques en biologie moléculaire.\r\n3. Expérience pratique avec des techniques de laboratoire telles que la PCR, le clonage et la microscopie.\r\n4. Capacité à travailler de manière autonome, avec précision et rigueur, tout en respectant les normes de sécurité en laboratoire.\r\n5. Aptitude à analyser et interpréter des données expérimentales, et à communiquer efficacement les résultats.\r\n6. Passion pour la recherche scientifique et désir de contribuer à des découvertes innovantes dans le domaine de la biologie moléculaire.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique au sein d\'un environnement de recherche stimulant et collaboratif.\r\n2. Encadrement et mentorat par des chercheurs expérimentés.\r\n3. Opportunité de participer à des projets de recherche novateurs et de développer des compétences avancées en biologie moléculaire.\r\n4. Accès à des équipements de pointe et à des ressources technologiques de pointe.\r\n5. Flexibilité pour explorer différents aspects de la recherche en biologie moléculaire et pour développer des compétences spécialisées.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+5', 9),
(10, 'Stage en design industriel', 'Sketching, Modélisation 3D, AutoCAD', '456 Rue de la République,Lyon,France', 'Design', '3 mois', 1500.00, '2024-04-02 23:23:30', 1, '**Résumé du Poste:**\r\nNous offrons une opportunité passionnante pour un stagiaire en design industriel de rejoindre notre équipe créative et innovante. Ce stage offre une expérience pratique dans divers aspects du design industriel, notamment le sketching, la modélisation 3D et l\'utilisation d\'AutoCAD. Le stagiaire travaillera en étroite collaboration avec nos designers expérimentés pour contribuer au développement de concepts de produits et à la création de modèles numériques.\r\n\r\n**Responsabilités:**\r\n1. Participer à des séances de brainstorming pour générer des idées de design innovantes et fonctionnelles.\r\n2. Utiliser des techniques de sketching pour représenter visuellement les concepts de design.\r\n3. Créer des modèles 3D réalistes en utilisant des logiciels de modélisation tels que SolidWorks, Fusion 360 ou Rhino.\r\n4. Effectuer des rendus et des animations pour présenter les concepts de design de manière convaincante.\r\n5. Collaborer avec les ingénieurs et d\'autres membres de l\'équipe pour intégrer les aspects techniques dans les concepts de design.\r\n6. Contribuer à la création de plans de fabrication et de documentation technique à l\'aide d\'AutoCAD.\r\n7. Assister à des réunions de projet et participer activement à la résolution de problèmes de conception.\r\n\r\n**Compétences Requises:**\r\n1. Étudiant en design industriel, en génie mécanique ou domaine connexe (niveau Bac+5 minimum).\r\n2. Maîtrise des techniques de sketching pour communiquer des idées de design rapidement et efficacement.\r\n3. Expérience pratique dans la modélisation 3D avec des logiciels tels que SolidWorks, Fusion 360, Rhino, etc.\r\n4. Connaissance approfondie d\'AutoCAD pour la création de plans de fabrication et de documentation technique.\r\n5. Créativité, sens esthétique développé et capacité à penser de manière innovante.\r\n6. Excellentes compétences en communication et capacité à travailler en équipe.\r\n7. Capacité à gérer efficacement son temps et à respecter les délais.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique au sein d\'une équipe de design industrielle dynamique et collaborative.\r\n2. Encadrement et mentorat par des designers expérimentés.\r\n3. Opportunité de travailler sur des projets de design concrets et de contribuer à leur développement du concept à la réalisation.\r\n4. Accès à des outils et des technologies de pointe pour la conception et la modélisation.\r\n5. Possibilité de développer des compétences techniques et créatives précieuses pour une carrière dans le design industriel.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+5', 10),
(11, 'Software Dev [H/F]', 'Java, C, Python, AngularJS, React', '6 Rue Gustave Delory', NULL, '4 mois', 900.00, '2024-03-31 15:37:41', 2, '**Aperçu du stage :**\r\nPlongez dans le domaine du développement logiciel avec notre programme de stage dynamique. En tant que Stagiaire en Développement Logiciel, vous explorerez des projets de pointe, travaillant aux côtés de professionnels chevronnés dans un environnement collaboratif et innovant. Ce stage offre une opportunité unique d\'acquérir une expérience pratique, de perfectionner vos compétences et de contribuer à des projets concrets qui font la différence.\r\n\r\n**Responsabilités clés :**\r\n\r\n1. **Codage et Développement :** Plongez-vous dans les défis de codage, en écrivant un code propre et efficace dans divers langages de programmation et plates-formes. Travaillez sur des améliorations de fonctionnalités, des corrections de bogues et de nouveaux projets de développement logiciel sous la supervision de développeurs expérimentés.\r\n\r\n2. **Résolution de Problèmes Collaborative :** Participez à des séances de remue-méninges et à des exercices de résolution de problèmes en collaboration avec des équipes pluridisciplinaires. Apportez des idées, proposez des solutions et participez activement aux discussions pour résoudre des problèmes techniques complexes.\r\n\r\n3. **Tests et Assurance Qualité :** Apprenez l\'importance des méthodologies de test et des processus d\'assurance qualité. Aidez à rédiger et à exécuter des cas de test, à identifier les bogues et à garantir la fiabilité et les performances globales des applications logicielles.\r\n\r\n4. **Documentation et Rapports :** Maîtrisez la documentation des changements de code, des spécifications techniques et de l\'avancement du projet. Préparez des rapports détaillés et une documentation pour suivre les jalons de développement, communiquer les mises à jour du projet et faciliter le transfert de connaissances au sein de l\'équipe.\r\n\r\n5. **Apprentissage Continu et Amélioration des Compétences :** Adoptez une culture d\'apprentissage continu et de croissance professionnelle. Profitez des ressources d\'apprentissage, des sessions de formation et des opportunités de mentorat pour élargir vos compétences techniques, rester informé des tendances de l\'industrie et perfectionner votre expertise en développement logiciel.\r\n\r\n**Qualifications :**\r\n\r\n- Étudiant(e) en informatique, génie logiciel ou dans un domaine connexe.\r\n- Maîtrise d\'au moins un langage de programmation (par exemple, Python, Java, JavaScript, C++) et volonté d\'apprendre de nouvelles technologies.\r\n- Solides compétences en résolution de problèmes et passion pour le développement logiciel.\r\n- Excellentes capacités de communication et d\'esprit d\'équipe.\r\n- Capacité à s\'adapter à des environnements rapides et à gérer efficacement plusieurs tâches.\r\n\r\n**Avantages :**\r\n\r\n- Expérience pratique sur des projets concrets.\r\n- Mentorat de développeurs logiciels expérimentés et de professionnels de l\'industrie.\r\n- Exposition à des technologies de pointe et à des méthodologies de développement.\r\n- Opportunités de réseautage avec des pairs et des professionnels du secteur.\r\n- Possibilité d\'avancement de carrière et de considération pour de futures opportunités d\'emploi.\r\n\r\n**Durée :**\r\nCe programme de stage s\'étend généralement sur [insérer la durée], offrant aux stagiaires une expérience d\'apprentissage complète et de nombreuses opportunités de croissance et de développement.\r\n\r\n**Rejoignez-nous :**\r\nSi vous êtes impatient(e) de vous lancer dans une aventure passionnante dans le monde du développement logiciel et de faire une différence significative grâce à votre travail, nous vous invitons à vous joindre à notre équipe en tant que Stagiaire en Développement Logiciel. Faites le premier pas pour libérer tout votre potentiel et façonner l\'avenir de la technologie. Postulez dès maintenant et libérez votre créativité, votre innovation et votre passion pour le codage !', 'bac+4', 3),
(12, 'Photoshop Engineer [H/F]', 'Java, C, Python, AngularJS, React', '6 Rue Gustave Delory', 'Design', '4 mois', 900.00, '2024-04-02 16:52:03', 4, '**Résumé du Poste:**\r\nNous proposons une opportunité passionnante pour un stagiaire en tant qu\'Engineer spécialisé(e) en Photoshop pour rejoindre notre équipe de développement logiciel. Ce stage offre une expérience pratique dans l\'intégration et l\'optimisation des fonctionnalités de Photoshop en utilisant une variété de langages de programmation tels que Java, C, Python, AngularJS et React. Le stagiaire travaillera en collaboration avec nos ingénieurs expérimentés pour contribuer à l\'amélioration de l\'efficacité et des performances de notre logiciel en intégrant des fonctionnalités avancées de Photoshop.\r\n\r\n**Responsabilités:**\r\n1. Participer à l\'analyse des besoins des utilisateurs et à la spécification des fonctionnalités à intégrer dans notre logiciel.\r\n2. Développer des modules et des plugins en utilisant Java, C, Python, AngularJS et React pour étendre les fonctionnalités de Photoshop.\r\n3. Collaborer avec l\'équipe de conception pour intégrer de manière transparente les fonctionnalités de Photoshop dans l\'interface utilisateur de notre logiciel.\r\n4. Optimiser les performances et la compatibilité de notre logiciel avec les différentes versions de Photoshop.\r\n5. Effectuer des tests unitaires et des tests d\'intégration pour assurer la fiabilité et la stabilité des fonctionnalités intégrées.\r\n6. Documenter le code développé et les procédures associées pour faciliter la maintenance et le transfert des connaissances.\r\n\r\n**Compétences Requises:**\r\n1. Étudiant(e) en informatique, génie logiciel ou domaine connexe (niveau Bac+5 minimum).\r\n2. Maîtrise des langages de programmation Java, C et Python.\r\n3. Expérience pratique avec les frameworks AngularJS et React pour le développement d\'applications web.\r\n4. Connaissance des principes de conception logicielle et des bonnes pratiques de développement.\r\n5. Capacité à travailler de manière autonome et en équipe, avec d\'excellentes compétences en communication.\r\n6. Aptitude à résoudre des problèmes de manière créative et à apprendre rapidement de nouvelles technologies.\r\n\r\n**Avantages du Stage:**\r\n1. Expérience pratique au sein d\'une équipe de développement logiciel dynamique et innovante.\r\n2. Encadrement et mentorat par des ingénieurs expérimentés.\r\n3. Opportunité de travailler sur des projets concrets et de contribuer à l\'amélioration des logiciels utilisés par des millions d\'utilisateurs.\r\n4. Accès à des outils et des ressources de pointe pour le développement logiciel.\r\n5. Flexibilité pour explorer différents aspects du développement logiciel et pour développer des compétences spécialisées.\r\n\r\n**Comment Postuler:**\r\nLes candidats intéressés sont priés de postuler. Les candidatures seront évaluées au fur et à mesure de leur réception, et le processus de sélection pourra être clôturé une fois le poste pourvu.', 'bac+5', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login` text NOT NULL,
  `mot_de_passe` text NOT NULL,
  `profilePic` text NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `id_promo` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `mot_de_passe`, `profilePic`, `nom`, `prenom`, `id_promo`, `type`) VALUES
(1, 'adam.adjeroud@viacesi.fr', 'f7f376a1fcd0d0e11a10ed1b6577c99784d3a6bbe669b1d13fae43eb64634f6e', 'IMG_20240403_090707915.jpg', 'Adjeroud', 'Adam', 1, 1),
(2, 'maksum@viacesi.fr', '8a425aeb5a3cd7d80744f2d49a8b583ff2c8431da7b2fe1d3564e759be9ede05', 'IMG_20240403_083719514.jpg', 'Chakira', 'Maksum', 1, 1),
(3, 'smail@viacesi.fr', 'cb5ae6b802109557edbeaa78d8e8c90ec4a1c13199aea7317f193617629973f6', '', 'Benali', 'Smail', 500, 2),
(4, 'amir@viacesi.fr', '1574ad62d48a37f847699d7d2157105a5a5fd6ed323a3497fa41c7731229bf23', '', 'Chachoui', 'Amir', 500, 2),
(7, 'theo.marteel@viacesi.fr', 'e9e27a6e15e5ca210351d03e41266f864328e531ce10c7338a13e85443997899', 'img_20240204_164524032~2-200w.jpg', 'MARTEL', 'Théo', 1, 1),
(8, 'aymeric.delabie@viacesi.fr', '2aa5945c13240afbfcecca21100181753020fae848d72fab7c1aa3d0833ed14c', 'sniffer.jpg', 'DELABIE', 'Aymeric', 501, 1),
(9, 'mtisseaux@cesi.fr', '2aa5945c13240afbfcecca21100181753020fae848d72fab7c1aa3d0833ed14c', '', 'TISSEAUX', 'Myriam', 500, 2),
(10, 'maths.brydenbach@gmail.com', '138adf58fb8a0b0357417b581573bfc658f4aa828f574cfe1bd198ff4a2966a1', 'looker.jpg', 'Brydenbach', 'Ludovic', 500, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`id_utilisateur`,`id_promo`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);
ALTER TABLE `entreprise` ADD FULLTEXT KEY `nom` (`nom`);
ALTER TABLE `entreprise` ADD FULLTEXT KEY `nom_2` (`nom`,`description`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promo`);
ALTER TABLE `promotion` ADD FULLTEXT KEY `promo` (`promo`);
ALTER TABLE `promotion` ADD FULLTEXT KEY `displayName` (`displayName`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_utilisateur`,`id_stage`),
  ADD KEY `id_stage` (`id_stage`);

--
-- Index pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  ADD PRIMARY KEY (`id_secteur`);
ALTER TABLE `secteur_activite` ADD FULLTEXT KEY `secteur` (`secteur`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `id_entreprise` (`id_entreprise`);
ALTER TABLE `stage` ADD FULLTEXT KEY `titre` (`titre`,`competences`,`adresse`,`domaine_activite`,`description`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `promo` (`type`),
  ADD KEY `promo_idetrangere` (`id_promo`);
ALTER TABLE `utilisateur` ADD FULLTEXT KEY `nom` (`nom`,`prenom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `appartenir_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`);

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`id_stage`) REFERENCES `stage` (`id_stage`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `promo_idetrangere` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
