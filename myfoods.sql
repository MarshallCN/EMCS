-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-02-05 19:20:44
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myfoods`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Raw Meet'),
(2, 'Cooked Meet'),
(3, 'Salted Meet'),
(4, 'Smoked Meet'),
(5, 'Fruit'),
(6, 'Vegetable'),
(7, 'Flavour'),
(8, 'Cake'),
(9, 'Bread'),
(10, 'Soup'),
(11, 'Dessert'),
(12, 'Pancakes'),
(13, 'Sandwiches'),
(14, 'microwave food'),
(15, 'Dairy'),
(16, 'Drinks'),
(17, 'Fruits'),
(18, 'Grains'),
(19, 'Proteins');

-- --------------------------------------------------------

--
-- 表的结构 `cook_method`
--

CREATE TABLE IF NOT EXISTS `cook_method` (
  `id` int(11) NOT NULL,
  `main_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `cook_method`
--

INSERT INTO `cook_method` (`id`, `main_method`) VALUES
(1, 'boil'),
(2, 'fry'),
(3, 'bake'),
(4, 'steam'),
(5, 'stir or mix');

-- --------------------------------------------------------

--
-- 表的结构 `datehtml`
--

CREATE TABLE IF NOT EXISTS `datehtml` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `htmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `datehtml`
--

INSERT INTO `datehtml` (`id`, `category_id`, `name`, `url`, `htmlid`) VALUES
(1, 6, 'Asparagus', 'http://www.eatbydate.com/vegetables/fresh-vegetables/asparagus/', 1),
(2, 6, 'Broccoli', 'http://www.eatbydate.com/vegetables/fresh-vegetables/broccoli/', 2),
(3, 6, 'Carrots', 'http://www.eatbydate.com/how-long-do-carrots-last-shelf-life/', 3),
(4, 6, 'Canned Vegetables', 'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/', 4),
(5, 6, 'Canned Vegetable Soup', 'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/', 4),
(6, 6, 'Cauliflower', 'http://www.eatbydate.com/vegetables/fresh-vegetables/cauliflower/', 5),
(7, 6, 'Celery', 'http://www.eatbydate.com/how-long-does-celery-last-shelf-life/', 6),
(8, 6, 'Corn', 'http://www.eatbydate.com/vegetables/fresh-vegetables/corn/', 7),
(9, 6, 'Corn - Canned ', 'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/', 4),
(10, 6, 'Corn - Frozen ', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(11, 6, 'Cucumbers', 'http://www.eatbydate.com/how-long-do-cucumbers-last-shelf-life-expiration-date/', 9),
(12, 6, 'Frozen Vegetables', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(13, 6, 'Frozen Carrots', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(14, 6, 'Frozen Corn', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(15, 6, 'Frozen Peas', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(16, 6, 'Frozen String Beans', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(17, 6, 'Garlic', 'http://www.eatbydate.com/how-long-does-garlic-last-shelf-life', 10),
(18, 6, 'Green Beans', 'http://www.eatbydate.com/vegetables/fresh-vegetables/green-beans/', 11),
(19, 6, 'Kale', 'http://www.eatbydate.com/vegetables/fresh-vegetables/kale/', 12),
(20, 6, 'Lettuce', 'http://www.eatbydate.com/how-long-does-lettuce-last', 13),
(21, 6, 'Mushrooms', 'http://www.eatbydate.com/vegetables/fresh-vegetables/mushrooms/', 14),
(22, 6, 'Onions', 'http://www.eatbydate.com/how-long-do-onions-last-shelf-life/', 15),
(23, 6, 'Peppers', 'http://www.eatbydate.com/vegetables/fresh-vegetables/bell-peppers/', 16),
(24, 6, 'Pickles', 'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/', 17),
(25, 6, 'Pickled Peppers', 'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/', 17),
(26, 6, 'Pickled Corn', 'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/', 17),
(27, 6, 'Potatoes', 'http://www.eatbydate.com/potatoes-shelf-life-expiration-date/', 18),
(28, 6, 'Parsnips', 'http://www.eatbydate.com/vegetables/fresh-vegetables/parsnips/', 19),
(29, 6, 'Pumpkin', 'http://www.eatbydate.com/how-long-does-pumpkin-last/', 20),
(30, 6, 'Salad', 'http://www.eatbydate.com/salad-shelf-life-expiration-date/', 21),
(31, 6, 'Salsa', 'http://www.eatbydate.com/vegetables/fresh-vegetables/salsa-shelf-life-expiration-date/', 22),
(32, 6, 'Sauerkraut (Pickled Cabbage)', 'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/', 17),
(33, 6, 'Seaweed (Nori)', 'http://www.eatbydate.com/how-long-does-nori-last-shelf-life/', 23),
(34, 6, 'Spaghetti Sauce', 'http://www.eatbydate.com/spaghetti-sauce-shelf-life-expiration-date/', 24),
(35, 6, 'Spinach', 'http://www.eatbydate.com/vegetables/fresh-vegetables/spinach/', 25),
(36, 6, 'Summer Squash', 'http://www.eatbydate.com/how-long-does-summer-squash-last/', 26),
(37, 6, 'Sweet Potatoes', 'http://www.eatbydate.com/how-long-do-sweet-potatoes-or-yams-last/', 27),
(38, 6, 'Tomatoes', 'http://www.eatbydate.com/tomatoes-shelf-life-expiration-date', 28),
(39, 6, 'Vegetables - Canned', 'http://www.eatbydate.com/canned-vegetables-shelf-life-expiration-date/', 29),
(40, 6, 'Vegetables - Frozen', 'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/', 8),
(41, 6, 'Winter Squash', 'http://www.eatbydate.com/how-long-does-winter-squash-last/', 30);

-- --------------------------------------------------------

--
-- 表的结构 `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `id` int(11) NOT NULL,
  `dish_name` varchar(100) DEFAULT NULL,
  `cook_method_id` int(11) DEFAULT NULL,
  `recipe` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `dish_items`
