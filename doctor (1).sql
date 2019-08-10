-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2018 at 01:22 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

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
(3, '2018-09-04', 6, '58b3688243111f4893d4d43effa580e6.pdf', 'files_p9DFyy/doctor/attachments', 'varuan', 0, 0, '2018-09-03 23:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `doc_disease`
--

CREATE TABLE `doc_disease` (
  `dis_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `dis_report_on` date DEFAULT NULL,
  `dis_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_hospital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_hospital_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_relief` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_other_diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_status` int(11) NOT NULL DEFAULT '0',
  `dis_read` int(11) NOT NULL DEFAULT '0',
  `dis_added_by` int(11) NOT NULL,
  `dis_delete` int(11) NOT NULL DEFAULT '0',
  `dis_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_disease`
--

INSERT INTO `doc_disease` (`dis_id`, `pat_id`, `dis_report_on`, `dis_district`, `dis_hospital`, `dis_hospital_type`, `dis_relief`, `dis_diagnosis`, `dis_other_diagnosis`, `dis_desc`, `dis_condition`, `dis_longitude`, `dis_latitude`, `dis_status`, `dis_read`, `dis_added_by`, `dis_delete`, `dis_date`) VALUES
(1, 1, '2018-09-03', 'kollam', 'q', 'government', 'no', 'japanese encephalitis', '', '', '', '', '', 0, 0, 6, 1, '2018-09-03 17:00:24'),
(2, 2, '2018-09-03', 'kollam', 'q', 'government', 'yes', '', '', '', '', '', '', 0, 0, 6, 1, '2018-09-03 16:19:30'),
(3, 3, '2018-09-03', 'kollam', 'q', 'government', 'yes', 'cholera', '', '', '', '', '', 1, 0, 6, 0, '2018-09-03 17:30:22'),
(4, 4, '2018-09-03', 'kollam', 'q', 'government', 'yes', 'meningitis', '', '', '', '', '', 1, 0, 6, 0, '2018-09-03 17:30:22'),
(5, 5, '2018-08-15', 'kollam', 'q', 'government', 'no', '', '', '', '', '', '', 1, 0, 6, 0, '2018-09-03 17:32:22'),
(6, 6, '2018-09-01', 'kollam', 'q', 'government', 'yes', '', '', '', '', '', '', 0, 0, 6, 0, '2018-09-03 17:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `doc_hospital`
--

CREATE TABLE `doc_hospital` (
  `use_id` int(11) NOT NULL,
  `hos_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_pin` int(11) NOT NULL,
  `hos_longitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_latitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hos_delete` int(11) NOT NULL DEFAULT '0',
  `hos_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `use_login` int(11) NOT NULL DEFAULT '0',
  `use_delete` int(11) NOT NULL DEFAULT '0',
  `use_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_user`
--

INSERT INTO `doc_user` (`use_id`, `use_name`, `use_reg`, `use_email`, `use_mobile`, `use_image`, `use_type`, `use_password`, `use_login`, `use_delete`, `use_date`) VALUES
(1, 'sss', 'ddssaa', '', 9988999999, NULL, 'doctor', 'b69e9f9c2b8d8fa9e078113ae5ee98761a4e45df9d457991448639afe1594665', 0, 0, '2018-09-01 07:32:59'),
(2, 'sss', 'yyyyyy', '', 1111111111, NULL, 'doctor', 'aa23a88e5546912eb9def949398a0b8e69f28e08b30211dc1f3c30cfbf0b1517', 0, 0, '2018-09-01 07:39:33'),
(3, 'sss', 'tyyy', 'ass@ass.com', 0, NULL, 'doctor', 'aa23a88e5546912eb9def949398a0b8e69f28e08b30211dc1f3c30cfbf0b1517', 0, 0, '2018-09-01 07:40:36'),
(4, 'sssss', 'sssss', 'aa@bb.cc', NULL, NULL, 'hospital', 'a9bff57cbd3c6705e6f4ca8c16f856c975ed63e6349ff9dd2a4f89caa1065a26', 0, 0, '2018-09-01 07:48:11'),
(5, 'sssss', 'ddddss', 'aa@bb.dd', NULL, NULL, 'hospital', '1f7227107a0f73d374caab9c42fc63deb0c165184aa8aac685de33b91786f934', 1, 1, '2018-09-01 17:05:15'),
(6, 'aaaa', 'aaaaa', 'aaa@aa.aa', 9999999999, 'files_p9DFyy/doctor/images/bdcefc553953786dbe9b214338b280b5.png', 'doctor', 'ec925138e6af4b97381d549c71e8ae0781477185dc96139094106cda18fa72d4', 1, 0, '2018-09-01 17:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `doc_user_details`
--

CREATE TABLE `doc_user_details` (
  `use_id` int(11) NOT NULL,
  `usd_specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_address` text COLLATE utf8mb4_unicode_ci,
  `usd_hospital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_hospital_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd_experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd_dob` date NOT NULL,
  `usd_delete` int(11) DEFAULT '0',
  `usd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_user_details`
--

INSERT INTO `doc_user_details` (`use_id`, `usd_specialization`, `usd_city`, `usd_district`, `usd_address`, `usd_hospital`, `usd_hospital_type`, `usd_gender`, `usd_experience`, `usd_dob`, `usd_delete`, `usd_date`) VALUES
(6, 'qqqq', 'Kollam', 'kollam', 'sdfsfsf', 'q', 'government', 'female', '1', '2018-04-07', 0, '2018-09-02 09:40:38');

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
-- Indexes for table `doc_disease`
--
ALTER TABLE `doc_disease`
  ADD PRIMARY KEY (`dis_id`),
  ADD KEY `patient_id` (`pat_id`),
  ADD KEY `user_id` (`dis_added_by`);

--
-- Indexes for table `doc_hospital`
--
ALTER TABLE `doc_hospital`
  ADD KEY `user_id` (`use_id`);

--
-- Indexes for table `doc_patient`
--
ALTER TABLE `doc_patient`
  ADD PRIMARY KEY (`pat_id`),
  ADD KEY `user_id` (`pat_added_by`);

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
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doc_disease`
--
ALTER TABLE `doc_disease`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doc_patient`
--
ALTER TABLE `doc_patient`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doc_user`
--
ALTER TABLE `doc_user`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  ADD CONSTRAINT `doc_attachment_ibfk_1` FOREIGN KEY (`att_added_by`) REFERENCES `doc_user` (`use_id`);

--
-- Constraints for table `doc_disease`
--
ALTER TABLE `doc_disease`
  ADD CONSTRAINT `doc_disease_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `doc_patient` (`pat_id`),
  ADD CONSTRAINT `doc_disease_ibfk_2` FOREIGN KEY (`dis_added_by`) REFERENCES `doc_user` (`use_id`);

--
-- Constraints for table `doc_hospital`
--
ALTER TABLE `doc_hospital`
  ADD CONSTRAINT `doc_hospital_ibfk_1` FOREIGN KEY (`use_id`) REFERENCES `doc_user` (`use_id`);

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
