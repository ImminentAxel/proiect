-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2026 at 10:16 PM
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
  `nume` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `pret_noapte` decimal(10,2) NOT NULL,
  `stele` int(11) NOT NULL DEFAULT 3,
  `adresa` varchar(255) NOT NULL,
  `imagine` varchar(255) NOT NULL,
  `tip` varchar(50) NOT NULL DEFAULT 'Hotel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cazare`
--

INSERT INTO `cazare` (`id`, `nume`, `descriere`, `pret_noapte`, `stele`, `adresa`, `imagine`, `tip`) VALUES
(1, 'Hoshinoya Tokyo', 'Un ryokan de lux situat în inima orașului, oferind o experiență tradițională japoneză cu confort modern și ape termale onsen.', 80000.00, 5, 'Otemachi, Chiyoda', 'https://images.unsplash.com/photo-1590559993510-9118b62fa643?w=800', 'Ryokan'),
(2, 'Hotel Gracery Shinjuku', 'Cunoscut pentru capul Godzilla de pe terasă, acest hotel modern oferă camere confortabile în centrul districtului de divertisment.', 15000.00, 4, 'Kabukicho, Shinjuku', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800', 'Hotel'),
(3, '9h Nine Hours', 'Experiență futuristă într-un hotel capsulă minimalist. Ideal pentru călătorii care caută eficiență și un design unic.', 3500.00, 2, 'Akasaka, Minato', 'https://plus.unsplash.com/premium_photo-1661964071015-d97428970584?w=800', 'Hostel');

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

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `data_abonare`) VALUES
(1, 'alexandru.gheonea04@e-uvt.ro', '2026-01-24 18:57:31'),
(2, 'a@a.com', '2026-01-24 19:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `pachete_rezervari`
--

CREATE TABLE `pachete_rezervari` (
  `id` int(11) NOT NULL,
  `nume_pachet` varchar(100) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `tip_serviciu` enum('restaurant','cazare','tur') DEFAULT NULL,
  `pret` int(11) DEFAULT NULL,
  `durata` varchar(50) DEFAULT NULL,
  `caracteristici` text DEFAULT NULL,
  `popular` tinyint(1) DEFAULT 0,
  `activ` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pachete_rezervari`
--

INSERT INTO `pachete_rezervari` (`id`, `nume_pachet`, `descriere`, `tip_serviciu`, `pret`, `durata`, `caracteristici`, `popular`, `activ`) VALUES
(1, 'Sushi Experience Deluxe', 'Experiment authenitic de sushi la un restaurant Michelin. Inclusiv instrucție de la un șef profesionist și degustare de sake tradițional.', 'restaurant', 15000, '3 ore', 'Meniu de 12 bucăți sushi, Sake premium, Transfer inclus, Șef expert, Fotografi profesional', 1, 1),
(2, 'Ramen Tour Asakusa', 'Tur ghidat prin cele mai faimoase ramen shops din cartierul tradițional Asakusa. Vizită la templul Senso-ji inclus.', 'restaurant', 8000, '2.5 ore', 'Degustare 3 ramen diferite, Ghid în limba engleză, Apă și ceai incluse, Mână de hristos Senso-ji', 1, 1),
(3, 'Kaiseki 7-Course', 'Cea mai sofisticată experiență culinară japoneză. 7 meniuri gourmet în restaurant tradiții.', 'restaurant', 25000, '4 ore', 'Meniu complet 7 cursuri, Perechi cu vin, Rezervare privată, Uniforme tradiționale opționale', 0, 1),
(4, 'Ryokan Escape', 'Noapte în ryokan tradițional cu onsen privat. Cina și micul dejun incluse. Perfect pentru relaxare.', 'cazare', 35000, '1 noapte', 'Cameră tradițională (tatami), Onsen privat, Cina kaiseki, Micul dejun japones, Kimono inclus', 1, 1),
(5, 'Luxury Shinjuku Hotel', 'Hotel 5 stele cu vedere la Tokyo Tower. Servicii de concierge 24/7 și spa wellness.', 'cazare', 18000, '1 noapte', 'Cameră deluxe cu ocean view, Breakfast buffet, Spa access, Welcome drink, Late checkout', 0, 1),
(6, 'Budget Hostel Stay', 'Cazare economică dar confortabilă în capsule moderne cu facilități de top.', 'cazare', 4500, '1 noapte', 'Capsulă privată, WiFi gratis, Duș și toaletă comune, Lounge și TV room, Culoar 24/7', 0, 1),
(7, 'Tokyo Hidden Gems Tour', 'Tur de 6 ore cu ghid local care cunoaște Tokyo ca pe mărul din palmă. Temple, grădini, street food.', 'tur', 12000, '6 ore', 'Ghid bilingv, Transport local inclus, 5 site-uri principale, Snack tradițional, Fotografie profesională', 1, 1),
(8, 'Shibuya Crossing & Harajuku Walk', 'Tur pe jos prin cele mai vibrante cartiere ale Tokyoului. Magazinele, cultura pop japoneză.', 'tur', 6500, '3 ore', 'Ghid specialist, Vizită Shibuya Crossing, Takeshita Street, Crepe gratuit, Recomandări magazine', 0, 1),
(9, 'Mount Fuji Day Trip', 'Excursie zilei la muntele sacru Fuji cu drum scenic prin lacuri și păduri bamboo.', 'tur', 16000, '10 ore', 'Transport autocar A/C, Lungă promenadă ghidată, Lunch tradiției, Fotografie profesională, WiFi pe autobuz', 0, 1),
(10, 'Tea Ceremony & Temple', 'Experiență spirituală cu ceremonie tradițională de ceai într-un templu de 400 de ani.', 'tur', 9000, '2.5 ore', 'Ceremonie ceai autentic, Ghid specialist, Ceai și fursecuri, Pictură/caligrafie, Meditație ghidată', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recenzii`
--

CREATE TABLE `recenzii` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `nume_utilizator` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `comentariu` text NOT NULL,
  `data_adaugarii` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recenzii`
--

INSERT INTO `recenzii` (`id`, `restaurant_id`, `nume_utilizator`, `rating`, `comentariu`, `data_adaugarii`) VALUES
(1, 1, 'Ionut', 5, 'Cel mai bun sushi pe care l-am mâncat vreodată!', '2026-01-24 18:09:01'),
(2, 2, 'Maria', 4, 'Foarte bun, dar coada a fost cam lungă.', '2026-01-24 18:09:01'),
(3, 1, 'Alex', 5, 'O experiență incredibilă, maestrul Jiro este un geniu.', '2026-01-24 18:09:01');

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
(1, 'Sukiyabashi Jiro', 'Sushi', 'Ginza, Chuo City', '17:30-20:30 (Doar rezervări)', 35000.00, 4.9, NULL, 'Legendarul restaurant de sushi cu 3 stele Michelin. O experiență Omakase exclusivistă.', '2026-01-24 16:10:06'),
(2, 'Ichiran Ramen', 'Ramen', 'Shibuya, Tokyo', '24h', 1200.00, 4.8, NULL, 'Cel mai faimos Tonkotsu Ramen, servit în separeuri individuale pentru concentrare maximă.', '2026-01-24 16:10:06'),
(3, 'Rokurinsha', 'Ramen', 'Tokyo Station, Ramen Street', '07:30-09:45, 10:30-22:30', 1100.00, 4.6, NULL, 'Celebru pentru Tsukemen (tăiței reci înmuiați în supă fierbinte și densă). Cozi lungi.', '2026-01-24 16:10:06'),
(4, 'Yoroniku', 'Yakiniku', 'Minami-Aoyama, Minato', '17:00-24:00', 12000.00, 4.9, NULL, 'Carne Wagyu A5 de cea mai înaltă calitate, gătită la perfecțiune pe grătar la masă.', '2026-01-24 16:10:06'),
(5, 'Gonpachi Nishi-Azabu', 'Izakaya', 'Nishi-Azabu, Minato', '11:30-03:30', 5000.00, 4.5, NULL, 'Inspirația pentru scena luptei din Kill Bill. Atmosferă vibrantă și preparate tradiționale.', '2026-01-24 16:10:06'),
(6, 'Kura Sushi', 'Sushi', 'Ikebukuro, Toshima', '11:00-23:00', 1500.00, 4.3, NULL, 'Sushi pe bandă rulantă (Kaitenzushi). Ieftin, distractiv și tehnologizat.', '2026-01-24 16:10:06'),
(7, 'Tempura Kondo', 'Tempura', 'Ginza, Chuo City', '12:00-13:30, 17:00-20:30', 15000.00, 4.8, NULL, 'Tempura ușoară și crocantă, premiată cu stele Michelin. O artă a prăjirii.', '2026-01-24 16:10:06'),
(8, 'Gyukatsu Motomura', 'Yakiniku', 'Shinjuku, Tokyo', '11:00-22:00', 2200.00, 4.7, NULL, 'Cotlet de vită pane (Gyukatsu) pe care îl prăjești singur pe o piatră încinsă.', '2026-01-24 16:10:06'),
(9, 'Afuri Ramen', 'Ramen', 'Ebisu, Shibuya', '11:00-05:00', 1300.00, 4.6, NULL, 'Ramen ușor cu zeamă de Yuzu (citrice), perfect pentru o masă revigorantă.', '2026-01-24 16:10:06'),
(10, 'CoCo Ichibanya', 'Curry', 'Akihabara, Chiyoda', '11:00-23:00', 900.00, 4.4, NULL, 'Lanțul numărul 1 de Curry japonez. Poți alege nivelul de iuțeală de la 1 la 10.', '2026-01-24 16:10:06'),
(11, 'Harajuku Gyoza Lou', 'Gyoza', 'Harajuku, Shibuya', '11:30-04:30', 1000.00, 4.5, NULL, 'Specializat doar în colțunași Gyoza, prăjiți sau fierți. Simplu și delicios.', '2026-01-24 16:10:06'),
(12, 'Maisen Tonkatsu', 'Tonkatsu', 'Omotesando, Minato', '11:00-22:00', 2800.00, 4.7, NULL, 'Cel mai bun șnițel de porc din Tokyo, servit într-o fostă baie publică renovată.', '2026-01-24 16:10:06'),
(13, 'Tsukiji Itadori', 'Fructe de mare', 'Tsukiji Outer Market', '07:00-14:30', 3000.00, 4.6, NULL, 'Boluri cu fructe de mare proaspete (Kaisendon) chiar în piața de pește.', '2026-01-24 16:10:06'),
(14, 'Ryugin', 'Kaiseki', 'Hibiya, Chiyoda', '12:00-15:00, 18:00-23:00', 45000.00, 4.9, NULL, 'Bucătărie tradițională Kaiseki reinterpretată modern. 3 stele Michelin.', '2026-01-24 16:10:06'),
(15, 'Gindaco', 'Street Food', 'Shinjuku, Tokyo', '11:00-23:00', 700.00, 4.2, NULL, 'Celebrele bile de caracatiță (Takoyaki), crocante la exterior și moi la interior.', '2026-01-24 16:10:06'),
(16, 'Bills Omotesando', 'Cafenea', 'Omotesando, Shibuya', '08:30-23:00', 2500.00, 4.5, NULL, 'Cele mai pufoase clătite cu ricotta din lume. Perfect pentru mic dejun.', '2026-01-24 16:10:06'),
(17, 'Ningyocho Imahan', 'Sukiyaki', 'Nihonbashi, Chuo', '11:00-15:00, 17:00-22:00', 10000.00, 4.8, NULL, 'Carne de vită gătită în stil Sukiyaki, într-un decor tradițional cu tatami.', '2026-01-24 16:10:06'),
(18, 'Shin Udon', 'Udon', 'Shinjuku, Tokyo', '11:00-23:00', 1600.00, 4.6, NULL, 'Udon proaspăt făcut manual, servit în stil modern, cu unt și piper.', '2026-01-24 16:10:06'),
(19, 'Omoide Yokocho', 'Yakitori', 'Shinjuku West Exit', '17:00-24:00', 3000.00, 4.4, NULL, 'Aleea istorică cu frigărui de pui, fum și atmosferă retro din anii 50.', '2026-01-24 16:10:06'),
(20, 'Kaikaya by the Sea', 'Izakaya', 'Shibuya, Tokyo', '18:00-23:30', 5500.00, 4.7, NULL, 'Fusion între fructe de mare proaspete și stilul izakaya. Foarte popular.', '2026-01-24 16:10:06'),
(21, 'Pokémon Cafe', 'Tematic', 'Nihonbashi, Tokyo', '10:30-22:00 (Rezervare)', 4000.00, 4.5, NULL, 'Mâncare în formă de Pikachu și spectacole. Rezervarea este obligatorie.', '2026-01-24 16:10:06'),
(22, 'Sato Yosuke', 'Udon', 'Ginza, Chuo', '11:30-15:00, 17:00-22:00', 2000.00, 4.6, NULL, 'Udon subțire și elegant din regiunea Akita, servit cu sos de susan.', '2026-01-24 16:10:06'),
(23, 'Nakiryu', 'Ramen', 'Otsuka, Toshima', '11:30-15:00', 1500.00, 4.7, NULL, 'Unul dintre puținele locuri de Ramen cu stea Michelin. Tantanmen excepțional.', '2026-01-24 16:10:06'),
(24, 'Tofuya Ukai', 'Tradițional', 'Minato City', '11:00-22:00', 8000.00, 4.8, NULL, 'Restaurant specializat în Tofu, situat într-o grădină japoneză superbă lângă Tokyo Tower.', '2026-01-24 16:10:06'),
(25, 'Mos Burger', 'Fast Food', 'Shinjuku, Tokyo', '07:00-24:00', 900.00, 4.1, NULL, 'Lanțul japonez de burgeri. Încearcă burgerul cu chiflă din orez.', '2026-01-24 16:10:06'),
(26, 'Unagi Obana', 'Unagi', 'Minami-Senju, Arakawa', '11:30-13:30, 17:00-19:30', 6000.00, 4.7, NULL, 'Anghilă la grătar (Unagi) într-un restaurant istoric. Se așteaptă la coadă.', '2026-01-24 16:10:06'),
(27, 'Kanda Yabu Soba', 'Soba', 'Kanda, Chiyoda', '11:30-20:00', 2200.00, 4.5, NULL, 'Unul dintre cele mai vechi restaurante de tăiței Soba din Tokyo, reconstruit după incendiu.', '2026-01-24 16:10:06'),
(28, 'Fuunji', 'Ramen', 'Shinjuku, Tokyo', '11:00-15:00, 17:00-21:00', 1100.00, 4.6, NULL, 'Tsukemen cu supă ultra-concentrată de pui și pește. O bijuterie ascunsă.', '2026-01-24 16:10:06'),
(29, 'Sushi Zanmai', 'Sushi', 'Tsukiji, Tokyo', '24h', 3500.00, 4.4, NULL, 'Deschis 24/7, faimos pentru tonul proaspăt. Fondatorul este Regele Tonului.', '2026-01-24 16:10:06'),
(30, 'Hedgehog Cafe Harry', 'Tematic', 'Harajuku, Shibuya', '11:00-19:00', 2800.00, 4.3, NULL, 'O cafenea unde poți ține în brațe arici drăgălași în timp ce bei ceai.', '2026-01-24 16:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `reviews_rezervari`
--

CREATE TABLE `reviews_rezervari` (
  `id` int(11) NOT NULL,
  `nume_client` varchar(100) DEFAULT NULL,
  `tip_experienta` varchar(50) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `comentariu` text DEFAULT NULL,
  `data_review` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews_rezervari`
--

INSERT INTO `reviews_rezervari` (`id`, `nume_client`, `tip_experienta`, `rating`, `comentariu`, `data_review`) VALUES
(1, 'Maria Popescu', 'Sushi Experience Deluxe', 5, 'Incredibil! Șeful a fost foarte amabil și m-a învățat secretele sushi-ului. Mâncarea a fost fresh și delioasă. Cu siguranță o recomand prietenilor mei!', '2026-01-22 21:03:44'),
(2, 'Alexandru Ionescu', 'Ryokan Escape', 5, 'Noapte magică! Onsen-ul a fost relaxant, iar cina kaiseki a fost o operă culinară. Personal foarte atent. Experiența de viață!', '2026-01-19 21:03:44'),
(3, 'Elena Vasile', 'Tokyo Hidden Gems Tour', 4, 'Ghidul nostru a fost super cunoștător și plin de energi. Locurile pe care le-am vizitat au fost autentice și pe care mulți turiști le ratează. Foarte bine organizat!', '2026-01-16 21:03:44'),
(4, 'Cristian Mihai', 'Shibuya Crossing Walk', 5, 'Perfect pentru cei care vor să simtă energia Tokyoului! Crossing-ul Shibuya este adevărat spectacol. Recomand cu tărie.', '2026-01-12 21:03:44'),
(5, 'Laura Constantin', 'Tea Ceremony & Temple', 5, 'O experiență zen adevărată. Maestrul de ceai a fost patient și am simțit pacea interioara. Ghid foarte profesionist cu explicații detaliate.', '2026-01-09 21:03:44'),
(6, 'Andrei Badea', 'Ramen Tour Asakusa', 4, 'Trei ramen-uri diferite și toate au fost delicioase! Ghidul a povestit istoria fiecărui loc. Asakusa este zona perfect pentru acest tur.', '2026-01-04 21:03:44'),
(7, 'Sorin Țepeluș', 'Mount Fuji Day Trip', 5, 'Ziua cea mai frumoasă din vacanță! Peisajul era spectaculos. Autobuzul confortabil și lunch tradițional a fost excelent. Vale orice bani!', '2025-12-30 21:03:44'),
(8, 'Diana Popovici', 'Luxury Shinjuku Hotel', 4, 'Hotel elegant cu o priveliște minunată la Tokyo Tower. Serviciile sunt impecabile. Mic dejunul buffet a fost foarte bun cu multe opțiuni japoneze și internaționale.', '2025-12-25 21:03:44');

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

--
-- Dumping data for table `rezervari`
--

INSERT INTO `rezervari` (`id`, `nume_client`, `email`, `telefon`, `data_rezervare`, `ora_rezervare`, `numar_persoane`, `tip_serviciu`, `observatii`, `status`, `data_creare`) VALUES
(1, 'A', 'a@a.com', '121212133112321', '2026-01-29', '00:34:00', 3, 'restaurant', 'aaaa', 'pending', '2026-01-24 20:32:40');

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
-- Indexes for table `pachete_rezervari`
--
ALTER TABLE `pachete_rezervari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recenzii`
--
ALTER TABLE `recenzii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews_rezervari`
--
ALTER TABLE `reviews_rezervari`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pachete_rezervari`
--
ALTER TABLE `pachete_rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recenzii`
--
ALTER TABLE `recenzii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews_rezervari`
--
ALTER TABLE `reviews_rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezervari`
--
ALTER TABLE `rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
