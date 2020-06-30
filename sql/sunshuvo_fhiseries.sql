-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2020 at 11:19 AM
-- Server version: 5.7.30-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunshuvo_fhiseries`
--

-- --------------------------------------------------------

--
-- Table structure for table `field_input`
--

CREATE TABLE `field_input` (
  `id` int(11) NOT NULL,
  `trip_id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `fish_type` text,
  `weight` int(4) DEFAULT NULL,
  `messsage` varchar(255) DEFAULT NULL,
  `emergency` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `field_input`
--

INSERT INTO `field_input` (`id`, `trip_id`, `username`, `date`, `latitude`, `longitude`, `fish_type`, `weight`, `messsage`, `emergency`) VALUES
(1, 0, 'tarikul', '2020-06-29 23:42:13', '', '', 'Ilihsa', 300, 'test', 0),
(2, 0, 'tarikul', '2020-06-29 23:48:12', '', '', 'Ilihsa', 120, 'test2', 0),
(3, 8, 'tarikul', '2020-06-30 00:04:52', '', '', 'Tuna', 100, 'test', 0),
(4, 8, 'tarikul', '2020-06-30 00:35:31', '', '', 'Tuna', 30, 'read', 0),
(5, 8, 'tarikul', '2020-06-30 00:35:49', '', '', 'Tyuna', 500, 'new', 0),
(6, 8, 'tarikul', '2020-06-30 00:40:10', '', '', 'Ilihsa', 20, 'test', 0),
(7, 8, 'tarikul', '2020-06-30 00:43:08', '30.3', '32.3', 'tuna', 100, 'test', 0),
(8, 8, 'tarikul', '2020-06-30 02:09:51', '23.782031999999997', '90.368298', 'Ilihsa', 300, 'test2', 0),
(9, 8, 'tarikul', '2020-06-30 03:22:44', '23.782031999999997', '90.368298', 'Tuna', 90, 'test', 0),
(10, 0, 'ziaul', '2020-06-30 03:28:43', '23.797993101836646', '90.37412206121381', 'fish', 12, '2', 0),
(11, 9, 'ziaul', '2020-06-30 03:30:01', '23.797993101836646', '90.37412206121381', 'fish', 12, '2', 0),
(12, 9, 'ziaul', '2020-06-30 03:30:44', '23.798013695404194', '90.37417889200773', 'tuna', 30, 'test', 0),
(13, 9, 'ziaul', '2020-06-30 03:34:23', '23.798013695404194', '90.37417889200773', 'fish', 12, 'res', 0),
(14, 9, 'ziaul', '2020-06-30 03:34:39', '23.798013695404194', '90.37417889200773', 'tuna', 45, '2', 0),
(15, 10, 'niloy', '2020-06-30 03:37:59', '', '', 'Tyuna', 50, 'Ok', 0),
(16, 10, 'niloy', '2020-06-30 03:38:46', '', '', 'Ilihsa', 500, 'Test', 0),
(17, 11, 'sazzad', '2020-06-30 10:05:52', '23.7980554', '90.3746395', 'Tuna', 45, 'Test', NULL),
(18, 9, 'ziaul', '2020-06-30 10:48:35', '23.771', '90.361', 'Fish 1', 15, 'test message', NULL),
(19, 12, 'ziaul', '2020-06-30 10:56:28', '23.771', '90.361', 'Hilsha', 22, 'test message 2', NULL),
(20, 12, 'ziaul', '2020-06-30 10:57:16', '23.771', '90.361', 'Loitta', 25, 'Test message 3', NULL),
(21, 12, 'ziaul', '2020-06-30 11:00:05', '23.7552908', '90.383266', 'Ruhi', 50, 'Test message 4', NULL),
(22, 10, 'niloy', '2020-06-30 11:12:11', '23.798015407936642', '90.37418445751032', 'fish', 12, '2', NULL),
(23, 13, 'niloy', '2020-06-30 11:13:05', '23.798015407936642', '90.37418445751032', 'tuna', 12, '2', NULL),
(24, 13, 'niloy', '2020-06-30 11:15:42', '23.798015407936642', '90.37418445751032', 'fish', 30, 'test', NULL),
(25, 13, 'niloy', '2020-06-30 11:18:56', '23.798015407936642', '90.37418445751032', 'fish', 30, 'test', NULL),
(26, 14, 'niloy', '2020-06-30 11:19:35', '23.79799286601564', '90.37418828944512', 'fish', 12, '2', NULL);

--
-- Triggers `field_input`
--
DELIMITER $$
CREATE TRIGGER `update_from_field` AFTER INSERT ON `field_input` FOR EACH ROW begin
       DECLARE id_exists Boolean;
       -- Check existing trip table
       SELECT 1
       INTO @id_exists
       FROM trip
       WHERE trip.id= NEW.trip_id;

       IF @id_exists = 1
       THEN
          UPDATE trip SET current_weight = current_weight + NEW.weight WHERE id = NEW.trip_id;
          UPDATE trip SET last_seen = new.date WHERE id = NEW.trip_id;
          UPDATE trip SET latitude = NEW.latitude WHERE id = NEW.trip_id;
          UPDATE trip SET longitude = NEW.longitude WHERE id = NEW.trip_id;
        END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `trip_id` int(10) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `trip_username` varchar(50) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `trip_started` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `current_weight` int(5) DEFAULT '0',
  `total_passengers` int(11) DEFAULT NULL,
  `operation_days` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `trip_id`, `user_id`, `trip_username`, `latitude`, `longitude`, `last_seen`, `trip_started`, `current_weight`, `total_passengers`, `operation_days`, `status`) VALUES
