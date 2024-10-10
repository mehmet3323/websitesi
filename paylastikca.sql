-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 14 Ağu 2024, 18:16:13
-- Sunucu sürümü: 8.3.0
-- PHP Sürümü: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `paylastikca`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

DROP TABLE IF EXISTS `iletisim`;
CREATE TABLE IF NOT EXISTS `iletisim` (
  `ıd` int NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(35) COLLATE utf8mb4_turkish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `konu` varchar(40) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mesaj` varchar(300) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`ıd`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`ıd`, `adsoyad`, `telefon`, `email`, `konu`, `mesaj`) VALUES
(42, 'mehmet müjdeci', '444', 'a@a', 'bb', 'd');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayitol`
--

DROP TABLE IF EXISTS `kayitol`;
CREATE TABLE IF NOT EXISTS `kayitol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_adi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `eposta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kayitol`
--

INSERT INTO `kayitol` (`id`, `kullanici_adi`, `sifre`, `eposta`) VALUES
(7, 'çato', '$2y$10$10BfWGiT09zBdDxlSmTigeWx0IiPQLAtLeP747wXFMz5DVxS2qYJW', 'ars@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `kayit_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adsoyad`, `email`, `sifre`, `kayit_tarihi`) VALUES
(16, '999', '9@9', '9', '2024-08-14 14:54:43'),
(17, '777', '7@7', '7', '2024-08-14 15:06:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
