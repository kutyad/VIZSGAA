-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 17. 00:05
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Férfi';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWomenProducts` ()   BEGIN
    SELECT * FROM products WHERE gender = 'Nő';
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

DELIMITER ;

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
(1, 'Cipzáros kapucnis felső Loose Fit', 8495, 'uploads/030eb2348575a7a7edccae63eaf03903.png', 'uploads/8a634155aad10789727ef0d73ea11816.jpeg', 'uploads/f1e621cd63f4e1b733151372ffddc6ab.jpeg', 'uploads/8a634155aad10789727ef0d73ea11816.jpeg', 50, 50, 50, 50, 50, 'Férfi', 'Kabátok & Pulóverek', '2025-02-16 16:53:57'),
(3, 'Fekete JACK & JONES Télikabát \'JPRCCBolton\'', 41990, 'uploads/abb5c44ffd871c8643beb5f7c947ebf2.jpg', 'uploads/b02df4e55016154f8c7c9c0617f43aa9.jpg', 'uploads/b2637945682939029abd05e560bc8847.jpg', 'uploads/89645867c3be46e8eb33444e92188a2d.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Kabátok & Pulóverek', '2025-02-16 16:53:57'),
(4, 'Fehér Polo Ralph Lauren Regular fit Ing', 56990, 'uploads/dc069bbf04fc38de163e0bdebbb18394.png', 'uploads/d4c798a217442bfea3f0fb89416a68c6.jpg', 'uploads/519b00c76449e34446cc490c0c335ba2.jpg', 'uploads/0a48e866131319ddad7d888f5f91ca31.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-16 17:00:01'),
(8, 'Fekete G-STAR Póló \'Lash\'', 12490, 'uploads/7d0070b3c97845484bbc9695b9770e64.png', 'uploads/d92af3eef8bf940405e23b11076a0687.jpg', 'uploads/bb95b254ee28db00ade37eff102384a2.jpg', 'uploads/4c9b18e6130c05d23e06529d269cbcf2.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-16 22:11:42'),
(9, 'JACK & JONES Slimfit Chino nadrág', 26990, 'uploads/76ca487808f323449281c45f453d4ab7.jpg', 'uploads/4836a9023b13b3cd8329738a47cb13e4.jpg', 'uploads/a99c2797bf67c3c584650f3b046e9d41.jpg', 'uploads/26c71d4430b99c8fb6787ed8e0dfa0d0.png', 50, 50, 50, 50, 50, 'Férfi', 'Nadrágok & Rövidnadrágok', '2025-02-16 22:15:42'),
(10, 'Piszkosfehér HOLLISTER Szabványos Nadrág', 16490, 'uploads/256ae4c42ad57a74973f8257b486f10a.jpg', 'uploads/f27b1ec7307b1dfd02fe6b633a62669d.png', 'uploads/7c0e8336c2079ecab3f78c596c2d1e8c.jpg', 'uploads/ce7c6fca730b80db3a55a37974d6dee7.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Nadrágok & Rövidnadrágok', '2025-02-16 22:20:29'),
(11, 'Fekete JACK & JONES Slim fit Ing \'Cardiff\'', 14490, 'uploads/91ef05ec7e9671c1ade6a9ba054ffb87.jpg', 'uploads/44e48ef13e52fa99dc632a21f570ee7b.jpg', 'uploads/9d3f37d5aabca147462e1ce170d15647.jpg', 'uploads/71b2e543551d64e53fbc2de598873c67.jpg', 50, 50, 50, 50, 50, 'Férfi', 'Ingek & Pólók', '2025-02-17 00:00:58');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
