-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 06:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadibel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_requests`
--

CREATE TABLE `admin_requests` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `course_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `course_image`, `created_at`) VALUES
(1, 'Python', 'Learn the basics and advanced topics of Python programming.', 'python.jpg', '2024-08-14 07:19:58'),
(2, 'Adobe Master', 'Master the Adobe suite of products.', 'adobe.jpeg', '2024-08-14 07:19:58'),
(3, 'C', 'Learn the C programming language.', 'c.jpg', '2024-08-14 07:19:58'),
(4, 'Java', 'Comprehensive course on Java programming.', 'java.jpeg', '2024-08-14 07:19:58'),
(5, 'Linux', 'Introduction and advanced concepts in Linux.', 'linux.jpg', '2024-08-14 07:19:58'),
(6, 'UI & UX', 'Design beautiful and user-friendly interfaces.', 'ux.png', '2024-08-14 07:19:58'),
(7, 'C++', 'Learn C++ programming from scratch.', 'c++.png', '2024-08-14 07:19:58'),
(8, 'Video Editing', 'Master video editing techniques.', 'v.jpeg', '2024-08-14 07:19:58'),
(9, 'Full Stack Development', 'Become a full stack developer.', 'fsd.jpg', '2024-08-14 07:19:58'),
(10, 'CCNA Using Software', 'Cisco Certified Network Associate training.', 'ccna.png', '2024-08-14 07:19:58'),
(11, 'Microsoft Office', 'Proficiency in Microsoft Office applications.', 'microsoft-office.png', '2024-08-14 07:19:58'),
(12, 'Animation Design', 'Learn the art of animation design.', 'animation.jpg', '2024-08-14 07:19:58'),
(13, 'Bash Scripting', 'Automate tasks with Bash scripting.', 'bash.png', '2024-08-14 07:19:58'),
(14, 'Backend Development', 'Develop robust backend systems.', 'bed.jpg', '2024-08-14 07:19:58'),
(15, 'Frontend Development', 'Create beautiful and responsive front-end interfaces.', 'fed.png', '2024-08-14 07:19:58'),
(16, 'Diploma Full Stack Development', 'Diploma course in full stack development.', 'dfsd.png', '2024-08-14 07:19:58'),
(17, 'Figma', 'Design interfaces using Figma.', 'figma.png', '2024-08-14 07:19:58'),
(18, 'React JS', 'Build web applications using React JS.', 'react.png', '2024-08-14 07:19:58'),
(19, 'Github', 'Version control and collaboration with GitHub.', 'github.png', '2024-08-14 07:19:58'),
(20, 'Blender', '3D modeling and animation with Blender.', 'blender.png', '2024-08-14 07:19:58'),
(21, 'Maya', '3D animation and modeling with Maya.', 'maya.png', '2024-08-14 07:19:58'),
(22, 'Unity', 'Game development using Unity.', 'unity.jpeg', '2024-08-14 07:19:58'),
(23, 'Machine Learning', 'Introduction to machine learning concepts.', 'ml.jpg', '2024-08-14 07:19:58'),
(24, 'Data Analysis', 'Analyze data and derive insights.', 'data-analysis.jpg', '2024-08-14 07:19:58'),
(25, 'Windows', 'Learn the essentials of Windows OS.', 'window.jpeg', '2024-08-14 07:19:58'),
(26, 'Windows Server', 'Administer and manage Windows Server.', 'windows-server.jpg', '2024-08-14 07:19:58'),
(27, 'PHP', 'Develop web applications with PHP.', 'php.png', '2024-08-14 07:19:58'),
(28, 'Photo Editing', 'Master photo editing techniques.', 'pe.png', '2024-08-14 07:19:58'),
(29, 'Structured Query Language', 'Learn SQL for database management.', 'sql.png', '2024-08-14 07:19:58'),
(30, 'JavaScript', 'Develop dynamic web pages with JavaScript.', 'js.jpg', '2024-08-14 07:19:58'),
(31, 'Tally Prime', 'Learn Tally Prime for accounting and finance.', 'tally.jpg', '2024-08-14 07:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('pending','approved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_username`, `course_id`, `status`) VALUES
(1, 'vignesh', 1, 'approved'),
(3, 'vignesh', 7, 'approved'),
(4, 'Nitheesh', 4, 'approved'),
(5, 'Nitheesh', 2, 'approved'),
(6, 'vignesh', 5, 'approved'),
(12, 'vignesh', 3, 'approved'),
(13, 'cadibel', 26, 'approved'),
(14, 'cadibel', 27, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `institution` varchar(100) NOT NULL,
  `aadhar_number` varchar(12) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `account_holder_name` varchar(100) NOT NULL,
  `ifsc_code` varchar(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `institution` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `username`, `password`, `dob`, `phone_number`, `photo`, `address`, `institution`, `created_at`) VALUES
(1, 'Nitheesh kumar', 'C', 'Nitheesh', '$2y$10$6N89kDmrT29.tZ3RnMknT.uxZjtBI3MxwaqQo6rAceusmEytbJtl.', '2024-08-13', '6383756693', 'uploads/1913062 NITHEESH KUMAR.C.jpg', 'Athani', 'KSRCE', '2024-08-12 03:42:52'),
(2, 'Vignesh', 'S', 'vignesh', '$2y$10$y0LNZ5nX2w0HgpRZKy0gGey0nkE4v2RMXjn3l2wBCb47b1fv9kFWG', '2024-08-07', '', 'IMG_20210719_204433_346.jpg', 'Elur', 'KSRCE', '2024-08-12 05:44:27'),
(3, 'Arjun', 'C', 'cadibel', '$2y$10$09w0T36I2Sc22WQe6CzB5.jbeZ.zhEL8/xzWHzXw77HSGBoXmOWfG', '2024-08-21', '', 'IMG_20210719_204433_346.jpg', 'Erode', 'KSRCE', '2024-08-16 06:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `background_img_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`id`, `file_name`, `file_path`, `background_img_path`, `uploaded_at`) VALUES
(1, 'code.zip', 'uploads/code.zip', 'uploads/Screenshot 2024-07-26 225648.png', '2024-08-15 07:41:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_requests`
--
ALTER TABLE `admin_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_username` (`student_username`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_requests`
--
ALTER TABLE `admin_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_requests`
--
ALTER TABLE `admin_requests`
  ADD CONSTRAINT `admin_requests_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_username`) REFERENCES `students` (`username`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