(4, 0, 0, 'tarikul', '', '', '0000-00-00 00:00:00', '2020-06-29 00:00:00', 0, 2, 15, 2),
(5, 0, 0, 'tarikul', '', '', '0000-00-00 00:00:00', '2020-06-29 00:00:00', 0, 2, 15, 2),
(6, 0, 0, 'tarikul', '', '', '0000-00-00 00:00:00', '2020-06-29 00:00:00', 0, 1, 12, 2),
(7, 0, 0, 'tarikul', '', '', '0000-00-00 00:00:00', '2020-06-29 00:00:00', 0, 16, 131, 2),
(8, 0, 0, 'tarikul', '23.782031999999997', '90.368298', '2020-06-30 00:40:10', '2020-06-29 00:00:00', 1040, 2, 12, 2),
(9, 0, 0, 'ziaul', '23.771', '90.361', '2020-06-30 10:48:35', '2020-06-30 00:00:00', 114, 2, 15, 2),
(10, 0, 0, 'niloy', '23.798015407936642', '90.37418445751032', '2020-06-30 11:12:11', '2020-06-30 00:00:00', 562, 2, 15, 2),
(11, NULL, NULL, 'sazzad', '23.7980554', '90.3746395', '2020-06-30 10:05:52', '2020-06-30 10:03:18', NULL, 10, 45, 1),
(12, NULL, NULL, 'ziaul', '23.7552908', '90.383266', '2020-06-30 11:00:05', '2020-06-30 10:55:34', NULL, 5, 12, 1),
(13, NULL, NULL, 'niloy', '23.798015407936642', '90.37418445751032', '2020-06-30 11:18:56', '2020-06-30 11:12:51', 30, 2, 12, 2),
(14, NULL, NULL, 'niloy', '23.79799286601564', '90.37418828944512', '2020-06-30 11:19:35', '2020-06-30 11:19:21', 12, 2, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trip_request`
--

CREATE TABLE `trip_request` (
  `id` int(11) NOT NULL,
  `trip_id` int(10) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `trip_username` varchar(50) NOT NULL,
  `operation_days` int(3) NOT NULL,
  `total_passengers` int(3) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip_request`
--

INSERT INTO `trip_request` (`id`, `trip_id`, `user_id`, `trip_username`, `operation_days`, `total_passengers`, `status`) VALUES
(1, 0, 13, 'asd', 40, 3, 2),
(3, NULL, NULL, 'tarikul', 50, 15, 2),
(4, NULL, NULL, 'ziaul', 90, 55, 2),
(5, NULL, NULL, 'tarikul', 15, 2, 2),
(6, NULL, NULL, 'tarikul', 15, 2, 2),
(7, NULL, NULL, 'tarikul', 15, 0, 2),
(8, NULL, NULL, 'tarikul', 15, 0, 2),
(9, NULL, NULL, 'tarikul', 12, 2, 2),
(10, NULL, NULL, 'tarikul', 45, 12, 2),
(11, NULL, NULL, 'tarikul', 12, 1, 2),
(12, NULL, NULL, 'tarikul', 131, 16, 2),
(13, NULL, NULL, 'tarikul', 12, 2, 2),
(15, NULL, NULL, 'ziaul', 15, 2, 2),
(16, NULL, NULL, 'niloy', 15, 2, 2),
(17, NULL, NULL, 'sazzad', 45, 10, 2),
(18, NULL, NULL, 'sazzad', 45, 10, 2),
(19, NULL, NULL, 'sazzad', 45, 10, 2),
(20, NULL, NULL, 'ziaul', 12, 5, 2),
(21, NULL, NULL, 'niloy', 12, 2, 2),
(22, NULL, NULL, 'niloy', 15, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `vessel_type` varchar(30) NOT NULL,
  `allow_weight` int(4) NOT NULL,
  `make_year` int(4) NOT NULL,
  `passenger_capacity` int(2) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_trip` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `active_trip` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `vessel_type`, `allow_weight`, `make_year`, `passenger_capacity`, `added_date`, `last_trip`, `password`, `active_trip`) VALUES
(14, 'tarikul', 'Islam', 'Islam', 'Large', 800, 0, 15, '2020-06-29 00:00:00', '2020-06-01', '$2y$10$wCo/RGaqH5H11Yf8PCKlteHv5I3nB3YlN7cH5hTObwV', 0),
(15, 'ziaul', 'Hasan', 'Hasan', 'Very Large', 2000, 0, 100, '2020-06-29 00:00:00', '2020-06-01', '$2y$10$x7Szu.1e61VT5EiTQ1PPguTtj3b0VEYFw9hpAkdg2JM', 0),
(17, 'niloy', 'Niloy', 'Ranjan', 'Large', 900, 0, 20, '2020-06-29 00:00:00', '2020-06-01', '$2y$10$BTFHVUPJcmeONbg1DFfWq.tZrSkpdOeNvvT1amAY3h6', 0),
(18, 'sazzad', 'Sazzad', 'Hossain', 'Medium', 300, 0, 6, '2020-06-30 00:00:00', '2020-06-01', '$2y$10$9cGIgMJwY2JvIIVxxjpa8.ZHzRcs56Xf0GyeIFemAL9', 0),
(19, 'admin', 'admin', 'admin', 'large', 30, 0, 1, '2020-06-30 00:00:00', '2020-06-01', '$2y$10$PCe7/e8nzGr7BE4Rw0U3yeHsQebBsSUjXNChCaxRMq9', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `field_input`
--
ALTER TABLE `field_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trip_request`
--
ALTER TABLE `trip_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD KEY `username` (`username`);
ALTER TABLE `user` ADD FULLTEXT KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field_input`
--
ALTER TABLE `field_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trip_request`
--
ALTER TABLE `trip_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
