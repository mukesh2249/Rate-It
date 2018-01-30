-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2017 at 01:54 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(20, 'ALCATEL'),
(18, 'APPLE'),
(30, 'aqewuriy'),
(23, 'ASUS'),
(28, 'aswin'),
(1, 'AUDI'),
(13, 'BEATS'),
(21, 'BLU'),
(2, 'BMW'),
(6, 'BSA'),
(9, 'CAMPAGNOLO'),
(3, 'DODGE'),
(10, 'GARMIN'),
(8, 'HERCULES'),
(24, 'INSIGNIA'),
(14, 'JBL'),
(31, 'krishna'),
(5, 'LANCER'),
(19, 'LG'),
(4, 'MARUTI'),
(16, 'MICROSOFT XBOX'),
(15, 'MONSTER'),
(22, 'MOTOROLA'),
(26, 'PANASONIC'),
(11, 'SAMSUNG'),
(27, 'SHARP'),
(12, 'SONY'),
(17, 'SONY PLAYSTATION'),
(25, 'TCL'),
(7, 'THUNDERBIRD'),
(29, 'xmvbakj');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `deletedyn` varchar(1) NOT NULL,
  `image` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `deletedyn`, `image`) VALUES
(1, 'Car', '', 'audia8.jpg'),
(2, 'Cycle', '', ''),
(3, 'TV', '', ''),
(4, 'Electronics', '', ''),
(5, 'Mobiles', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(20, ' brake wires'),
(5, 'A backup camera'),
(16, 'a basket on the front '),
(19, 'a covered chain'),
(18, 'a lock and chain'),
(17, 'adjustable seat '),
(11, 'android'),
(14, 'athletic'),
(4, 'Automatic emergency braking'),
(10, 'Automatic high beams'),
(7, 'Blind-spot monitoring'),
(8, 'Bluetooth connectivity'),
(1, 'Comfortable seats'),
(12, 'czxcvasidfyis'),
(23, 'easy mount and dismount'),
(3, 'Forward-collision warning'),
(9, 'Head-up displays'),
(2, 'Power driver seat '),
(21, 'protect clothing'),
(6, 'Rear cross-traffic alert'),
(24, 'safety bell'),
(22, 'step-through frame '),
(15, 'three gears'),
(13, 'vcamnsdfqwehriqwer');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `subcategoryid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `content` longtext NOT NULL,
  `deletedyn` varchar(1) NOT NULL,
  `images` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `categoryid`, `subcategoryid`, `brandid`, `price`, `date`, `content`, `deletedyn`, `images`) VALUES
(1, 'AUDI A8', 1, 1, 1, 2000, '2017-11-27', 'The Audi A8 is a four-door, full-size, luxury sedan manufactured and marketed by the German automaker Audi since 1994. Succeeding the Audi V8, and now in its third generation, the A8 has been offered with both front- or permanent all wheel drive and in short and long wheelbase variants. The first two generations employed the Volkswagen Group D platform, with the current generation deriving from the MLB platform. After the original models 1994 release, Audi released the second generation in late 2002, and the third and current iteration in late 2009.', '', 'audia8.jpg'),
(2, 'BMW i8', 1, 1, 2, 2500, '2017-11-27', 'The BMW i8 is a plug-in hybrid sports car developed by BMW. The i8 is part of BMW electric fleet Project i being marketed as a new sub-brand, BMW i. The 2015 model year BMW i8 has a 7.1 kWh lithium-ion battery pack that delivers an all-electric range of 37 km (23 mi) under the New European Driving Cycle. Under the United States Environmental Protection Agency cycle, the range in EV mode is 24 km (15 mi) with a small amount of gasoline consumption. Its design is heavily influenced by the M1 Hommage Concept car, which in turn pays homage to BMW last production sports car prior to the i8: the BMW M1.', '', 'bmwi8.jpg'),
(3, 'DODGE CHARGER', 1, 2, 3, 1500, '2017-11-27', 'The Dodge Charger is a brand of automobile marketed by Dodge. The first Charger was a show car in 1964. There have been several different production Chargers, built on three different platforms and sizes. In the U.S., the Charger nameplate has been used on subcompact hatchbacks, full-sized sedans, and personal luxury coupes. The current version is a four-door sedan.', '', 'dodgecharger.jpg'),
(4, 'MARUTI BALENO', 1, 3, 4, 1000, '2017-11-27', 'The Suzuki Baleno is a compact car produced by the Japanese manufacturer Suzuki since 2015. Prior to this, the Baleno name had been applied to the Suzuki Cultus Crescent in numerous export markets.\r\nThe car was unveiled at the Frankfurt Motor Show in September 2015,[3][4] and was launched in India on October 24, 2015 and in Japan on March 9, 2016.[5] It became available in Europe in April 2016[5] and in Indonesia on August 10, 2017 at the 25th Gaikindo Indonesia International Auto Show.', '', 'marutibaleno.jpg'),
(5, 'MITSUBISHI LANCER', 1, 4, 5, 2000, '2017-11-27', 'The Mitsubishi Lancer is a compact car produced by the Japanese manufacturer Mitsubishi since 1973. It has been marketed as the Colt Lancer, Dodge/Plymouth Colt, Chrysler Valiant Lancer, Chrysler Lancer, Eagle Summit, Hindustan Lancer, Soueast Lioncel, and Mitsubishi Mirage in various countries at different times, and has been sold as the Mitsubishi Galant Fortis in Japan since 2007. It has also been sold as Mitsubishi Lancer Fortis in Taiwan with a different facelift than the Galant Fortis. In Japan, it was sold at a specific retail chain called Car Plaza.', '', 'lancer.jpg'),
(9, 'camnsdf', 1, 1, 30, 123, '2017-12-03', 'hkasjdfhk', 'y', ''),
(10, 'kg', 1, 1, 31, 123, '2017-12-03', 'aswin', '', 'kg.jpg'),
(11, 'MUKESH CYCLE', 2, 8, 6, 2000, '2017-12-19', '', '', ''),
(12, 'Hercules 1.0', 2, 8, 8, 500, '2017-11-14', 'They have a light frame, medium gauge wheels, and derailleur gearing, and feature straight or curved-back, touring handlebars for more upright riding and a hybrid with all the accessories necessary for bicycle touring - mudguards, pannier rack, lights etc', '', 'hercules.jpg'),
(13, 'BSA bicycle', 2, 8, 6, 300, '2017-12-04', 'It designed specifically for commuting over short or long distances. It typically features derailleur gearing, 700c wheels with fairly light 1.125-inch (28 mm) tires, a carrier rack, full fenders, and a frame with suitable mounting points for attachment of various load-carrying baskets or panniers. It sometimes, though not always, has an enclosed chainguard to allow a rider to pedal the bike in long pants without entangling them in the chain', '', 'bsa.jpg'),
(14, 'Hercules 2.0', 2, 8, 6, 200, '2017-11-20', 'it optimized for the rough-and-tumble of urban commuting. The city bike differs from the familiar European city bike in its mountain bike heritage', '', 'bsa2.jpg'),
(15, 'Hercules 3.0', 2, 8, 8, 600, '2017-12-04', 'It usually features mountain bike-sized (26-inch) wheels, a more upright seating position, and fairly wide 1.5 - 1.95-inch (38 – 50 mm) heavy belted tires designed to shrug off road hazards commonly found in the city,', '', 'her1.jpg'),
(16, 'Hercules 4.0', 2, 8, 8, 1000, '2017-12-01', 'Using a sturdy welded chromoly or aluminum frame derived from the mountain bike, the city bike is more capable at handling urban hazards such as deep potholes, drainage grates, and jumps off city curbs.', '', 'her2.jpg'),
(17, 'Hercules 5.0', 2, 8, 8, 800, '2017-12-05', 'City bikes are designed to have reasonably quick, yet solid and predictable handling, and are normally fitted with full fenders for use in all weather conditions.', '', 'her3.jpg'),
(18, 'Hercules 6.0', 2, 8, 8, 1800, '2017-12-01', 'A few city bikes may have enclosed chainguards, while others may be equipped with suspension forks, similar to mountain bikes. City bikes may also come with front and rear lighting systems for use at night or in bad weather.', '', 'her4.jpg'),
(19, 'BSA Bicycle 2.0', 2, 8, 6, 700, '2017-12-04', 'Comfort bikes typically incorporate such features as front suspension forks, seat post suspension with wide plush saddles, and drop-center, angled North Road style handlebars designed for easy reach while riding in an upright position.', '', 'bsa2.jpg'),
(20, 'BSA bicycle 3.0', 2, 8, 6, 300, '2017-12-03', ' kind of cargo bicycle designed for carrying loads on a platform rack attached to the fork', '', 'bsa4.jpg'),
(21, 'BSA bicycle 4.0', 2, 8, 6, 600, '2017-12-05', 'a type of bicycle (specifically a type of longbike) with a longer than usual frame wheelbase at the rear compared to a standard utility bicycle.', '', 'bsa5.jpg'),
(22, 'BSA bicycle 6.0', 2, 8, 6, 200, '2017-11-13', 'designed for off-road cycling. All mountain bicycles feature sturdy, highly durable frames and wheels, wide-gauge treaded tires, and cross-wise handlebars to help the rider resist sudden jolts.', '', 'bsa7.jpg'),
(23, 'Hercules 7.0', 2, 8, 8, 1500, '2017-12-08', 'Mountain bicycle gearing is often very wide-ranging, from very low ratios to mid ratios, typically with 16 to 28 gears, although some riders prefer the mechanical simplicity and ease of maintenance of single-speed mountain bikes.', '', 'her8.jpg'),
(24, 'Hercules 8.0', 2, 8, 8, 800, '2017-12-04', 'heavy framed bicycles designed for comfort, with curved back handlebars, padded seats, and balloon tires. They are also called beach bikes or boulevardiers and are designed for comfortable travel', '', 'her9.jpg'),
(25, 'Hercules 10.0', 2, 8, 6, 750, '2017-12-04', 'Cruisers were the bicycle standard in the United States from the 1930s until the 1950s. The traditional cruiser is single-speed with coaster brakes, but modern cruisers come with three to seven speeds. Aluminum frames have recently been used in Cruiser construction, lowering weight. Cruisers typically have minimal gearing and are often available for rental at beaches and parks which feature flat terrain.', '', 'her10.jpg'),
(26, 'BSA bicycle 10.0', 2, 8, 6, 300, '2017-12-04', 'transmission used either to power the vehicle unassisted, or to assist with pedaling. Since it always retains both pedals and a discrete connected drive for rider-powered propulsion, the motorized bicycle is in technical terms a true bicycle, albeit a power-assisted one. However, for purposes of governmental licensing and registration requirements, the type may be legally defined as a motor vehicle, motorcycle, moped, or a separate class of hybrid vehicle. Powered by a variety of engine types and designs, the motorized bicycle formed the prototype for what would later become the motorcycle.', '', 'bsa11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `featureid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`id`, `productid`, `featureid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 7),
(5, 2, 8),
(6, 2, 4),
(7, 3, 3),
(8, 3, 10),
(9, 3, 9),
(10, 4, 1),
(11, 4, 2),
(12, 4, 10),
(13, 5, 6),
(14, 5, 5),
(15, 5, 9),
(17, 9, 13),
(18, 10, 14),
(19, 11, 14),
(20, 11, 11),
(21, 13, 16),
(22, 20, 17),
(23, 13, 18),
(24, 21, 18),
(25, 12, 16),
(26, 14, 23),
(27, 15, 20),
(28, 16, 10),
(29, 17, 21),
(30, 18, 24),
(31, 24, 4),
(32, 23, 22),
(33, 19, 17),
(34, 22, 20),
(35, 26, 18),
(36, 21, 15),
(37, 15, 21),
(38, 17, 19),
(39, 25, 16),
(40, 18, 17);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `feedback` longtext NOT NULL,
  `datereviewed` datetime NOT NULL,
  `deletedyn` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `productid`, `userid`, `rating`, `feedback`, `datereviewed`, `deletedyn`) VALUES
(1, 1, 1, 1, '0', '2017-11-05 00:00:00', ''),
(2, 2, 1, 5, 'Very Good!', '2017-11-15 00:00:00', ''),
(3, 3, 3, 1, 'Poor', '2017-11-29 00:00:00', ''),
(4, 4, 3, 3, 'Okayish', '2017-11-11 00:00:00', ''),
(5, 5, 4, 4, 'Good!', '2017-11-21 00:00:00', ''),
(6, 1, 3, 1, '0', '2017-11-04 00:00:00', ''),
(7, 1, 2, 3, 'Finally I got it workedddddddddd', '2017-12-06 02:58:27', ''),
(9, 5, 3, 3, 'Looks good', '0000-00-00 00:00:00', ''),
(10, 1, 15, 4, 'Mukesh Kumarrrrrrrrrrrrqwasasasas', '2017-12-02 11:08:55', 'Y'),
(11, 1, 14, 2, 'mukesh kumar', '2017-12-02 10:35:18', ''),
(12, 5, 14, 3, 'saassasa', '2017-12-02 00:00:00', ''),
(13, 2, 14, 3, 'asasssssssssssssssssssss', '2017-12-02 00:00:00', ''),
(14, 4, 14, 3, 'ssssssssssssssssssssssssssssssss', '0000-00-00 00:00:00', ''),
(20, 1, 16, 2, 'nmbasdft435', '2017-12-03 09:36:31', ''),
(21, 10, 16, 4, 'jhgjhgjgkjh', '2017-12-03 02:30:00', ''),
(22, 11, 2, 4, 'CHeckingg it form me', '2017-12-04 00:00:00', ''),
(24, 1, 5, 5, 'bu firsat icin tesekkurler\r\n', '2017-12-06 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rolename` varchar(400) NOT NULL,
  `adminrights` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rolename`, `adminrights`) VALUES
(1, 'user', 'N'),
(2, 'admin', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `deletedyn` varchar(1) NOT NULL,
  `image` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `name`, `deletedyn`, `image`) VALUES
(1, 1, 'Luxury car', '', ''),
(2, 1, 'Compact car', '', ''),
(3, 1, 'Economy car', '', ''),
(4, 1, 'Roadster', '', ''),
(5, 1, 'Cargo van', '', ''),
(6, 2, 'Tandem', '', ''),
(7, 2, 'GEAR CYCLE', '', ''),
(8, 2, 'BICYCLE', '', ''),
(9, 2, 'Tricycle', '', ''),
(10, 3, 'LED TV', '', ''),
(11, 3, 'LCD TV', '', ''),
(12, 3, 'SMART TV', '', ''),
(13, 3, 'Plasma Display Panels', '', ''),
(14, 3, 'Digital Light Processing', '', ''),
(15, 3, 'Cathode ray tube', '', ''),
(16, 4, 'HEADPHONES', '', ''),
(17, 4, 'EARPHONES', '', ''),
(18, 4, 'SPEAKER', '', ''),
(19, 4, 'SMARTWATCH', '', ''),
(20, 4, 'MOUSE', '', ''),
(31, 5, 'Camera Phones', '', ''),
(32, 5, 'Smart Phones', '', ''),
(33, 5, 'Music Phones', '', ''),
(34, 5, '4G PHONES', '', ''),
(35, 5, 'TABLET PHONE', '', ''),
(41, 1, 'kg', '', 'kg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `fname` varchar(400) NOT NULL,
  `lname` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `roleid` int(11) NOT NULL,
  `review_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `password`, `email`, `roleid`, `review_count`) VALUES
