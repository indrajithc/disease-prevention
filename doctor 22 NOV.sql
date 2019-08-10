-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2018 at 10:32 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc_admin`
--

CREATE TABLE `doc_admin` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adm_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adm_mobile` bigint(20) DEFAULT NULL,
  `adm_landline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adm_address` text COLLATE utf8mb4_unicode_ci,
  `adm_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adm_login` int(11) NOT NULL DEFAULT '1',
  `adm_delete` int(11) NOT NULL DEFAULT '0',
  `adm_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_admin`
--

INSERT INTO `doc_admin` (`adm_id`, `adm_name`, `adm_email`, `adm_mobile`, `adm_landline`, `adm_address`, `adm_image`, `adm_password`, `adm_login`, `adm_delete`, `adm_date`) VALUES
(1, 'admin', 'admin@admin.com', 2243422111, '11223322111', 'aomw addredd now', 'files_p9DFyy/admin/images/8df1260500cd24608be3bcd9a431c6c3.png', 'f2633596c389281c67ecc2e90473973ad7934748e582dc47a11c18dcbd3f2c30', 1, 0, '2018-09-01 13:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `doc_attachment`
--

CREATE TABLE `doc_attachment` (
  `att_id` int(11) NOT NULL,
  `att_on_date` date NOT NULL,
  `att_added_by` int(11) NOT NULL,
  `att_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `att_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `att_desc` text COLLATE utf8mb4_unicode_ci,
  `att_read` int(11) NOT NULL DEFAULT '0',
  `att_delete` int(11) NOT NULL DEFAULT '0',
  `att_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_attachment`
--

INSERT INTO `doc_attachment` (`att_id`, `att_on_date`, `att_added_by`, `att_name`, `att_path`, `att_desc`, `att_read`, `att_delete`, `att_date`) VALUES
(1, '0000-00-00', 6, '553d4e62c2d6ec07433e6701e4b3f629.pdf', 'files_p9DFyy/doctor/attachments', '', 0, 0, '2018-09-03 23:43:43'),
(2, '2018-09-04', 6, '58b3688243111f4893d4d43effa580e6.pdf', 'files_p9DFyy/doctor/attachments', '', 0, 0, '2018-09-03 23:45:16'),
(3, '2018-09-04', 6, '58b3688243111f4893d4d43effa580e6.pdf', 'files_p9DFyy/doctor/attachments', 'varuan', 0, 0, '2018-09-03 23:56:49'),
(4, '2018-09-08', 6, '58b3688243111f4893d4d43effa580e6.pdf', 'files_p9DFyy/doctor/attachments', '', 0, 0, '2018-09-08 10:29:09'),
(5, '2018-09-10', 8, 'e8be29769b8b812b616ff416a2b70c10.jpg', 'files_p9DFyy/doctor/attachments', '', 0, 0, '2018-09-10 06:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `doc_hospital`
--

CREATE TABLE `doc_hospital` (
  `use_id` int(11) NOT NULL,
  `hos_nname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_nmobile` bigint(20) NOT NULL,
  `hos_bed` int(11) NOT NULL,
  `hos_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_pin` int(11) DEFAULT NULL,
  `hos_longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hos_delete` int(11) NOT NULL DEFAULT '0',
  `hos_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_hospital`
--

INSERT INTO `doc_hospital` (`use_id`, `hos_nname`, `hos_nmobile`, `hos_bed`, `hos_type`, `hos_area`, `hos_city`, `hos_district`, `hos_pin`, `hos_longitude`, `hos_latitude`, `hos_delete`, `hos_date`) VALUES
(8, 'nper', 0, 45, 'government', 'are', 'city', 'Alappuzha', 889988, '', '', 0, '2018-09-08 13:19:21'),
(10, 'nper', 3344334444, 0, NULL, NULL, NULL, 'Alappuzha', NULL, NULL, NULL, 0, '2018-09-10 01:35:17'),
(12, 'nper', 2233223534, 12, NULL, NULL, NULL, 'Alappuzha', NULL, NULL, NULL, 0, '2018-09-10 01:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `doc_notification`
--

CREATE TABLE `doc_notification` (
  `notification_id` int(11) NOT NULL,
  `notification_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_body` text COLLATE utf8mb4_unicode_ci,
  `notification_to` text COLLATE utf8mb4_unicode_ci,
  `notification_expiry` datetime NOT NULL,
  `notification_delete` int(11) DEFAULT '0',
  `notification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_notification`
--

INSERT INTO `doc_notification` (`notification_id`, `notification_type`, `notification_subject`, `notification_body`, `notification_to`, `notification_expiry`, `notification_delete`, `notification_date`) VALUES
(1, 'alert', 'dfgdfg', NULL, '[\"Malappuram\"]', '2018-11-29 00:00:00', 1, '2018-11-22 08:41:58'),
(2, 'alert', 'dfgdfg dfgdfg sdfus 3 3wi d;fisier ks;eoirsdf', 'fgdfg', '[\"Malappuram\"]', '2018-11-29 00:00:00', 1, '2018-11-22 08:42:50'),
(3, 'alert', 'dfgdfg', 'fgdfg', '[\"Malappuram\"]', '2018-11-29 00:00:00', 0, '2018-11-21 18:30:00'),
(4, 'alert', 'gggg', 'dddd', '[\"Thrissur\"]', '2018-11-29 00:00:00', 0, '2018-11-21 18:30:00'),
(5, 'alert', 'dfgdfg dfgdfg sdfus 3 3wi d;fisier ks;eoirsdf', 'DSFSDF', '[\"Kozhikode\",\"Thrissur\",\"Alappuzha\"]', '2018-11-29 00:00:00', 0, '2018-11-22 08:42:03'),
(6, 'alert', 'dfsfsfsd', 'soeritntdsf', '[\"Palakkad\",\"Alappuzha\"]', '2018-11-29 00:00:00', 0, '2018-11-21 18:30:00'),
(7, 'high alert', 'dddd', 'dddsdfs', '[\"Malappuram\",\"Kannur\",\"Ernakulam\"]', '2018-11-29 14:50:33', 0, '2018-11-21 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `doc_patient`
--

CREATE TABLE `doc_patient` (
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_dob` date DEFAULT NULL,
  `pat_gender` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_house` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_ward` int(11) DEFAULT NULL,
  `pat_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_contact` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_pin` int(11) DEFAULT NULL,
  `pat_longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pat_added_by` int(11) NOT NULL,
  `pat_delete` int(11) NOT NULL DEFAULT '0',
  `pat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_patient`
--

INSERT INTO `doc_patient` (`pat_id`, `pat_name`, `pat_dob`, `pat_gender`, `pat_house`, `pat_area`, `pat_landmark`, `pat_ward`, `pat_district`, `pat_contact`, `pat_pin`, `pat_longitude`, `pat_latitude`, `pat_added_by`, `pat_delete`, `pat_date`) VALUES
(1, 'ddd', '2018-03-10', 'male', '', '', '', 0, '', '', 0, '', '', 6, 0, '2018-09-03 16:59:17'),
(2, 'avklarindf', '0000-00-00', '', '', '', '', 0, '', '', 0, '', '', 6, 0, '2018-09-03 16:18:37'),
(3, 'nnn', '2018-02-01', 'transgender', '', '', '', 0, '', '', 0, '', '', 6, 0, '2018-09-03 17:30:22'),
(4, 'jjjjjjjj', '2018-03-09', 'female', '', '', '', 0, '', '', 99999, '', '', 6, 0, '2018-09-03 17:30:22'),
(5, 'newone', '2016-07-06', 'transgender', '', '', '', 0, '', '', 0, '', '', 6, 0, '2018-09-03 17:32:22'),
(6, 'avklarindf', '2018-03-01', 'transgender', '', '', '', 0, '', '', 0, '', '', 6, 0, '2018-09-03 17:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `doc_surveillance`
--

CREATE TABLE `doc_surveillance` (
  `sur_id` int(11) NOT NULL,
  `sur_report_on` date NOT NULL,
  `sur_form` longtext COLLATE utf8mb4_unicode_ci,
  `sur_status` int(11) NOT NULL DEFAULT '0',
  `sur_added_by` int(11) NOT NULL,
  `sur_read` int(11) NOT NULL DEFAULT '0',
  `sur_delete` int(11) NOT NULL DEFAULT '0',
  `sur_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_surveillance`
--

INSERT INTO `doc_surveillance` (`sur_id`, `sur_report_on`, `sur_form`, `sur_status`, `sur_added_by`, `sur_read`, `sur_delete`, `sur_date`) VALUES
(5, '2018-09-07', NULL, 0, 6, 0, 0, '2018-09-06 23:45:23'),
(10, '2018-09-08', '[{\"id\":0,\"date\":\"2018-09-08T09:42:21.695Z\",\"name\":\"sd\",\"age\":\"34\",\"gender\":\"male\",\"diagnosis\":\"hepatitis a\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"},{\"id\":0,\"date\":\"2018-09-08T09:42:41.514Z\",\"name\":\"sd\",\"age\":\"2\",\"gender\":\"transgender\",\"diagnosis\":\"pertussis / whooping cough\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 6, 0, 0, '2018-09-08 08:00:28'),
(11, '2018-09-08', '[{\"id\":0,\"date\":\"2018-09-08T09:21:47.343Z\",\"name\":\"sd\",\"age\":\"34\",\"gender\":\"male\",\"diagnosis\":\"gastroenteritis\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"},{\"id\":0,\"date\":\"2018-09-08T09:21:54.491Z\",\"name\":\"sd\",\"age\":\"34\",\"gender\":\"male\",\"diagnosis\":\"cholera\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":true,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 6, 0, 0, '2018-09-08 08:08:28'),
(12, '2018-09-08', '[{\"id\":0,\"date\":\"2018-09-08T09:42:21.695Z\",\"name\":\"sd\",\"age\":\"34\",\"gender\":\"male\",\"diagnosis\":\"hepatitis a\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":true,\"longitude\":\"\",\"latitude\":\"\"},{\"id\":0,\"date\":\"2018-09-08T09:42:41.514Z\",\"name\":\"sd\",\"age\":\"2\",\"gender\":\"transgender\",\"diagnosis\":\"pertussis / whooping cough\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 6, 0, 0, '2018-09-08 09:37:08'),
(13, '2018-09-08', NULL, 0, 8, 0, 0, '2018-09-08 13:25:34'),
(14, '2018-09-08', '[{\"id\":0,\"date\":\"2018-09-08T14:32:07.614Z\",\"name\":\"sd\",\"age\":\"33\",\"gender\":\"transgender\",\"diagnosis\":\"measles\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 6, 0, 0, '2018-09-08 14:30:25'),
(15, '2018-09-08', NULL, 0, 6, 0, 0, '2018-09-08 14:32:27'),
(16, '2018-09-09', NULL, 0, 6, 0, 0, '2018-09-09 14:27:13'),
(17, '2018-09-10', '[{\"id\":0,\"date\":\"2018-09-09T23:51:55.687Z\",\"name\":\"sd\",\"age\":\"12\",\"gender\":\"male\",\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\",\"district\":\"Kozhikode\",\"blocks\":[\"Balussery\",\"Chelannur\",\"Koduvally\",\"Kozhikode\",\"Kunnamangalam\",\"Kunnummal\",\"Meladi\",\"Panthalayani\",\"Perambra\",\"Thodannur\",\"Tuneri\",\"Vatakara\"],\"block\":\"Meladi\"},{\"id\":0,\"date\":\"2018-09-10T02:14:02.046Z\",\"name\":\"ttt\",\"age\":\"45\",\"gender\":\"female\",\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\",\"district\":\"Palakkad\",\"blocks\":[\"Alathur\",\"Attappady (ITDP)\",\"Chittur\",\"Kollengode\",\"Kuzhalmannam\",\"Malampuzha\",\"Mannarkad\",\"Nenmara\",\"Ottappalam\",\"Palakkad\",\"Pattambi\",\"Sreekrishnapuram\",\"Thrithala\"],\"block\":\"Ottappalam\"},{\"id\":0,\"date\":\"2018-09-10T02:17:34.610Z\",\"name\":\"rr\",\"age\":\"67\",\"gender\":\"female\",\"district\":\"Thrissur\",\"blocks\":[\"Anthikkad\",\"Chalakudy\",\"Chavakkad\",\"Cherpu\",\"Chowannur\",\"Irinjalakuda\",\"Kodakara\",\"Mala\",\"Mathilakam\",\"Mullassery\",\"Ollukkara\",\"Pazhayannur\",\"Puzhakkal\",\"Thalikulam\",\"Vellangallur\",\"Wadakkanchery\"],\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 6, 0, 0, '2018-09-09 23:24:45'),
(18, '2018-09-10', NULL, 0, 6, 0, 0, '2018-09-10 03:21:08'),
(19, '2018-09-10', '[]', 1, 8, 0, 0, '2018-09-10 06:39:38'),
(20, '2018-09-10', '[{\"id\":0,\"date\":\"2018-09-10T06:39:48.876Z\",\"name\":\"rr\",\"age\":\"45\",\"gender\":\"female\",\"district\":\"\",\"blocks\":[],\"block\":\"\",\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"},{\"id\":0,\"date\":\"2018-09-10T06:39:57.762Z\",\"name\":\"rr\",\"age\":\"67\",\"gender\":\"female\",\"district\":\"Malappuram\",\"blocks\":[\"Areakode\",\"Kondotty\",\"Kuttippuram\",\"Malappuram\",\"Mankada\",\"Nilambur\",\"Perinthalmanna\",\"Perumpadappu\",\"Ponnani\",\"Thanur\",\"Tirur\",\"Thirurangadi\",\"Vengara\",\"Wandoor\",\"Kalikavu\"],\"block\":\"Nilambur\",\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 8, 0, 0, '2018-09-10 06:39:48'),
(21, '2018-09-10', '[{\"id\":0,\"date\":\"2018-09-10T06:43:16.818Z\",\"name\":\"hos\",\"age\":\"45\",\"gender\":\"male\",\"district\":\"\",\"blocks\":[],\"block\":\"\",\"diagnosis\":\"\",\"desc\":\"\",\"address\":\"\",\"contact\":\"\",\"plongitude\":\"\",\"platitude\":\"\",\"is_edit\":false,\"longitude\":\"\",\"latitude\":\"\"}]', 1, 8, 0, 0, '2018-09-10 06:40:11'),
(22, '2018-09-10', NULL, 0, 8, 0, 0, '2018-09-10 06:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `doc_user`
--

CREATE TABLE `doc_user` (
  `use_id` int(11) NOT NULL,
  `use_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_reg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_mobile` bigint(20) DEFAULT NULL,
  `use_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_android_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_login` int(11) NOT NULL DEFAULT '0',
  `use_delete` int(11) NOT NULL DEFAULT '0',
  `use_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_user`
--

INSERT INTO `doc_user` (`use_id`, `use_name`, `use_reg`, `use_email`, `use_mobile`, `use_image`, `use_type`, `use_password`, `use_android_key`, `use_login`, `use_delete`, `use_date`) VALUES
(1, 'sss', 'ddssaa', '', 9988999999, NULL, 'doctor', 'b69e9f9c2b8d8fa9e078113ae5ee98761a4e45df9d457991448639afe1594665', NULL, 0, 0, '2018-09-01 07:32:59'),
(2, 'sss', 'yyyyyy', '', 1111111111, NULL, 'doctor', 'aa23a88e5546912eb9def949398a0b8e69f28e08b30211dc1f3c30cfbf0b1517', NULL, 0, 0, '2018-09-01 07:39:33'),
(3, 'sss', 'tyyy', 'ass@ass.com', 0, NULL, 'doctor', 'aa23a88e5546912eb9def949398a0b8e69f28e08b30211dc1f3c30cfbf0b1517', NULL, 0, 0, '2018-09-01 07:40:36'),
(4, 'sssss', 'sssss', 'aa@bb.cc', NULL, NULL, 'hospital', 'a9bff57cbd3c6705e6f4ca8c16f856c975ed63e6349ff9dd2a4f89caa1065a26', NULL, 0, 0, '2018-09-01 07:48:11'),
(5, 'sssss', 'ddddss', 'aa@bb.dd', NULL, NULL, 'hospital', '1f7227107a0f73d374caab9c42fc63deb0c165184aa8aac685de33b91786f934', NULL, 1, 1, '2018-09-01 17:05:15'),
(6, 'aaaa', 'aaaaa', 'aaa@aa.aa', 9999999999, 'files_p9DFyy/doctor/images/bdcefc553953786dbe9b214338b280b5.png', 'doctor', 'f2633596c389281c67ecc2e90473973ad7934748e582dc47a11c18dcbd3f2c30', NULL, 1, 0, '2018-09-01 17:02:55'),
(7, 'aaa', 'aaa1', 'bb@bb.bb', NULL, NULL, 'hospital', 'c0d1db4a8389b459d4e39fdf4c068dc268f8ca1c0ddbadd902afe9e42af82e4a', NULL, 1, 0, '2018-09-04 02:12:47'),
(8, 'hos', '112233', 'bbb@bbb.bbb', 5566556655, 'files_p9DFyy/hospital/images/636e8b5e29789eb4e70eac449e2a584a.png', 'hospital', 'f2633596c389281c67ecc2e90473973ad7934748e582dc47a11c18dcbd3f2c30', NULL, 1, 0, '2018-09-08 13:00:25'),
(9, 'df', '33333', 'aad@aa.aa', NULL, NULL, 'hospital', 'ec925138e6af4b97381d549c71e8ae0781477185dc96139094106cda18fa72d4', NULL, 0, 0, '2018-09-10 01:34:35'),
(10, 'df', '333333', 'aa@aa.aa', NULL, NULL, 'hospital', 'ec925138e6af4b97381d549c71e8ae0781477185dc96139094106cda18fa72d4', NULL, 0, 0, '2018-09-10 01:35:17'),
(11, 'df', '333334', 'aac@aa.aa', NULL, NULL, 'hospital', 'ec925138e6af4b97381d549c71e8ae0781477185dc96139094106cda18fa72d4', NULL, 0, 0, '2018-09-10 01:41:55'),
(12, 'df', '333335', 'aad@aa.aay', NULL, NULL, 'hospital', 'ec925138e6af4b97381d549c71e8ae0781477185dc96139094106cda18fa72d4', NULL, 0, 0, '2018-09-10 01:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `doc_user_details`
--

CREATE TABLE `doc_user_details` (
  `use_id` int(11) NOT NULL,
  `usd_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_address` text COLLATE utf8mb4_unicode_ci,
  `usd_hospital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_hospital_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd_delete` int(11) DEFAULT '0',
  `usd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_user_details`
--

INSERT INTO `doc_user_details` (`use_id`, `usd_district`, `usd_address`, `usd_hospital`, `usd_hospital_type`, `usd_gender`, `usd_delete`, `usd_date`) VALUES
(6, 'Alappuzha', 'ddddd', 'q', 'government', '', 0, '2018-09-04 17:07:38'),
(8, 'Alappuzha', '', '', '', '', 0, '2018-09-08 13:05:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_admin`
--
ALTER TABLE `doc_admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `user_id` (`att_added_by`);

--
-- Indexes for table `doc_notification`
--
ALTER TABLE `doc_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `doc_patient`
--
ALTER TABLE `doc_patient`
  ADD PRIMARY KEY (`pat_id`),
  ADD KEY `user_id` (`pat_added_by`);

--
-- Indexes for table `doc_surveillance`
--
ALTER TABLE `doc_surveillance`
  ADD PRIMARY KEY (`sur_id`),
  ADD KEY `userid` (`sur_added_by`);

--
-- Indexes for table `doc_user`
--
ALTER TABLE `doc_user`
  ADD PRIMARY KEY (`use_id`);

--
-- Indexes for table `doc_user_details`
--
ALTER TABLE `doc_user_details`
  ADD KEY `user_id` (`use_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_admin`
--
ALTER TABLE `doc_admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc_notification`
--
ALTER TABLE `doc_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doc_patient`
--
ALTER TABLE `doc_patient`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doc_surveillance`
--
ALTER TABLE `doc_surveillance`
  MODIFY `sur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doc_user`
--
ALTER TABLE `doc_user`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  ADD CONSTRAINT `doc_attachment_ibfk_1` FOREIGN KEY (`att_added_by`) REFERENCES `doc_user` (`use_id`);

--
-- Constraints for table `doc_patient`
--
ALTER TABLE `doc_patient`
  ADD CONSTRAINT `doc_patient_ibfk_1` FOREIGN KEY (`pat_added_by`) REFERENCES `doc_user` (`use_id`);

--
-- Constraints for table `doc_user_details`
--
ALTER TABLE `doc_user_details`
  ADD CONSTRAINT `doc_user_details_ibfk_1` FOREIGN KEY (`use_id`) REFERENCES `doc_user` (`use_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
