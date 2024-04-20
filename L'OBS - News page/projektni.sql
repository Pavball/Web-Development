-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 20, 2023 at 01:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektni`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `administratorska_prava` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `ime`, `prezime`, `lozinka`, `administratorska_prava`) VALUES
(2, 'Marco1', '', '', 'Marco1', 1),
(6, 'root', 'Root', 'Root', '$2y$10$7Xg6mlf2IJhGgnRV9o1Ki.w/kbBb5guZCbFbkvn0eF//rX/kKzmcS', 1),
(7, 'root2', 'Root', 'Matijević', '$2y$10$59scd2XSOQ8KpEndb3qhYubkXR6dUVZdPbiFwBUhXagnOJb.Tnpou', 0),
(8, 'root3', 'ro', 'ro', '$2y$10$j77FpEeDIS1ftliCIWc6Bucp46lq8AMWuSJnG67gqAUC9uhCrAkXK', 0),
(9, 'ro', 'ro', 'ro', '$2y$10$.IRkOFHnpI0A1sluK21YEO1NoqMPuVhpTVsxXMuUK2EzK74AAPn8a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijest`
--

CREATE TABLE `vijest` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) NOT NULL,
  `naslov` varchar(64) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(64) NOT NULL,
  `kategorija` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `vijest`
--

INSERT INTO `vijest` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(3, '2023-06-19', 'LeBron James', 'Lebron je zvijezda!', 'LeBronLeBron LeBron LeBronLeBronLeBronLeBron LeBronLeBronLeBronLeBron LeBronLeBronLeBronLeBronLeBron LeBronLeBronLeBronLeBronLeBronLeBronLeBronLeBron.', 'uploads/LeBron_James_(51959977144)_(cropped2).jpg', 'sport', 0),
(5, '2023-06-19', 'Kulturno', 'Kultura je zakon!', 'Kulturno u srcu! Kulturno u srcu! Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!Kulturno u srcu!', 'uploads/sto-je-kultura-e1473876151223.jpg', 'kultura', 0),
(7, '2023-06-19', 'Nogomet', 'Nogometasi (Vatreni) osvojili drugo mjesto na natjecanju Liga Nacija!', 'Veoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!\r\n\r\nVeoma teski poraz nasih vatrenih, skoro pobjeda, no zivot je namijenjen da neke bitke pobijedimo i neke izgubimo, te na kraju ovisi na nama kako cemo nastaviti dalje nakon toga!', 'uploads/91180327f85146d56dff.jpg', 'sport', 1),
(8, '2023-06-19', 'Vatreni opet', 'Test vatrenih je jako dobar test!', 'Ovo je test 100 puta! Ovo je test 100 puta! Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!Ovo je test 100 puta!', 'uploads/91180327f85146d56dff.jpg', 'sport', 0),
(9, '2023-06-19', 'Sport Scena', 'Dogadaji na sport sceniii!', 'Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!Dogadaji na sport sceniii!', 'uploads/aLO7da1B_400x400.jpg', 'sport', 0),
(11, '2023-06-19', 'csacsacascascsac', 'ascascsacxascasdcads', 'cdacdacadcdacadcdaqvfdasvsdfvfdsvdfseaveasfr', 'uploads/sto-je-kultura-e1473876151223.jpg', 'kultura', 0),
(12, '2023-06-19', 'csacsacascascsac', 'ascascsacxascasdcads', 'cdacdacadcdacadcdaqvfdasvsdfvfdsvdfseaveasfr', 'uploads/sto-je-kultura-e1473876151223.jpg', 'kultura', 0),
(17, '2023-06-20', 'dwadawdwad', 'awdawdwadwad', 'wadawdawdawddad', 'uploads/LeBron_James_(51959977144)_(cropped2).jpg', 'kultura', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vijest`
--
ALTER TABLE `vijest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vijest`
--
ALTER TABLE `vijest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
