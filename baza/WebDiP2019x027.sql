-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 05:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdip2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `dijete`
--

CREATE TABLE `dijete` (
  `dijete_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `skupina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dijete`
--

INSERT INTO `dijete` (`dijete_id`, `ime`, `prezime`, `slika`, `skupina_id`) VALUES
(1, 'Adrijan', 'Dujaković', 'dijete.jpg', 1),
(2, 'Marko', 'Ivić', 'dijete.jpg', 1),
(3, 'Ivan', 'Lucić', 'dijete2.jpg', 3),
(4, 'Noa', 'Dujak', 'dijete2.jpg', 3),
(5, 'Leon', 'Marić', 'dijete.jpg', 1),
(6, 'Matija', 'Perić', 'dijete.jpg', 1),
(7, 'Milan', 'Sivić', 'dijete2.jpg', 1),
(14, 'Dijete', 'Neko', 'nestoo.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `radnja` text NOT NULL,
  `upit` varchar(255) NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `radnja`, `upit`, `datum_vrijeme`, `korisnik_id`, `tip_id`) VALUES
(6, 'prijava', 'SELECT * FROM korisnik;', '2020-04-03 00:00:00', 3, 1),
(17, 'odjava', 'neki upit', '2020-06-06 21:02:42', 1, 1),
(23, 'odjava', '-', '2020-06-06 21:11:26', 1, 1),
(24, 'odjava', '-', '2020-06-06 21:15:02', 1, 1),
(25, 'odjava', '-', '2020-06-06 21:18:01', 1, 1),
(26, 'odjava', '-', '2020-06-06 21:18:12', 1, 1),
(27, 'odjava', '-', '2020-06-06 21:18:25', 1, 1),
(28, 'odjava', '-', '2020-06-06 21:19:12', 1, 1),
(29, 'odjava', '-', '2020-06-06 21:19:26', 1, 1),
(30, 'odjava', '-', '2020-06-06 21:19:28', 1, 1),
(31, 'odjava', '-', '2020-06-06 21:19:28', 1, 1),
(47, 'odjava', 'nesto', '2020-06-07 17:15:03', 1, 1),
(48, 'odjava', 'neklaksajdj', '2020-06-07 17:24:05', 1, 1),
(49, 'odjava', 'ahahaha', '2020-06-07 17:25:18', 1, 1),
(50, 'odjava', 'SELECTFROMkorisnikWHEREkorisnicko_ime=', '2020-06-07 17:27:51', 1, 1),
(52, 'odjava', '-', '2020-06-07 17:30:09', 1, 1),
(53, 'odjava', '-', '2020-06-07 17:30:40', 6, 1),
(54, 'odjava', '-', '2020-06-07 21:52:31', 4, 1),
(55, 'odjava', '-', '2020-06-07 21:57:23', 1, 1),
(56, 'prijava', '-', '2020-06-07 22:10:35', 1, 1),
(57, 'odjava', '-', '2020-06-07 23:04:29', 1, 1),
(58, 'prijava', '-', '2020-06-07 23:04:37', 3, 1),
(59, 'odjava', '-', '2020-06-07 23:08:39', 3, 1),
(60, 'prijava', '-', '2020-06-07 23:08:53', 3, 1),
(61, 'prijava', '-', '2020-06-08 09:08:48', 3, 1),
(62, 'odjava', '-', '2020-06-08 09:11:09', 3, 1),
(63, 'prijava', '-', '2020-06-08 09:11:16', 1, 1),
(64, 'odjava', '-', '2020-06-08 09:32:16', 1, 1),
(65, 'prijava', '-', '2020-06-08 09:32:23', 3, 1),
(66, 'odjava', '-', '2020-06-08 10:11:34', 3, 1),
(67, 'prijava', '-', '2020-06-08 10:11:40', 1, 1),
(68, 'odjava', '-', '2020-06-08 10:11:58', 1, 1),
(69, 'prijava', '-', '2020-06-08 10:12:04', 3, 1),
(70, 'odjava', '-', '2020-06-08 14:49:02', 3, 1),
(71, 'prijava', '-', '2020-06-08 14:49:11', 1, 1),
(72, 'odjava', '-', '2020-06-08 14:50:35', 1, 1),
(73, 'prijava', '-', '2020-06-08 14:50:49', 3, 1),
(74, 'brisanje', 'DELETE FROM skupina WHERE skupina_id = 17', '2020-06-08 16:48:52', 3, 2),
(75, 'brisanje', 'DELETE FROM skupina WHERE skupina_id', '2020-06-08 16:49:40', 3, 2),
(76, 'brisanje', 'DELETE FROM skupina', '2020-06-08 16:50:26', 3, 2),
(77, 'brisanje', 'DELETE', '2020-06-08 16:51:00', 3, 2),
(78, 'odjava', '-', '2020-06-08 16:54:38', 3, 1),
(79, 'prijava', '-', '2020-06-08 16:54:57', 1, 1),
(80, 'odjava', '-', '2020-06-08 17:03:43', 1, 1),
(81, 'prijava', '-', '2020-06-08 17:03:51', 3, 1),
(82, 'brisanje', 'DELETE FROM skupina WHERE skupina_id = 26', '2020-06-08 17:06:33', 3, 1),
(83, 'brisanje', 'UPDATE skupina SET naziv = Sovice, cijena = 400 WHERE skupina_id = 5', '2020-06-08 17:07:39', 3, 1),
(84, 'odjava', '-', '2020-06-08 17:07:43', 3, 1),
(85, 'prijava', '-', '2020-06-08 17:07:51', 1, 1),
(86, 'odjava', '-', '2020-06-08 17:10:06', 1, 1),
(87, 'prijava', '-', '2020-06-08 17:10:53', 3, 1),
(88, 'dodavanje', 'INSERT INTO `skupina` (`skupina_id`, `naziv`, `cijena`, `vrtic_id`, `korisnik_id`) VALUES (NULL, Proba, 421, 1, 3)', '2020-06-08 17:11:06', 3, 1),
(89, 'brisanje', 'DELETE FROM javni_poziv WHERE javni_poziv_id = 11', '2020-06-08 17:12:24', 3, 1),
(90, 'ažuriranje', 'UPDATE javni_poziv SET broj_mjesta = 17, datum_od = 2020-04-05, datum_do = 2020-04-19 WHERE javni_poziv_id = 2', '2020-06-08 17:14:58', 3, 1),
(91, 'odjava', '-', '2020-06-08 17:15:03', 3, 1),
(92, 'prijava', '-', '2020-06-08 17:15:10', 1, 1),
(93, 'odjava', '-', '2020-06-08 17:17:38', 1, 1),
(94, 'prijava', '-', '2020-06-08 17:17:46', 3, 1),
(95, 'dodavanje', 'INSERT INTO `javni_poziv` (`javni_poziv_id`, `broj_mjesta`, `datum_od`, `datum_do`, `vrtic_id`, `korisnik_id`) VALUES (NULL, 18, 2020-06-01, 2020-06-22, 1, 3)', '2020-06-08 17:17:58', 3, 1),
(96, 'odjava', '-', '2020-06-08 17:18:01', 3, 1),
(97, 'prijava', '-', '2020-06-08 17:18:07', 1, 1),
(98, 'odjava', '-', '2020-06-08 17:19:33', 1, 1),
(99, 'prijava', '-', '2020-06-08 17:19:42', 3, 1),
(100, 'dodavanje', 'INSERT INTO `skupina` (`skupina_id`, `naziv`, `cijena`, `vrtic_id`, `korisnik_id`) VALUES (NULL, Škola, 500, 1, 3)', '2020-06-08 17:19:54', 3, 2),
(101, 'odjava', '-', '2020-06-08 17:19:55', 3, 1),
(102, 'prijava', '-', '2020-06-08 17:20:05', 1, 1),
(103, 'odjava', '-', '2020-06-08 17:21:14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dz4_dijete`
--

CREATE TABLE `dz4_dijete` (
  `dijete_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `spol` varchar(45) NOT NULL,
  `najdraza_boja` varchar(45) NOT NULL,
  `zanima` varchar(45) NOT NULL,
  `visina` int(11) NOT NULL,
  `o_djetetu` text NOT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `korisnik_id` int(11) NOT NULL,
  `vrtic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dz4_dijete`
--

INSERT INTO `dz4_dijete` (`dijete_id`, `ime`, `prezime`, `spol`, `najdraza_boja`, `zanima`, `visina`, `o_djetetu`, `slika`, `korisnik_id`, `vrtic_id`) VALUES
(1, 'Ivana', 'Ivič', 'female', '#253647', 'crtanje, igrice, ', 57, 'Voli jako crtat.', 'multimedija/ivana.png', 5, 1),
(8, 'Luka', 'Lukić', 'male', '#ffaa33', 'igranje', 65, 'Voli igrat igrice', 'default.jpg', 5, 1),
(9, 'Martin', 'Mirić', 'male', '#ff8000', 'igrice, ', 78, 'igra igrice', 'nekaslika', 5, 1),
(10, 'Elvis', 'Mirić', 'male', '#000000', 'crtanje, igrice, ', 83, '123123', 'nekaslika', 5, 1),
(11, 'Ime', 'Prezime', 'female', '#42bcc6', 'crtanje, igrice, ', 86, 'Opis djeteta!', 'nekaslika', 5, 1),
(12, 'Antonio', 'Antolić', 'male', '#2e5fd1', 'crtanje, auta, ', 66, 'Voli crtat auta!', 'images/users/default.jpg', 5, 8),
(13, 'Marinko', 'Antolić', 'male', '#3e41c6', 'crtanje, auta, ', 92, 'dasdasdasdad', 'images/users/default.jpg', 5, 9),
(14, 'Marinko', 'asfasfsaf', 'other', '#105fe2', 'crtanje, igrice, auta, ', 83, 'wqeqwewqeqwe', 'images/users/default.jpg', 5, 10),
(15, 'absdasd', 'asdasdad', 'female', '#ffffff', 'crtanje, auta, ', 70, 'asdasdasdadad', 'images/users/default.jpg', 5, 11),
(16, 'Marinko', 'DADADA', 'male', '#536bcc', 'crtanje, igrice, ', 68, 'wsdsafasfsafasfa', 'images/users/default.jpg', 5, 12),
(17, 'Matej', 'DANEDA', 'male', '#ec1ab3', 'crtanje, igrice, ', 100, 'kakskkakak', 'images/users/default.jpg', 5, 13),
(18, 'Matej', 'neneeeeekfkf', 'male', '#2b4f86', 'crtanje, auta, ', 100, 'saeqweq', 'images/users/default.jpg', 5, 14),
(19, 'Saša', '123asd123', 'female', '#42c4d2', 'crtanje, igrice, ', 87, '212asdsa12312312', 'images/users/default.jpg', 5, 15),
(20, 'Matej', 'Marić', 'male', '#40c89b', 'igrice, auta, ', 86, 'asdasfafasfas', 'images/users/default.jpg', 5, 16),
(21, 'Matej', 'Marić', 'male', '#1dd32b', 'crtanje, igrice, ', 87, '123123123133', 'images/users/default.jpg', 5, 17),
(22, 'Nekaj', 'Nekaj', 'other', '#38f1ac', 'crtanje, igrice, auta, ', 100, '1231231231231', 'images/users/default.jpg', 5, 18),
(23, 'Test', 'Test', 'other', '#000000', 'crtanje, igrice, ', 84, 'Test.', 'images/users/default.jpg', 5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `dz4_dnevnik`
--

CREATE TABLE `dz4_dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `radnja` text NOT NULL,
  `upit` text NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dz4_korisnik`
--

CREATE TABLE `dz4_korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `datum_rodenja` date DEFAULT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_sha1` char(40) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `uloga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dz4_korisnik`
--

INSERT INTO `dz4_korisnik` (`korisnik_id`, `ime`, `prezime`, `korisnicko_ime`, `datum_rodenja`, `lozinka`, `lozinka_sha1`, `email`, `uvjeti`, `status`, `uloga_id`) VALUES
(2, 'Stanko', 'Dujakovic', 'sdujakovi', '1995-08-15', 'admin_u4GB', '49ad96eddf5668e1661fd915c49839b165b89de0', 'sdujakovi@foi.hr', '2020-05-13 13:19:07', 1, 1),
(4, 'Ana', 'Anić', 'aanic', '2020-05-05', 'Lozinka12', '816176fe5ae7abd5ba706b78a04a5d32ebde41e2', 'aanic@gmail.com', '2020-05-21 13:19:32', 1, 2),
(5, 'Marko', 'Maric', 'mmaric', '2020-05-13', 'Lozinka12', '5aaba09e8d762375a251606e02f7cbcbda248c58', 'mmaric@gmail.com', '2020-05-07 13:20:51', 1, 3),
(7, 'Goran', 'Dujaković', 'gdujakovic', NULL, 'Gorandujakovic12', 'Gorandujakovic12', 'gdujakovic@gmail.com', NULL, 1, 3),
(14, 'a', 'a', 'sdujakovic', '0001-01-01', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a', NULL, 1, 3),
(15, 'a', 'a', 'sdujakovic', '0001-01-01', 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'a@a', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dz4_tip`
--

CREATE TABLE `dz4_tip` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dz4_uloga`
--

CREATE TABLE `dz4_uloga` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dz4_uloga`
--

INSERT INTO `dz4_uloga` (`uloga_id`, `naziv`) VALUES
(1, 'administrator'),
(2, 'voditelj'),
(3, 'roditelj'),
(4, 'neprijavljen');

-- --------------------------------------------------------

--
-- Table structure for table `dz4_vrtic`
--

CREATE TABLE `dz4_vrtic` (
  `vrtic_id` int(11) NOT NULL,
  `broj_telefona` varchar(45) NOT NULL,
  `web_adresa` varchar(255) NOT NULL,
  `datum_osnivanja` date NOT NULL,
  `velicina` varchar(45) NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `broj_slobodnih_mjesta` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dz4_vrtic`
--

INSERT INTO `dz4_vrtic` (`vrtic_id`, `broj_telefona`, `web_adresa`, `datum_osnivanja`, `velicina`, `broj_mjesta`, `broj_slobodnih_mjesta`, `korisnik_id`) VALUES
(1, '00931238321', 'https://www.vrtic.hr', '2020-05-13', '23', 23, 20, 4),
(3, '+493991293', 'https://nekastranica.hr', '2020-05-20', '40', 40, 30, 2),
(4, '', '', '0000-00-00', '', 0, 0, 2),
(5, '+1435145', 'https://neeneeene.hr', '2020-05-23', '30', 30, 20, 2),
(6, '+1435145', 'https://ndest.hr', '2020-05-22', '20', 20, 13, 2),
(7, '+1435145', 'https://neeneeene.hr', '2020-05-16', '20', 20, 30, 2),
(8, '+1435145', 'https://neeneeene.hr', '2020-05-16', '20', 20, 10, 2),
(9, '+1435145', 'https://nwq.hr', '2020-05-22', '22', 22, 12, 2),
(10, '+1435145', 'https://neeneeene.hr', '2020-05-22', '22', 22, 12, 2),
(11, '+1435145', 'https://ndest.hr', '2020-05-23', '33', 33, 23, 2),
(12, '+1435145', 'https://neeneeene.hr', '2020-05-21', '70', 70, 38, 2),
(13, '+1435145', 'https://neeneeene.hr', '2020-05-16', '22', 22, 12, 2),
(14, '+1435145', 'https://ndest.hr', '2020-05-14', '22', 22, 2, 2),
(15, '1435145', 'https://neeneeene.hr', '2020-05-14', '23', 23, 23, 2),
(16, '+52323235', 'https://neeneeene.hr', '2020-05-22', '50', 50, 12, 2),
(17, '+5345345', 'neeneeene.hr', '2020-05-08', '22', 22, 2, 2),
(18, '+93213123', 'dasdasdad', '2020-04-30', '55', 55, 42, 2),
(19, '00931238321', 'https://www.vrtic.hr', '0001-01-01', '1', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evidencija`
--

CREATE TABLE `evidencija` (
  `evidencija_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `prisutno` varchar(45) NOT NULL DEFAULT 'NE',
  `dijete_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `racun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evidencija`
--

INSERT INTO `evidencija` (`evidencija_id`, `datum`, `prisutno`, `dijete_id`, `korisnik_id`, `racun_id`) VALUES
(1, '2020-03-02', 'DA', 1, 4, 1),
(2, '2020-03-03', 'DA', 1, 4, 1),
(3, '2020-03-04', 'DA', 1, 4, 1),
(4, '2020-03-05', 'NE', 1, 4, 1),
(5, '2020-03-02', 'NE', 2, 5, 3),
(6, '2020-03-03', 'NE', 2, 5, 3),
(7, '2020-03-04', 'DA', 2, 5, 3),
(8, '2020-03-05', 'NE', 2, 5, 3),
(9, '2020-04-01', 'DA', 1, 4, 2),
(10, '2020-04-02', 'DA', 1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `javni_poziv`
--

CREATE TABLE `javni_poziv` (
  `javni_poziv_id` int(11) NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `vrtic_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `javni_poziv`
--

INSERT INTO `javni_poziv` (`javni_poziv_id`, `broj_mjesta`, `datum_od`, `datum_do`, `vrtic_id`, `korisnik_id`) VALUES
(1, 15, '2020-04-05', '2020-04-19', 1, 3),
(2, 17, '2020-04-05', '2020-04-19', 1, 3),
(4, 14, '2020-04-12', '2020-04-26', 2, 12),
(5, 17, '2020-04-06', '2020-04-19', 3, 13),
(6, 19, '2020-04-07', '2020-04-21', 3, 14),
(7, 19, '2020-04-15', '2020-04-29', 3, 15),
(8, 34, '2020-06-10', '2020-06-11', 4, 1),
(9, 34, '2020-06-10', '2020-06-11', 4, 1),
(12, 18, '2020-06-01', '2020-06-22', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `datum_rodenja` date NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_sha1` varchar(40) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime NOT NULL,
  `zadnja_prijava` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `uloga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `korisnicko_ime`, `datum_rodenja`, `lozinka`, `lozinka_sha1`, `email`, `uvjeti`, `zadnja_prijava`, `status`, `uloga_id`) VALUES
(1, 'Stanko', 'Dujaković', 'sdujakovi', '1998-09-15', 'admin_u4GB', '49ad96eddf5668e1661fd915c49839b165b89de0', 'sdujakovi@foi.hr', '2020-04-08 00:00:00', '2020-04-09 00:00:00', 1, 1),
(2, 'Ana', 'Anić', 'aanic', '1993-06-16', 'aanic1', 'c1661a11df4b414ba1620512cafa6119d2b92b9a', 'aanic@gmail.com', '2020-04-03 00:00:00', '2020-04-04 00:00:00', 1, 2),
(3, 'Ivana', 'Dujak', 'idujak', '0000-00-00', 'idujak1', '4c5cda5c4197b1a9c4a4471d8f046e4dde7aa8cc', 'idujak@gmail.com', '2020-04-04 00:00:00', '2020-04-05 00:00:00', 1, 2),
(4, 'Goran', 'Dujaković', 'gdujakovi', '0000-00-00', 'gdujakovi1', '2123934182290e7069d89ad7a9ba71480a0f95fb', 'gdujakovi@gmail.com', '2020-04-04 00:00:00', '2020-04-05 00:00:00', 1, 3),
(5, 'Ivan', 'Ivić', 'iivic', '0000-00-00', 'iivic1', '6addc37fa26927de1c415e24d4ec1f32e7cdbb74', 'iivic@gmail.com', '2020-04-04 00:00:00', '2020-04-05 00:00:00', 0, 3),
(6, 'Lucija', 'Lucić', 'llucic', '0000-00-00', 'llucic1', 'aef1119dc915db8a55495f0c00335e7b898e4f70', 'llucic@gmail.com', '2020-04-06 00:00:00', '2020-04-07 00:00:00', 1, 3),
(7, 'Marina', 'Dujak', 'mdujak', '0000-00-00', 'mdujak1', 'fd3f88bb48825d045fa36217e101ed2fd737433b', 'mdujak@gmail.com', '2020-04-05 00:00:00', '2020-04-14 00:00:00', 1, 3),
(8, 'Marko', 'Marić', 'mmaric', '0000-00-00', 'mmaric1', '44f05a827644f226c9cc078944568004e7c00b6c', 'mmaric@gmail.com', '2020-04-07 00:00:00', '2020-04-08 00:00:00', 1, 3),
(9, 'Pero', 'Perić', 'pperic', '0000-00-00', 'pperic1', 'b3349f78d87172da0644589ed3403167fc3153a8', 'pperic@gmail.com', '2020-04-06 00:00:00', '2020-04-07 00:00:00', 1, 3),
(10, 'Silvio', 'Sivić', 'ssivic', '0000-00-00', 'ssivic1', 'c727fbcfebbb35208e75f8a5e800e0b49cff47a5', 'ssivic@gmail.com', '2020-04-04 00:00:00', '2020-04-05 00:00:00', 0, 3),
(11, 'Iva', 'Ivić', 'iivic', '0000-00-00', 'iivic1', '6addc37fa26927de1c415e24d4ec1f32e7cdbb74', 'iivic@gmail.com', '2020-04-02 00:00:00', '2020-04-04 00:00:00', 1, 2),
(12, 'Blaženka', 'Blažić', 'bblazic', '0000-00-00', 'bblazic1', '275fe6b5a4e391d18f12d34dcb85fa2355038717', 'bblazic@gmail.com', '2020-04-03 00:00:00', '2020-04-05 00:00:00', 1, 2),
(13, 'Luka', 'Grbeš', 'lgrbes', '0000-00-00', 'lgbes1', 'dc782b177951ec1e0be404aa1a623eddb396f875', 'lgrbes@gmail.com', '2020-04-03 00:00:00', '2020-04-04 00:00:00', 1, 2),
(14, 'Patrik', 'Patrić', 'ppatric', '0000-00-00', 'ppatric1', '376e10f75b8870bb870856ffc6f12ec7653df14f', 'ppatric@gmail.com', '2020-04-02 00:00:00', '2020-04-03 00:00:00', 1, 2),
(15, 'Josip', 'Jozić', 'jjozic', '0000-00-00', 'jjozic1', '4f9c1aec2e7678c8d789257670757996a48ed7d7', 'jjozic@gmail.com', '2020-04-12 00:00:00', '2020-04-26 00:00:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `moderator_dodijeljen`
--

CREATE TABLE `moderator_dodijeljen` (
  `korisnik_id` int(11) NOT NULL,
  `vrtic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderator_dodijeljen`
--

INSERT INTO `moderator_dodijeljen` (`korisnik_id`, `vrtic_id`) VALUES
(1, 1),
(2, 2),
(11, 3),
(12, 4),
(13, 5),
(14, 11),
(15, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena`
--

CREATE TABLE `ocjena` (
  `ocjena_id` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  `mjesec` date NOT NULL,
  `vrtic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ocjena`
--

INSERT INTO `ocjena` (`ocjena_id`, `ocjena`, `mjesec`, `vrtic_id`) VALUES
(1, 5, '2020-01-31', 1),
(2, 4, '2020-02-29', 1),
(3, 5, '2020-03-31', 1),
(4, 5, '2020-01-31', 2),
(5, 5, '2020-02-29', 2),
(6, 5, '2020-03-31', 2),
(7, 4, '2020-01-31', 3),
(8, 3, '2020-02-29', 3),
(9, 3, '2020-03-31', 3),
(10, 5, '2020-01-31', 4),
(11, 5, '2020-02-29', 4),
(12, 5, '2020-03-31', 4),
(13, 1, '2020-06-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `status` varchar(45) NOT NULL,
  `datum_prijave` datetime NOT NULL,
  `javni_poziv_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `skupina_skupina_id` int(11) NOT NULL,
  `dijete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`status`, `datum_prijave`, `javni_poziv_id`, `korisnik_id`, `skupina_skupina_id`, `dijete_id`) VALUES
('NE', '2020-04-08 11:00:00', 1, 3, 1, 1),
('NE', '2020-04-06 08:00:00', 1, 4, 1, 2),
('NE', '2020-04-07 12:00:00', 1, 5, 1, 3),
('NE', '2020-04-08 08:00:00', 1, 6, 1, 4),
('NE', '2020-04-08 07:00:00', 1, 7, 1, 5),
('NE', '2020-04-09 13:00:00', 1, 9, 1, 6),
('NE', '2020-04-10 05:00:00', 1, 10, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `iznos` int(11) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'NEPODMIREN',
  `skupina_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`racun_id`, `datum`, `iznos`, `status`, `skupina_id`, `korisnik_id`) VALUES
(1, '2020-03-10', 500, 'NEPODMIREN', 1, 4),
(2, '2020-04-10', 500, 'NEPODMIREN', 1, 4),
(3, '2020-03-10', 500, 'NEPODMIREN', 1, 5),
(4, '2020-04-10', 500, 'NEPODMIREN', 1, 5),
(5, '2020-03-10', 500, 'NEPODMIREN', 1, 6),
(6, '2020-04-10', 500, 'NEPODMIREN', 1, 6),
(7, '2020-03-10', 500, 'NEPODMIREN', 1, 7),
(8, '2020-04-10', 500, 'NEPODMIREN', 1, 7),
(9, '2020-03-10', 500, 'NEPODMIREN', 1, 8),
(10, '2020-04-10', 500, 'NEPODMIREN', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

CREATE TABLE `skupina` (
  `skupina_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `cijena` int(11) NOT NULL,
  `vrtic_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`skupina_id`, `naziv`, `cijena`, `vrtic_id`, `korisnik_id`) VALUES
(1, 'Pred škola', 500, 1, 1),
(2, 'Jaslice', 500, 1, 1),
(3, 'Tratinčice', 430, 26, 3),
(4, 'Jagodice', 450, 2, 1),
(5, 'Sovice', 400, 3, 3),
(6, 'Točkice', 390, 3, 1),
(7, 'Zvijezdice', 390, 3, 1),
(8, 'Leptirići', 470, 4, 1),
(9, 'Kockice', 470, 4, 1),
(21, 'jaslice', 450, 1, 3),
(27, 'Proba', 421, 1, 3),
(28, 'Škola', 500, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`tip_id`, `naziv`) VALUES
(1, 'prijava/odjava'),
(2, 'rad s bazom'),
(3, 'ostale radnje');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Voditelj'),
(3, 'Roditelj');

-- --------------------------------------------------------

--
-- Table structure for table `vrtic`
--

CREATE TABLE `vrtic` (
  `vrtic_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vrtic`
--

INSERT INTO `vrtic` (`vrtic_id`, `naziv`, `adresa`, `korisnik_id`) VALUES
(1, 'Igra', 'Ul. Kneza Domagoja 93, 48000, Koprivnica', 3),
(3, 'Korak po korak', 'Trg podravskih heroja 7, 48000, Koprivnica', 12),
(24, 'Tratinčica', 'Ul. Antuna Mihanovića 30, 10000, Zagreb', 2),
(26, 'Proba', 'Proba', 13),
(29, 'Radost', 'Starogradska ul. 22, 48000, Koprivnica', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dijete`
--
ALTER TABLE `dijete`
  ADD PRIMARY KEY (`dijete_id`),
  ADD KEY `fk_dijete_skupina1_idx` (`skupina_id`);

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`korisnik_id`,`tip_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_id`);

--
-- Indexes for table `dz4_dijete`
--
ALTER TABLE `dz4_dijete`
  ADD PRIMARY KEY (`dijete_id`),
  ADD KEY `fk_DZ4_dijete_DZ4_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_DZ4_dijete_DZ4_vrtic1_idx` (`vrtic_id`);

--
-- Indexes for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`korisnik_id`,`tip_id`),
  ADD KEY `fk_DZ4_dnevnik_DZ4_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_DZ4_dnevnik_DZ4_tip1_idx` (`tip_id`);

--
-- Indexes for table `dz4_korisnik`
--
ALTER TABLE `dz4_korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_DZ4_korisnik_DZ4_uloga_idx` (`uloga_id`);

--
-- Indexes for table `dz4_tip`
--
ALTER TABLE `dz4_tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `dz4_uloga`
--
ALTER TABLE `dz4_uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `dz4_vrtic`
--
ALTER TABLE `dz4_vrtic`
  ADD PRIMARY KEY (`vrtic_id`),
  ADD KEY `fk_DZ4_vrtic_DZ4_korisnik1_idx` (`korisnik_id`);

--
-- Indexes for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD PRIMARY KEY (`evidencija_id`),
  ADD KEY `fk_evidencija_dijete1_idx` (`dijete_id`),
  ADD KEY `fk_evidencija_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_evidencija_racun1_idx` (`racun_id`);

--
-- Indexes for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD PRIMARY KEY (`javni_poziv_id`),
  ADD KEY `fk_javni_poziv_vrtic1_idx` (`vrtic_id`),
  ADD KEY `fk_javni_poziv_korisnik1_idx` (`korisnik_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_id`);

--
-- Indexes for table `moderator_dodijeljen`
--
ALTER TABLE `moderator_dodijeljen`
  ADD PRIMARY KEY (`korisnik_id`,`vrtic_id`),
  ADD KEY `fk_moderator_dodijeljen_vrtic1_idx` (`vrtic_id`);

--
-- Indexes for table `ocjena`
--
ALTER TABLE `ocjena`
  ADD PRIMARY KEY (`ocjena_id`),
  ADD KEY `fk_ocjena_vrtic1_idx` (`vrtic_id`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`javni_poziv_id`,`korisnik_id`),
  ADD KEY `fk_prijava_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_prijava_skupina1_idx` (`skupina_skupina_id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_id`),
  ADD KEY `fk_racun_skupina1_idx` (`skupina_id`),
  ADD KEY `fk_racun_korisnik1_idx` (`korisnik_id`);

--
-- Indexes for table `skupina`
--
ALTER TABLE `skupina`
  ADD PRIMARY KEY (`skupina_id`),
  ADD KEY `fk_skupina_vrtic1_idx` (`vrtic_id`),
  ADD KEY `fk_skupina_korisnik1_idx` (`korisnik_id`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD PRIMARY KEY (`vrtic_id`),
  ADD KEY `fk_vrtic_korisnik1_idx` (`korisnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dijete`
--
ALTER TABLE `dijete`
  MODIFY `dijete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `dz4_dijete`
--
ALTER TABLE `dz4_dijete`
  MODIFY `dijete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dz4_korisnik`
--
ALTER TABLE `dz4_korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dz4_tip`
--
ALTER TABLE `dz4_tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dz4_uloga`
--
ALTER TABLE `dz4_uloga`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dz4_vrtic`
--
ALTER TABLE `dz4_vrtic`
  MODIFY `vrtic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `evidencija`
--
ALTER TABLE `evidencija`
  MODIFY `evidencija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  MODIFY `javni_poziv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ocjena`
--
ALTER TABLE `ocjena`
  MODIFY `ocjena_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skupina`
--
ALTER TABLE `skupina`
  MODIFY `skupina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vrtic`
--
ALTER TABLE `vrtic`
  MODIFY `vrtic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dijete`
--
ALTER TABLE `dijete`
  ADD CONSTRAINT `fk_dijete_skupina1` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_id`) REFERENCES `tip` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dz4_dijete`
--
ALTER TABLE `dz4_dijete`
  ADD CONSTRAINT `fk_DZ4_dijete_DZ4_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `dz4_korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DZ4_dijete_DZ4_vrtic1` FOREIGN KEY (`vrtic_id`) REFERENCES `dz4_vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  ADD CONSTRAINT `fk_DZ4_dnevnik_DZ4_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `dz4_korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DZ4_dnevnik_DZ4_tip1` FOREIGN KEY (`tip_id`) REFERENCES `dz4_tip` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dz4_korisnik`
--
ALTER TABLE `dz4_korisnik`
  ADD CONSTRAINT `fk_DZ4_korisnik_DZ4_uloga` FOREIGN KEY (`uloga_id`) REFERENCES `dz4_uloga` (`uloga_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dz4_vrtic`
--
ALTER TABLE `dz4_vrtic`
  ADD CONSTRAINT `fk_DZ4_vrtic_DZ4_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `dz4_korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD CONSTRAINT `fk_evidencija_dijete1` FOREIGN KEY (`dijete_id`) REFERENCES `dijete` (`dijete_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencija_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencija_racun1` FOREIGN KEY (`racun_id`) REFERENCES `racun` (`racun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD CONSTRAINT `fk_javni_poziv_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_javni_poziv_vrtic1` FOREIGN KEY (`vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`uloga_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderator_dodijeljen`
--
ALTER TABLE `moderator_dodijeljen`
  ADD CONSTRAINT `fk_moderator_dodijeljen_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moderator_dodijeljen_vrtic1` FOREIGN KEY (`vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ocjena`
--
ALTER TABLE `ocjena`
  ADD CONSTRAINT `fk_ocjena_vrtic1` FOREIGN KEY (`vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `fk_prijava_javni_poziv1` FOREIGN KEY (`javni_poziv_id`) REFERENCES `javni_poziv` (`javni_poziv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijava_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijava_skupina1` FOREIGN KEY (`skupina_skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_racun_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_racun_skupina1` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skupina`
--
ALTER TABLE `skupina`
  ADD CONSTRAINT `fk_skupina_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_skupina_vrtic1` FOREIGN KEY (`vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD CONSTRAINT `fk_vrtic_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
