-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 25 oct. 2022 à 16:00
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_netsoc`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
                        `id` int(11) NOT NULL,
                        `ID_user` int(11) NOT NULL,
                        `post` text NOT NULL,
                        `commentaires` text NOT NULL,
                        `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
                           `biographie` text NOT NULL,
                           `id_user` int(11) NOT NULL,
                           `username` varchar(30) NOT NULL,
                           `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `profile`
--

INSERT INTO `profile` (`biographie`, `id_user`, `username`, `id`) VALUES
                                                                      ('asdlhiasd', 4, '', 1),
                                                                      ('asdlhiasd', 4, '', 2),
                                                                      ('asdlhiasd', 4, 'Knup', 3),
                                                                      ('asdlhiasd', 4, 'Knup', 4),
                                                                      ('asdlhiasd', 1, 'wxu', 5),
                                                                      ('asdlhiasd', 7, 'qweqwe', 6),
                                                                      ('BIO DE GRIFFEN', 8, 'Griffen', 7),
                                                                      ('Biographie de JULIEN', 10, 'JULIEN', 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `username` varchar(30) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `age` int(11) NOT NULL,
                        `genre` varchar(10) NOT NULL,
                        `Date_inscrpition` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `age`, `genre`, `Date_inscrpition`) VALUES
                                                                                                   (1, 'wxu', 'wx.perso@gmail.com', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 18, 'on', '2022-10-25 13:13:46'),
                                                                                                   (2, 'wx', 'wxu@et.esiea.fr', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 22, 'on', '2022-10-25 13:20:52'),
                                                                                                   (3, 'Jules', 'boissel@et.esiea.fr', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 23, 'Gay', '2022-10-25 13:22:34'),
                                                                                                   (4, 'Knup', 'xwilliamx.xu@gmail.com', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 19, 'Homme', '2022-10-25 15:10:02'),
                                                                                                   (5, 'asdxcz', 'asd@asd.fr', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 20, 'Homme', '2022-10-25 15:13:43'),
                                                                                                   (6, 'caxsda', 'wxu@et.esiea.frw', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 21, 'Homme', '2022-10-25 15:15:53'),
                                                                                                   (7, 'qweqwe', 'wx.perso@gmail.com123', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 20, 'Homme', '2022-10-25 15:16:47'),
                                                                                                   (8, 'Griffen', 'savadoux@et.esiea.fr', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 19, 'Homme', '2022-10-25 15:43:08'),
                                                                                                   (9, 'JULESSS', 'jules.jules@jules.fr', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 24, 'Femme', '2022-10-25 15:48:21'),
                                                                                                   (10, 'JULIEN', 'ads@asd.fr', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 18, 'Homme', '2022-10-25 15:49:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profile`
--
ALTER TABLE `profile`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
