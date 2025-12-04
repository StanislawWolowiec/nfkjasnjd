-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komputa`
--

-- --------------------------------------------------------

--
-- Table structure for table `wczytane`
--

CREATE TABLE `wczytane` (
  `id` int(11) NOT NULL,
  `json` longtext NOT NULL,
  `url` varchar(100) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `kategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zapisane`
--

CREATE TABLE `zapisane` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zapisane`
--

INSERT INTO `zapisane` (`id`, `url`) VALUES
(4, 'https://www.komputronik.pl/api/front/v1/pages/product/896614'),
(5, 'https://www.komputronik.pl/api/front/v1/pages/product/905690'),
(6, 'https://www.komputronik.pl/api/front/v1/pages/product/894328'),
(7, 'https://www.komputronik.pl/api/front/v1/pages/product/902862'),
(8, 'https://www.komputronik.pl/api/front/v1/pages/product/902472'),
(9, 'https://www.komputronik.pl/api/front/v1/pages/product/891650'),
(10, 'https://www.komputronik.pl/api/front/v1/pages/product/903094'),
(11, 'https://www.komputronik.pl/api/front/v1/pages/product/906924'),
(12, 'https://www.komputronik.pl/api/front/v1/pages/product/898534'),
(13, 'https://www.komputronik.pl/api/front/v1/pages/product/898266'),
(14, 'https://www.komputronik.pl/api/front/v1/pages/product/909938'),
(15, 'https://www.komputronik.pl/api/front/v1/pages/product/891992'),
(16, 'https://www.komputronik.pl/api/front/v1/pages/product/902409'),
(17, 'https://www.komputronik.pl/api/front/v1/pages/product/891394'),
(18, 'https://www.komputronik.pl/api/front/v1/pages/product/896370'),
(19, 'https://www.komputronik.pl/api/front/v1/pages/product/906563'),
(20, 'https://www.komputronik.pl/api/front/v1/pages/product/894796'),
(21, 'https://www.komputronik.pl/api/front/v1/pages/product/906203'),
(22, 'https://www.komputronik.pl/api/front/v1/pages/product/907819'),
(23, 'https://www.komputronik.pl/api/front/v1/pages/product/900692'),
(24, 'https://www.komputronik.pl/api/front/v1/pages/product/895303'),
(25, 'https://www.komputronik.pl/api/front/v1/pages/product/900460'),
(26, 'https://www.komputronik.pl/api/front/v1/pages/product/897197'),
(27, 'https://www.komputronik.pl/api/front/v1/pages/product/901697'),
(28, 'https://www.komputronik.pl/api/front/v1/pages/product/892465'),
(29, 'https://www.komputronik.pl/api/front/v1/pages/product/899120'),
(30, 'https://www.komputronik.pl/api/front/v1/pages/product/892007'),
(31, 'https://www.komputronik.pl/api/front/v1/pages/product/897191'),
(32, 'https://www.komputronik.pl/api/front/v1/pages/product/909766'),
(33, 'https://www.komputronik.pl/api/front/v1/pages/product/899852'),
(34, 'https://www.komputronik.pl/api/front/v1/pages/product/892525'),
(35, 'https://www.komputronik.pl/api/front/v1/pages/product/892707'),
(36, 'https://www.komputronik.pl/api/front/v1/pages/product/908562'),
(37, 'https://www.komputronik.pl/api/front/v1/pages/product/893430'),
(38, 'https://www.komputronik.pl/api/front/v1/pages/product/891556'),
(39, 'https://www.komputronik.pl/api/front/v1/pages/product/892794'),
(40, 'https://www.komputronik.pl/api/front/v1/pages/product/904412'),
(41, 'https://www.komputronik.pl/api/front/v1/pages/product/909905'),
(42, 'https://www.komputronik.pl/api/front/v1/pages/product/903224'),
(43, 'https://www.komputronik.pl/api/front/v1/pages/product/904208'),
(44, 'https://www.komputronik.pl/api/front/v1/pages/product/900666'),
(45, 'https://www.komputronik.pl/api/front/v1/pages/product/896819'),
(46, 'https://www.komputronik.pl/api/front/v1/pages/product/900669'),
(47, 'https://www.komputronik.pl/api/front/v1/pages/product/893394'),
(48, 'https://www.komputronik.pl/api/front/v1/pages/product/891963'),
(49, 'https://www.komputronik.pl/api/front/v1/pages/product/896413'),
(50, 'https://www.komputronik.pl/api/front/v1/pages/product/891289'),
(51, 'https://www.komputronik.pl/api/front/v1/pages/product/893335'),
(52, 'https://www.komputronik.pl/api/front/v1/pages/product/906658'),
(53, 'https://www.komputronik.pl/api/front/v1/pages/product/909477'),
(54, 'https://www.komputronik.pl/api/front/v1/pages/product/893053'),
(55, 'https://www.komputronik.pl/api/front/v1/pages/product/901521'),
(56, 'https://www.komputronik.pl/api/front/v1/pages/product/894640'),
(57, 'https://www.komputronik.pl/api/front/v1/pages/product/891378'),
(58, 'https://www.komputronik.pl/api/front/v1/pages/product/905420'),
(59, 'https://www.komputronik.pl/api/front/v1/pages/product/890954'),
(60, 'https://www.komputronik.pl/api/front/v1/pages/product/894236'),
(61, 'https://www.komputronik.pl/api/front/v1/pages/product/894481'),
(62, 'https://www.komputronik.pl/api/front/v1/pages/product/909634'),
(63, 'https://www.komputronik.pl/api/front/v1/pages/product/891942'),
(64, 'https://www.komputronik.pl/api/front/v1/pages/product/908386'),
(65, 'https://www.komputronik.pl/api/front/v1/pages/product/894438'),
(66, 'https://www.komputronik.pl/api/front/v1/pages/product/902368'),
(67, 'https://www.komputronik.pl/api/front/v1/pages/product/904135'),
(68, 'https://www.komputronik.pl/api/front/v1/pages/product/902175'),
(69, 'https://www.komputronik.pl/api/front/v1/pages/product/907595'),
(70, 'https://www.komputronik.pl/api/front/v1/pages/product/892876'),
(71, 'https://www.komputronik.pl/api/front/v1/pages/product/901500'),
(72, 'https://www.komputronik.pl/api/front/v1/pages/product/900385'),
(73, 'https://www.komputronik.pl/api/front/v1/pages/product/897778'),
(74, 'https://www.komputronik.pl/api/front/v1/pages/product/896576'),
(75, 'https://www.komputronik.pl/api/front/v1/pages/product/905339'),
(76, 'https://www.komputronik.pl/api/front/v1/pages/product/898188'),
(77, 'https://www.komputronik.pl/api/front/v1/pages/product/891840'),
(78, 'https://www.komputronik.pl/api/front/v1/pages/product/906608'),
(79, 'https://www.komputronik.pl/api/front/v1/pages/product/901566'),
(80, 'https://www.komputronik.pl/api/front/v1/pages/product/906666'),
(81, 'https://www.komputronik.pl/api/front/v1/pages/product/905579'),
(82, 'https://www.komputronik.pl/api/front/v1/pages/product/902927'),
(83, 'https://www.komputronik.pl/api/front/v1/pages/product/902653'),
(84, 'https://www.komputronik.pl/api/front/v1/pages/product/900194'),
(85, 'https://www.komputronik.pl/api/front/v1/pages/product/892519'),
(86, 'https://www.komputronik.pl/api/front/v1/pages/product/897487'),
(87, 'https://www.komputronik.pl/api/front/v1/pages/product/895521'),
(88, 'https://www.komputronik.pl/api/front/v1/pages/product/907003'),
(89, 'https://www.komputronik.pl/api/front/v1/pages/product/894804'),
(90, 'https://www.komputronik.pl/api/front/v1/pages/product/891428'),
(91, 'https://www.komputronik.pl/api/front/v1/pages/product/892907'),
(92, 'https://www.komputronik.pl/api/front/v1/pages/product/903985'),
(93, 'https://www.komputronik.pl/api/front/v1/pages/product/905746'),
(94, 'https://www.komputronik.pl/api/front/v1/pages/product/906906'),
(95, 'https://www.komputronik.pl/api/front/v1/pages/product/900364'),
(96, 'https://www.komputronik.pl/api/front/v1/pages/product/900428'),
(97, 'https://www.komputronik.pl/api/front/v1/pages/product/903073'),
(98, 'https://www.komputronik.pl/api/front/v1/pages/product/907774'),
(99, 'https://www.komputronik.pl/api/front/v1/pages/product/897630'),
(100, 'https://www.komputronik.pl/api/front/v1/pages/product/905676'),
(101, 'https://www.komputronik.pl/api/front/v1/pages/product/894750'),
(102, 'https://www.komputronik.pl/api/front/v1/pages/product/890984'),
(103, 'https://www.komputronik.pl/api/front/v1/pages/product/893317'),
(104, 'https://www.komputronik.pl/api/front/v1/pages/product/893494'),
(105, 'https://www.komputronik.pl/api/front/v1/pages/product/904794'),
(106, 'https://www.komputronik.pl/api/front/v1/pages/product/898575'),
(107, 'https://www.komputronik.pl/api/front/v1/pages/product/904929'),
(108, 'https://www.komputronik.pl/api/front/v1/pages/product/908150'),
(109, 'https://www.komputronik.pl/api/front/v1/pages/product/906518'),
(110, 'https://www.komputronik.pl/api/front/v1/pages/product/903095'),
(111, 'https://www.komputronik.pl/api/front/v1/pages/product/896964'),
(112, 'https://www.komputronik.pl/api/front/v1/pages/product/905480'),
(113, 'https://www.komputronik.pl/api/front/v1/pages/product/893070'),
(114, 'https://www.komputronik.pl/api/front/v1/pages/product/891002'),
(115, 'https://www.komputronik.pl/api/front/v1/pages/product/909024'),
(116, 'https://www.komputronik.pl/api/front/v1/pages/product/904507'),
(117, 'https://www.komputronik.pl/api/front/v1/pages/product/901892'),
(118, 'https://www.komputronik.pl/api/front/v1/pages/product/903862'),
(119, 'https://www.komputronik.pl/api/front/v1/pages/product/903530'),
(120, 'https://www.komputronik.pl/api/front/v1/pages/product/897256'),
(121, 'https://www.komputronik.pl/api/front/v1/pages/product/896231'),
(122, 'https://www.komputronik.pl/api/front/v1/pages/product/903492'),
(123, 'https://www.komputronik.pl/api/front/v1/pages/product/893200'),
(124, 'https://www.komputronik.pl/api/front/v1/pages/product/891849'),
(125, 'https://www.komputronik.pl/api/front/v1/pages/product/898883'),
(126, 'https://www.komputronik.pl/api/front/v1/pages/product/895135'),
(127, 'https://www.komputronik.pl/api/front/v1/pages/product/900085'),
(128, 'https://www.komputronik.pl/api/front/v1/pages/product/903860'),
(129, 'https://www.komputronik.pl/api/front/v1/pages/product/908367'),
(130, 'https://www.komputronik.pl/api/front/v1/pages/product/909002'),
(131, 'https://www.komputronik.pl/api/front/v1/pages/product/899991'),
(132, 'https://www.komputronik.pl/api/front/v1/pages/product/891858'),
(133, 'https://www.komputronik.pl/api/front/v1/pages/product/903846'),
(134, 'https://www.komputronik.pl/api/front/v1/pages/product/908261'),
(135, 'https://www.komputronik.pl/api/front/v1/pages/product/903480');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wczytane`
--
ALTER TABLE `wczytane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zapisane`
--
ALTER TABLE `zapisane`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wczytane`
--
ALTER TABLE `wczytane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zapisane`
--
ALTER TABLE `zapisane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
