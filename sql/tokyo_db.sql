
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2026 at 04:10 PM
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

--
-- Structura tabelului pentru tabelul `cazare`
--

DROP TABLE IF EXISTS `cazare`;
CREATE TABLE `cazare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `pret_noapte` decimal(10,2) NOT NULL,
  `stele` int(11) NOT NULL DEFAULT 3,
  `adresa` varchar(255) NOT NULL,
  `imagine` varchar(255) NOT NULL,
  `tip` varchar(50) NOT NULL DEFAULT 'Hotel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Date de test pentru tabelul `cazare` (Cu imagini actualizate)
--

INSERT INTO `cazare` (`nume`, `descriere`, `pret_noapte`, `stele`, `adresa`, `imagine`, `tip`) VALUES
('Hoshinoya Tokyo', 'Un ryokan de lux situat în inima orașului, oferind o experiență tradițională japoneză cu confort modern și ape termale onsen.', 80000.00, 5, 'Otemachi, Chiyoda', 'https://images.unsplash.com/photo-1590559993510-9118b62fa643?w=800', 'Ryokan'),
('Hotel Gracery Shinjuku', 'Cunoscut pentru capul Godzilla de pe terasă, acest hotel modern oferă camere confortabile în centrul districtului de divertisment.', 15000.00, 4, 'Kabukicho, Shinjuku', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800', 'Hotel'),
('9h Nine Hours', 'Experiență futuristă într-un hotel capsulă minimalist. Ideal pentru călătorii care caută eficiență și un design unic.', 3500.00, 2, 'Akasaka, Minato', 'https://plus.unsplash.com/premium_photo-1661964071015-d97428970584?w=800', 'Hostel');

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
  `program` varchar(100) DEFAULT NULL,
  `detalii_extinse` text DEFAULT NULL,
  `imagine_url` varchar(255) DEFAULT NULL,
  `rute` text DEFAULT NULL,
  `plata_metoda` varchar(255) DEFAULT NULL,
  `plata_instructiuni` text DEFAULT NULL,
  `imagine_harta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`id`, `tip`, `denumire`, `descriere`, `pret`, `program`, `detalii_extinse`, `imagine_url`, `rute`, `plata_metoda`, `plata_instructiuni`, `imagine_harta`) VALUES
(1, 'Metrou', 'Tokyo Metro', 'Cea mai eficientă metodă de deplasare, acoperă tot orașul.', '170 - 320 JPY', '05:00 - 00:00', 'Metroul din Tokyo este operat de două companii mari: Tokyo Metro și Toei Subway. Rețeaua este extrem de vastă și punctuală. Stațiile importante precum Shinjuku sau Shibuya pot fi foarte aglomerate, deci este recomandat să urmați semnele de pe podea pentru direcția de mers. Atenție: majoritatea liniilor se opresc în jurul miezului nopții și reîncep la 5 dimineața.', '../images/metro.jpg', 'Ginza, Shibuya, Shinjuku, Asakusa, Roppongi', 'Suica, Pasmo, Tokyo Subway Ticket', 'Introduceți biletul în fantă sau atingeți cardul IC la porți.', '../images/Metro2.jpg'),
(2, 'Tren', 'JR Yamanote Line', 'Linia circulară verde care unește marile centre (Shibuya, Shinjuku, Tokyo).', '150 - 200 JPY', '04:30 - 01:00', 'Linia JR Yamanote este cea mai utilă pentru turiști. Este o linie circulară care unește marile centre de divertisment și afaceri (Shibuya, Shinjuku, Akihabara). Trenurile vin la fiecare 2-3 minute. Un cerc complet durează aproximativ o oră. Dacă aveți JR Pass, puteți folosi această linie gratuit.', '../images/YamanoteLine.jpg', 'Shibuya, Shinjuku, Tokyo Station, Akihabara, Ueno, Ikebukuro', 'Suica, Pasmo, JR Pass', 'Atingeți cardul IC la cititorul albastru de la porțile automate.', '../images/Yamanote.jpg'),
(3, 'Autobuz', 'Toei Bus', 'Ideal pentru zonele unde metroul nu ajunge direct.', '210 JPY (fix)', '06:00 - 22:00', 'Autobuzele Toei sunt excelente pentru a ajunge în zone mai puțin deservite de trenuri, cum ar fi zonele rezidențiale din estul orașului sau zona Asakusa. Plata se face de obicei la intrare (tarif fix de 210 JPY). Puteți folosi cardul Suica sau Pasmo atingând cititorul de lângă șofer.', '../images/Toei.jpg', 'Trasee locale: Asakusa, Odaiba, Roppongi Hills', 'Suica, Pasmo, Cash', 'Plata se face la urcare, direct la șofer sau prin atingerea cardului IC.', '../images/toei_harta.jpg'),
(4, 'Tren', 'Yurikamome', 'Tren automatizat (fără șofer) spre insula artificială Odaiba.', '190 - 390 JPY', '06:00 - 00:00', 'Yurikamome este un sistem de tranzit complet automatizat care leagă stația Shimbashi de insula artificială Odaiba. Deoarece trenul nu are conductor, pasagerii pot sta chiar în partea din față pentru o vedere panoramică spectaculoasă asupra Rainbow Bridge și a golfului Tokyo. Este metoda ideală pentru a vizita atracțiile din Odaiba într-un mod relaxant și pitoresc.', '../images/YurikanomeLine.jpg', 'Shimbashi, Shiodome, Daiba, Telecom Center, Toyosu.', 'Suica, Pasmo, Bilet de o zi (One-day Pass).', 'Atingeți cardul IC la porțile de acces. Dacă plănuiți să coborâți la mai mult de 3 stații în Odaiba, biletul de o zi (820 JPY) este mult mai avantajos.', '../images/yurikanome.jpg'),
(5, 'Autobuz', 'Airport Limousine', 'Autobuze de lux care fac legătura între Narita/Haneda și marile hoteluri.', '1300 - 3200 JPY', '24/7 (variabil)', 'Airport Limousine este cel mai confortabil transfer direct între Aeroporturile Narita/Haneda și marile hoteluri sau gări din Tokyo.', '../images/Limousine.jpg', 'Trasee locale: Asakusa, Odaiba, Roppongi Hills', 'Suica, Pasmo, Cash', 'Plata se face la urcare, direct la șofer sau prin atingerea cardului IC.', '../images/airport_harta.jpg'),
(6, 'Tren', 'Shinkansen', 'Trenurile glonț pentru călătorii rapide către alte orașe (Kyoto, Osaka).', '13,000+ JPY', '06:00 - 23:00', 'Shinkansen, faimosul „tren-glonț” al Japoniei, oferă cea mai rapidă și confortabilă conexiune între Tokyo și celelalte mari orașe ale țării. Cu viteze de peste 300 km/h și o punctualitate legendară, acest tren transformă călătoriile pe distanțe lungi într-o experiență premium, oferind spațiu generos pentru picioare și facilități moderne la bord.', '../images/ShinkansenTrain.jpg', 'Tokyo Station ↔ Kyoto, Osaka, Nagoya, Hiroshima, Kanazawa.', 'Bilet fizic (Paper Ticket), JR Pass, Smart EX.', 'Introduceți biletul în fanta porții automate și recuperați-l imediat după ce treceți. Păstrați biletul până la destinația finală pentru a putea ieși din stație.', '../images/Shinkansen.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
