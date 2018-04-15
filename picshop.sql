-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 16 avr. 2018 à 00:02
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `picshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `pk_id` int(11) NOT NULL,
  `nom` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`pk_id`, `nom`) VALUES
(1, 'urbain'),
(2, 'nature'),
(3, 'portrait'),
(4, 'paysage');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `pkid` int(4) NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 NOT NULL,
  `prix` float NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`pkid`, `titre`, `description`, `prix`, `url`, `fk`) VALUES
(1, 'Bordeaux', 'Shortcutting in Stockholm can lead you special places - places like the spacy Brunkeberg Tunnel.', 12, 'DSC0266-min.jpg', 1),
(2, 'Photographer and people', 'Despite nearly dying by way of black ice on the roads while driving in Golden Ears Provincial Park, yesterday morning still proved to be the most beautiful I had ever experienced there. Soft, still, serene, silent. Exactly what my dreams are made of.', 5, 'DSC0323-min.jpg', 1),
(3, 'Tree and the darkness', 'Just some magic in the Forest', 16, 'Bolga_0020-min.jpg', 4),
(4, 'River', 'Despite nearly dying by way of black ice on the roads while driving in Golden Ears Provincial Park, yesterday morning still proved to be the most beautiful I had ever experienced there. Soft, still, serene, silent. Exactly what my dreams are made of.', 25, 'bolga_0032.jpg', 1),
(5, 'Summer Lake', 'The famous colorful fishing nets near the city of Xiapu, Fujian province, China.', 15, 'DSC_0222.jpg', 4),
(6, 'Violins', 'This entire cave was like standing in a freezing cold shower... worth it? Oh yes. <3', 17, 'dsc0551.jpg', 3),
(7, 'Eiffel tower', 'Usually I am not really happy with just a blue sky and no clouds but sometimes it gives a wonderful color contrast in an image. So was it that morning when I was shooting the old harbour of Maassluis.', 19, 'dsc0088.jpg', 1),
(8, 'Way', 'From a series of shots on Slieve Meelbeg taken last October. Following the line of the Mourne Wall towards Doan.', 14, 'dsc0235.jpg', 2),
(9, 'Bord de mer', 'I hope you like my latest work,,and if you do, please Like ? Comment ? Share ? Follow ?\r\nI recommend strongly to view it on black background.', 12, 'dsc0222bis.jpg', 2),
(10, 'Her walking', 'Just edited this from the series shot two years ago..', 11, 'DSC_0558-min.jpg', 3),
(11, 'Amsterdam', 'Sunset in the beautiful historical city of Amsterdam.', 15, 'dsc0352.jpg', 1),
(12, 'Amsterdam', 'Beautiful view of Amsterdam canals, in Papiermolensluis street', 18, 'dsc0117.jpg', 4),
(13, 'Coffee', 'created this panoramic shot with multiple photographs. I love this fish eye look. Really liked the outcome. Took this photo on the same night as my 2 previous shots. Enjoy!', 20, 'dsc0123.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `pkid` int(11) NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role` enum('normal','vip','admin') CHARACTER SET utf8 NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`pkid`, `prenom`, `nom`, `email`, `mdp`, `role`) VALUES
(9, 'Compte', 'Normal', 'normal@gmail.com', '$2y$10$XZVmKfmeNt.aN7YK/fI07evjjSjuO0D0J9p8uNxkvEVw65NMdgK1K', 'normal'),
(10, 'Compte', 'Vip', 'vip@gmail.com', '$2y$10$6nVrmVnTlJQikKMBT8e/qepc.gd3OPSJYG1jKdLJqbCQQqAnaL0l.', 'vip'),
(11, 'Elric', 'l\'Omniscient', 'ngohoanvu.05@gmail.com', '$2y$10$xAeEb6wsI9ImC4Tq/AfNWumLkwAfPzuxDOGNsdWGOG5OQkOf6Rosi', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`pk_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`pkid`),
  ADD KEY `etrangere` (`fk`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pkid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `pkid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `pkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `etrangere` FOREIGN KEY (`fk`) REFERENCES `categorie` (`pk_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
