-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 20 Oca 2021, 23:58:49
-- Sunucu sürümü: 10.3.27-MariaDB
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `enginpyx_moviex`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `publishMovieId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `publishMovieId`, `userId`, `comment`, `create_at`) VALUES
(1, 1, 1, 'Harika bir film. <3', '2021-01-17 02:42:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `year` varchar(256) NOT NULL,
  `released` varchar(256) NOT NULL,
  `runtime` varchar(256) NOT NULL,
  `genre` varchar(256) NOT NULL,
  `director` varchar(256) NOT NULL,
  `writer` varchar(256) NOT NULL,
  `actors` varchar(256) NOT NULL,
  `poster` varchar(256) NOT NULL,
  `imdbRating` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `plot` varchar(256) NOT NULL,
  `imdbID` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `released`, `runtime`, `genre`, `director`, `writer`, `actors`, `poster`, `imdbRating`, `type`, `plot`, `imdbID`) VALUES
(1, 'Ayla', '2017', '06 Oct 2017', '86 min', 'Drama, Fantasy, Horror, Thriller', 'Elias', 'Elias', 'Nicholas Wilder, Tristan Risk, Dee Wallace, Sarah Schoofs', 'https://m.media-amazon.com/images/M/MV5BODU3YTkzMGQtNzE4YS00NTQ3LWExYzAtZDRjZWY3ZmQ2NzBiXkEyXkFqcGdeQXVyMzQwMjc0NTU@._V1_SX300.jpg', '3.2', 'movie', 'A man haunted by the mysterious death of his 4-year-old sister brings her back to life thirty years later as an adult woman, with dire consequences.', 'tt4044896'),
(2, 'Cep Herkülü: Naim Süleymanoglu', '2019', '22 Nov 2019', '141 min', 'Biography, Drama, Sport', 'Ozer Feyzioglu', 'Ozer Feyzioglu, Baris Pirhasan (screenplay)', 'Hayat Van Eck, Selen Öztürk, Yetkin Dikinciler, Gürkan Uygun', 'https://m.media-amazon.com/images/M/MV5BM2E2MjRiZDctMmQwMC00Y2Y4LWFiYjctYmFkN2Y4NmMwYTM1XkEyXkFqcGdeQXVyMTA0NDE3ODU2._V1_SX300.jpg', '8.4', 'movie', 'The biography of Turkish weight lifter, and champion of Olympics, Naim Suleymanoglu.', 'tt9500372'),
(3, 'Çanakkale 1915', '2012', '18 Oct 2012', '100 min', 'Drama, History', 'Yesim Sezgin', 'Turgut Özakman', 'Baris Çakmak, Bülent Alkis, Celil Nalcakan, Baran Akbulut', 'https://m.media-amazon.com/images/M/MV5BYzE3MDQyMWEtOTEwNi00ODM3LThiMDctZThhY2QxNTgwNjcwXkEyXkFqcGdeQXVyNDQ2MTMzODA@._V1_SX300.jpg', '6.5', 'movie', 'The Doc and the Junkster get desperate on the final day in Austin, a locker is full of pinatas.', 'tt2415964'),
(4, 'Çanakkale 1915', '2012', '18 Oct 2012', '100 min', 'Drama, History', 'Yesim Sezgin', 'Turgut Özakman', 'Baris Çakmak, Bülent Alkis, Celil Nalcakan, Baran Akbulut', 'https://m.media-amazon.com/images/M/MV5BYzE3MDQyMWEtOTEwNi00ODM3LThiMDctZThhY2QxNTgwNjcwXkEyXkFqcGdeQXVyNDQ2MTMzODA@._V1_SX300.jpg', '6.5', 'movie', 'The Doc and the Junkster get desperate on the final day in Austin, a locker is full of pinatas.', 'tt2415964'),
(5, 'Recep Ivedik', '2008', '22 Feb 2008', '90 min', 'Comedy', 'Togan Gökbakar', 'Serkan Altunigne (scenario), Mehmet Ali Bayhan, Sahan Gökbakar', 'Sahan Gökbakar, Fatma Toptas, Tulug Çizgen, Ismail Hakki Ürün', 'https://m.media-amazon.com/images/M/MV5BYzRkZTNhMDctODU5Zi00MjA3LTgxMjYtMGQ3MDI1MzBkOTM5XkEyXkFqcGdeQXVyMjExNjgyMTc@._V1_SX300.jpg', '4.6', 'movie', 'A man trying to impress his childhood lover, although it may sound romantic, it is not.', 'tt1193516');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `publishmovie`
--

CREATE TABLE `publishmovie` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `imdbID` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `publishmovie`
--

INSERT INTO `publishmovie` (`id`, `userId`, `imdbID`, `create_at`) VALUES
(1, 1, 'tt9500372', '2021-01-17 02:41:55'),
(2, 1, 'tt2415964', '2021-01-17 19:06:14'),
(3, 1, 'tt1193516', '2021-01-17 19:32:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `create_at`) VALUES
(1, 'admin', 'admin', '2021-01-17 02:40:50');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `publishmovie`
--
ALTER TABLE `publishmovie`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `publishmovie`
--
ALTER TABLE `publishmovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
