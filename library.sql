-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2025 at 10:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `summary` text,
  `status` enum('available','borrowed','reserved') DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category_id`, `cover_image`, `summary`, `status`, `created_at`) VALUES
(15, 'Atomic Habits CHAANGER', 'James EDIT CHANGER', 3, 'https://www.bookganga.com/eBooks/Content/images/books/154c4ec5e1dd4a6aadb88ad57c3dfca6.jpg', 'book for habbits EDIT', 'borrowed', '2025-01-03 09:57:53'),
(16, 'Cashvertising', 'DEREC', 3, 'https://m.media-amazon.com/images/I/81aXfNzyaNL._UF1000,1000_QL80_.jpg', 'book cashvertising', 'borrowed', '2025-01-03 10:03:18'),
(17, 'Livre', 'livre 1', 5, 'https://placehold.co/400x600/orange/red', 'un description', 'available', '2025-01-06 12:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `book_status` enum('Reserved','Borrowed','Returned') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `book_status`) VALUES
(52, 5, 15, '2025-01-03', '2025-01-04', '2025-01-03', 'Returned'),
(53, 5, 15, '2025-01-04', '2025-01-07', NULL, 'Borrowed'),
(54, 7, 16, '2025-01-10', '2025-01-11', '2025-01-06', 'Returned'),
(55, 7, 16, '2025-01-06', '2025-01-07', '2025-01-06', 'Returned'),
(56, 7, 16, '2025-01-11', '2025-01-08', NULL, 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'marketing & business'),
(5, 'Self modifier'),
(6, 'categorie');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `role_id`, `created_at`) VALUES
(1, 'admin', 'Lamlilas Ibrahim', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 1, '2024-12-31 08:14:52'),
(2, 'user1', 'El Mourabit Wassim', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(3, 'user2', 'Fetti Ayoub', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(4, 'user3', 'Ouirghane Lahcen', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(5, 'user4', 'Jebbouri Ayoub', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(6, 'user5', 'Latrach Mohammed', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(7, 'user6', 'Ettaoussi Ilyas', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(8, 'user7', 'Hammaoui Anas', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(9, 'user8', 'El Mokhtari Firdaous', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(10, 'user9', 'Achbab Oussama', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(11, 'user10', 'Guezadi Abdellatif', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(12, 'user11', 'Imouga Younes', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(13, 'user12', 'Mahtaj Issam', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(14, 'user13', 'Filali Zehri Driss', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(15, 'user14', 'Oumha Ayyoub', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(16, 'user15', 'Asfor Dounia', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(17, 'user16', 'Karroumi Mohamed', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(18, 'user17', 'Zouhairi Mohamed', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(19, 'user18', 'Bassam Lahcen', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(20, 'user19', 'Lamrini Fouad', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(21, 'user20', 'ARZIKI Souad', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(22, 'user21', 'Kibous Samira', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(23, 'user22', 'Elyagoubi Mohammed Abdessetar', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52'),
(24, 'user23', 'El Benallali Ikram', '$2y$10$z5hvjVbnx11kyif3UNNtSe73DpyAvCpj5s6oNLJ8GAvPvygqa0AWa', 2, '2024-12-31 08:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','authenticated') DEFAULT 'authenticated',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'anas hammaoui', 'anas@gmail.com', '$2y$10$sXqTfEgU2pHWeuEKznSiuuVQTl.d014J5hJwI7eSacJnGWvuijPpS', 'admin', '2024-12-26 10:00:26'),
(5, 'Yassine', 'user@gmail.com', '$2y$10$ilTo93f4OGzqrDMvsWTU.evLLI4W1OvqC.ccKxUqUKLKmUxrUiX8O', 'admin', '2024-12-29 09:39:33'),
(7, 'user2', 'user2@gmail.com', '$2y$10$nZdq.xpGRMoBiwtoF68bueVuEEFnm3DjRYjPujkjrKSYwDq/ITmJ.', 'authenticated', '2025-01-03 10:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `usrole`
--

CREATE TABLE `usrole` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usrole`
--

INSERT INTO `usrole` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usrole`
--
ALTER TABLE `usrole`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usrole`
--
ALTER TABLE `usrole`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
