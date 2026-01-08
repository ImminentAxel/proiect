-- =====================================================
-- Baza de date pentru site-ul Tokyo
-- Rulează acest script în phpMyAdmin
-- =====================================================

CREATE DATABASE IF NOT EXISTS tokyo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tokyo_db;

-- Tabel Newsletter (Pagina principală)
CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_abonare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Restaurante
CREATE TABLE IF NOT EXISTS restaurante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    tip_bucatarie VARCHAR(50),
    adresa VARCHAR(200),
    program VARCHAR(100),
    pret_mediu DECIMAL(10,2),
    rating DECIMAL(2,1),
    imagine VARCHAR(255),
    descriere TEXT,
    data_adaugare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Rezervări
CREATE TABLE IF NOT EXISTS rezervari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume_client VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefon VARCHAR(20),
    data_rezervare DATE NOT NULL,
    ora_rezervare TIME NOT NULL,
    numar_persoane INT NOT NULL,
    tip_serviciu ENUM('restaurant', 'cazare', 'tur') NOT NULL,
    observatii TEXT,
    status ENUM('pending', 'confirmat', 'anulat') DEFAULT 'pending',
    data_creare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Atracții turistice
CREATE TABLE IF NOT EXISTS atractii (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    categorie VARCHAR(50),
    adresa VARCHAR(200),
    program VARCHAR(100),
    pret_intrare DECIMAL(10,2),
    descriere TEXT,
    imagine VARCHAR(255),
    rating DECIMAL(2,1)
);

-- Tabel Cazare
CREATE TABLE IF NOT EXISTS cazare (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    tip ENUM('hotel', 'hostel', 'ryokan', 'apartament') NOT NULL,
    adresa VARCHAR(200),
    pret_noapte DECIMAL(10,2),
    stele INT,
    facilitati TEXT,
    imagine VARCHAR(255),
    descriere TEXT
);

-- Tabel Evenimente
CREATE TABLE IF NOT EXISTS evenimente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titlu VARCHAR(150) NOT NULL,
    descriere TEXT,
    data_start DATE,
    data_sfarsit DATE,
    locatie VARCHAR(200),
    pret DECIMAL(10,2),
    imagine VARCHAR(255),
    categorie VARCHAR(50)
);

-- Tabel Transport
CREATE TABLE IF NOT EXISTS transport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tip VARCHAR(50) NOT NULL,
    denumire VARCHAR(100),
    descriere TEXT,
    pret VARCHAR(100),
    program VARCHAR(100)
);

-- Tabel Mesaje Contact
CREATE TABLE IF NOT EXISTS contact_mesaje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subiect VARCHAR(200),
    mesaj TEXT NOT NULL,
    data_trimitere TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    citit BOOLEAN DEFAULT FALSE
);

-- =====================================================
-- Date demo pentru testare
-- =====================================================

-- Demo Restaurante
INSERT INTO restaurante (nume, tip_bucatarie, adresa, program, pret_mediu, rating, descriere) VALUES
('Sukiyabashi Jiro', 'Sushi', 'Ginza, Tokyo', '17:30-20:30', 30000, 4.9, 'Cel mai celebru restaurant de sushi din lume'),
('Ichiran Ramen', 'Ramen', 'Shibuya, Tokyo', '24h', 1200, 4.5, 'Lanț popular de ramen tonkotsu'),
('Gonpachi', 'Traditional', 'Roppongi, Tokyo', '11:30-23:00', 5000, 4.3, 'Restaurant tradițional japonez');

-- Demo Atracții
INSERT INTO atractii (nume, categorie, adresa, program, pret_intrare, descriere, rating) VALUES
('Tokyo Tower', 'Monument', 'Minato, Tokyo', '09:00-23:00', 1200, 'Turn iconic de 333m înălțime', 4.5),
('Senso-ji Temple', 'Templu', 'Asakusa, Tokyo', '06:00-17:00', 0, 'Cel mai vechi templu budist din Tokyo', 4.8),
('Shibuya Crossing', 'Landmark', 'Shibuya, Tokyo', '24h', 0, 'Cea mai aglomerată trecere de pietoni din lume', 4.7);

-- Demo Cazare
INSERT INTO cazare (nume, tip, adresa, pret_noapte, stele, descriere) VALUES
('Park Hyatt Tokyo', 'hotel', 'Shinjuku, Tokyo', 50000, 5, 'Hotel de lux cu vedere panoramică'),
('Khaosan Tokyo Kabuki', 'hostel', 'Asakusa, Tokyo', 3500, 3, 'Hostel popular pentru buget redus'),
('Hoshinoya Tokyo', 'ryokan', 'Otemachi, Tokyo', 80000, 5, 'Ryokan tradițional de lux în centrul orașului');

-- Demo Evenimente
INSERT INTO evenimente (titlu, descriere, data_start, data_sfarsit, locatie, pret, categorie) VALUES
('Cherry Blossom Festival', 'Celebrare tradițională a înfloririi cireșilor', '2025-03-25', '2025-04-15', 'Ueno Park', 0, 'Festival'),
('Tokyo Game Show', 'Cea mai mare expoziție de jocuri video din Asia', '2025-09-20', '2025-09-23', 'Makuhari Messe', 2500, 'Expoziție'),
('Sumida River Fireworks', 'Festival spectaculos de artificii', '2025-07-26', '2025-07-26', 'Sumida River', 0, 'Festival');

-- Demo Transport
INSERT INTO transport (tip, denumire, descriere, pret, program) VALUES
('Metrou', 'Tokyo Metro', 'Rețea extinsă de 13 linii', '170-320 JPY', '05:00-24:00'),
('Tren', 'JR Yamanote Line', 'Linie circulară care conectează principalele zone', '150-200 JPY', '04:30-01:00'),
('Autobuz', 'Toei Bus', 'Rețea de autobuze urbane', '210 JPY flat', '06:00-23:00');
