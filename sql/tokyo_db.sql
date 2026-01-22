-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 09:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokyo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `atractii`
--

CREATE TABLE `atractii` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `adresa` varchar(200) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `pret_intrare` decimal(10,2) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `imagine` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atractii`
--

INSERT INTO `atractii` (`id`, `nume`, `categorie`, `adresa`, `program`, `pret_intrare`, `descriere`, `imagine`, `rating`) VALUES
(1, 'Tokyo Tower', 'Monument', 'Minato, Tokyo', '09:00-23:00', 1200.00, 'Turn iconic de 333m înălțime', 'tokyotower.jpg', 4.5),
(2, 'Senso-ji Temple', 'Templu', 'Asakusa, Tokyo', '06:00-17:00', 0.00, 'Cel mai vechi templu budist din Tokyo', 'sensoji.jpg', 4.8),
(3, 'Shibuya Crossing', 'Landmark', 'Shibuya, Tokyo', '24h', 0.00, 'Cea mai aglomerată trecere de pietoni din lume', 'shibuya.jpg', 4.7),
(4, 'Tokyo Skytree', 'Monument', 'Sumida, Tokyo', '10:00-21:00', 2100.00, 'Cel mai înalt turn din lume (634m), oferind o priveliște completă asupra metropolei și magazinelor de la bază.', 'skytree.jpg', 4.6),
(5, 'Meiji Jingu', 'Altar', 'Shibuya, Tokyo', 'Răsărit-Apus', 0.00, 'Altar shintoist dedicat spiritelor Împăratului Meiji, situat într-o pădure liniștită de 70 de hectare în mijlocul orașului.', 'meiji.jpg', 4.7),
(6, 'Akihabara Electric Town', 'Shopping', 'Akihabara, Chiyoda', '10:00-20:00', 0.00, 'Centrul culturii otaku, anime și al electronicelor. Un cartier plin de lumini neon, maid cafes și magazine tematice.', 'akihabara.jpg', 4.4),
(7, 'TeamLab Planets', 'Muzeu', 'Toyosu, Koto', '09:00-22:00', 3800.00, 'Un muzeu de artă digitală imersivă unde vizitatorii merg desculți prin apă și lumini interactive.', 'teamlab.jpg', 4.8),
(8, 'Shinjuku Gyoen', 'Parc', 'Shinjuku, Tokyo', '09:00-16:00', 500.00, 'Una dintre cele mai mari și populare grădini din Tokyo, combinând stiluri de grădină japoneză, engleză și franceză.', 'shinjuku.jpg', 4.6);

-- --------------------------------------------------------

--
-- Table structure for table `cazare`
--

CREATE TABLE `cazare` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `tip` enum('hotel','hostel','ryokan','apartament') NOT NULL,
  `adresa` varchar(200) DEFAULT NULL,
  `pret_noapte` decimal(10,2) DEFAULT NULL,
  `stele` int(11) DEFAULT NULL,
  `facilitati` text DEFAULT NULL,
  `imagine` varchar(255) DEFAULT NULL,
  `descriere` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cazare`
--

INSERT INTO `cazare` (`id`, `nume`, `tip`, `adresa`, `pret_noapte`, `stele`, `facilitati`, `imagine`, `descriere`) VALUES
(1, 'Park Hyatt Tokyo', 'hotel', 'Shinjuku, Tokyo', 50000.00, 5, NULL, NULL, 'Hotel de lux cu vedere panoramică'),
(2, 'Khaosan Tokyo Kabuki', 'hostel', 'Asakusa, Tokyo', 3500.00, 3, NULL, NULL, 'Hostel popular pentru buget redus'),
(3, 'Hoshinoya Tokyo', 'ryokan', 'Otemachi, Tokyo', 80000.00, 5, NULL, NULL, 'Ryokan tradițional de lux în centrul orașului');

-- --------------------------------------------------------

--
-- Table structure for table `contact_mesaje`
--

