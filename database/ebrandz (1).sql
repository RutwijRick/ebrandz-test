-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 05:58 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebrandz`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`%` PROCEDURE `getUserByEmail` (IN `e` VARCHAR(255))  NO SQL
BEGIN

	SELECT *
    FROM users
    WHERE users.email = e;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `getUserByEmailAndPassword` (IN `e` VARCHAR(255), IN `p` VARCHAR(255))  NO SQL
BEGIN

	SELECT *
    FROM users
    WHERE users.email = e
    AND users.pass = p;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `getUserByRole` (IN `r` TINYINT)  NO SQL
BEGIN

	SELECT *
    FROM users
    WHERE users.role = r
    ORDER BY users.firstName;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `insertUserDetails` (IN `fN` VARCHAR(255), IN `lN` VARCHAR(255), IN `e` VARCHAR(255), IN `p` VARCHAR(255), IN `pass` VARCHAR(255), IN `a` TINYINT, IN `r` TINYINT)  NO SQL
BEGIN

	START TRANSACTION;
	INSERT INTO users
    (users.firstName,users.lastName,users.email,users.pass,users.mobile,users.age,users.role)
    VALUES
    (fN,lN,e,pass,p,a,r);
    SELECT LAST_INSERT_ID() AS lastId;
    COMMIT;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `updateUserById` (IN `id` BIGINT, IN `fN` VARCHAR(255), IN `lN` VARCHAR(255), IN `e` VARCHAR(255), IN `p` VARCHAR(255), IN `a` TINYINT)  NO SQL
BEGIN

	UPDATE users
    SET users.firstName = fN,
    	users.lastName = lN,
    	users.email = e,
    	users.mobile = p,
    	users.age = a
    WHERE users.id = id;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
