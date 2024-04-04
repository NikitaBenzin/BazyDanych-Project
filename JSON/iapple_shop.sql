-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 02:13 PM
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
-- Database: `iapple_shop`
--
CREATE DATABASE IF NOT EXISTS `iapple_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `iapple_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_number` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `total_amount` varchar(10) NOT NULL,
  `products_id` text NOT NULL,
  `products_amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Table with order information';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_number`, `session_id`, `address`, `phone_number`, `pay_method`, `total_amount`, `products_id`, `products_amount`) VALUES
(18, '6609662b32818', 'Sadova 50 / 50 | Oswiecim 32-600', '+48537139732', 'Gotówka przy odbiorze', '4099 ', '[\"18\"]', '[\"1\"]');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `preview_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `branded` tinyint(1) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Table with products information';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `preview_name`, `description`, `price`, `discount`, `quantity`, `branded`, `category_id`) VALUES
(1, 'Przezroczyste etui z MagSafe do iPhone’a', 'Przezroczyste', 'Smukłe, lekkie i świetnie leżące w dłoni etui Apple chroni iPhone’a 15, nie zasłaniając pięknej, kolorowej obudowy.\r\n\r\nZastosowanie mieszanki przezroczystego poliwęglanu i elastycznych materiałów pozwoliło na dokładne dopasowanie kształtu do przycisków, żeby wygodnie się ich używało. Odporna na zadrapania powłoka pokrywa zarówno zewnętrzną, jak i wewnętrzną powierzchnię etui. Wszystkie materiały i powłoki są też optymalnie zabezpieczone przed żółknięciem.\r\n\r\nWbudowane magnesy, które za każdym razem precyzyjnie dopasowują etui do iPhone’a 15, sprawiają, że ładowanie jest szybsze, a inne akcesoria przyłączają się i odłączają niemal magicznie. Etui nie trzeba zdejmować do ładowania. Wystarczy doczepić ładowarkę MagSafe lub położyć iPhone’a na ładowarce z certyfikatem Qi.\r\n\r\nTo etui, jak każde zaprojektowane przez Apple, przeszło tysiące godzin testów na wszystkich etapach projektowania i produkcji. Dzięki temu nie tylko świetnie wygląda, ale też skutecznie chroni iPhone’a przed uderzeniami i zadrapaniami.', 279, 0, 10, 1, 1),
(2, 'Silikonowe etui z MagSafe do iPhone’a', 'Silikonowe', 'Zaprojektowane przez Apple silikonowe etui z MagSafe to doskonała ochrona iPhone’a 15.\r\n\r\nIdealnie gładki, miękki w dotyku silikon sprawia, że telefon świetnie leży w dłoni. A wewnętrzna wyściółka z mikrofibry dodatkowo go chroni.\r\n\r\nEtui ma wbudowane magnesy, które precyzyjnie dopasowują je do iPhone’a 15 i sprawiają, że ładowanie bezprzewodowe jest szybsze, a przyłączanie i odłączanie akcesoriów – niemal magiczne. Nie trzeba go zdejmować do ładowania. Wystarczy doczepić ładowarkę MagSafe lub położyć iPhone’a na ładowarce z certyfikatem Qi.\r\n\r\nTo etui, jak każde zaprojektowane przez Apple, przeszło tysiące godzin testów na wszystkich etapach projektowania i produkcji. Dzięki temu nie tylko świetnie wygląda, ale też skutecznie chroni iPhone’a przed uderzeniami i zadrapaniami.', 279, 35, 10, 0, 1),
(3, 'Etui z tkaniny FineWoven z MagSafe do iPhone’a', 'Z tkaniny', 'Zaprojektowane przez Apple etui z tkaniny FineWoven z MagSafe jest stylowym dopełnieniem Phone’a 15 i zapewnia mu dodatkową ochronę.\r\n\r\nMiękki materiał ma strukturę mikrodiagonalu i przypomina w dotyku zamsz. Ponadto tkaninę FineWoven zaprojektowano z myślą o planecie – jest wykonana z surowców pochodzących w 68 procentach z recyklingu odpadów pokonsumenckich, a jej produkcja wiąże się z dużo mniejszą emisją dwutlenku węgla niż w przypadku produktów ze skóry. Etui błyskawicznie i mocno przywiera do iPhone’a, prawie nie zmieniając jego rozmiarów.\r\n\r\nEtui ma wbudowane magnesy, które precyzyjnie dopasowują je do iPhone’a 15 i sprawiają, że ładowanie bezprzewodowe jest szybsze, a przyłączanie i odłączanie akcesoriów – niemal magiczne. Nie trzeba go zdejmować do ładowania. Wystarczy doczepić ładowarkę MagSafe lub położyć iPhone’a na ładowarce z certyfikatem Qi.\r\n\r\nTo etui, jak każde zaprojektowane przez Apple, przeszło tysiące godzin testów na wszystkich etapach projektowania i produkcji. Dzięki temu nie tylko świetnie wygląda, ale też skutecznie chroni iPhone’a przed uderzeniami i zadrapaniami.\r\n\r\nTo wysokiej jakości, wytrzymałe etui stworzono z myślą o skutecznej ochronie iPhone’a. Wraz z czasem na tkaninie FineWoven mogą pojawić się ślady zużycia, ponieważ jej włókna ulegają ściśnięciu przy normalnym użytkowaniu. Niektóre zarysowania mogą z czasem się zmniejszyć. Interakcje z akcesoriami MagSafe pozostawiają delikatne odciski. Szczegółowe informacje o pielęgnacji materiału znajdziesz tutaj. Jeśli stanowi to dla Ciebie niedogodność, sugerujemy wybór silikonowego lub przezroczystego etui do iPhone’a 15.', 349, NULL, 10, 1, 1),
(10, 'Zasilacz USB-C o mocy 20 W', NULL, '\r\nZasilacz Apple USB‑C o mocy 20 W szybko i sprawnie ładuje urządzenia w domu, w biurze i w podróży. Po sparowaniu z iPhonem 8 lub nowszym pozwala na jego szybkie naładowanie – uzupełnia energię baterii do 50 procent w około 30 minut¹. Używany z iPadem Pro lub iPadem Air zapewnia ich optymalne ładowanie. Pasuje do wszystkich urządzeń z portami USB‑C.', 119, NULL, 10, 0, 2),
(11, 'EarPods (USB‑C)', NULL, 'W odróżnieniu od tradycyjnych okrągłych słuchawek douszne słuchawki EarPods precyzyjnie odzwierciedlają geometrię ucha. Dzięki temu nosi się je wygodniej niż jakiekolwiek inne słuchawki douszne.', 119, NULL, 10, 1, 2),
(12, 'AirPods (2. generacji)', NULL, 'Nowe AirPods to słuchawki bezprzewodowe wymyślone na nowo. Wystarczy wyjąć je z etui ładującego Lightning i są od razu gotowe do działania z Twoim iPhonem, Apple Watch, iPadem lub komputerem Mac.\r\n\r\nAirPods skojarzysz z urządzeniem jednym stuknięciem. Odtąd startują automatycznie i pozostają połączone z odtwarzaczem. AirPods wyczuwają, kiedy masz je w uszach, i przestają grać po wyjęciu.', 699, NULL, 10, 1, 2),
(13, 'Apple Pencil (USB‑C)', NULL, 'Apple Pencil (USB‑C) doskonale nadaje się do notowania, szkicowania, dodawania adnotacji do dokumentów i wielu innych zadań. Działa z precyzją co do piksela i śladowym opóźnieniem, a do tego reaguje na kąt pochylenia. Używa się więc go równie naturalnie, jak ołówka.\r\n\r\nApple Pencil (USB‑C) paruje i ładuje się przez przewód zasilający USB‑C. Przyłącza się magnetycznie do boku iPada, co ułatwia przechowywanie.', 429, 35, 10, 1, 2),
(14, 'Rysik Logitech Crayon do iPada', NULL, 'Logitech Crayon to wszechstronny i precyzyjny co do piksela cyfrowy rysik do iPada. Ma złącze USB-C do ładowania i jest zgodny z apkami, które współpracują z Apple Pencil. W każdym obudzi artystę, a pisze się nim tak naturalnie jak długopisem na papierze.', 379, NULL, 10, 0, 2),
(15, 'Przejściówka z USB‑C na Apple Pencil', NULL, 'Przejściówka z USB‑C na Apple Pencil jest potrzebna do ładowania Apple Pencil (1. generacji) i parowania go z iPadem (10. generacji). Do jednego końca przejściówki należy podłączyć Apple Pencil, a do drugiego – połączony z iPadem przewód USB‑C do ładowania.', 55, NULL, 10, 0, 2),
(16, 'iPhone SE', NULL, 'Sercem iPhone’a SE jest\r\nten sam superszybki czip A15 Bionic,\r\nktóry jest w iPhonie 13.\r\nZ A15 Bionic iPhone prawie wszystko robi lepiej, a apki otwierają się błyskawicznie i działają jak marzenie.\r\nDzięki wydajności grafiki\r\nobraz w grach odświeża się z niesamowitą płynnością.', 2499, NULL, NULL, 1, 3),
(17, 'iPhone’a 13', NULL, 'Żeby osiągnąć neutralność węglową do 2030 roku, iPhone’a 13 sprzedajemy bez zasilacza i słuchawek EarPods. W pudełku znajdziesz przewód z USB‑C na Lightning do szybkiego ładowania zgodny z zasilaczami USB‑C i portami w komputerach.\r\n\r\nZachęcamy do korzystania z przewodów z USB-A na Lightning, zasilaczy i słuchawek, które już masz, a które są zgodne z tymi modelami iPhone’a. Jeśli jednak potrzebujesz nowego zasilacza lub nowych słuchawek od Apple, możesz je dokupić.', 3499, NULL, 0, 1, 3),
(18, 'iPhone’a 14', NULL, '6,7″ lub 6,1″\r\nWyświetlacz Super Retina XDR przypis\r\n—\r\nAluminium i szkło (tył obudowy)\r\nPrzełącznik trybu dzwonka/cichego\r\n—\r\nCzip A15 Bionic\r\nz 5-rdzeniowym GPU\r\nSystem dwóch aparatów\r\nAparat główny 12 MP | Aparat ultraszerokokątny\r\n—\r\nTryb Portret z funkcją kontroli punktu i głębi ostrości\r\n2x\r\nZoom optyczny\r\nAlarmowe SOS\r\nWykrywanie wypadków przypis ³\r\nDo 26 godzin odtwarzania wideo przypis ⁴\r\nLightning\r\nObsługa USB 2\r\nFace ID', 4099, NULL, 10, 1, 3),
(19, 'iPhone 15', NULL, 'Dynamic Island eksponuje alerty i wydarzenia na żywo, żeby Ci nie umknęły, gdy akurat robisz coś innego. Pozwoli najszybciej sterować odtwarzaniem muzyki, zobaczyć, kto dzwoni, i na przykład\r\nsprawdzić status lotu.\r\nNowa, innowacyjna konstrukcja ma tył ze szkła, które w całości nasycono kolorem. Dzięki wzmocnieniu szkła w specjalnym procesie dwukrotnej wymiany jonowej i obudowie z lotniczego aluminium iPhone 15 jest niesamowicie wytrzymały.', 4699, NULL, 10, 1, 3),
(20, 'iPhone 15 Pro', NULL, 'iPhone 15 Pro to pierwszy iPhone o konstrukcji z tytanu klasy lotniczej stosowanego w pojazdach misji kosmicznych na Marsa.\r\nTytan wśród metali. Ma jeden z najlepszych współczynników wytrzymałości do masy, dzięki czemu iPhone Pro jest lżejszy niż kiedykolwiek. Odczujesz różnicę, gdy tylko weźmiesz go do ręki.', 5999, NULL, 10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Table with categories data (images, colors)';

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`product_id`, `category_id`, `product_images`) VALUES
(1, 1, '[\r\n  {\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT203?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1693247981397\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT203_AV4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1693247987113\"\r\n    ]\r\n  }\r\n]'),
(2, 1, '[\r\n  {\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MWND3_SW_COLOR?wid=64&hei=64&fmt=jpeg&qlt=90&.v=1709930967268\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MWND3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1708125477348\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MWND3_AV4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1708125477324\"\r\n    ]\r\n  },\r\n  {\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT0J3_SW_COLOR?wid=64&hei=64&fmt=jpeg&qlt=90&.v=1693010173855\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT0J3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1692999273221\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT0J3_AV4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1692999286778\"  \r\n    ]\r\n  }\r\n]'),
(3, 1, '[\r\n  {\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT3G3_SW_COLOR?wid=64&hei=64&fmt=jpeg&qlt=90&.v=1709930967257\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT3G3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1699565391673\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT3G3_AV4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1699565389029\"\r\n    ]\r\n  },\r\n  {\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT393_SW_COLOR?wid=64&hei=64&fmt=jpeg&qlt=90&.v=1692921498965\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT393?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1693593673969\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MT393_AV4?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1693593674421\"\r\n    ]\r\n  }\r\n]'),
(10, 2, '[\r\n  {\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MU7V2_GEO_EMEA?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1544468120362\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MU7V2_AV2_GEO_EMEA?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1544468115124\"\r\n    ]\r\n  }\r\n]'),
(11, 2, '[\r\n  {\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MTJY3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1692824492931\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MTJY3_AV5?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1692824492474\"\r\n    ]\r\n  }\r\n]'),
(12, 2, '[\r\n{\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MV7N2?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1551489688005\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MV7N2_AV3?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1552508263186\"\r\n    ]\r\n  }\r\n]'),
(13, 2, '[\r\n{\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MUWA3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1695933856697\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MUWA3_AV1?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1695933856900\"\r\n    ]\r\n  }\r\n]'),
(14, 2, '[\r\n{\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/HQ6Q2?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1664910915657\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/HQ6Q2_AV2?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1664910916524\"\r\n    ]\r\n  }\r\n]'),
(15, 2, '[\r\n{\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MQLU3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1666191613710\",\r\n      \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MQLU3_AV2?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1664477824855\"\r\n    ]\r\n  }\r\n]'),
(16, 3, '[\r\n{\r\n    \"color\": \"\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/36/3640925/Smartfon-APPLE-iPhone-SE-2022-5G-Polnoc-1.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/36/3640925/Smartfon-APPLE-iPhone-SE-2022-5G-Polnoc-2.jpg\"\r\n    ]\r\n  }\r\n]'),
(17, 3, '[\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-13-finish-midnight-202108?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1630016969000\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/32/3225298/APPLE_iPhone_13__front_czarny.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/32/3225298/APPLE_iPhone_13__bok_czarny.jpg\"\r\n    ]\r\n  },\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-13-finish-blue-202108?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1630016970000\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/32/3225310/APPLE_iPhone_13__front_niebieski.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/32/3225310/APPLE_iPhone_13__bok_niebieski.jpg\"\r\n    ]\r\n  }\r\n]'),
(18, 3, '[\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/finish-blue-202209?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1660774892141\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/41/4118006/Smartfon-APPLE-14-Plus-Niebieski-1.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/41/4118006/Smartfon-APPLE-14-Plus-Niebieski-2.jpg\"\r\n    ]\r\n  },\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/finish-purple-202209?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1660774892139\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/41/4118082/Smartfon-APPLE-14-Plus-Fioletowy-1.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/41/4118082/Smartfon-APPLE-14-Plus-Fioletowy-2.jpg\"\r\n    ]\r\n  }\r\n]'),
(19, 3, '[\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/finish-green-202309?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1692831507021\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860228/Smartfon-APPLE-iPhone-15-128GB-5G-6.1-Zielony-front-tyl.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860228/Smartfon-APPLE-iPhone-15-128GB-5G-6.1-Zielony-front.jpg\"\r\n    ]\r\n  },\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/finish-black-202309?wid=204&amp;hei=204&amp;fmt=jpeg&amp;qlt=90&amp;.v=1692831506982\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860220/Smartfon-APPLE-iPhone-15-128GB-5G-6-1-Czarny-front-tyl-3.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860220/Smartfon-APPLE-iPhone-15-128GB-5G-6-1-Czarny-front.jpg\"\r\n    ]\r\n  }\r\n]'),
(20, 3, '[\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-pro-finish-bluetitanium-202309?wid=102&amp;hei=102&amp;fmt=jpeg&amp;qlt=95&amp;.v=1692895385157\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860404/Smartfon-APPLE-iPhone-15-Pro-Tytan-blekitny-1.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860404/Smartfon-APPLE-iPhone-15-Pro-Tytan-blekitny-2.jpg\"\r\n    ]\r\n  },\r\n{\r\n    \"color\": \"https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-pro-finish-naturaltitanium-202309?wid=102&amp;hei=102&amp;fmt=jpeg&amp;qlt=95&amp;.v=1692895385156\",\r\n    \"images\": [\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860372/Smartfon-APPLE-iPhone-15-Pro-Tytan-naturalny-1.jpg\",\r\n      \"https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/58/5860372/Smartfon-APPLE-iPhone-15-Pro-Tytan-naturalny-2.jpg\"\r\n    ]\r\n  }\r\n]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `favorites` text DEFAULT NULL,
  `cart` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Table woth user ids and cart products';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `session_id`, `favorites`, `cart`) VALUES
(8, '6609662b32818', '[\"18\"]', '[\"10\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_number`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `category_id_3` (`category_id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `session_id` (`session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `users` (`session_id`);

--
-- Constraints for table `products_category`
--
ALTER TABLE `products_category`
  ADD CONSTRAINT `products_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `products` (`category_id`),
  ADD CONSTRAINT `products_category_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
