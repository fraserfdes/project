-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 06:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(20) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author_email` varchar(40) NOT NULL,
  `cover_picture` varchar(30) NOT NULL,
  `dt_publish` date NOT NULL,
  `review` varchar(255) NOT NULL,
  `isbn_number` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `type` int(4) NOT NULL,
  `rating` int(10) NOT NULL,
  `is_paperback` tinyint(1) NOT NULL,
  `is_hardback` tinyint(1) NOT NULL,
  `is_ebook` tinyint(1) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `dt_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author_email`, `cover_picture`, `dt_publish`, `review`, `isbn_number`, `price`, `type`, `rating`, `is_paperback`, `is_hardback`, `is_ebook`, `in_stock`, `dt_modified`) VALUES
(32, 'Think and Grow Rich', 'np@gamil.com', 'think.jpg', '2020-09-01', 'Think and Grow Rich was written by Napoleon Hill in 1937 and promoted as a personal development and self-improvement book. He claimed to be inspired by a suggestion from business magnate and later-philanthropist Andrew Carnegie', '0-7475-3269-9', 222, 1, 22, 1, 1, 1, 1, '2020-09-02 02:04:31'),
(34, 'Superman', 's@gmail.com', 'super.jpg', '2015-06-10', 'he strip proved so popular that National launched Superman into his own self-titled comic book, the first for any superhero, premiering with the cover date Summer 1939. Between 1986 and 2006 it was retitled The Adventures of Superman while a new series us', '9780446303569', 67, 2, 5, 0, 0, 1, 1, '2020-09-02 02:07:29'),
(37, 'Sorry for your loss', 'kjl@gmail.coml', 'sss.jpg', '2020-08-31', 'great', '1234567890123', 22, 2, 4, 1, 0, 0, 1, '2020-09-02 03:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `bkcat_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`bkcat_id`, `book_id`, `cat_id`) VALUES
(1, 32, 1),
(3, 34, 6),
(7, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(20) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category`) VALUES
(1, 'Fantasy'),
(2, 'Fiction'),
(3, 'Romance'),
(4, 'Education'),
(5, 'Fashion'),
(6, 'Comics'),
(7, 'Myster'),
(8, 'Thriller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`bkcat_id`),
  ADD KEY `book_categories_ibfk_3` (`book_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `bkcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `book_categories_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `book_categories_ibfk_4` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
