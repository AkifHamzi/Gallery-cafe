-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 12:54 PM
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
-- Database: `gallery_cafe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_reservations`
--

CREATE TABLE `car_reservations` (
  `car_reservation_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_time` time NOT NULL,
  `entry_date` date NOT NULL,
  `exit_date` date NOT NULL,
  `reservation_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_reservations`
--

INSERT INTO `car_reservations` (`car_reservation_id`, `name`, `email`, `phone`, `vehicle_no`, `vehicle_type`, `check_in_time`, `check_out_time`, `entry_date`, `exit_date`, `reservation_status`) VALUES
(1, 'Akif Ali', 'akif@mail.com', '0761228122', 'BIM 6659', 'Car', '05:45:00', '19:00:00', '2024-07-31', '2024-07-31', 'cancelled'),
(2, 'Dhanushka', 'dhanushka@mail.com', '0724561234', 'CAA - 5555', 'Jeep', '08:24:00', '13:20:00', '2024-07-29', '2024-07-29', 'confirmed'),
(3, 'Shukry Ansar', 'shukry566@gmail.com', '0776116569', 'CAS - 6576', 'Jeep', '18:00:00', '20:00:00', '2024-07-30', '2024-07-30', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `category`, `details`, `image`) VALUES
(1, 'Live music night', 'event', 'Join us every Friday evening for live music featuring local bands and artists. Enjoy great food and entertainment to kick off your weekend.', 'eventmusic.png'),
(2, 'Friday game nights', 'event', 'Join us every Friday for an exciting Game Night at The Gallery Cafe! Bring your friends and family for an evening of fun and competition. Enjoy games while savoring delicious snacks and drinks. Prizes await the winners!', 'games.png'),
(3, 'Happy hour special', 'promotion', 'Enjoy 50% off on selected drinks and appetizers every weekday from 4 PM to 6 PM.', 'promotionlabourday.png'),
(4, 'Loyalty program', 'promotion', 'Sign up for our loyalty program and earn points with every purchase. Redeem points for free meals and exclusive offers.\r\n', 'promotionloyalty.jpg'),
(5, 'Date night package', 'promotion', 'Book a table for two and receive a complimentary dessert and a glass of wine with any main course ordered.', 'promotiondate.jpg'),
(6, 'Family discounts', 'promotion', 'Bring the whole family and enjoy a special family platter with a mix of our best dishes at a discounted price. Available for groups of four or more.', 'promotionfamily.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(1, 'Khabsa', 'Arabic', 'Khabsa is a delicious arabic meal', 900, 'arabic_cuisine.jpg'),
(2, 'Fattoush', 'Arabic', 'Fattoush is a vibrant and refreshing Middle Eastern salad featuring crispy pita bread, fresh vegetables, and a tangy lemon-sumac dressing. Perfect for a light and healthy meal!', 1200, 'fattoush.png'),
(3, 'Hummus', 'Arabic', 'Hummus is a creamy and savory Middle Eastern dip made from blended chickpeas, tahini, lemon juice, and garlic. Perfect for pairing with pita bread or fresh vegetables.', 750, 'hummus.png'),
(4, 'Shawarma', 'Arabic', 'A flavorful Middle Eastern dish featuring marinated meat, roasted on a vertical spit and thinly sliced. Served in a warm pita with fresh vegetables and a drizzle of tahini or garlic sauce.', 1300, 'shawarma.png'),
(5, 'Biriyani', 'Indian', 'Biriyani is a fragrant and flavorful rice dish from South Asia, made with basmati rice, tender meat or vegetables, and a blend of aromatic spices. Often garnished with fried onions, fresh herbs, and boiled eggs, it&#39;s a feast for the senses.', 1000, 'biriyani.jpg'),
(6, 'Butter chicken', 'Indian', 'Butter Chicken is a rich and creamy Indian dish featuring tender chicken pieces simmered in a luscious tomato-based sauce infused with aromatic spices and butter. Perfectly paired with naan or rice, it’s a crowd favorite for its flavorful and comforting taste.', 2600, 'butter-chicken.jpg'),
(7, 'Chicken pakora', 'Indian', 'Chicken Pakora is a popular Indian appetizer made by coating marinated chicken pieces in a spiced chickpea flour batter and deep-frying them to golden perfection. Crispy on the outside and tender on the inside, they are perfect for dipping in mint chutney.\r\n\r\n', 1200, 'chicken-pakora.jpg'),
(8, 'Naan rotti', 'Indian', 'Naan Rotti is a soft and pillowy flatbread, traditionally baked in a tandoor oven. This delicious Indian bread is perfect for scooping up curries, dipping in sauces, or enjoying on its own with a pat of butter.', 175, 'naan.jpg'),
(9, 'Samosa', 'Indian', 'Samosa is a popular Indian snack consisting of a crispy pastry filled with a savory mixture of spiced potatoes, peas, and sometimes meat. These delicious triangles are perfect for dipping in tamarind or mint chutney.', 150, 'samosa.jpg'),
(10, 'Chicken Scaripello', 'Italian', 'Chicken Scarpiello is a classic Italian dish featuring succulent chicken pieces sautéed with bell peppers, onions, and mushrooms in a tangy white wine and vinegar sauce. This flavorful dish is often served with potatoes or pasta for a hearty, satisfying meal.', 2800, 'Chicken-Scarpariello.png'),
(11, 'Pizza', 'Italian', 'Pizza is a beloved Italian classic featuring a crispy, thin crust topped with rich tomato sauce, melted cheese, and a variety of fresh ingredients. Whether you prefer classic toppings like pepperoni and mushrooms or gourmet options like prosciutto and arugula, every bite is a delicious experience.', 4500, 'pizza.jpg'),
(12, 'Risotto', 'Italian', 'Risotto is a creamy and comforting Italian rice dish cooked slowly in a savory broth until the grains are tender and infused with flavor. Often enriched with ingredients like mushrooms, seafood, or vegetables, it’s a rich and satisfying meal.', 2500, 'risotto.png'),
(13, 'Spaghetti', 'Italian', 'Spaghetti is a classic Italian pasta dish featuring long, thin strands of pasta served with a variety of savory sauces. From a rich tomato and basil marinara to a creamy Alfredo, spaghetti is a versatile and comforting meal.', 1300, 'spaghetti.png'),
(14, 'Vegetable rotti', 'SriLankan', 'Vegetable Rotti is a savory flatbread made with a mix of finely chopped vegetables and spices, all incorporated into a soft, crispy dough. This flavorful and nutritious bread is perfect for pairing with curries or enjoying on its own.', 200, 'vegetable_rotti.jpg'),
(15, 'Dolphin kotthu', 'SriLankan', 'Dolphin Kotthu is a unique Sri Lankan dish featuring finely chopped rotti stir-fried, aromatic spices, and fresh vegetables. This flavorful and hearty dish offers a distinct taste of traditional Sri Lankan cuisine.', 1350, 'dolphin.jpeg'),
(16, 'Crab curry', 'SriLankan', 'Crab Curry is a spicy and aromatic dish featuring tender crab meat simmered in a rich, coconut-based curry sauce with a blend of flavorful spices. Perfectly paired with rice or bread, this dish brings a taste of tropical heat to your plate.', 3500, 'Crab-curry.png'),
(17, 'Pittu', 'SriLankan', 'Pittu is a traditional Sri Lankan dish made from steamed cylinders of rice flour and grated coconut. Often served with spicy curries or yogurt, it’s a comforting and versatile dish that showcases the flavors of Sri Lankan cuisine.', 450, 'pittu.jpg'),
(18, 'Shrimp fritters', 'SriLankan', 'Shrimp Fritters are crispy and golden bite-sized snacks made from shrimp mixed with a flavorful batter and deep-fried to perfection. Perfect as an appetizer or side dish, they’re often served with a tangy dipping sauce.', 150, 'shrimp-fritters.png'),
(19, 'Pol rotti', 'SriLankan', 'Pol Rotti is a traditional Sri Lankan flatbread made with a mixture of grated coconut and flour. This slightly crispy yet soft bread is often enjoyed with spicy curries or used as a wrap for various fillings.', 100, 'polrotti-with-chillipaste.png'),
(20, 'Rice with polos and dhal', 'SriLankan', 'Rice with Polos and Dhal is a hearty Sri Lankan meal featuring fragrant rice served with Polos (young jackfruit curry) and Dhal (lentil curry). This combination offers a satisfying blend of flavors and textures, perfect for a nourishing and traditional dining experience.', 750, 'polos.jpg'),
(21, 'Coffee', 'Beverages', 'Coffee is a rich and aromatic beverage made from freshly brewed coffee beans. Whether you prefer it black, with milk, or as a creamy cappuccino, coffee is the perfect way to start your day or enjoy a relaxing break.', 150, 'coffee.jpg'),
(22, 'Milk tea', 'Beverages', 'Milk Tea is a soothing and flavorful drink made by blending brewed tea with a splash of milk. Sweetened to taste, this comforting beverage is perfect for a relaxing moment or to accompany your favorite snacks.', 150, 'milk-tea.png'),
(23, 'Water', 'Beverages', 'Water is a refreshing and essential beverage that quenches your thirst and keeps you hydrated. Served chilled or at room temperature, it’s the perfect companion for any meal.', 160, 'water.jpg'),
(24, 'Milkshake', 'Beverages', 'Milk Shake is a creamy and indulgent treat made by blending milk, ice cream, and your favorite flavors or fruits. Whether you choose classic vanilla, rich chocolate, or fruity options, it&#39;s a delightful and refreshing drink perfect for any time of day.', 1200, 'milkshakes.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `rating` int(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `name`, `email`, `message`, `rating`, `image`) VALUES
(1, 0, 'Akif Ali', 'akifali_@outlook.com', 'Had the best dining experience here. ', 5, 'uploads/1722188414_1718639997_aakif.png'),
(2, 0, 'Ayyash', 'abcd@gmail.com', 'I recommend this place, the meals are mouth watering ', 5, 'uploads/1722188510_1718639907_ayyash.png'),
(3, 0, 'Krish', 'krish@mail.com', 'WOW the meal was splendid', 5, 'uploads/1722188570_pic-5.png'),
(4, 0, 'Dhanushka', 'dhanushka@mail.com', 'It was hassle free since they offer parking reservations as well', 5, 'uploads/1722188663_pic-1.png'),
(5, 0, 'Sameera', 'sameera@mail.com', 'Will come again for the pizza, it was tasty', 5, 'uploads/1722188746_1718640178_sameera.png'),
(6, 0, 'Akif Ali', 'akifali_@outlook.com', 'Had the best dining experience here.', 5, 'uploads/1722188876_1718639997_aakif.png');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `special_requests` text NOT NULL,
  `table_capacity` int(11) NOT NULL,
  `reservation_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `name`, `email`, `phone`, `reservation_date`, `reservation_time`, `special_requests`, `table_capacity`, `reservation_status`) VALUES
(1, 4, 'Akif Ali', 'akif@mail.com', '0761228122', '2024-07-29', '13:31:00', '', 2, 'confirmed'),
(2, 4, 'Dhanushka', 'dhanushka@gmal.com', '0785246555', '2024-07-29', '17:58:00', 'Reserve us a table that focuses on the view', 1, 'cancelled'),
(3, 4, 'Shukry Ansar', 'shukry566@gmail.com', '0776116569', '2024-07-31', '02:05:00', '', 3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(1, 'Akif Ali', 'akifali_@outlook.com', '179ad45c6ce2cb97cf1029e212046e81', 'admin', 'Akif.png'),
(2, 'Admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.jpg'),
(3, 'Staff', 'staff@mail.com', '1253208465b1efa876f982d8a9e73eef', 'staff', 'user.jpg'),
(4, 'User', 'user@mail.com', '24c9e15e52afc47c225b757e7bee1f9d', 'user', '1718639997_aakif.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_reservations`
--
ALTER TABLE `car_reservations`
  ADD PRIMARY KEY (`car_reservation_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_reservations`
--
ALTER TABLE `car_reservations`
  MODIFY `car_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