CREATE TABLE `contact_mesaje` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subiect` varchar(200) DEFAULT NULL,
  `mesaj` text NOT NULL,
  `data_trimitere` timestamp NOT NULL DEFAULT current_timestamp(),
  `citit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evenimente`
--

CREATE TABLE `evenimente` (
  `id` int(11) NOT NULL,
  `titlu` varchar(150) NOT NULL,
  `descriere` text DEFAULT NULL,
  `data_start` date DEFAULT NULL,
  `data_sfarsit` date DEFAULT NULL,
  `locatie` varchar(200) DEFAULT NULL,
  `pret` decimal(10,2) DEFAULT NULL,
  `imagine` varchar(255) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evenimente`
--

INSERT INTO `evenimente` (`id`, `titlu`, `descriere`, `data_start`, `data_sfarsit`, `locatie`, `pret`, `imagine`, `categorie`) VALUES
(1, 'Cherry Blossom Festival', 'Celebrare tradițională a înfloririi cireșilor', '2025-03-25', '2025-04-15', 'Ueno Park', 0.00, NULL, 'Festival'),
(2, 'Tokyo Game Show', 'Cea mai mare expoziție de jocuri video din Asia', '2025-09-20', '2025-09-23', 'Makuhari Messe', 2500.00, NULL, 'Expoziție'),
(3, 'Sumida River Fireworks', 'Festival spectaculos de artificii', '2025-07-26', '2025-07-26', 'Sumida River', 0.00, NULL, 'Festival');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_abonare` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurante`
--

CREATE TABLE `restaurante` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `tip_bucatarie` varchar(50) DEFAULT NULL,
  `adresa` varchar(200) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `pret_mediu` decimal(10,2) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `imagine` varchar(255) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurante`
--

INSERT INTO `restaurante` (`id`, `nume`, `tip_bucatarie`, `adresa`, `program`, `pret_mediu`, `rating`, `imagine`, `descriere`, `data_adaugare`) VALUES
(1, 'Sukiyabashi Jiro', 'Sushi', 'Ginza, Tokyo', '17:30-20:30', 30000.00, 4.9, NULL, 'Cel mai celebru restaurant de sushi din lume', '2026-01-08 07:16:05'),
(2, 'Ichiran Ramen', 'Ramen', 'Shibuya, Tokyo', '24h', 1200.00, 4.5, NULL, 'Lanț popular de ramen tonkotsu', '2026-01-08 07:16:05'),
(3, 'Gonpachi', 'Traditional', 'Roppongi, Tokyo', '11:30-23:00', 5000.00, 4.3, NULL, 'Restaurant tradițional japonez', '2026-01-08 07:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `rezervari`
--

CREATE TABLE `rezervari` (
  `id` int(11) NOT NULL,
  `nume_client` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `data_rezervare` date NOT NULL,
  `ora_rezervare` time NOT NULL,
  `numar_persoane` int(11) NOT NULL,
  `tip_serviciu` enum('restaurant','cazare','tur') NOT NULL,
  `observatii` text DEFAULT NULL,
  `status` enum('pending','confirmat','anulat') DEFAULT 'pending',
  `data_creare` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `tip` varchar(50) NOT NULL,
  `denumire` varchar(100) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `pret` varchar(100) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`id`, `tip`, `denumire`, `descriere`, `pret`, `program`) VALUES
(1, 'Metrou', 'Tokyo Metro', 'Rețea extinsă de 13 linii', '170-320 JPY', '05:00-24:00'),
(2, 'Tren', 'JR Yamanote Line', 'Linie circulară care conectează principalele zone', '150-200 JPY', '04:30-01:00'),
(3, 'Autobuz', 'Toei Bus', 'Rețea de autobuze urbane', '210 JPY flat', '06:00-23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atractii`
--
ALTER TABLE `atractii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cazare`
--
ALTER TABLE `cazare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_mesaje`
--
ALTER TABLE `contact_mesaje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evenimente`
--
ALTER TABLE `evenimente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervari`
--
ALTER TABLE `rezervari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atractii`
--
ALTER TABLE `atractii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cazare`
--
ALTER TABLE `cazare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_mesaje`
--
ALTER TABLE `contact_mesaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evenimente`
--
ALTER TABLE `evenimente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezervari`
--
ALTER TABLE `rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
