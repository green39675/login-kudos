-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2018 at 09:22 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `kudos`
--

CREATE TABLE `kudos` (
  `id` int(11) NOT NULL,
  `fromUser` int(11) NOT NULL,
  `toUser` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_520_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `kudos`
--

INSERT INTO `kudos` (`id`, `fromUser`, `toUser`, `message`, `date`, `time`, `count`) VALUES
(5, 2, 1, 'Yo!', '2018-10-10', '11:54:56', 1),
(6, 2, 1, 'Yo!', '2018-10-10', '11:55:21', 2),
(7, 1, 3, 'Thank You!', '2018-10-10', '20:43:40', 1),
(8, 1, 3, 'Way to go!', '2018-10-10', '20:43:58', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_520_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_520_ci NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `gender`, `birth_date`) VALUES
(1, 'andhrelja', '904259e1845a3a289e2eccf026740dea', 'andhrelja@hotmail.com', 'Andrea', 'Hrelja', 'male', '0000-00-00'),
(2, 'example', '202cb962ac59075b964b07152d234b70', 'example@name', 'Example', 'Name', 'male', '0000-00-00'),
(3, 'flakoseljac', '202cb962ac59075b964b07152d234b70', 'filip_131996@hotmail.com', 'Filip', 'Lakoseljac', 'male', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kudos`
--
ALTER TABLE `kudos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromUser` (`fromUser`),
  ADD KEY `toUser` (`toUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kudos`
--
ALTER TABLE `kudos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kudos`
--
ALTER TABLE `kudos`
  ADD CONSTRAINT `kudos_ibfk_1` FOREIGN KEY (`fromUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kudos_ibfk_2` FOREIGN KEY (`toUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