(1, 'mukesh', 'mukesh', 'g s', 'mukesh', 'mukesh2249@gmail.com', 1, 0),
(2, 'mukesh1', 'm', 'm', '$2y$12$k3O7grv1quHyJ5mMbFCopexsWb5tIfBtthH8wb/EijgkoGhi6g9x.', 'a@a.c', 1, 0),
(3, 'mukesh123', 'm', 'm', '$2y$12$T1HdZyuKir6ju4cyP5jrNuMzmQO6tZTn4SKETL8JSPykdljT/pV7y', 'b@a.c', 1, 0),
(4, 'mukeshabc', 'mukesh', 'kumar', '$2y$12$sW/2IDdSjxMws05CwTnBPeiCEvQIRkewfk706VBSXvnT1roWDzTqu', 'mukesh123@gmail.com', 1, 0),
(5, 'mukesh456', 'mukesh', 'kumar', '$2y$12$N11yTZuLDmi6e22xZaQ9OuA3cWBr.zksubZmECbziExhlw8ExwouC', 'jai@jai.com', 1, 0),
(6, '1234mukesh', 'mukesh', 'kumar', '$2y$12$35WCT6odyh5p5n4YOBBOvOCjL5je1DOR4QblkWIDQf8atxYn39VwG', 'mukesh2249@gmail.comm', 1, 0),
(7, 'jagsajgsasg', 'as', 'j', '$2y$12$OHX3H4/riK2Ah.Vel5Jecuicl0xu26g5IPR5E5n5As6iXce7LH3TK', 'm@abc.c', 1, 0),
(8, 'Mukeshcheck', 'M', 'm', '$2y$12$lOFsWIx2TG8Q1XXcSIomeuISuiXNUeAkHyb.nkZpiO7JhWS8rY6fq', 'asasa@asa.com', 1, 0),
(9, 'checking', 'm', 'm', '$2y$12$BOsAwvxilUpc5bkOmxwyku0FxWVmNiupFSvHCI1GmGtts1nnn94Zi', 'check@ch.com', 1, 0),
(12, 'check123', 'm', 'm', '$2y$12$EDqjFyZyz1FOljpPPLb6BeoG0jP2aD0t3OIBsDf8DrNyubyY4aYwS', 'mukesh@muk.com', 1, 0),
(13, 'firstuuchecking', 'm', 'm', '$2y$12$ZpJYIgO8DplK28VtdE6aneOWhBzs43jrUQ05hm4T0JbGYdRzlBGZC', 'check123@ch.com', 1, 0),
(14, 'mukesh1234', 'm', 'm', '$2y$12$YGOYm18i7bKE9RqPeE80MO2WV.gxOFoqYprB3i58FpGOJ6sbIkiGi', 'mukesh@123.com', 1, 0),
(15, 'kgaswin', 'm', 'm', '$2y$12$LSNpxjB8gpI1semE.Sj6OOZfaBkGegPmv9j2bcxfOMG3aa9ILU5LW', 'mukesh@gmail.com', 1, 0),
(16, 'kgaswin93', 'aswin', 'asdjdfh', '$2y$12$zrA1zdHDZ2tZhoG2HJ6Tb.vAwUnrwy/2ALYwnB0ePXMDGqCEvNHnG', 'kgaswin93@gmail.com', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `deletedyn` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userid`, `productid`, `deletedyn`) VALUES
(3, 2, 3, ''),
(4, 2, 4, ''),
(5, 2, 5, ''),
(9, 15, 1, ''),
(14, 2, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brandid` (`brandid`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `subcategoryid` (`subcategoryid`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `featureid` (`featureid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `productid_2` (`productid`),
  ADD KEY `userid_2` (`userid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brandid`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`subcategoryid`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_features`
--
ALTER TABLE `product_features`
  ADD CONSTRAINT `product_features_ibfk_1` FOREIGN KEY (`featureid`) REFERENCES `features` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_features_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
