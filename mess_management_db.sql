-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 08:12 AM
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
-- Database: `mess_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `bill_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `rollno`, `amount`, `description`, `status`, `bill_date`) VALUES
(1, '22105110036', 30000.00, 'January-June(2025)', 'paid', '2025-07-02'),
(2, '22/CSE/22', 25000.00, 'January-May(205)', 'paid', '2025-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `message`, `date`) VALUES
(1, 'Priyanshu Patel', 'Food quality good', '2025-07-02 09:26:49'),
(2, 'Satyam Kumar', 'Great facility!', '2025-07-02 10:46:28'),
(3, 'Ankit', 'Fantastic!', '2025-07-02 18:14:42'),
(4, 'Krishna Kumar', 'Great!', '2025-07-02 18:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `meal_attendance`
--

CREATE TABLE `meal_attendance` (
  `id` int(11) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `meal_type` enum('breakfast','lunch','dinner') NOT NULL,
  `attendance_date` date DEFAULT curdate(),
  `status` enum('present','absent') DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_attendance`
--

INSERT INTO `meal_attendance` (`id`, `rollno`, `meal_type`, `attendance_date`, `status`) VALUES
(1, '22105110036', 'breakfast', '2025-07-02', 'present'),
(2, '22105110033', 'breakfast', '2025-07-02', 'present'),
(3, '22105110036', 'lunch', '2025-07-02', 'present'),
(4, '22105110036', 'dinner', '2025-07-02', 'present'),
(5, '22105110033', 'lunch', '2025-07-02', 'present'),
(6, '22105110033', 'dinner', '2025-07-02', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `breakfast` varchar(100) DEFAULT NULL,
  `lunch` varchar(100) DEFAULT NULL,
  `dinner` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `day`, `breakfast`, `lunch`, `dinner`) VALUES
(1, 'Monday', 'Idli Sambhar', 'Rice, Dal & Bhujiya', 'Roti and Paneer'),
(2, 'Tuesday', 'Poha with peanuts & chai', 'Kadhi pakora with steamed rice', 'Aloo matar with chapati'),
(3, 'Wednesday', 'Methi thepla with pickle & curd', 'Chole with jeera rice', 'Biryani (veg or chicken) with onion raita'),
(4, 'Thursday', 'Moong dal dosa with tomato chutney', 'Masala rice with leftover dal', 'Bhindi masala with roti'),
(5, 'Friday', 'Vegetable sevai (vermicelli upma)', 'Chana masala with rice', 'Fish curry with steamed rice (or veg)'),
(6, 'Saturday', '	Suji halwa & puri', 'Rajma chawal (kidney beans with rice)', 'Matar paneer with paratha'),
(7, 'Sunday', 'Poori with aloo bhaji', 'Masoor dal with roti & cucumber salad', 'Matar paneer with paratha');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `rollno`, `password`) VALUES
(1, 'Priyanshu Patel', '22105110036', '$2y$10$ZU8ZKP/PkZFBBAKSFaoJve.9xp.rXwsyTXAmUDO7sEXp7iFoTuQYO'),
(2, 'Krishna Kumar', '22105110042', '$2y$10$xILMrQJ76DbwOIO.yUD0kuGU4vLuxqcRkttYNEfEQWAudGFXYyaX2'),
(3, 'Satyam Kumar', '22105110033', '$2y$10$XUdV0qpz8YLKULUu8YefjeMGtZpf4ZN7n.7QQKIW7gOqYsa0PF4ou'),
(4, 'Chandan Kumar', '22105110006', '$2y$10$IEB8vgXtNDWdPocc8Ar7De9u8bam/iao5MrFWljRRpjeBd8gTkNJm'),
(5, 'Ankit', '22/CSE/22', '$2y$10$p5PioOTzqO9JipW92LzzyeFDaRkU0A/ghv13Dae5p2VtPFubFOFQa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal_attendance`
--
ALTER TABLE `meal_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meal_attendance`
--
ALTER TABLE `meal_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
