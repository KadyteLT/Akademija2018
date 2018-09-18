-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018 m. Rgs 18 d. 17:18
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jumpers_eshop`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Akmenė'),
(2, 'Alytus'),
(3, 'Anykščiai'),
(4, 'Ariogala'),
(5, 'Baltoji Vokė'),
(6, 'Birštonas'),
(7, 'Biržai'),
(8, 'Daugai'),
(9, 'Druskininkai'),
(10, 'Dūkštas'),
(11, 'Dusetos'),
(12, 'Eišiškės'),
(13, 'Elektrėnai'),
(14, 'Ežerėlis'),
(15, 'Gargždai'),
(16, 'Garliava'),
(17, 'Gelgaudiškis'),
(18, 'Grigiškės'),
(19, 'Ignalina'),
(20, 'Jieznas'),
(21, 'Jonava'),
(22, 'Joniškėlis'),
(23, 'Joniškis'),
(24, 'Jurbarkas'),
(25, 'Kaišiadorys'),
(26, 'Kalvarija'),
(27, 'Kaunas'),
(28, 'Kavarskas'),
(29, 'Kazlų ruda'),
(30, 'Kėdainiai'),
(31, 'Kelmė'),
(32, 'Kybartai'),
(33, 'Klaipėda'),
(34, 'Kretinga'),
(35, 'Kudirkos naumiestis'),
(36, 'Kupiškis'),
(37, 'Kuršėnai'),
(38, 'Lazdijai'),
(39, 'Lentvaris'),
(40, 'Linkuva'),
(41, 'Marijampolė'),
(42, 'Mažeikiai'),
(43, 'Molėtai'),
(44, 'Naujoji Akmenė'),
(45, 'Nemenčinė'),
(46, 'Neringa'),
(47, 'Nida'),
(48, 'Obeliai'),
(49, 'Pabradė'),
(50, 'Pagėgiai'),
(51, 'Pakruojis'),
(52, 'Palanga'),
(53, 'Pandėlys'),
(54, 'Panemunė'),
(55, 'Panevėžys'),
(56, 'Pasvalys'),
(57, 'Plungė'),
(58, 'Priekulė'),
(59, 'Prienai'),
(60, 'Radviliškis'),
(61, 'Ramygala'),
(62, 'Raseiniai'),
(63, 'Rietavas'),
(64, 'Rokiškis'),
(65, 'Rūdiškės'),
(66, 'Salantai'),
(67, 'Seda'),
(68, 'Simnas'),
(69, 'Skaudvilė'),
(70, 'Skuodas'),
(71, 'Smalininkai'),
(72, 'Subačius'),
(73, 'Šakiai'),
(74, 'Šalčininkai'),
(75, 'Šeduva'),
(76, 'Šiauliai'),
(77, 'Šilalė'),
(78, 'Šilutė'),
(79, 'Širvintos'),
(80, 'Švenčionėliai'),
(81, 'Švenčionys'),
(82, 'Tauragė'),
(83, 'Telšiai'),
(84, 'Tytuvėnai'),
(85, 'Trakai'),
(86, 'Troškūnai'),
(87, 'Ukmergė'),
(88, 'Utena'),
(89, 'Užventis'),
(90, 'Vabalninkas'),
(91, 'Varėna'),
(92, 'Varniai'),
(93, 'Veisiejai'),
(94, 'Venta'),
(95, 'Viekšniai'),
(96, 'Vievis'),
(97, 'Vilkaviškis'),
(98, 'Vilkija'),
(99, 'Vilnius'),
(100, 'Virbalis'),
(101, 'Visaginas'),
(102, 'Zarasai'),
(103, 'Žagarė'),
(104, 'Žiežmariai'),
(105, 'Akmenės raj.'),
(106, 'Alytaus raj.'),
(107, 'Anykščių raj.'),
(108, 'Biržų raj.'),
(109, 'Ignalinos raj.'),
(110, 'Jonavos raj.'),
(111, 'Joniškio raj.'),
(112, 'Jurbarko raj.'),
(113, 'Kaišiadorių raj.'),
(114, 'Kauno raj.'),
(115, 'Kėdainių raj.'),
(116, 'Kelmės raj.'),
(117, 'Kretingos raj'),
(118, 'Kupiškio raj.'),
(119, 'Lazdijų raj.'),
(120, 'Mažeikių raj.'),
(121, 'Molėtų raj.'),
(122, 'Pakruojo raj.'),
(123, 'Panevėžio raj.'),
(124, 'Pasvalio raj.'),
(125, 'Plungės raj.'),
(126, 'Prienų raj.'),
(127, 'Radviliškio raj.'),
(128, 'Raseinių raj.'),
(129, 'Rokiškio raj.'),
(130, 'Skuodo raj.'),
(131, 'Šakių raj.'),
(132, 'Šalčininkų raj.'),
(133, 'Šiaulių raj.'),
(134, 'Šilalės raj.'),
(135, 'Šilutės raj.'),
(136, 'Širvintų raj.'),
(137, 'Švenčionių raj.'),
(138, 'Tauragės raj.'),
(139, 'Telšių raj.'),
(140, 'Trakų raj.'),
(141, 'Ukmergės raj.'),
(142, 'Utenos raj.'),
(143, 'Varėnos raj.'),
(144, 'Vilkaviškio raj.'),
(145, 'Vilniaus raj.'),
(146, 'Zarasų raj.');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `jumpers`
--

DROP TABLE IF EXISTS `jumpers`;
CREATE TABLE IF NOT EXISTS `jumpers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `price` text NOT NULL,
  `about_product` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `jumpers`
