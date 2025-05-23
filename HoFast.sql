-- copyrights
-- @AmrKhaled2024

-- You should importing these tables into phpMyadmin to run website correctly

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2025 at 01:28 PM
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
-- Database: `HoFast`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `city`, `rating`, `description`, `image`, `phone`, `email`) VALUES
(2, 'Napoli Palace', '90 Ocean Avenue', 'Alexandria', 4.5, 'Modern rooms with sea view, perfect for a relaxing stay.', '', '+20 120 456 7890', 'contact@sunrise.com'),
(3, 'Tokyo Inn', '5 Sakura Lane', 'Tokyo', 3.0, 'Cozy hotel with Japanese traditional aesthetics.', 'tokyo_inn.jpg', '+81 90 1234 5678', 'hello@tokyoinn.jp'),
(4, 'Hotel Dreams', '102 Rue de Seine', 'Paris', 4.0, 'Romantic hotel near Eiffel Tower with elegant design.', 'parisian_dreams.jpg', '+33 1 23 45 10 20', 'Hotel@parisdreams.fr'),
(5, 'Manhattan Suites', '501 5th Ave', 'Cairo', 5.0, 'Elegant suites in downtown NYC with skyline views.', 'manhattan_suites.jpg', '+1 212 555 6789', 'ny@manhattansuites.com'),
(6, 'Al Qasr Resort', '1 Desert Road', 'Riyadh', 2.0, 'Desert resort with pool and family activities.', 'alqasr_resort.jpg', '+966 50 345 6789', 'info@alqasr.sa'),
(7, 'Berlin Central Hotel', '32 Hauptstraße', 'Berlin', 3.0, 'Central location with modern business facilities.', 'berlin_central.jpg', '+49 30 1234567', 'contact@berlincentral.de'),
(8, 'Santorini Blue', 'Sunset Blvd 3', 'Santorini', 5.0, 'Stunning sea views with infinity pools.', 'santorini_blue.jpg', '+30 2286 123456', 'book@santoriniblue.gr'),
(9, 'Moscow Plaza', '77 Tverskaya St', 'Moscow', 4.0, 'Historic luxury with modern amenities.', 'moscow_plaza.jpg', '+7 495 123 4567', 'info@moscowplaza.ru'),
(10, 'Dubai Marina Hotel', '11 Marina Walk', 'Dubai', 5.0, 'Ultra-modern hotel with waterfront views.', 'dubai_marina.jpg', '+971 55 123 4567', 'hello@dubaimarina.ae'),
(11, 'Capetown Cove', 'Beach Rd 45', 'Cape Town', 3.0, 'Charming coastal hotel with mountain views.', 'capetown_cove.jpg', '+27 21 456 7890', 'info@capetowncove.co.za'),
(12, 'Bangkok Breeze', '22 Sukhumvit Soi 5', 'Bangkok', 2.0, 'Colorful city hotel with local cuisine.', 'bangkok_breeze.jpg', '+66 2 123 4567', 'contact@breezebkk.co.th'),
(13, 'Rome Heritage', 'Via Roma 21', 'Rome', 4.0, 'Classical hotel close to Colosseum.', 'rome_heritage.jpg', '+39 06 123 4567', 'info@romeheritage.it'),
(14, 'Barcelona Lights', 'Carrer de Mallorca, 401', 'Barcelona', 5.0, 'Modernist hotel steps from Sagrada Familia.', 'barcelona_lights.jpg', '+34 93 123 4567', 'book@barcelonalights.es'),
(15, 'Seoul Serenity', 'Gangnam-daero 10', 'Seoul', 4.0, 'Peaceful escape in the heart of Gangnam.', 'seoul_serenity.jpg', '+82 10 1234 5678', 'info@seoulserenity.kr'),
(16, 'Sydney Harbour View', 'Harbour St 19', 'Sydney', 5.0, 'Overlooks the Opera House with rooftop dining.', 'sydney_harbour.jpg', '+61 2 1234 5678', 'book@sydneyharbour.au');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `is_reserved` tinyint(1) DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `price_per_night` decimal(8,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_type_id`, `is_reserved`, `room_number`, `beds`, `price_per_night`, `description`) VALUES
(1, 1, 1, 1, '100', 1, 330.02, 'Race capital him attention reveal sometimes pick.'),
(2, 1, 3, 0, '101', 3, 1161.22, 'Artist research card none phone agent war.'),
(3, 1, 3, 1, '102', 3, 855.00, 'They door figure throughout debate yeah standard several then.'),
(4, 1, 1, 0, '103', 1, 434.65, 'Operation parent money none since continue up thing understand available field court.'),
(5, 1, 3, 1, '104', 3, 313.21, 'Against listen special certainly under process federal mouth lot three.'),
(6, 1, 2, 0, '105', 2, 487.80, 'Common main significant kind doctor section foot because war time environmental particular accept.'),
(7, 1, 2, 0, '106', 2, 731.83, 'Available arrive perhaps edge need mother minute country especially anyone.'),
(8, 1, 3, 0, '107', 3, 683.05, 'Wife example west hour rather about Mrs why say.'),
(9, 1, 1, 1, '108', 1, 934.22, 'Other too make drive beat anyone by hotel other.'),
(10, 1, 2, 0, '109', 2, 581.08, 'Pm defense class party response room employee professor administration field religious hospital.'),
(11, 1, 3, 0, '110', 3, 904.30, 'Seven cell join at each past lawyer.'),
(12, 1, 2, 1, '111', 2, 896.16, 'As full allow perhaps get available.'),
(13, 1, 2, 0, '112', 2, 456.51, 'Always around factor town them change week.'),
(14, 1, 3, 1, '113', 3, 901.48, 'Movie other beat artist town want claim eye study thousand black.'),
(15, 1, 2, 0, '114', 2, 1103.06, 'Wife mean home surface from expert anything medical participant cut charge bag citizen.'),
(16, 1, 1, 0, '115', 1, 709.28, 'Play money prove suffer good success his per about understand describe seem hot.'),
(17, 1, 2, 1, '116', 2, 577.77, 'Each commercial go weight red represent.'),
(18, 1, 1, 1, '117', 1, 759.24, 'Answer conference case actually care what measure test try story.'),
(19, 1, 3, 1, '118', 3, 325.34, 'Economy shoulder spend by commercial poor beyond quality all benefit poor before.'),
(20, 1, 1, 1, '119', 1, 867.86, 'Happen concern identify skill available bad size much former no.'),
(21, 1, 3, 1, '120', 3, 535.38, 'Week he left our blood cover during break cell civil.'),
(22, 1, 1, 0, '121', 1, 983.74, 'Through accept whole develop staff fund treat break according.'),
(23, 1, 3, 0, '122', 3, 1145.09, 'Raise responsibility hour word cut time adult move prepare least next walk popular.'),
(24, 1, 1, 0, '123', 1, 1124.04, 'Sea until thing hour director onto language.'),
(25, 1, 2, 1, '124', 2, 1120.52, 'Other rich road these trouble effect six ball.'),
(26, 1, 2, 0, '125', 2, 560.67, 'Our bar Congress fly police apply community could.'),
(27, 1, 1, 0, '126', 1, 552.01, 'Test ready test art admit three read guess hit as.'),
(28, 1, 3, 1, '127', 3, 927.14, 'Bag though protect role manager happen report.'),
(29, 1, 3, 1, '128', 3, 904.10, 'Professional institution anything land while everybody together environment suddenly next.'),
(30, 1, 2, 1, '129', 2, 680.10, 'Physical daughter effort another control nature in wear such car beat.'),
(31, 2, 1, 1, '200', 1, 385.93, 'Professional learn out old term early hear commercial cup east.'),
(32, 2, 1, 1, '201', 1, 1029.57, 'Stock any no can officer your degree guess worry case dark watch she.'),
(33, 2, 2, 0, '202', 2, 1077.88, 'Customer trip nearly of will show happy.'),
(34, 2, 1, 0, '203', 1, 932.98, 'Almost large serve growth office that course effort Republican.'),
(35, 2, 3, 1, '204', 3, 488.35, 'High focus memory challenge learn among cultural community dinner in exactly.'),
(36, 2, 1, 0, '205', 1, 1016.62, 'Rule specific nor boy international finally property pressure not in.'),
(37, 2, 3, 0, '206', 3, 1191.88, 'Room indicate indeed her media his politics participant maintain reduce establish main great.'),
(38, 2, 1, 0, '207', 1, 897.95, 'Figure morning not data seat evening stock girl rest industry major.'),
(39, 2, 2, 0, '208', 2, 861.06, 'Way tend middle history radio wonder.'),
(40, 2, 3, 1, '209', 3, 512.54, 'Not case real five blue around.'),
(41, 2, 1, 0, '210', 1, 1125.04, 'Step huge American push method life activity amount.'),
(42, 2, 1, 0, '211', 1, 784.21, 'Behind create table surface win way performance quality paper should play pick yeah president.'),
(43, 2, 1, 1, '212', 1, 982.06, 'Reason fact amount structure hold level seat fine bad score public but.'),
(44, 2, 3, 1, '213', 3, 734.33, 'West both sometimes cause audience response instead toward.'),
(45, 2, 2, 0, '214', 2, 841.93, 'Walk form agreement southern case nor traditional management relate though never total.'),
(46, 2, 3, 1, '215', 3, 1169.15, 'Bill than action provide draw bag behind course order up.'),
(47, 2, 2, 1, '216', 2, 1074.26, 'Dinner lead perhaps and race its assume receive none require ball strong water.'),
(48, 2, 3, 1, '217', 3, 1156.56, 'Father image deep edge Mrs art development.'),
(49, 2, 1, 0, '218', 1, 443.88, 'Yard provide article opportunity tree say young company.'),
(50, 2, 3, 1, '219', 3, 407.87, 'Full western up television medical amount represent.'),
(51, 2, 1, 0, '220', 1, 1127.99, 'Since city medical organization it hundred see.'),
(52, 2, 2, 1, '221', 2, 731.67, 'Data middle prevent high hair create support food themselves stage newspaper.'),
(53, 2, 3, 0, '222', 3, 926.66, 'Popular maintain answer young to government general hear remain six.'),
(54, 2, 1, 0, '223', 1, 838.31, 'That for run rule ask article would evidence build street whether season.'),
(55, 2, 1, 0, '224', 1, 1184.63, 'Give between shoulder TV size agreement moment medical under five get small customer.'),
(56, 2, 2, 1, '225', 2, 1076.23, 'Mother hope discuss raise management would reach race.'),
(57, 2, 2, 1, '226', 2, 1028.67, 'Deal phone girl toward time money scientist responsibility her short offer hold.'),
(58, 2, 3, 0, '227', 3, 516.13, 'Brother how economy most play manage off country popular happen.'),
(59, 2, 1, 0, '228', 1, 979.49, 'Value three catch example lay job plant.'),
(60, 2, 1, 1, '229', 1, 909.10, 'Language painting enter crime effect he.'),
(61, 2, 1, 1, '200', 1, 385.93, 'Professional learn out old term early hear commercial cup east.'),
(62, 2, 1, 1, '201', 1, 1029.57, 'Stock any no can officer your degree guess worry case dark watch she.'),
(63, 2, 2, 0, '202', 2, 1077.88, 'Customer trip nearly of will show happy.'),
(64, 2, 1, 0, '203', 1, 932.98, 'Almost large serve growth office that course effort Republican.'),
(65, 2, 3, 1, '204', 3, 488.35, 'High focus memory challenge learn among cultural community dinner in exactly.'),
(66, 2, 1, 0, '205', 1, 1016.62, 'Rule specific nor boy international finally property pressure not in.'),
(67, 2, 3, 0, '206', 3, 1191.88, 'Room indicate indeed her media his politics participant maintain reduce establish main great.'),
(68, 2, 1, 0, '207', 1, 897.95, 'Figure morning not data seat evening stock girl rest industry major.'),
(69, 2, 2, 0, '208', 2, 861.06, 'Way tend middle history radio wonder.'),
(70, 2, 3, 1, '209', 3, 512.54, 'Not case real five blue around.'),
(71, 2, 1, 0, '210', 1, 1125.04, 'Step huge American push method life activity amount.'),
(72, 2, 1, 0, '211', 1, 784.21, 'Behind create table surface win way performance quality paper should play pick yeah president.'),
(73, 2, 1, 1, '212', 1, 982.06, 'Reason fact amount structure hold level seat fine bad score public but.'),
(74, 2, 3, 1, '213', 3, 734.33, 'West both sometimes cause audience response instead toward.'),
(75, 2, 2, 0, '214', 2, 841.93, 'Walk form agreement southern case nor traditional management relate though never total.'),
(76, 2, 3, 1, '215', 3, 1169.15, 'Bill than action provide draw bag behind course order up.'),
(77, 2, 2, 1, '216', 2, 1074.26, 'Dinner lead perhaps and race its assume receive none require ball strong water.'),
(78, 2, 3, 1, '217', 3, 1156.56, 'Father image deep edge Mrs art development.'),
(79, 2, 1, 0, '218', 1, 443.88, 'Yard provide article opportunity tree say young company.'),
(80, 2, 3, 1, '219', 3, 407.87, 'Full western up television medical amount represent.'),
(81, 2, 1, 0, '220', 1, 1127.99, 'Since city medical organization it hundred see.'),
(82, 2, 2, 1, '221', 2, 731.67, 'Data middle prevent high hair create support food themselves stage newspaper.'),
(83, 2, 3, 0, '222', 3, 926.66, 'Popular maintain answer young to government general hear remain six.'),
(84, 2, 1, 0, '223', 1, 838.31, 'That for run rule ask article would evidence build street whether season.'),
(85, 2, 1, 0, '224', 1, 1184.63, 'Give between shoulder TV size agreement moment medical under five get small customer.'),
(86, 2, 2, 1, '225', 2, 1076.23, 'Mother hope discuss raise management would reach race.'),
(87, 2, 2, 1, '226', 2, 1028.67, 'Deal phone girl toward time money scientist responsibility her short offer hold.'),
(88, 2, 3, 0, '227', 3, 516.13, 'Brother how economy most play manage off country popular happen.'),
(89, 2, 1, 0, '228', 1, 979.49, 'Value three catch example lay job plant.'),
(90, 2, 1, 1, '229', 1, 909.10, 'Language painting enter crime effect he.'),
(91, 2, 1, 1, '200', 1, 385.93, 'Professional learn out old term early hear commercial cup east.'),
(92, 2, 1, 1, '201', 1, 1029.57, 'Stock any no can officer your degree guess worry case dark watch she.'),
(93, 2, 2, 0, '202', 2, 1077.88, 'Customer trip nearly of will show happy.'),
(94, 2, 1, 0, '203', 1, 932.98, 'Almost large serve growth office that course effort Republican.'),
(95, 2, 3, 1, '204', 3, 488.35, 'High focus memory challenge learn among cultural community dinner in exactly.'),
(96, 2, 1, 0, '205', 1, 1016.62, 'Rule specific nor boy international finally property pressure not in.'),
(97, 2, 3, 0, '206', 3, 1191.88, 'Room indicate indeed her media his politics participant maintain reduce establish main great.'),
(98, 2, 1, 0, '207', 1, 897.95, 'Figure morning not data seat evening stock girl rest industry major.'),
(99, 2, 2, 0, '208', 2, 861.06, 'Way tend middle history radio wonder.'),
(100, 2, 3, 1, '209', 3, 512.54, 'Not case real five blue around.'),
(101, 2, 1, 0, '210', 1, 1125.04, 'Step huge American push method life activity amount.'),
(102, 2, 1, 0, '211', 1, 784.21, 'Behind create table surface win way performance quality paper should play pick yeah president.'),
(103, 2, 1, 1, '212', 1, 982.06, 'Reason fact amount structure hold level seat fine bad score public but.'),
(104, 2, 3, 1, '213', 3, 734.33, 'West both sometimes cause audience response instead toward.'),
(105, 2, 2, 0, '214', 2, 841.93, 'Walk form agreement southern case nor traditional management relate though never total.'),
(106, 2, 3, 1, '215', 3, 1169.15, 'Bill than action provide draw bag behind course order up.'),
(107, 2, 2, 1, '216', 2, 1074.26, 'Dinner lead perhaps and race its assume receive none require ball strong water.'),
(108, 2, 3, 1, '217', 3, 1156.56, 'Father image deep edge Mrs art development.'),
(109, 2, 1, 0, '218', 1, 443.88, 'Yard provide article opportunity tree say young company.'),
(110, 2, 3, 1, '219', 3, 407.87, 'Full western up television medical amount represent.'),
(111, 2, 1, 0, '220', 1, 1127.99, 'Since city medical organization it hundred see.'),
(112, 2, 2, 1, '221', 2, 731.67, 'Data middle prevent high hair create support food themselves stage newspaper.'),
(113, 2, 3, 0, '222', 3, 926.66, 'Popular maintain answer young to government general hear remain six.'),
(114, 2, 1, 0, '223', 1, 838.31, 'That for run rule ask article would evidence build street whether season.'),
(115, 2, 1, 0, '224', 1, 1184.63, 'Give between shoulder TV size agreement moment medical under five get small customer.'),
(116, 2, 2, 1, '225', 2, 1076.23, 'Mother hope discuss raise management would reach race.'),
(117, 2, 2, 1, '226', 2, 1028.67, 'Deal phone girl toward time money scientist responsibility her short offer hold.'),
(118, 2, 3, 0, '227', 3, 516.13, 'Brother how economy most play manage off country popular happen.'),
(119, 2, 1, 0, '228', 1, 979.49, 'Value three catch example lay job plant.'),
(120, 2, 1, 1, '229', 1, 909.10, 'Language painting enter crime effect he.'),
(121, 1, 1, 0, '101', 1, 299.99, 'Standard King Room with city view'),
(122, 1, 2, 0, '102', 2, 349.99, 'Deluxe Double Room with balcony'),
(123, 1, 3, 1, '103', 2, 399.99, 'Executive Suite with jacuzzi'),
(124, 1, 4, 0, '104', 3, 449.99, 'Family Room with extra space'),
(125, 1, 5, 0, '105', 1, 279.99, 'Standard Queen Room'),
(126, 2, 1, 0, '201', 1, 199.99, 'Standard Business Single'),
(127, 2, 2, 1, '202', 2, 249.99, 'Deluxe Twin Room'),
(128, 2, 3, 0, '203', 2, 299.99, 'Executive Room with work desk'),
(129, 2, 1, 0, '204', 1, 189.99, 'Compact Single Room'),
(130, 2, 2, 0, '205', 2, 229.99, 'Standard Double Room'),
(131, 3, 3, 0, '301', 2, 349.99, 'Ocean View Room with balcony'),
(132, 3, 4, 1, '302', 4, 499.99, 'Family Suite with kitchenette'),
(133, 3, 5, 0, '303', 1, 279.99, 'Garden View Single'),
(134, 3, 3, 0, '304', 2, 379.99, 'Premium Ocean Front'),
(135, 3, 2, 0, '305', 2, 319.99, 'Partial Ocean View'),
(136, 4, 1, 0, '101', 1, 89.99, 'Basic Single Room'),
(137, 4, 2, 0, '102', 2, 119.99, 'Standard Double Room'),
(138, 4, 1, 1, '103', 1, 79.99, 'Economy Single'),
(139, 4, 2, 0, '104', 2, 109.99, 'Twin Beds Room'),
(140, 4, 1, 0, '105', 1, 85.99, 'Compact Single'),
(141, 5, 3, 0, '201', 2, 229.99, 'Designer Double Room'),
(142, 5, 4, 0, '202', 3, 299.99, 'Junior Suite'),
(143, 5, 5, 1, '203', 1, 179.99, 'Cozy Single Room'),
(144, 5, 3, 0, '204', 2, 239.99, 'Deluxe King Room'),
(145, 5, 2, 0, '205', 2, 209.99, 'Classic Double'),
(146, 6, 1, 0, '101', 1, 129.99, 'Standard Single Room'),
(147, 6, 2, 0, '102', 2, 159.99, 'Double Room with soundproofing'),
(148, 6, 1, 1, '103', 1, 119.99, 'Economy Single'),
(149, 6, 3, 0, '104', 2, 179.99, 'Executive Room'),
(150, 6, 2, 0, '105', 2, 149.99, 'Standard Twin'),
(151, 7, 4, 0, '301', 3, 259.99, 'Family Room with fireplace'),
(152, 7, 3, 0, '302', 2, 219.99, 'Mountain View Double'),
(153, 7, 5, 1, '303', 1, 169.99, 'Cozy Single with view'),
(154, 7, 4, 0, '304', 4, 289.99, 'Large Family Suite'),
(155, 7, 3, 0, '305', 2, 229.99, 'Premium Double Room'),
(156, 8, 2, 0, '101', 2, 199.99, 'Standard Double Room'),
(157, 8, 3, 0, '102', 2, 249.99, 'Deluxe Room with city view'),
(158, 8, 1, 0, '103', 1, 149.99, 'Single Room'),
(159, 8, 5, 1, '104', 1, 179.99, 'Superior Single'),
(160, 8, 2, 0, '105', 2, 209.99, 'Comfort Double'),
(161, 9, 3, 0, '201', 2, 349.99, 'Deluxe Room with spa access'),
(162, 9, 4, 0, '202', 3, 429.99, 'Family Room with spa package'),
(163, 9, 5, 0, '203', 1, 279.99, 'Single Room with spa credit'),
(164, 9, 3, 1, '204', 2, 369.99, 'Premium Spa Suite'),
(165, 9, 2, 0, '205', 2, 319.99, 'Double Room with massage'),
(166, 10, 3, 0, '301', 2, 279.99, 'Classic Double Room'),
(167, 10, 4, 0, '302', 3, 349.99, 'Historic Family Suite'),
(168, 10, 5, 0, '303', 1, 199.99, 'Antique Single Room'),
(169, 10, 3, 1, '304', 2, 299.99, 'Premium Heritage Room'),
(170, 10, 2, 0, '305', 2, 249.99, 'Traditional Double'),
(171, 1, 3, 0, '106', 2, 429.99, 'Corner Suite with panoramic views'),
(172, 2, 4, 0, '206', 3, 279.99, 'Executive Family Room'),
(173, 3, 5, 0, '306', 1, 259.99, 'Beachfront Single'),
(174, 4, 2, 0, '106', 2, 99.99, 'Budget Twin Room'),
(175, 5, 3, 0, '206', 2, 259.99, 'Designer Suite'),
(176, 6, 1, 0, '106', 1, 109.99, 'Transit Single'),
(177, 7, 4, 0, '306', 4, 269.99, 'Mountain Family Suite'),
(178, 8, 2, 0, '106', 2, 189.99, 'City View Double'),
(179, 9, 3, 0, '206', 2, 359.99, 'Spa View Room'),
(180, 10, 4, 0, '306', 3, 329.99, 'Historic Triple Room'),
(181, 1, 2, 1, '107', 2, 369.99, 'Deluxe King with lounge access'),
(182, 2, 3, 0, '207', 2, 269.99, 'Corner Executive Room'),
(183, 3, 4, 0, '307', 3, 459.99, 'Beach Family Suite'),
(184, 4, 1, 0, '107', 1, 79.99, 'Small Single Room'),
(185, 5, 2, 0, '207', 2, 229.99, 'Boutique Double'),
(186, 6, 3, 1, '107', 2, 189.99, 'Runway View Room'),
(187, 7, 5, 0, '307', 1, 159.99, 'Mountain View Single'),
(188, 8, 1, 0, '107', 1, 139.99, 'Compact City Room'),
(189, 9, 2, 0, '207', 2, 339.99, 'Deluxe Spa Double'),
(190, 10, 3, 0, '307', 2, 289.99, 'Heritage Double Room'),
(191, 1, 4, 0, '108', 3, 479.99, 'Presidential Suite'),
(192, 2, 5, 0, '208', 1, 179.99, 'Executive Single'),
(193, 3, 1, 0, '308', 1, 299.99, 'Ocean View Single'),
(194, 4, 2, 1, '108', 2, 109.99, 'Standard Twin Room'),
(195, 5, 3, 0, '208', 2, 279.99, 'Luxury Double'),
(196, 6, 4, 0, '108', 3, 199.99, 'Family Room'),
(197, 7, 5, 0, '308', 1, 169.99, 'Lodge Single'),
(198, 8, 1, 0, '108', 1, 129.99, 'Basic Single'),
(199, 9, 2, 1, '208', 2, 329.99, 'Spa Double'),
(200, 10, 3, 0, '308', 2, 269.99, 'Classic Double');

-- --------------------------------------------------------

--
-- Stand-in structure for view `show all`
-- (See below for the actual view)
--
CREATE TABLE `show all` (
`id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(100)
,`password` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `user_img` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `role`, `user_img`) VALUES
(15, 'fahd', 'Elantably', 'fahdelantably00@gmail.com', '$2y$10$5QFh5rhMWZ09nDxxoHKHDed7KsX9z41d2vnQL0Vh/8S8iExWDuR4m', '2025-05-18 05:43:19', 'user', 'default.jpg'),
(16, 'Amr', 'khaled', 'amr.khaled.admin@example.com', 'admin111', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(17, 'Eyad', 'Magdy', 'eyad.magdy.admin@example.com', 'admin123', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(18, 'Ziad', 'Saeed', 'ziad.saeed.admin@example.com', 'admin124', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(19, 'Badr', 'Mohamed', 'badr.mohamed.admin@example.com', 'admin125', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(20, 'Hanan', 'Tarek', 'hanan.tarek.admin@example.com', 'admin126', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(21, 'Ibrahim', 'Eldesouky', 'ibrahim.eldesouky.admin@example.com', 'admin111', '2025-05-18 06:47:18', 'admin', 'default.jpg'),
(50, 'Eyad', 'Magdy', 'Eyad100@gmail.com', '$2y$10$j5niqbxUIhLgGwgsR7Byo.gzneZ53a4J6Xt5gUvKlOCAnZrvaZf1i', '2025-05-20 05:34:51', 'user', 'default.jpg'),
(51, 'zeyadMenofia', 'saeed', 'zsaeed@gmail.com', '$2y$10$KU4Q8MgRJtSkaUtggfm3.OUELPoqOUv28K6DBOMJMFokxHtc3oRsu', '2025-05-20 05:36:58', 'user', 'default.jpg'),
(54, 'Amr', 'Ahmed', 'amrkhaledahasasasasasasmed100@gmail.com', '$2y$10$3o3Znb3O7LUYfESU53pthuSqPbwuiAyguev9.BWDxlxtgM43FqXC.', '2025-05-20 06:28:07', 'user', 'default.jpg'),
(55, 'Mamon', 'Ahmed', 'Manmonahmed100@gmail.com', '$2y$10$Myow1suWiOaJE4j0FqjcKO/YhtedH7Ci9NDXytBgIHiYC0kVbbrpi', '2025-05-20 06:31:42', 'user', 'default.jpg'),
(57, 'Amr', 'Ahmed', 'amrkhaledahmed100@gmail.com', '$2y$10$Q./v9UBh5JsUWNOgsr3rze3UfBHu6B7iSiosrLwycj8m8ycbps2QG', '2025-05-21 20:21:47', 'user', 'default.jpg');

-- --------------------------------------------------------

--
-- Structure for view `show all`
--
DROP TABLE IF EXISTS `show all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hofast`.`show all`  AS SELECT `hofast`.`users`.`id` AS `id`, `hofast`.`users`.`first_name` AS `first_name`, `hofast`.`users`.`last_name` AS `last_name`, `hofast`.`users`.`email` AS `email`, `hofast`.`users`.`password` AS `password`, `hofast`.`users`.`created_at` AS `created_at` FROM `hofast`.`users` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
