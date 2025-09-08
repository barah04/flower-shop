-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 12:46 PM
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
-- Database: `online_flower_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `bouquetes`
--

CREATE TABLE `bouquetes` (
  `Boiqiets_ID` int(11) NOT NULL,
  `Flower_ID` int(11) NOT NULL,
  `Boiqiets_Name` varchar(255) NOT NULL,
  `Boiqiets_Price` decimal(10,2) NOT NULL,
  `bouquete_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bouquetes`
--

INSERT INTO `bouquetes` (`Boiqiets_ID`, `Flower_ID`, `Boiqiets_Name`, `Boiqiets_Price`, `bouquete_img`) VALUES
(1111, 11, 'Rose and Daisy ', 20.00, 'https://cdn.salla.sa/DAzWg/aebf840e-ad0e-4838-9c91-6d80254f773e-500x500-8gzxAdIirdJfWcw0fGNIvWGIzyN0kTrPpSQ6MGrQ.jpg'),
(2222, 22, 'Tulip and Daisy', 20.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYbnitEg9Dw3HJPKvYNDtG42MuFZ31kH-5JVrN3chi1VXZ-PwlJKaXFl6DjX2kHhnOevY&usqp=CAU'),
(3333, 33, 'Lily and Daisy', 20.00, 'https://cdn.shopify.com/s/files/1/0741/2259/2535/files/charming-white-lilies-bouquet-standard_1_1.webp?v=1704569788');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Bouquet_ID` int(11) NOT NULL,
  `Boiqiets_Name` varchar(200) NOT NULL,
  `Quantity_item` int(11) NOT NULL,
  `Message_On_Card` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `Addition` varchar(255) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Item_ID`, `User_ID`, `Bouquet_ID`, `Boiqiets_Name`, `Quantity_item`, `Message_On_Card`, `color`, `Addition`, `Subtotal`, `Created_At`) VALUES
(58, 3, 1111, 'Rose and Daisy', 1, 'اضاءت قلبي بعودتك', 'white', 'Chocolate + 25jod', 45.00, '2025-01-01 17:21:21'),
(72, 5, 2222, 'tulip and Daisy', 2, 'حبينا نصبح عليكي ', 'pink', 'Teddy bear + 10jod', 50.00, '2025-01-01 18:27:22'),
(74, 1, 3333, 'Lily and Daisy', 5, 'happy birthdaay', 'pink', 'Add 10 flower more + 5jod, Teddy bear + 10jod, Chocolate + 25jod', 140.00, '2025-01-03 19:09:38'),
(75, 3, 2222, 'tulip and Daisy', 2, 'جمال الورد من جمالك', 'pink', 'Chocolate + 25jod', 65.00, '2025-01-04 13:11:25'),
(76, 3, 1111, 'Rose and Daisy', 1, 'happy birthday', 'pink', 'Add 10 flower more + 5jod', 25.00, '2025-01-04 13:33:41'),
(79, 5, 3333, 'Lily and Daisy', 2, 'Happy Birthday', 'white', 'Teddy bear + 10jod', 50.00, '2025-01-04 13:38:34'),
(81, 3, 3333, 'Lily and Daisy', 1, 'كل عام وانت بخير', 'red', 'Teddy bear + 10jod', 30.00, '2025-01-07 17:00:01'),
(82, 1, 3333, 'Lily and Daisy', 1, 'عيد سعيد', 'red', 'Teddy bear + 10jod', 30.00, '2025-01-07 17:14:49'),
(83, 12, 2222, 'tulip and Daisy', 1, 'اhi', 'red', '', 20.00, '2025-01-08 18:31:20'),
(85, 13, 2222, 'tulip and Daisy', 2, 'hiii', 'pink', 'Teddy bear + 10jod', 50.00, '2025-01-13 08:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `Flower_ID` int(11) NOT NULL,
  `Flower_Name` varchar(255) NOT NULL,
  `Flower_Decripation` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`Flower_ID`, `Flower_Name`, `Flower_Decripation`, `image_url`, `Created_At`) VALUES
(11, 'Rose', 'It is considered a symbol of love and beauty, characterized by its multiple colors and fragrant smell. It is used in decoration and on romantic occasions.', 'https://i.pinimg.com/736x/52/17/bf/5217bf37413d750fc6833425bfd653bb.jpg', '2024-12-29 19:27:29'),
(22, 'Tulip', 'Tulip:  A beautiful flower that comes in bright colors, expressing spring. It has a distinctive cup-like shape and is considered a symbol of elegance.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6RC8ytGuuzqNEDjnfjoTIQCV7ZKRu3E4UrA&s', '2024-12-29 19:22:26'),
(33, 'Lily', 'Lily: A large, beautiful flower, known for its strong scent. It comes in different colors and is used for decoration and special occasions.', 'https://images.pexels.com/photos/132466/pexels-photo-132466.jpeg?cs=srgb&dl=pexels-inspiredimages-132466.jpg&fm=jpg', '2024-12-29 19:27:29'),
(44, 'Daisy', 'Daisy: A simple yet attractive flower, characterized by its white petals and yellow center. It symbolizes innocence and purity.', 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Leucanthemum_vulgare_close_up.jpg', '2024-12-29 19:27:29'),
(55, 'Orchid', 'Orchid: A strange and beautiful flower, considered one of the rarest flowers. It is characterized by its diverse colors and unique shapes.', 'https://www.rosepedia.com/wp-content/uploads/2016/03/29b489b621ea92a0/orchid-flower-pictures-7.jpeg', '2024-12-29 19:27:29'),
(66, 'Sunflower', 'Sunflower: A large, bright flower that follows the sun, symbolizing happiness and optimism. It is considered a symbol of freedom and joy.', 'https://images.pexels.com/photos/2651796/pexels-photo-2651796.jpeg?cs=srgb&dl=pexels-zszen-2651796.jpg&fm=jpg', '2024-12-29 19:23:06'),
(77, 'Carnation', 'Carnation: A fragrant flower with multiple colors, used in cut flowers and considered a symbol of love and respect.', 'https://cdn.pixabay.com/photo/2016/04/12/18/19/carnation-1325012_640.jpg', '2024-12-29 19:27:29'),
(88, 'Rose Peony', 'Rose Peony: A large flower similar to a rose, characterized by its bright colors and fragrant smell, used in decorations and occasions.', 'https://thumbs.dreamstime.com/b/pink-peony-bloom-petals-leaves-light-grey-background-copy-space-generative-ai-design-instagram-facebook-wall-327469976.jpg', '2024-12-29 19:27:29'),
(99, 'Lavender', 'Lavender: A small, purple flower, known for its fragrant smell and used in the manufacture of perfumes and essential oils.', 'https://photozil.com/wp-content/uploads/2024/06/Fresh-Lavender-Flower-Herb-Display.jpg', '2024-12-29 19:27:29'),
(1010, 'Marigold', 'Marigold: A bright flower with orange and yellow colors, used in decorations and considered a symbol of joy.', 'https://cdn.pixabay.com/photo/2021/08/21/01/27/marigold-6561566_640.jpg', '2024-12-29 19:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Order_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `Deliveryto` text NOT NULL,
  `Subtotal` decimal(10,0) NOT NULL,
  `Payment_Method` varchar(100) NOT NULL,
  `Created_At` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Order_ID`, `User_ID`, `Full_Name`, `Email`, `PhoneNumber`, `Deliveryto`, `Subtotal`, `Payment_Method`, `Created_At`) VALUES