--

CREATE TABLE IF NOT EXISTS `dish_items` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `storage_method_id` int(11) DEFAULT NULL,
  `expiration` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `food`
--

INSERT INTO `food` (`id`, `name`, `category_id`, `status_id`, `storage_method_id`, `expiration`) VALUES
(1, 'Potato', 6, 7, 3, 7);

-- --------------------------------------------------------

--
-- 表的结构 `food_user`
--

CREATE TABLE IF NOT EXISTS `food_user` (
  `id` int(11) NOT NULL,
  `food_dish_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `htmlcont`
--

CREATE TABLE IF NOT EXISTS `htmlcont` (
  `id` int(11) NOT NULL,
  `html` text
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `htmlcont`
--

INSERT INTO `htmlcont` (`id`, `html`) VALUES
(1, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Asparagus lasts</strong> for</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td><strong>Cooked Asparagus lasts</strong> for</td>\n<td>5-7 Days</td>\n</tr>\n'),
(2, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Broccoli lasts</strong> for</td>\n<td>7-14 Days</td>\n</tr>\n<tr>\n<td><strong>Cooked Broccoli lasts</strong> for</td>\n<td>7-9 Days</td>\n</tr>\n'),
(3, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Carrots (Whole)</strong> last for</td>\n<td>4-5 Weeks</td>\n</tr>\n<tr>\n<td><strong>Baby Carrots</strong> last for</td>\n<td>3-4 Weeks</td>\n</tr>\n<tr class="alt">\n<td><strong>Cooked Carrots</strong> last for</td>\n<td>1 Week</td>\n</tr>\n'),
(4, '<tr>\n<th>(Unopened)</th>\n<th>Pantry</th>\n</tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n<tr class="alt">\n<td><strong>Canned Vegetables</strong> last for </td>\n<td>1-2 Years</td>\n</tr>\n<tr>\n<td><strong>Canned Corn</strong> lasts for </td>\n<td>1-2 Years</td>\n</tr>\n<tr class="alt">\n<td><strong>Canned Soup</strong> lasts for </td>\n<td>1-2 Years</td>\n</tr>\n<th>(Opened)</th>\n<th>Refrigerator</th>\n<tr class="alt">\n<td><strong>Canned Vegetables</strong> last for </td>\n<td>7-10 Days</td>\n</tr>\n<tr>\n<td><strong>Canned Corn</strong> lasts for </td>\n<td>7-10 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Canned Soup lasts for</strong> </td>\n<td>7 Days</td>\n</tr>\n'),
(5, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Cauliflower lasts</strong> for</td>\n<td>7-21 Days</td>\n</tr>\n<tr>\n<td><strong>Cooked Cauliflower lasts</strong> for</td>\n<td>7-10 Days</td>\n</tr>\n'),
(6, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td>Fresh (Whole) <strong>Celery lasts</strong> for</td>\n<td>3-4 Weeks</td>\n</tr>\n<tr>\n<td><strong>Celery Packages last</strong> for</td>\n<td>2-3 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Cooked Celery lasts</strong> for</td>\n<td>1 Week</td>\n</tr>\n'),
(7, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Corn </strong> lasts for</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td><strong>Cooked Corn</strong> lasts for</td>\n<td>5-7 Days</td>\n</tr>\n'),
(8, '<tr>\n<th>(Open/Unopened)</th>\n<th>Freezer</th>\n</tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Frozen Vegetables last</strong> for</td>\n<td>8-10 Months</td>\n</tr>\n'),
(9, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Cucumbers (Whole)</strong> last for</td>\n<td>1 Week</td>\n</tr>\n<tr>\n<td><strong>English Cucumbers</strong> last for</td>\n<td>7-10 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Japanese Cucumbers</strong> last for</td>\n<td>7-10 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Persian Cucumbers</strong> last for</td>\n<td>1 Week</td>\n</tr>\n<tr>\n<td><strong>Pickling Cukes</strong> last for</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Sliced Cucumbers</strong> last for</td>\n<td>1-2 Days</td>\n</tr>\n'),
(10, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Fridge</th>\n</tr>\n<tr class="alt">\n<td>Fresh (Whole) <strong>Garlic lasts</strong> for</td>\n<td>3-6 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Fresh Garlic Cloves last</strong> for</td>\n<td>1-2 Months</td>\n<td>--</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Chopped Garlic lasts</strong> for</td>\n<td>--</td>\n<td>1 Week</td>\n</tr>\n<tr>\n<td><strong>Prepared Jar of Chopped Garlic lasts</strong> for</td>\n<td>--</td>\n<td>2-3 Months</td>\n</tr>\n'),
(11, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Green Beans last</strong> for</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td><strong>Cooked Green Beans last</strong> for</td>\n<td>5-7 Days</td>\n</tr>\n'),
(12, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Kale </strong> lasts for</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Cooked Kale</strong> lasts for</td>\n<td>5-7 Days</td>\n</tr>\n'),
(13, '<tr>\n<th>(Unopened/Opened)</th>\n<th>Refrigerator</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td>Head <strong>Iceburg Lettuce lasts for</strong></td>\n<td>7-10 Days</td>\n</tr>\n<tr>\n<td>Head <strong>Romaine Lettuce lasts for</strong></td>\n<td>7-10 Days</td>\n</tr>\n<tr class="alt">\n<td>Head <strong>Leaf Lettuce lasts for</strong></td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td>Head <strong>Butter Lettuce lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Chopped or Loose Lettuce lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr>\n<td><strong>Fresh Express Lettuce lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n'),
(14, '<tr>\n<th></th>\n<th>Fridge</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"></td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Whole Mushrooms last</strong> for</td>\n<td>7-10 Days</td>\n</tr>\n<tr>\n<td><strong>Fresh Sliced Mushrooms last</strong> for</td>\n<td>5-7 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Cooked Mushrooms last</strong> for</td>\n<td>7-10 Days</td>\n</tr>\n'),
(15, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Fridge</th>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Whole Onions last for</strong></td>\n<td>4-6 Weeks</td>\n<td>1-2 Months</td>\n</tr>\n<tr>\n<td><strong>Fresh Chopped Onions last for</strong></td>\n<td>--</td>\n<td>1 Week</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Whole Scallions last</strong> for</td>\n<td>1-2 Days</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Frozen Onions last for</strong></td>\n<td>--</td>\n<td>6-8 Months in Freezer</td>\n</tr>\n'),
(16, '<tr>\n<th></th>\n<th>Refrigerator</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh (Whole) Green Bell Peppers last</strong> for</td>\n<td>2-3 Weeks</td>\n</tr>\n<tr>\n<td><strong>Fresh Red Bell Peppers (Whole)</strong> last for</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Orange Bell Peppers</strong> last for</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Fresh Yellow Bell Peppers (Whole)</strong> last for</td>\n<td>1-2 Weeks</td>\n</tr>\n<tr class="alt">\n<td><strong>Cut Bell Peppers (any color)</strong> last for</td>\n<td>1-3 Days</td>\n</tr>\n<tr>\n<td><strong>Frozen Chopped Bell Peppers</strong> last for</td>\n<td>4-6 Months in freezer</td>\n</tr>\n'),
(17, '<tr>\n<th>Product</th>\n<th>Pantry (Unopened)</th>\n<th>Refrigerator (Opened)</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Pickles last</strong> for</td>\n<td>1-2 Years</td>\n<td>1-2 Years</td>\n</tr>\n<tr>\n<td><strong>Pickled Peppers last</strong> for</td>\n<td>1-2 Years</td>\n<td>1-2 Years</td>\n</tr>\n<tr class="alt">\n<td><strong>Pickled Corn lasts</strong> for</td>\n<td>1-2 Years</td>\n<td>1-2 Years</td>\n</tr>\n<tr>\n<td><strong>Sauerkraut (pickled cabbage)</strong> lasts</td>\n<td>1-2 Years</td>\n<td>1-2 Years</td>\n</tr>\n'),
(18, '<tr>\n<th>Potato</th>\n<th>Pantry</th>\n<th>Fridge</th>\n<th>Freezer</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Date</td>\n<td> Past Date</td>\n<td> Past Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Russet or White Potatoes</strong> last for</td>\n<td>3-5 Weeks</td>\n<td>3-4 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Yukon Gold Potatoes</strong> last for</td>\n<td>2-3 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr class="alt">\n<td><strong>Red or New Potatoes</strong> last for</td>\n<td>2-3 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Fingerlings</strong> last for</td>\n<td>2-3 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr class="alt">\n<td><strong>Sweet Potatoes</strong> lasts for</td>\n<td>3-5 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Sliced Potatoes or French Fries</strong> last </td>\n<td>--</td>\n<td>1-2 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr class="alt">\n<td><strong>Cooked Potatoes</strong> last for</td>\n<td>--</td>\n<td>5-7 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr>\n<td><strong>Baked Potatoes</strong> last for</td>\n<td>--</td>\n<td>5-7 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr class="alt">\n<td><strong>Mashed Potatoes</strong> last for</td>\n<td>--</td>\n<td>4-6 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr>\n<td><strong>Instant Dry Potato Packages</strong> last for</td>\n<td>1 Year</td>\n<td>4-5 Days</td>\n<td>--</td>\n</tr>\n'),
(19, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Refrigerator</th>\n<th>Freezer</th>\n</tr>\n<tr class="alt">\n<td><strong>Parsnips (Whole)</strong> last for</td>\n<td>4-5 Days</td>\n<td>1 Month</td>\n<td>6-9 Months (blanch first)</td>\n</tr>\n'),
(20, '<tr>\n<th>Unopened</th>\n<th>Counter</th>\n<th>Refrigerator</th>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Pumpkins last</strong> for</td>\n<td>2-3 Months</td>\n<td>3-5 Months</td>\n</tr>\n<tr>\n<td><strong>Canned Pumpkin lasts</strong> for</td>\n<td>1-2 Years</td>\n<td>1-2 Years</td>\n</tr>\n<tr>\n<th>Opened</th>\n<th>Refrigerator</th>\n<th>Freezer</th>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Cut Pumpkins last</strong> for</td>\n<td>2-3 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr>\n<td><strong>Cooked Pumpkin lasts</strong> for</td>\n<td>7 Days</td>\n<td>6-8 Months</td>\n</tr>\n</tr>\n<tr class="alt">\n<td><strong>Canned Pumpkin lasts</strong> for</td>\n<td>7 Days</td>\n<td>3-5 Months</td>\n</tr>\n<tr>\n<td><strong>Pumpkin Pie lasts</strong> for</td>\n<td>3-4 Days</td>\n<td>4-6 Months</td>\n</tr>\n'),
(21, '<tr>\n<th></th>\n<th>Refrigerator</th>\n</tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Packaged Lettuce lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr>\n<td><strong>Caesar Salad (Undressed)</strong> lasts for</td>\n<td>3-5 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Green Salad (Dressed)</strong> lasts for</td>\n<td>1-5 Days</td>\n</tr>\n<tr>\n<td><strong>Egg Salad  lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Chicken Salad lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Tuna Salad lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr>\n<td><strong>Potato Salad  lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Macaroni Salad lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n<tr>\n<td><strong>Pasta Salad (Non-mayonnaise)</strong> lasts for</td>\n<td>5-7 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Fruit Salad lasts for</strong></td>\n<td>3-5 Days</td>\n</tr>\n'),
(22, '<tr>\r<th>(Unopened)</th>\r<th>Pantry</th>\r<th>Refrigerator</th>\r</tr>\r<td></td>\r<td style="text-align: center;">Past Printed Date</td>\r<td style="text-align: center;">Past Printed Date</td>\r<tr class="alt">\r<td><strong>Salsa (Jar)</strong> lasts for</td>\r<td>1-2 Months</td>\r<td>1-2 Months</td>\r</tr>\r<tr>\r<th>(Opened)</th>\r<th>Pantry</th>\r<th>Fridge</th>\r<tr>\r<td><strong>Salsa</strong> lasts for</td>\r<td>--</td>\r<td>1-2 Weeks</td>\r</tr>\r<tr class="alt">\r<td><strong>Homemade Salsa</strong> lasts for</td>\r<td>--</td>\r<td>5-7 Days</td>\r</tr>\r'),
(23, '<tr>\n<th></th>\n<th>Pantry</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;"><strong>Past Printed Date</strong></td>\n</tr>\n<tr class="alt">\n<td><strong>Nori</strong> lasts for</td>\n<td>2-3 Years</td>\n</tr>\n'),
(24, '<tr>\n<th>Product</th>\n<th>Pantry (Unopened)</th>\n<th>Refrigerator (Opened)</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n<td style="text-align: center;">After Opening</td>\n</tr>\n<tr class="alt">\n<td><strong>Tomato Based Pasta Sauce lasts</strong> for</td>\n<td>1 Year</td>\n<td>5-10 Days</td>\n</tr>\n<tr>\n<td><strong>Cream Based Pasta Sauce lasts</strong> for</td>\n<td>6-8 Months</td>\n<td>7 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Oil Based Pasta Sauce lasts</strong> for</td>\n<td>1 Year</td>\n<td>2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Dry Package Pasta Sauce Mix lasts</strong> for</td>\n<td>6-12 Months</td>\n<td>7-10 Days(prepared)</td>\n</tr>\n'),
(25, '<tr>\n<th>(Unopened)</th>\n<th>Refrigerator</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Spinach</strong> lasts for</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<th>(Opened)</th>\n<th>Refrigerator</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Spinach</strong> lasts for</td>\n<td>3-5 Days</td>\n</tr>\n'),
(26, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Refrigerator</th>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Summer Squash lasts</strong> for</td>\n<td>1-5 Days</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td><strong>Zucchini lasts</strong> for</td>\n<td>3-5 Days</td>\n<td>5-7 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Crooked Neck Squash lasts</strong> for</td>\n<td>3-5 Days</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td><strong>Prepared (Cooked) Squash lasts</strong> for</td>\n<td>--</td>\n<td>7 Days</td>\n</tr>\n'),
(27, '<tr>\n<th>(Unopened)</th>\n<th>Pantry</th>\n<th>Fridge</th>\n<th>Freezer</th>\n</tr>\n<tr>\n<td></td>\n<td style="text-align: center;">Past Date</td>\n<td>Past Printed Date</td>\n<td>Past Printed Date</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Sweet Potatoes last</strong> for</td>\n<td>3-5 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Canned Sweet Potatoes last</strong> for</td>\n<td>1 Year</td>\n<td>--</td>\n<td></td>\n</tr>\n<tr class="alt">\n<td><strong>Sweet Potato Fries last</strong> for</td>\n<td>--</td>\n<td>2-3 Days</td>\n<td>4-6 months</td>\n</tr>\n<tr>\n<td><strong>Frozen Sweet Potatoes last</strong> for </td>\n<td>--</td>\n<td>5-7 Days</td>\n<td>6-8 Months</td>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Yams last</strong> for </td>\n<td>3-5 Weeks</td>\n<td>2-3 Months</td>\n<td>--</td>\n</tr>\n<tr>\n<td><strong>Canned Yams last</strong> for</td>\n<td>1 Year</td>\n<td>--</td>\n<td>--</td>\n</tr>\n<tr class="alt">\n<td><strong>Dry Instant Sweet Potatoes last</strong> for</td>\n<td>6-12 Months</td>\n<td>--</td>\n<td>--</td>\n</tr>\n<tr>\n<th>(Opened)</th>\n<th>Pantry</th>\n<th>Fridge</th>\n<th>Freezer</th>\n<tr>\n<td><strong>Canned Sweet Potatoes or Yams</strong> last for</td>\n<td>--</td>\n<td>7 Days</td>\n<td>--</td>\n</tr>\n<tr class="alt">\n<td><strong>Cooked Sweet Potatoes last</strong> for</td>\n<td>--</td>\n<td>7 Days</td>\n<td>4-6 Months</td>\n</tr>\n<tr>\n<td><strong>Cooked Yams last</strong> for</td>\n<td>--</td>\n<td>7 Days</td>\n<td>4-6 Months</td>\n</tr>\n'),
(28, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Refrigerator</th>\n</tr>\n<tr class="alt">\n<td><strong>Fresh Tomatoes</strong> last for</td>\n<td>1 Week</td>\n<td>2 Weeks</td>\n</tr>\n<tr>\n<td><strong>Canned Tomatoes</strong> last for</td>\n<td>1 Year - 18 Months (Unopened)</td>\n<td>7 Days (Opened)</td>\n</tr>\n'),
(29, '<tr>\n<th>(Unopened)</th>\n<th>Pantry</th>\n</tr>\n<td></td>\n<td style="text-align: center;">Past Printed Date</td>\n<tr class="alt">\n<td><strong>Canned Vegetables</strong> last for </td>\n<td>1-2 Years</td>\n</tr>\n<tr>\n<td><strong>Canned Corn</strong> lasts for </td>\n<td>1-2 Years</td>\n</tr>\n<tr class="alt">\n<td><strong>Canned Soup</strong> lasts for </td>\n<td>1-2 Years</td>\n</tr>\n<th>(Opened)</th>\n<th>Refrigerator</th>\n<tr class="alt">\n<td><strong>Canned Vegetables</strong> last for </td>\n<td>7-10 Days</td>\n</tr>\n<tr>\n<td><strong>Canned Corn</strong> lasts for </td>\n<td>7-10 Days</td>\n</tr>\n<tr class="alt">\n<td><strong>Canned Soup lasts for</strong> </td>\n<td>7 Days</td>\n</tr>\n'),
(30, '<tr>\n<th></th>\n<th>Counter</th>\n<th>Refrigerator</th>\n</tr>\n<tr class="alt">\n<td>Fresh <strong>Winter Squash lasts for</strong></td>\n<td>1-3 Months</td>\n<td>1-3 Months</td>\n</tr>\n<tr>\n<td>Fresh <strong>Spaghetti Squash lasts</strong> for</td>\n<td>1-3 Months</td>\n<td>1-3 Months</td>\n</tr>\n<tr class="alt">\n<td>Fresh <strong>Butternut Squash lasts for</strong></td>\n<td>1-3 Months</td>\n<td>1-3 Months</td>\n</tr>\n<tr>\n<td>Chopped/Sliced Fresh <strong>Winter Squash lasts</strong> for</td>\n<td>--</td>\n<td>2-5 Days</td>\n</tr>\n<tr class="alt">\n<td>Cooked <strong>Spaghetti Squash lasts for</strong></td>\n<td>--</td>\n<td>5-7 Days</td>\n</tr>\n<tr>\n<td>Cooked <strong>Butternut Squash lasts</strong> for</td>\n<td>--</td>\n<td>5-7 Days</td>\n</tr>\n<tr class="alt">\n<td>Other <strong>Cooked Winter Squash lasts for</strong></td>\n<td>--</td>\n<td>5-7 Days</td>\n</tr>\n');

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'chunked'),
(2, 'sliced'),
(3, 'mashed'),
(4, 'liquid'),
(5, 'sealed'),
(6, 'opened'),
(7, 'Unopened/Fresh');

-- --------------------------------------------------------

--
-- 表的结构 `storage`
--

CREATE TABLE IF NOT EXISTS `storage` (
  `id` int(11) NOT NULL,
  `food_user_id` int(11) DEFAULT NULL,
  `bestbefore` date DEFAULT NULL,
  `storage_method_id` int(11) DEFAULT NULL,
  `amount` smallint(6) DEFAULT NULL,
  `last_storage_id` int(11) DEFAULT NULL,
  `healthtag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `storage_method`
--

CREATE TABLE IF NOT EXISTS `storage_method` (
  `id` int(11) NOT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `storage_method`
--

INSERT INTO `storage_method` (`id`, `method`) VALUES
(1, 'Frozen(-20degree)'),
(2, 'cold storage(0~4degree)'),
(3, 'cool, dry and ventilated'),
(4, 'cool, dry and sealed');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pwdhash` varchar(60) DEFAULT NULL,
  `salt_code` varchar(10) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `self_desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `pwdhash`, `salt_code`, `gender`, `email`, `birth_date`, `self_desc`) VALUES
(1, 'Marshall', 'bda1630a9b49f083d784709dad92ec60', 'oKm0lY2R', NULL, 'marshallcnliu@gmail.com', NULL, NULL),
(2, 'David', '41a422d7af01e511800decc789dcfb7b', 'oLdkEPdD', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cook_method`
--
ALTER TABLE `cook_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datehtml`
--
ALTER TABLE `datehtml`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`), ADD KEY `cook_method_id` (`cook_method_id`);

--
-- Indexes for table `dish_items`
--
ALTER TABLE `dish_items`
  ADD PRIMARY KEY (`id`), ADD KEY `food_id` (`food_id`), ADD KEY `dish_id` (`dish_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`), ADD KEY `status_id` (`status_id`), ADD KEY `storage_method_id` (`storage_method_id`);

--
-- Indexes for table `food_user`
--
ALTER TABLE `food_user`
  ADD PRIMARY KEY (`id`), ADD KEY `food_dish_id` (`food_dish_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `htmlcont`
--
ALTER TABLE `htmlcont`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`), ADD KEY `last_storage_id` (`last_storage_id`), ADD KEY `storage_method_id` (`storage_method_id`), ADD KEY `food_user_id` (`food_user_id`);

--
-- Indexes for table `storage_method`
--
ALTER TABLE `storage_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `cook_method`
--
ALTER TABLE `cook_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `datehtml`
--
ALTER TABLE `datehtml`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dish_items`
--
ALTER TABLE `dish_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `food_user`
--
ALTER TABLE `food_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `htmlcont`
--
ALTER TABLE `htmlcont`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `storage_method`
--
ALTER TABLE `storage_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- 限制导出的表
--

--
-- 限制表 `dish`
--
ALTER TABLE `dish`
ADD CONSTRAINT `dish_ibfk_1` FOREIGN KEY (`cook_method_id`) REFERENCES `cook_method` (`id`);

--
-- 限制表 `dish_items`
--
ALTER TABLE `dish_items`
ADD CONSTRAINT `dish_items_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`),
ADD CONSTRAINT `dish_items_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`);

--
-- 限制表 `food`
--
ALTER TABLE `food`
ADD CONSTRAINT `food_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `food_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
ADD CONSTRAINT `food_ibfk_4` FOREIGN KEY (`storage_method_id`) REFERENCES `storage_method` (`id`);

--
-- 限制表 `food_user`
--
ALTER TABLE `food_user`
ADD CONSTRAINT `food_user_ibfk_1` FOREIGN KEY (`food_dish_id`) REFERENCES `food` (`id`),
ADD CONSTRAINT `food_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- 限制表 `storage`
--
ALTER TABLE `storage`
ADD CONSTRAINT `storage_ibfk_2` FOREIGN KEY (`last_storage_id`) REFERENCES `storage` (`id`),
ADD CONSTRAINT `storage_ibfk_3` FOREIGN KEY (`storage_method_id`) REFERENCES `storage_method` (`id`),
ADD CONSTRAINT `storage_ibfk_4` FOREIGN KEY (`food_user_id`) REFERENCES `food_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
