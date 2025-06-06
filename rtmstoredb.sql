-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 18. 14:36
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `rtmstoredb`
--

DELIMITER $$
--
-- Eljárások
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddToCart` (IN `p_user_id` INT, IN `p_product_id` INT, IN `p_quantity` INT, IN `p_size` VARCHAR(10))   BEGIN
    INSERT INTO cart (user_id, product_id, quantity, size)
    VALUES (p_user_id, p_product_id, p_quantity, p_size);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenIngekPolok` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi' AND category = 'Ingek & Pólók' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenKabatokPuloverek` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi' AND category = 'Kabátok & Pulóverek';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenNadragokRovidnadragok` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi' AND category = 'Nadrágok & Rövidnadrágok' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetNewestMenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi' ORDER BY created_at DESC LIMIT 4;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetNewestWomenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő' ORDER BY created_at DESC LIMIT 4;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductById` (IN `p_product_id` INT)   BEGIN
    SELECT * FROM products WHERE product_id = p_product_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserCart` (IN `p_user_id` INT)   BEGIN
    SELECT c.*, p.product_name, p.product_price, p.product_image_1 
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWomenBluzokPolok` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő' AND category = 'Blúzok & Pólók' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWomenKabatokPuloverek` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő' AND category = 'Kabátok & Pulóverek' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWomenNadragokRovidnadragok` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő' AND category = 'Nadrágok & Rövidnadrágok' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWomenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő' ORDER BY created_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `p_product_name` VARCHAR(255), IN `p_product_price` INT, IN `p_product_image_1` VARCHAR(255), IN `p_product_image_2` VARCHAR(255), IN `p_product_image_3` VARCHAR(255), IN `p_product_image_4` VARCHAR(255), IN `p_product_xs_quantity` INT, IN `p_product_s_quantity` INT, IN `p_product_m_quantity` INT, IN `p_product_l_quantity` INT, IN `p_product_xl_quantity` INT, IN `p_gender` VARCHAR(50), IN `p_category` VARCHAR(255))   BEGIN
    INSERT INTO products (
        product_name, product_price, product_image_1, product_image_2, product_image_3, product_image_4,
        product_xs_quantity, product_s_quantity, product_m_quantity, product_l_quantity, product_xl_quantity,
        gender, category, created_at
    ) VALUES (
        p_product_name, p_product_price, p_product_image_1, p_product_image_2, p_product_image_3, p_product_image_4,
        p_product_xs_quantity, p_product_s_quantity, p_product_m_quantity, p_product_l_quantity, p_product_xl_quantity,
        p_gender, p_category, NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LoginUser` (IN `p_email` VARCHAR(100))   BEGIN
    SELECT user_id, username, password, is_admin FROM users WHERE email = p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PlaceOrder` (IN `p_user_id` INT, IN `p_coupon_code` VARCHAR(50), IN `p_delivery_type` VARCHAR(50), IN `p_salutation` VARCHAR(20), IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_country` VARCHAR(100), IN `p_street` VARCHAR(255), IN `p_house_number` VARCHAR(50), IN `p_zip_code` VARCHAR(20), IN `p_city` VARCHAR(100), IN `p_phone` VARCHAR(20))   BEGIN
  DECLARE orderTotal DECIMAL(10,2);

  SELECT SUM(p.product_price * c.quantity)
    INTO orderTotal
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
   WHERE c.user_id = p_user_id;

  START TRANSACTION;

  INSERT INTO orders
    (user_id, total_amount, coupon_code, delivery_type, salutation,
     first_name, last_name, country, street, house_number,
     zip_code, city, phone)
  VALUES
    (p_user_id, orderTotal, p_coupon_code, p_delivery_type, p_salutation,
     p_first_name, p_last_name, p_country, p_street, p_house_number,
     p_zip_code, p_city, p_phone);
  SET @new_order_id = LAST_INSERT_ID();

  INSERT INTO order_items (order_id, product_id, size, quantity, price)
  SELECT @new_order_id, c.product_id, c.size, c.quantity, p.product_price
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
   WHERE c.user_id = p_user_id;

  UPDATE products p
    JOIN cart c ON p.product_id = c.product_id
   SET
     p.product_xs_quantity = IF(c.size='xs', p.product_xs_quantity - c.quantity, p.product_xs_quantity),
     p.product_s_quantity  = IF(c.size='s',  p.product_s_quantity  - c.quantity, p.product_s_quantity),
     p.product_m_quantity  = IF(c.size='m',  p.product_m_quantity  - c.quantity, p.product_m_quantity),
     p.product_l_quantity  = IF(c.size='l',  p.product_l_quantity  - c.quantity, p.product_l_quantity),
     p.product_xl_quantity = IF(c.size='xl', p.product_xl_quantity - c.quantity, p.product_xl_quantity)
   WHERE c.user_id = p_user_id;

  DELETE FROM cart WHERE user_id = p_user_id;

  COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegisterUser` (IN `p_username` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255))   BEGIN
    INSERT INTO users (username, email, password) VALUES (p_username, p_email, p_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RemoveFromCart` (IN `p_cart_id` INT)   BEGIN
    DELETE FROM cart WHERE cart_id = p_cart_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidateCoupon` (IN `p_code` VARCHAR(50))   BEGIN
    SELECT * FROM coupons WHERE code = p_code;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `size`) VALUES
(70, 23, 10, 1, 's'),
(71, 23, 9, 2, 's');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `discount`) VALUES
(1, 'AKCIO10', 1000.00),
(2, 'NYAR20', 2000.00);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `delivery_type` varchar(50) NOT NULL,
  `salutation` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `coupon_code`, `delivery_type`, `salutation`, `first_name`, `last_name`, `country`, `street`, `house_number`, `zip_code`, `city`, `phone`, `delivered`, `created_at`) VALUES
(1, 1, 54480.00, '', 'home', 'Hölgy', 'a', 'a', 'Magyarország', 'a', 'a', 'a', 'a', 'a', 0, '2025-04-18 01:17:12'),
(2, 1, 16490.00, '', 'home', 'Egyéb', 'b', 'b', 'Magyarország', 'b', 'b', 'b', 'b', 'b', 0, '2025-04-18 01:19:57'),
(3, 1, 524500.00, '', 'home', 'Hölgy', 'Kriszta', 'nagy', 'Magyarország', 'pitypang utca', '10/b', '5432', 'varos', '11111111111', 0, '2025-04-18 01:24:47'),
(4, 1, 10490.00, '', 'home', 'Hölgy', 'v', 'v', 'Magyarország', 'v', 'v', 'v', 'v', 'v', 0, '2025-04-18 01:31:48'),
(5, 23, 12490.00, 'nyar20', 'home', 'Hölgy', 'a', 'a', 'Magyarország', 'a', 'a', 'a', 'a', '11111111111', 0, '2025-04-18 14:04:09'),
(6, 23, 24980.00, 'akcio10', 'home', 'Egyéb', 'kocsis', 'kornél', 'Magyarország', 'pitypang utca', '10/b', '22432', 'varos', '11111111111', 0, '2025-04-18 14:06:43');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `size`, `quantity`, `price`) VALUES
(1, 1, 3, 'xs', 1, 41990.00),
(2, 1, 8, 'xs', 1, 12490.00),
(4, 2, 10, 'l', 1, 16490.00),
(5, 3, 16, 'l', 50, 10490.00),
(6, 4, 18, 'xs', 1, 10490.00),
(7, 5, 8, 's', 1, 12490.00),
(8, 6, 8, 'm', 2, 12490.00);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image_1` varchar(255) NOT NULL,
  `product_image_2` varchar(255) DEFAULT NULL,
  `product_image_3` varchar(255) DEFAULT NULL,
  `product_image_4` varchar(255) DEFAULT NULL,
  `product_xs_quantity` int(11) NOT NULL DEFAULT 0,
  `product_s_quantity` int(11) NOT NULL DEFAULT 0,
  `product_m_quantity` int(11) NOT NULL DEFAULT 0,
  `product_l_quantity` int(11) NOT NULL DEFAULT 0,
  `product_xl_quantity` int(11) NOT NULL DEFAULT 0,
  `gender` enum('Férfi','Nő') NOT NULL,
  `category` enum('Kabátok & Pulóverek','Ingek & Pólók','Nadrágok & Rövidnadrágok','Blúzok & Pólók') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image_1`, `product_image_2`, `product_image_3`, `product_image_4`, `product_xs_quantity`, `product_s_quantity`, `product_m_quantity`, `product_l_quantity`, `product_xl_quantity`, `gender`, `category`, `created_at`) VALUES
(1, 'Cipzáros kapucnis felső Loose Fit', 8495, 'uploads/030eb2348575a7a7edccae63eaf03903.png', 'uploads/8a634155aad10789727ef0d73ea11816.jpeg', 'uploads/f1e621cd63f4e1b733151372ffddc6ab.jpeg', 'uploads/8a634155aad10789727ef0d73ea11816.jpeg', 40, 36, 35, 42, 38, 'Férfi', 'Kabátok & Pulóverek', '2025-02-16 16:53:57'),
(3, 'Fekete JACK & JONES Télikabát \'JPRCCBolton\'', 41990, 'uploads/abb5c44ffd871c8643beb5f7c947ebf2.jpg', 'uploads/b02df4e55016154f8c7c9c0617f43aa9.jpg', 'uploads/b2637945682939029abd05e560bc8847.jpg', 'uploads/89645867c3be46e8eb33444e92188a2d.jpg', 49, 50, 50, 50, 50, 'Férfi', 'Kabátok & Pulóverek', '2025-02-16 16:53:57'),
(4, 'Fehér Polo Ralph Lauren Regular fit Ing', 56990, 'uploads/dc069bbf04fc38de163e0bdebbb18394.png', 'uploads/d4c798a217442bfea3f0fb89416a68c6.jpg', 'uploads/519b00c76449e34446cc490c0c335ba2.jpg', 'uploads/0a48e866131319ddad7d888f5f91ca31.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-16 17:00:01'),
(8, 'Fekete G-STAR Póló \'Lash\'', 12490, 'uploads/7d0070b3c97845484bbc9695b9770e64.png', 'uploads/d92af3eef8bf940405e23b11076a0687.jpg', 'uploads/bb95b254ee28db00ade37eff102384a2.jpg', 'uploads/4c9b18e6130c05d23e06529d269cbcf2.jpg', 49, 49, 48, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-16 22:11:42'),
(9, 'JACK & JONES Slimfit Chino nadrág', 26990, 'uploads/76ca487808f323449281c45f453d4ab7.jpg', 'uploads/4836a9023b13b3cd8329738a47cb13e4.jpg', 'uploads/a99c2797bf67c3c584650f3b046e9d41.jpg', 'uploads/26c71d4430b99c8fb6787ed8e0dfa0d0.png', 50, 50, 50, 50, 50, 'Férfi', 'Nadrágok & Rövidnadrágok', '2025-02-16 22:15:42'),
(10, 'Piszkosfehér HOLLISTER Szabványos Nadrág', 16490, 'uploads/256ae4c42ad57a74973f8257b486f10a.jpg', 'uploads/f27b1ec7307b1dfd02fe6b633a62669d.png', 'uploads/7c0e8336c2079ecab3f78c596c2d1e8c.jpg', 'uploads/ce7c6fca730b80db3a55a37974d6dee7.jpg', 50, 50, 50, 49, 50, 'Férfi', 'Nadrágok & Rövidnadrágok', '2025-02-16 22:20:29'),
(11, 'Fekete JACK & JONES Slim fit Ing \'Cardiff\'', 14490, 'uploads/91ef05ec7e9671c1ade6a9ba054ffb87.jpg', 'uploads/44e48ef13e52fa99dc632a21f570ee7b.jpg', 'uploads/9d3f37d5aabca147462e1ce170d15647.jpg', 'uploads/71b2e543551d64e53fbc2de598873c67.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-17 00:00:58'),
(12, 'Fekete VERO MODA Télikabátok \'VMHALSEY\'', 28990, 'uploads/d48150d8a5eaef2f1d08d8ba65fd8e3c.jpg', 'uploads/d2b7682f694425962b74f8740cf67f4b.jpg', 'uploads/c416be9497a39bb1e534b6020b02552d.jpg', 'uploads/0d7d85abab086411483cc07508eae8e0.jpg', 50, 50, 50, 50, 50, 'Nő', 'Kabátok & Pulóverek', '2025-02-18 21:06:16'),
(13, 'Vegyes Színek ONLY Pulóver \'Atia\'', 13490, 'uploads/3f3951c871331328ea888379e620fad4.jpg', 'uploads/d0ddaadeaae7d269868a8864af056387.jpg', 'uploads/bcd789a09512ecb5738b190c1355c679.jpg', 'uploads/7046c03ca61eaebd7cd1818b5ecd2ac2.jpg', 50, 50, 50, 50, 50, 'Nő', 'Kabátok & Pulóverek', '2025-02-18 21:09:08'),
(15, 'Krém VILA Blúz \'VIChikka\'', 16490, 'uploads/4d441417167dc072198359b8d3987abd.jpg', 'uploads/b12e1380dc31307096332e3311396661.png', 'uploads/8ecca33dc068f741c9487a860cb0fa47.jpg', 'uploads/54d0d95fe36d3358ec5e617b55cc576d.jpg', 50, 50, 50, 50, 50, 'Nő', 'Blúzok & Pólók', '2025-02-18 21:17:58'),
(16, 'Fekete JDY Bő szár Nadrág', 10490, 'uploads/30f9e98049a0bf7ca5dcf433688df7f9.jpg', 'uploads/6d0d5bc3af3d37865f7eb5af00ec0399.png', 'uploads/049cd64259b88784201502d35af285a5.jpg', 'uploads/fa28129f8676ffe3ae463a05c5619727.jpg', 50, 50, 50, 0, 50, 'Nő', 'Nadrágok & Rövidnadrágok', '2025-02-18 21:21:15'),
(17, 'Krém Guido Maria Kretschmer Women Szabványos Nadrág \'Cara\'', 16490, 'uploads/300b05f4a8642bd8afe9274677f0aeb1.jpg', 'uploads/c9170d7945948667fccd4dd96fe40ec7.png', 'uploads/2bc60521e3af7df414667c8f9cd75041.jpg', 'uploads/ad125aeeebe5b79140cdf2e55b639dea.jpg', 50, 50, 50, 50, 50, 'Nő', 'Nadrágok & Rövidnadrágok', '2025-02-18 21:27:53'),
(18, 'Fehér LEVI\'S ® Póló \'PERFECT\'', 10490, 'uploads/9071270cd69fec4ea0f651f1ff036b37.png', 'uploads/c6da258d740511735f2b7deb9b3b88e2.jpg', 'uploads/219d5548de8334cc8bbd9688bda0e33d.jpg', 'uploads/a6762d780372da82691c06275fecccac.jpg', 49, 50, 50, 50, 50, 'Nő', 'Blúzok & Pólók', '2025-02-18 21:37:46'),
(19, 'Fekete b.young Slimfit Chino nadrág \'Days\'', 20490, 'uploads/edcdab9159fa4813a6a76a16ac2bafb4.jpg', 'uploads/f0ae29d3ba2c2415f2c3a18249833095.jpg', 'uploads/3797abd92741d1cb716dff08a7bf014a.jpg', 'uploads/926d1786894da2605f6e57a41586d2b0.jpg', 50, 50, 50, 50, 50, 'Nő', 'Nadrágok & Rövidnadrágok', '2025-03-03 01:44:31');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'a', 'a@gmail.com', '$2y$10$QiO6Jkq6Dfvk8cfuNK9M7ej/AuxjbcIE6SjUAx/Z8TzOjziGqiRZa', 0),
(2, 'admin', 'admin@gmail.com', '$2y$10$47XFEAVdqapL5cGUvc/4WuUTJdMLgfUnCizD7UfANk8RncF2.Rf8O', 1),
(23, 'm', 'm@gmail.com', '$2y$10$JJPU0xhlK3Par3sWQnHNEOu50EZFlEtnND7AamdhUFqJu4bzDaP56', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- A tábla indexei `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT a táblához `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
