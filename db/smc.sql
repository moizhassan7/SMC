-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 08:08 PM
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
-- Database: `smc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `rcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `date`, `name`, `email`, `uname`, `pass`, `rcode`) VALUES
(1, '11-04-17', 'Moiz Hassan', 'hassanmoiz.119sb@gmail.com', 'admin', 'Moiz#Hassan9878', '4847');

-- --------------------------------------------------------

--
-- Table structure for table `chairmen`
--

CREATE TABLE `chairmen` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chairmen`
--

INSERT INTO `chairmen` (`id`, `department_id`, `name`, `designation`, `message`, `image_url`) VALUES
(1, 1, 'Dr. Ahmed Khan', 'Head of Anatomy Department', 'Welcome to the Department of Anatomy. Our goal is to foster a deep understanding of human anatomy through rigorous academic programs and hands-on practical sessions.', '1752312594_12.jpg'),
(2, 2, 'Prof. Zubaida Begum', 'Head of Physiology Department', 'Our department is committed to exploring the intricate functions of the human body, providing students with a strong physiological foundation for their medical careers.', 'zubaida_begum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `name`, `image_url`, `overview`) VALUES
(1, 1, 'Anatomy', '1752312410_.png', 'The Department of Anatomy provides comprehensive education in human structure and development, utilizing modern teaching methodologies and cadaveric dissection to offer an in-depth understanding for medical students.'),
(2, 1, 'Physiology', '', 'Physiology'),
(3, 1, 'Biochemistry', '1752312459_imgi_33_Picture6_0.jpg', 'The Department of Biochemistry provides comprehensive education in human structure and development, utilizing modern teaching methodologies and cadaveric dissection to offer an in-depth understanding for medical students.'),
(4, 1, 'Pharmacology', '', 'Pharmacology'),
(5, 2, 'Internal Medicine', '', 'Internal Medicine'),
(6, 2, 'Surgery', '', 'Surgery'),
(7, 2, 'Pediatrics', '', 'Pediatrics'),
(8, 2, 'Gynaecology', '1752312495_.png', 'The Department of Gynaecolgy provides comprehensive education in human structure and development, utilizing modern teaching methodologies and cadaveric dissection to offer an in-depth understanding for medical students.'),
(9, 1, 'Physiology', 'physiology_dept.jpg', 'The Department of Physiology focuses on the study of how the human body functions, from cellular mechanisms to organ systems, providing essential knowledge for medical practice.');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `overview` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `overview`, `image_url`) VALUES
(1, 'Faculty of Basic Sciences', 'The Faculty of Basic Sciences provides foundational knowledge in core scientific disciplines, preparing students for advanced studies and research in various fields of medicine and allied health sciences.', '1752315829_imgi_33_Picture6_0.jpg'),
(2, 'Faculty of Clinical Sciences', 'Dedicated to advanced medical training and patient care, the Faculty of Clinical Sciences offers specialized programs and hands-on experience in diverse clinical settings.', '1752311167_imgi_2_main-banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `description` text NOT NULL,
  `full_article` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `additional_images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `txt` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `txt`, `image`) VALUES
(1, 'Find the Right Job . Right Now.\r\n', 'Your job search starts and ends with us.'),
(2, '', '11072020250714508.png'),
(3, '', '24072020250714558.png'),
(5, '', '35072020250714928.jpg'),
(6, '', '47072020250714139.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff_members`
--

CREATE TABLE `staff_members` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_members`
--

INSERT INTO `staff_members` (`id`, `department_id`, `name`, `designation`, `details`, `image_url`) VALUES
(1, 1, 'Dr. Sara Ali', 'Professor', 'MBBS, MPhil Anatomy. Specializes in neuroanatomy and embryology. Over 15 years of teaching experience.', '1752312635_13.jpg'),
(2, 1, 'Dr. Omar Butt', 'Associate Professor', 'MBBS, FCPS Anatomy. Expert in gross anatomy and histology. Actively involved in research on musculoskeletal system.', '1752312626_14.jpg'),
(3, 1, 'Mr. Ali Raza', 'Lecturer', 'BSc, MSc Anatomy. Passionate about anatomical illustration and modern pedagogical approaches.', '1752312692_17.jpg'),
(4, 2, 'Dr. Imran Malik', 'Assistant Professor', 'MBBS, PhD Physiology. Special interest in cardiovascular physiology and renal function.', 'imran_malik.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `chairmen`
--
ALTER TABLE `chairmen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chairmen`
--
ALTER TABLE `chairmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_members`
--
ALTER TABLE `staff_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chairmen`
--
ALTER TABLE `chairmen`
  ADD CONSTRAINT `chairmen_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD CONSTRAINT `staff_members_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