--

INSERT INTO `jumpers` (`id`, `type`, `price`, `about_product`) VALUES
(1, 'Su pilnu užtrauktuku, kišenėmis ir kapišonu', '47,65', '80% medvilnė / 20% poliesteris. Šiltas, pagamintas iš kokybiškos medvilnės'),
(2, 'Be užtrauktuko, su kišenėmis ir kapišonu', '20,99', '80% medvilnė / 20% poliesteris'),
(3, 'Su daliniu užtrauktu ir kišenėmis', '23,55', 'Su daliniu užtrauktu ir kišenėmis aprasymas'),
(4, 'Su pilnu užtrauktu be kišenių', '21,99', 'Su pinu užtrauktu be kišenių aprasymas'),
(5, 'Su daliniu užtrauktu be kišenių', '14,99', '80% medvilnė / 20% poliesteris. '),
(6, 'Be kišenių, be užtrauktuko ir kapišono', '12,50', 'Be kišenių, be užtrauktuko'),
(7, 'Su pilnu užtrauktuku, kišenėmis be kapišono', '17,59', '80% medvilnė / 20% poliesteris. '),
(9, 'Be užtrauktuko, be kišenių su kapišonu', '18,69', '80% medvilnė / 20% poliesteris. ');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `jumper_color`
--

DROP TABLE IF EXISTS `jumper_color`;
CREATE TABLE IF NOT EXISTS `jumper_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `jumper_color`
--

INSERT INTO `jumper_color` (`id`, `color`) VALUES
(1, 'Juoda'),
(2, 'Balta'),
(3, 'Geltona/žalia/raudona'),
(4, 'Raudona'),
(5, 'Šviesiai žalia'),
(6, 'Geltona'),
(7, 'Žalia');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `jumper_gender`
--

DROP TABLE IF EXISTS `jumper_gender`;
CREATE TABLE IF NOT EXISTS `jumper_gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `jumper_gender`
--

INSERT INTO `jumper_gender` (`id`, `gender`) VALUES
(1, 'Moteriškas'),
(2, 'Vyriškas');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `jumper_size`
--

