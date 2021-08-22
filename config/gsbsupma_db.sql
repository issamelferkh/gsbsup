-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 07:37 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsbsupma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id_credit` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `tele` int(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `business_adress` varchar(320) NOT NULL,
  `home_adress` varchar(320) NOT NULL,
  `remarque` varchar(1000) NOT NULL,
  `credit` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id_credit`, `id_client`, `full_name`, `class`, `group`, `gender`, `tele`, `email`, `facebook`, `date_naissance`, `business_adress`, `home_adress`, `remarque`, `credit`, `create_at`) VALUES
(2, 2, 'gfjyhfiy', 'ps', 'a', 'masculine', 86975974, 'jgfut@hjgiuyg.com', 'hjythedtr', '2021-05-06 00:00:00', 'gbhnttgbgfbgfbgf', 'fvrghtngfb@jdvcjhdv', 'gfuyfuyg', 0, '2021-05-31 12:27:28'),
(3, 3, 'btissamyaqine', 'CE6', 'b', 'feminine', 879865983, 'btissamyaqine123@gmail.com', 'btissamyaqine', '2021-04-29 00:00:00', 'gbhnttgbgfbgfbgf', 'fvrghtngfb@jdvcjhdv', 'asrysgsfdbgfdsvfz', 0, '2021-05-31 12:27:28'),
(4, 0, 'HSDJHG', 'CE1', 'B', 'masculine', 86975974, 'btissamyaqine123@gmail.com', 'btissamyaqine', '2021-05-26 00:00:00', 'gbhnttgbgfbgfbgf', 'fvrghtngfb@jdvcjhdv', '4FRFC', 0, '2021-05-31 12:27:28'),
(7, 0, 'issam', 'PS', 'A', 'Gender', 0, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2021-05-31 12:27:28'),
(8, 0, 'btissam', 'Class', 'Group', 'Gender', 661452145, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2021-05-31 12:27:28'),
(10, 0, 'btissam', '', '', 'Gender', 0, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2021-05-31 12:27:28'),
(15, 0, 'hahahha', 'PS', 'B', 'masculine', 2147483647, 'jgfut@hjgiuyg.com', 'hahh', '2021-05-26 00:00:00', 'gbhnttgbgfbgfbgf', 'fvrghtngfb@jdvcjhdv', 'hfdnfdmbvksgf;owibvd', 0, '2021-05-31 12:27:28'),
(16, 16, 'Nouamane Ajana', 'CE2', 'A', 'Gender', 698738346, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2021-05-31 12:27:28'),
(17, 17, 'hahahhas', 'Class', 'Group', 'Gender', 2147483647, 'jgfut@hjgiuyg.com', 'hahh', '0000-00-00 00:00:00', 'gbhnttgbgfbgfbgf', 'fvrghtngfb@jdvcjhdv', '', 0, '2021-05-31 12:27:28'),
(25, 19, 'aSASAS', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2021-05-31 13:32:35'),
(26, 0, 'aSASAS', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 12, '2021-05-31 13:43:13'),
(27, 0, 'aSASAS', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 23, '2021-05-31 21:02:28'),
(28, 20, 'issm test', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', -15, '2021-06-01 14:39:51'),
(29, 20, 'issm test', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 20, '2021-06-01 14:40:02'),
(30, 18, 'wswssw', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 12, '2021-06-02 16:03:00'),
(31, 18, 'wswssw', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', -45, '2021-06-02 16:03:19'),
(32, 22, 'anas', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', 10, '2021-06-02 16:14:39'),
(33, 22, 'anas', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', -15, '2021-06-02 16:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ing` int(11) NOT NULL,
  `name_ing` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id_ing`, `name_ing`, `create_at`) VALUES
(1, 'test 01', '2021-06-02 18:24:56'),
(2, 'test 01', '2021-06-02 18:24:56'),
(3, 'test 01', '2021-06-02 18:24:58'),
(4, 'test 01', '2021-06-02 18:24:58'),
(5, '545454', '2021-06-01 23:00:00'),
(6, 'sdsdsd', '2021-06-02 20:01:36'),
(7, 'test02', '2021-06-02 20:01:42'),
(8, 'tomat', '2021-06-02 21:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price` float NOT NULL DEFAULT 0,
  `ingredients` varchar(2550) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `menu_price`, `ingredients`, `create_at`) VALUES
(1, 'test', 120, '545454,sdsdsd,test02,', '2021-06-02 21:33:48'),
(2, 'test 2 ', 675, 'test - test - test02 - ', '2021-06-02 21:35:54'),
(3, 'tacos', 35, '545454 - test - tomat - ', '2021-06-02 21:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_client` int(255) NOT NULL,
  `id_day` int(11) NOT NULL,
  `timestamp_day` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `tele` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remarque` varchar(320) NOT NULL,
  `remise` int(255) NOT NULL,
  `order_menus` varchar(255) NOT NULL,
  `price_total` float NOT NULL,
  `price_remise` float NOT NULL,
  `price_final` float NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `id_day`, `timestamp_day`, `full_name`, `tele`, `class`, `status`, `remarque`, `remise`, `order_menus`, `price_total`, `price_remise`, `price_final`, `create_at`) VALUES
(21, 10, 1, 18802, 'btissam', '6541254', '/', 'Pending', '', 0, 'tacos - 35Dhs - Qte:1\r\n', 35, 0, 35, '2021-06-01 13:53:39'),
(22, 2, 2, 18802, 'gfjyhfiy', '86975974', 'ps/a', 'Pending', '', 0, 'tacos - 35Dhs - Qte:1\r\n', 35, 0, 35, '2021-06-02 13:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `tele` int(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `business_adress` varchar(320) NOT NULL,
  `home_adress` varchar(320) NOT NULL,
  `remarque` varchar(1000) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `student_name`, `class`, `group`, `gender`, `tele`, `email`, `facebook`, `date_naissance`, `business_adress`, `home_adress`, `remarque`, `create_at`) VALUES
(30, 'a', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', '2021-08-21 16:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id_teacher` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `tele` int(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `business_adress` varchar(320) NOT NULL,
  `home_adress` varchar(320) NOT NULL,
  `remarque` varchar(1000) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id_teacher`, `teacher_name`, `class`, `group`, `gender`, `tele`, `email`, `facebook`, `date_naissance`, `business_adress`, `home_adress`, `remarque`, `create_at`) VALUES
(30, 'a', '', '', '', 0, '', '', '0000-00-00 00:00:00', '', '', '', '2021-08-21 16:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `login`, `password`, `fname`, `lname`, `role`, `active`, `create_on`) VALUES
(1, 'test', 'test', 'btissam', 'yaqine', 'admin', 0, '2021-05-25 12:41:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id_credit`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ing`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id_teacher`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id_credit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id_teacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