(1, 12, 'batool emad', 'batool@gmail.com', '798653245', 'Irbid', 20, 'credit_card', '2025-01-09 00:12:50'),
(2, 3, 'saja adi', 'saja@gmail.com', '798698532', 'Ma\'an', 135, 'credit_card', '2025-01-09 00:17:16'),
(3, 3, 'saja adi', 'saja@gmail.com', '798698532', 'Aqaba', 110, 'credit_card', '2025-01-11 21:57:14'),
(4, 3, 'saja adi', 'saja@gmail.com', '798698532', 'Karak', 110, 'credit_card', '2025-01-11 21:58:01'),
(5, 13, 'batt', 'batt@gmail.com', '798965230', 'Ma\'an', 50, 'credit_card', '2025-01-13 13:40:45'),
(6, 3, 'saja adi', 'saja@gmail.com', '798698532', 'Ma\'an', 110, 'credit_card', '2025-01-13 14:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_User` int(4) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `Password_UserEmail` varchar(10) NOT NULL,
  `date_birth` date NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `first_name`, `last_name`, `user_phone`, `User_Email`, `Password_UserEmail`, `date_birth`, `gender`, `Created_At`) VALUES
(1, 'Barah', 'AL_Kayali', '0798554863', 'barahALkayali@gmail.com', '1231233', '2003-08-07', 'female', '2025-01-08 15:37:54'),
(3, 'saja', 'adi', '0785682344', 'saja@gmail.com', '159951', '2005-08-26', 'female', '2025-01-08 15:37:29'),
(5, 'sereen', 'Alborein', '0775869498', 'sereen@gmail.com', '147741', '2004-09-11', 'female', '2025-01-08 14:56:52'),
(6, 'shahed', 'alblwi', '0798655265', 'shahed@gmail.com', '123321', '2004-02-11', 'female', '2025-01-08 14:56:52'),
(7, 'براءة', 'الكيالي', '0798654258', 'barahemad@gmail.com', '123456789', '2003-08-07', 'female', '2025-01-08 14:55:45'),
(8, 'saja', 'ali', '0798996584', 'sajaAli@gamil.com', '163163', '2010-05-04', 'female', '2025-01-08 14:57:54'),
(11, 'seham', 'asaad', '0798996584', 'seham@gmail.com', '963258', '2004-08-08', 'female', '2025-01-08 15:05:56'),
(12, 'batool', 'emad', '0798653245', 'batool@gmail.com', '753753', '1997-05-25', 'female', '2025-01-08 15:08:45'),
(13, 'baat', 'vv', '0798653245', 'baat@gmail.com', '1122', '2020-06-13', 'female', '2025-01-13 10:30:32'),
(14, 'sss', 'deee', '0796356982', 'ss@gmail.com', '12345', '2003-01-14', 'female', '2025-01-13 11:39:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bouquetes`
--
ALTER TABLE `bouquetes`
  ADD PRIMARY KEY (`Boiqiets_ID`),
  ADD KEY `Flower_ID` (`Flower_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `Bouquet_ID` (`Bouquet_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`Flower_ID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bouquetes`
--
ALTER TABLE `bouquetes`
  ADD CONSTRAINT `bouquetes_ibfk_1` FOREIGN KEY (`Flower_ID`) REFERENCES `flowers` (`Flower_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Bouquet_ID`) REFERENCES `bouquetes` (`Boiqiets_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
