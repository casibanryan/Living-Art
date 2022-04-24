-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 07:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `living_art`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_toCart` (IN `user_id` INT, IN `art_id` INT)  INSERT INTO cart (user_id, art_id) VALUES (user_id, art_id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkout` (IN `fullname` VARCHAR(50), IN `address` VARCHAR(50), IN `zipcode` INT, IN `city` VARCHAR(50), IN `country` VARCHAR(50), IN `items` INT, IN `total` INT, IN `user_id` INT)  INSERT INTO checkout (fullname, address, zipcode, city, country, items, total, user_id) VALUES (fullname, address, zipcode, city, country, items, total, user_id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contact_us` (IN `name` VARCHAR(50), IN `email` VARCHAR(50), IN `subject` VARCHAR(50), IN `message` TEXT)  INSERT INTO contact (name, email, subject, message) VALUES (name, email, subject, message)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `not_show` (IN `id` INT)  UPDATE checkout SET not_show = 1 WHERE order_id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `on_search` (IN `id` INT)  SELECT * FROM artwork WHERE art_id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `post_art` (IN `image` TEXT, IN `title` VARCHAR(50), IN `price` INT, IN `quantity` INT, IN `categories` VARCHAR(50), IN `description` TEXT, IN `features` TEXT, IN `user_id` INT)  INSERT INTO artwork (image, title, price, quantity, categories, description, features, user_id) VALUES (image, title, price, quantity, categories, description, features, user_id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_artwork` ()  SELECT * FROM `artwork`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_address` (IN `name` VARCHAR(50), IN `address` VARCHAR(50), IN `zipcode` INT, IN `city` VARCHAR(50), IN `country` VARCHAR(50), IN `phone` INT, IN `id` INT)  UPDATE checkout SET fullname = name, address = address, zipcode = zipcode, city = city, country = country, phone = phone WHERE order_id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `art_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `features` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`art_id`, `image`, `title`, `price`, `quantity`, `categories`, `description`, `features`, `user_id`) VALUES
(73, 'Girl in the dark-38.jpg', 'Girl in the dark', 23243, 1, 'Commercial', 'girl in the dark', 'fierce', 1),
(75, ' Alexandra Mae Dela Cruz-39.jpeg', ' Alexandra Mae Dela Cruz', 7388, 1, 'Fine Art', 'The artwork depicts how the pandemic has distorted our lives and perception of it.', 'LOCATION Taguig City, Philippines\r\n\r\nPAINTINGS Cha', 1),
(76, 'Unna Jelly Fish-14.jpg', 'Unna Jelly Fish', 6740, 1, 'Decorative', 'My acrylic pieces are rendered with acrylic paint without the use of any brushes. I use paint palettes to flatten the colors to achieve the splashes of the paint. I love the effects of it, it creates a story.\r\n\r\nSometimes, I flatten it with paper or another glass.\r\n\r\nThis is first piece of my acrylics collection.', 'ARTIST Lorienelle Anne Gardon \r\n\r\nLOCATION San Jos', 1),
(77, 'Goldmine-1.jpg', 'Goldmine', 31999, 1, 'abstract', '“Goldmine” - Fortune favors those who explore. \r\n\r\nMuch like “The Cave,\" I was inspired by the concept of finding beauty in the rocks, and I wanted to convey that despite its roughness and darkness, something is mesmerizing and precious underneath. \"Goldmine\" touches on the concept of always digging deeper until you hit the jackpot.\r\n\r\nYou can hang the artwork in vertical or horizontal orientation.\r\n\r\nMEDIUM\r\nAcrylic on Canvas\r\n\r\nSUBJECT\r\nFigures and Patterns\r\n\r\nART STYLES\r\nAbstract, Contemporary\r\n\r\nYEAR CREATED\r\n2020\r\n\r\nFRAME\r\nThis Artwork is framed.', 'ARTIST Leslie Castaneda \r\n\r\nLOCATION Manila City, ', 1),
(78, 'Esoteric 3-6.jpg', 'Esoteric 3', 29882, 1, 'Fine Art', 'About the Artwork\r\n\"Esoteric 3,\" 2021\r\n\r\n \r\n\r\nMEDIUM\r\nOil on Canvas\r\n\r\nSUBJECT\r\nPortraits\r\n\r\nART STYLES\r\nPortraiture, Contemporary\r\n\r\nYEAR CREATED\r\n2021\r\n\r\nFRAME\r\nThis Artwork is unframed and requires framing.', 'ARTIST Dang Cupido \r\n\r\nLOCATION Quezon City, Phili', 1),
(79, 'Gondola Ride-41.jpeg', 'Gondola Ride', 4100, 1, 'Fine Art', 'About the Artwork\r\nBased on a photograph taken at the Venice Grand Canal Mall, Bonifacio Global City, in Taguig, Manila\r\n\r\nMEDIUM\r\nAcrylic on Paper\r\n\r\nSUBJECT\r\nLand, Sea, and Cityscapes\r\n\r\nART STYLES\r\nImpressionism, Contemporary\r\n\r\nYEAR CREATED\r\n2020\r\n\r\nFRAME\r\nThis Artwork is unframed and requires framing.', 'ARTIST Arnel Millos \r\n\r\nLOCATION Cebu City, Philip', 1),
(80, 'Colors of a Mountain View-18.jpeg', 'Colors of a Mountain View', 9600, 1, 'Commercial', 'About the Artwork\r\nInspired by the mountain view during sunset\r\n\r\nMEDIUM\r\nAcrylic on Canvas\r\n\r\nSUBJECT\r\nLandscapes, Seascapes, and Cityscapes\r\n\r\nART STYLES\r\nContemporary\r\n\r\nYEAR CREATED\r\n2018\r\n\r\nFRAME\r\nThis Artwork is unframed and requires framing.', 'ARTIST Rozen Sotomayor \r\n\r\nLOCATION Pagbilao, Phil', 1),
(81, 'Purest of Pain-25.jpeg', 'Purest of Pain', 8500, 4, 'Decorative', 'About the Artwork\r\n“Although the world is full of suffering, it\'s also full of the overcoming of it.”\r\n\r\nMEDIUM\r\nAcrylic on Canvas\r\n\r\nSUBJECT\r\nEveryday Life\r\n\r\nART STYLES\r\nDocumentary, Contemporary\r\n\r\nYEAR CREATED\r\n2018\r\n\r\nFRAME\r\nThis Artwork is unframed and requires framing.', 'ARTIST Beverly Novillos \r\n\r\nLOCATION Tarlac City, ', 1),
(82, 'Wawa Dam Reservoir-33.jpg', 'Wawa Dam Reservoir', 22846, 4, 'Oil Canvas', 'About the Artwork\r\nMajestic morning view of the Wawa Dam Reservoir in Montalban, Rizal\r\n\r\nMEDIUM\r\nOil on Canvas\r\n\r\nSUBJECT\r\nLand, Sea, and Cityscapes\r\n\r\nART STYLES\r\nPhotorealism, Realism, Contemporary\r\n\r\nYEAR CREATED\r\n2020\r\n\r\nFRAME\r\nThis Artwork is unframed and requires framing.', 'ARTIST Joemarie Barros \r\n\r\nLOCATION Cainta, Philip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `art_id`) VALUES
(53, 1, 73),
(56, 1, 75);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `order_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `items` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `phone` int(11) NOT NULL,
  `not_show` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='for user who wants to order';

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`order_id`, `fullname`, `address`, `zipcode`, `city`, `country`, `items`, `total`, `user_id`, `date`, `phone`, `not_show`) VALUES
(1, 'Restittuto Ochea', 'Basak LLC', 6015, 'Lapu-Lapu', 'Philippines', 3, 323232, 1, '2021-12-09', 0, 1),
(2, 'Restituto Amistoso. Ochea', 'Sudtonggan basak LLC', 6015, 'Lapu-lapu', 'Philippines', 3, 31758, 1, '2021-12-09', 2323, 0),
(3, 'Rodrigo Duterte', 'MAnila', 232, 'Davao', 'Philippines', 2, 2555, 6, '2021-12-09', 0, 0),
(4, 'Resty Ochea', 'Basak Lapu-lapu city', 6015, 'Lapu-lapu', 'Philippines', 4, 34697, 1, '2021-12-09', 0, 1),
(5, 'Resty Ochea', 'Basak Lapu-lapu city', 6015, 'Lapu-lapu', 'Philippines', 4, 34697, 1, '2021-12-09', 0, 1),
(6, 'Resty Ochea', 'Basak Lapu-lapu city', 6015, 'Lapu-lapu', 'Philippines', 5, 57940, 1, '2021-12-09', 0, 0),
(7, 'Resty Ochea', 'Basak Lapu-lapu city', 6015, 'Lapu-lapu', 'Philippines', 5, 57940, 1, '2021-12-09', 0, 1),
(8, 'Resty Ochea', 'Basak Lapu-lapu city', 6015, 'Lapu-lapu', 'Philippines', 5, 57940, 1, '2021-12-09', 0, 0),
(9, 'christian dave', 'basak llc', 2323, 'lapu-lapu', 'philippines', 4, 21828, 5, '2021-12-09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(59) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(21, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'fggfgf'),
(22, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'fggfgf'),
(23, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'fggfgf'),
(24, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'fggfgf'),
(25, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'dsdsds'),
(26, 'Resty Ochea', 'restyochea@gmail.com', 'dsdsd', 'dsdsdsds'),
(27, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'dsdsds'),
(28, 'Resty Ochea', 'casibanryan@yahoo.com', 'dsd', 'dsd'),
(29, 'Resty Ochea', 'casibanryan@yahoo.com', 'tesys', 'sdsdsdsds');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `fullname`, `username`, `email`, `pword`, `profile`) VALUES
(1, 'Resty Ochea', 'admin', 'casibanryan@yahoo.com', '123', 'Profile-1.jpg'),
(5, 'christian dave', 'chanix', 'chanix@gmail.com', 'admin', 'Profile-61b1caab1833e.jpg'),
(6, 'resty', 'resty', 'restyochea@gmail.com', '123', 'Profile-61b1d0c7f0259.jpg'),
(7, 'Karylle Mae Miano', 'admin', 'admin@yahoo.com', 'admin', ''),
(8, 'Renan Ochea', 'renan', 'renan@yahoo.com', 'hesoyam', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `artwork_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `artwork` (`art_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
