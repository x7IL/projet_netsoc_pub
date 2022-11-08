-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2022 at 07:03 PM
-- Server version: 8.0.31-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_netsoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `ID_user` int NOT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `commentaires` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `likes` int DEFAULT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `ID_user`, `post`, `commentaires`, `likes`, `post_date`) VALUES
(1, 11, 'test', NULL, NULL, '2022-10-31 13:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `biographie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`biographie`, `id_user`, `username`, `id`) VALUES
('asdlhiasd', 4, '', 1),
('asdlhiasd', 4, '', 2),
('asdlhiasd', 4, 'Knup', 3),
('asdlhiasd', 4, 'Knup', 4),
('asdlhiasd', 1, 'wxu', 5),
('asdlhiasd', 7, 'qweqwe', 6),
('BIO DE GRIFFEN', 8, 'Griffen', 7),
('Biographie de JULIEN', 10, 'JULIEN', 8),
('you want to play let s play', 11, 'griffen', 9),
('Biographie de griffen', 12, 'griffen', 10),
('Biographie de qwerty', 13, 'qwerty', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `age` int NOT NULL,
  `genre` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Date_inscrpition` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
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
(10, 'JULIEN', 'ads@asd.fr', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 18, 'Homme', '2022-10-25 15:49:04'),
(11, 'griffen', 's.b@gmail.com', '45c0a1024132bc3bab62188452276a110db75da1568b72195f0913270e2647f6ee9df2af24ffa629176952c66fd56722d9597faa6de1ba5a5a35298903d65d54', 19, 'Homme', '2022-10-26 18:43:55'),
(12, 'griffen', 'savadoux@gmail.com', '45c0a1024132bc3bab62188452276a110db75da1568b72195f0913270e2647f6ee9df2af24ffa629176952c66fd56722d9597faa6de1ba5a5a35298903d65d54', 19, 'Homme', '2022-10-26 18:50:03'),
(13, 'qwerty', 'qwerty@gmail.com', '45c0a1024132bc3bab62188452276a110db75da1568b72195f0913270e2647f6ee9df2af24ffa629176952c66fd56722d9597faa6de1ba5a5a35298903d65d54', 19, 'Homme', '2022-10-26 19:05:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