DROP TABLE IF EXISTS `jumper_size`;
CREATE TABLE IF NOT EXISTS `jumper_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `jumper_size`
--

INSERT INTO `jumper_size` (`id`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumper_id` int(11) NOT NULL,
  `jumper_color_id` int(11) NOT NULL,
  `jumper_gender_id` int(11) NOT NULL,
  `jumper_size_id` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_lastname` varchar(255) NOT NULL,
  `buyer_address_1` varchar(255) NOT NULL,
  `buyer_address_2` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

--
-- Sukurta duomenų kopija lentelei `orders`
--

INSERT INTO `orders` (`id`, `jumper_id`, `jumper_color_id`, `jumper_gender_id`, `jumper_size_id`, `buyer_name`, `buyer_lastname`, `buyer_address_1`, `buyer_address_2`, `mobile`, `city_id`) VALUES
(11, 7, 1, 2, 6, 'Ramūnas', 'Ruginis', 'Sporto 3-331', '', '867215458', 99),
(10, 1, 7, 1, 1, 'Radvilė', 'Radvilivičiūtė', 'Putinų g 20', 'Vaišvydava', '', 27),
(3, 4, 2, 1, 3, 'Ramunė', 'Antanavičiūtė', 'Upytės 25', 'Naisiai', '865346123', 133),
(2, 9, 5, 2, 4, 'Gytis', 'Radauskas', 'Gedimino 36-2', '', '864262326', 99),
(1, 1, 1, 1, 1, 'Rūta', 'Kaledienė', 'Joninių g 28-5', 'Garliava', '865432654', 27),
(12, 4, 3, 2, 4, 'Antanas', 'Kazys', 'Pakalnučių 56', '', '+37065863951', 34),
(13, 7, 6, 1, 1, 'Guoda', 'Armanė', 'Savanorių 25', '', '865432156', 33),
(14, 4, 7, 1, 4, 'Lina', 'Vaitkevičė', 'Rokų 52-1', '', '', 13),
(15, 6, 4, 1, 1, 'Asta', 'Garšvytė', 'Rožių g. 15-30', 'Laiviai', '+37066054232', 117),
(16, 1, 5, 2, 3, 'Kęstutis', 'Kadys', 'Jonavos 30', '', '842613217', 9),
(17, 4, 4, 2, 4, 'Algis', 'Ramanauskas', 'Ąžuolų g. 30-30', '', '867235489', 3),
(18, 7, 7, 2, 4, 'Linas', 'Varkalys', 'Joninių 28-4', 'Domeikava', '865730444', 114),
(19, 3, 7, 2, 3, 'Algis', 'Džiugutis', 'Gedimino 20', '', '+37066054555', 66),
(20, 3, 4, 1, 6, 'Augustė', 'Rimantytė', 'Kęstučio g 30-20', '', '863065475', 33),
(21, 4, 5, 2, 3, 'Igoris', 'Tomkevič', 'Rato g. 54', '', '868659860', 6),
(22, 7, 4, 2, 4, 'Andrius', 'Ivanauskas', 'Pakalnučių 56', '', '865232542', 96),
(23, 6, 7, 2, 1, 'Tomas', 'Jonaitis', 'Arklių g. 15', 'Kruopiai', '865764951', 105),
(24, 5, 2, 1, 3, 'Janina', 'Algimantė', 'Parko 30-3', 'Plateliai', '+37065863952', 125),
(25, 1, 5, 2, 5, 'Rokas', 'Galimauskas', 'Aušros 30', '', '+37066034444', 6),
(26, 2, 2, 1, 3, 'Gabija', 'Jėgelavičiūtė', 'Sodų 25', 'Mūniškiai', '+37068295642', 114),
(27, 7, 1, 2, 5, 'Jonas', 'Aklys', 'Vienuolyno 52', 'Šventūpe', '+37068342654', 141),
(28, 7, 7, 2, 6, 'Tomas', 'Karalius', 'Aušros 2-2', 'Notėnai', '+37068387945', 117),
(29, 6, 7, 2, 2, 'Gintaras', 'Kavaliauskas', 'Joninių 3 ', 'Troškūnai', '+37098265247', 107),
(30, 9, 3, 2, 4, 'Algimantas', 'Kalinauskas', 'Rietavo 20', 'Paliepiai', '+37068348754', 128),
(31, 3, 2, 1, 2, 'Liepa', 'Plieterytė', 'Saulėtekio g 30', '', '+37057063951', 27),
(32, 3, 6, 1, 2, 'Urtė', 'Girienė', 'Mindaugo g 5-30', '', '+37086593412', 99),
(33, 5, 2, 1, 3, 'Miglė', 'Kavaliauskienė', 'Kauno 30-6', 'Juodeliai', '+37068241541', 108),
(34, 3, 2, 1, 5, 'Vida', 'Šarkienė', 'Vilties g 17', 'Molainiai', '+37068263951', 123),
(35, 6, 2, 2, 5, 'Rokas', 'Jonikėlis', 'Radijo g 31-12', '', '+37068462354', 55),
(36, 9, 4, 1, 3, 'Vilma', 'Rubinienė', 'Šateikių g. 30', 'Gintališkė', '+37084796324', 125),
(37, 7, 4, 2, 3, 'Benas', 'Kavaliauskas', 'Vokiečių 32', '', '+370695321', 27),
(38, 9, 3, 2, 4, 'Darius', 'Urbonas', 'Kretingos g 30', '', '+37066254232', 16),
(39, 1, 4, 1, 2, 'Vytautė', 'Paulauskaitė', 'Akmenės g 14', '', '', 82),
(40, 6, 1, 1, 2, 'Jovita', 'Butkutė', 'Jūros g 11', '', '+37067430215', 31),
(41, 4, 6, 2, 3, 'Aleksas', 'Pocius', 'Telšių 12', 'Gaudikaičiai', '+37065321488', 139),
(42, 5, 1, 2, 4, 'Kostas', 'Stankevičius', 'Vilniaus 5', '', '+37066063951', 96),
(43, 3, 7, 1, 2, 'Akvilė', 'Navickienė', 'Akmenų 6', '', '+37064895175', 99),
(44, 6, 5, 1, 3, 'Edita', 'Pociūtė', 'Šaulių g 20', 'Bridai', '+37065932147', 133),
(45, 4, 7, 2, 2, 'Paulius', 'Lukošius', 'Pilies g 13', '', '+37065342478', 99),
(46, 3, 1, 1, 1, 'Rugilė', 'Balčiūnaitė', 'Upės g 15', '', '+37066063951', 27),
(47, 5, 6, 2, 2, 'Saulius', 'Mažulis', 'Jurginų 23', '', '+37065863555', 16),
(48, 2, 2, 1, 5, 'Viltė', 'Bertulienė', 'Miško g 25-2', '', '+37068362541', 27),
(49, 5, 4, 1, 3, 'Lina', 'Adomaitienė', 'ežero 12-5', 'Rubikiai', '+37068432154', 107),
(50, 2, 5, 1, 4, 'Goda', 'Petrauskytė', 'Kauno g 2', 'Vandžiogala', '+37068730611', 114),
(51, 9, 2, 2, 3, 'Petras', 'Rubinas', 'Karjero g 1', 'Drąseikiai', '+37065715185', 114),
(52, 6, 3, 1, 4, 'Austra', 'Ronkaitienė', 'Linų g 103', 'Ringaudai', '+37069562411', 114),
(53, 3, 3, 1, 2, 'Diana', 'Karvelytė', 'Palangos 12-6', '', '+37096385214', 33),
(54, 7, 4, 1, 1, 'Erika', 'Tomskytė', 'Kupiškio g. 45-5', '', '+37068530677', 55),
(55, 4, 7, 2, 1, 'Faustas', 'Žilinskas', 'Algirdo g. 32', '', '+37067421266', 63),
(56, 2, 2, 2, 2, 'Eugenijus', 'Gilmantas', 'Gelių g. 23', '', '+37095245777', 41);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
