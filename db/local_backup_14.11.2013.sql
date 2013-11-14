-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2013 at 10:56 AM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `grabli`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

DROP TABLE IF EXISTS `bugs`;
CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `steps_id` int(11) DEFAULT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  `assigned_to` int(10) unsigned DEFAULT '0',
  `owner_id` int(10) unsigned DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `type` enum('bug','enhancement','other','task','featurerequest','idea') NOT NULL DEFAULT 'bug',
  `description` varchar(1024) DEFAULT NULL,
  `rep_steps` varchar(1024) DEFAULT NULL COMMENT 'шаги воспроизведения для бага',
  `number` int(11) NOT NULL DEFAULT '1' COMMENT 'последовательный номер баги',
  `added_date` int(11) unsigned DEFAULT NULL,
  `dedline_date` int(10) unsigned DEFAULT NULL,
  `last_activity` int(10) unsigned DEFAULT '0' COMMENT 'последняя октивность',
  PRIMARY KEY (`id`),
  KEY `fk_bugs_steps1` (`steps_id`),
  KEY `fk_bugs_projects1` (`project_id`),
  KEY `fk_bugs_user1` (`owner_id`),
  KEY `fk_bugs_user2` (`assigned_to`),
  KEY `fk_bugs_bugs1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `steps_id`, `project_id`, `assigned_to`, `owner_id`, `parent_id`, `title`, `type`, `description`, `rep_steps`, `number`, `added_date`, `dedline_date`, `last_activity`) VALUES
(7, 3, 1, 3, 1, NULL, 'dssdadsa', 'enhancement', 'asdsasd', NULL, 2, NULL, NULL, 0),
(8, 1, 1, NULL, 1, NULL, 'sgdfdf', 'bug', 'sdfgsdf', 'dsfgd', 3, NULL, NULL, 0),
(16, 2, 1, 1, 1, NULL, 'qwer', 'task', 'qwerwe', NULL, 4, 1374758374, NULL, 0),
(17, 1, 1, NULL, 1, NULL, 'qwer', 'featurerequest', 'qwerwe', NULL, 5, 1374758393, NULL, 0),
(18, 1, 1, 3, 1, NULL, 'khgch', 'idea', 'htjycj', NULL, 6, 1374821464, NULL, 0),
(19, 1, 1, NULL, 1, NULL, 'Публикация баннера. На странице выбора регионов', '', '1. Если выбран баннер, блокировать места куда он не лезет или уже опубликован.\r\n2. Если есть уже выбранные места и цены ставить галочки.', NULL, 7, 1378790806, NULL, 0),
(20, 6, 3, 1, 1, NULL, 'При отображении бага ставить переносы в тексте2223333', 'bug', 'При отображении бага ставить \r\n\r\n\r\n\r\nпереносы в тексте333', 'При отображении бага ставить\r\n\r\n\r\n переносы в тексте444', 1, 1378790884, NULL, 0),
(21, 6, 3, 1, 1, NULL, 'Причесать страницу редактирования проекта', 'bug', 'Причесать страницу редактирования проекта', 'Причесать страницу редактирования проекта', 2, 1378790986, 1385496000, 0),
(22, 1, 1, 1, 1, NULL, 'Проверить по публикации баннерам', 'featurerequest', '1. Проверить публикацию в существующий счет\r\n2. Проверить публикацию баннера с неправильными данными', NULL, 8, 1378795911, NULL, 0),
(23, 1, 1, NULL, 1, NULL, 'Добавить переход на страницу после публикации баннера', 'featurerequest', 'Добавить переход на страницу после публикации баннера', NULL, 9, 1378797509, NULL, 0),
(24, 6, 3, NULL, 1, NULL, 'При отображении проекта скрыть завершенные баги', 'enhancement', 'При отображении проекта скрыть завершенные баги', NULL, 3, 1378797937, NULL, 0),
(25, 6, 3, NULL, 1, NULL, 'Для бага сделать установку даты дедлайна', 'other', 'А также \r\n1. ЕЕ очистку\r\n2. Ее изменение', NULL, 4, 1378967606, NULL, 0),
(26, 6, 1, 1, 1, NULL, 'Добавить к агенствам цены', '', 'Добавить к агенствам цены', NULL, 10, 1380794248, NULL, 0),
(27, 6, 1, NULL, 1, NULL, 'Удаление агенств', '', 'Удаление агенств', NULL, 11, 1381906394, NULL, 0),
(28, 1, 1, NULL, 1, NULL, 'Banner go', '', 'Считать переходы по баннерам', NULL, 12, 1381907648, NULL, 0),
(29, 1, 1, NULL, 1, NULL, 'Сделать загрузку изображений для агенств', '', 'Вынести размеры обрезки в отдельную настроку', NULL, 13, 1381987127, NULL, 0),
(30, 6, 3, NULL, 1, NULL, 'Причесать станицу страницу создания бага', 'bug', '1. Убрать обязательные поля кроме названия\r\n2. Заменить project_id на что то красивое', '1олд12о', 5, 1381990174, NULL, 0),
(31, 1, 1, NULL, 1, NULL, 'Добавить метро к анкетам', '', 'Добавить метро к анкетам', NULL, 14, 1382094737, NULL, 0),
(32, 1, 3, 4, 1, NULL, 'Milestones', 'enhancement', 'Механизм milestones', NULL, 6, 1383479214, NULL, 1383558011),
(33, 1, 3, NULL, 1, NULL, 'Приглашение пользователей', 'task', 'Отправлять приглашения на email. \r\nС данными\r\nзарегистрированный email \r\nдата подачи приглашения\r\n', NULL, 7, 1383481284, NULL, 0),
(34, 1, 3, 1, 1, NULL, 'Регистрация пользователей', 'task', 'Регистрация пользователей только по приглашениям из формы', NULL, 8, 1383481328, NULL, 0),
(35, 1, 3, 1, 1, NULL, 'Связывание заданий', 'enhancement', 'Связывание заданий', NULL, 9, 1383481373, NULL, 1383553105),
(36, 1, 2, NULL, 1, NULL, 'Две строке в заголовок товара на сане.', 'task', 'Подумать на тему увеличения строк в шапке товара при выводе его в списке товаров к каталоге на сане', NULL, 3, 1383567509, NULL, 1383567509),
(37, 1, 2, NULL, 1, NULL, 'Пакетная обработка товаров на сан', 'idea', 'Нужно сделать:\r\n1. Перемещение по категориям', NULL, 4, 1383567630, NULL, 1383567630),
(38, 1, 2, NULL, 1, NULL, 'Дополнительные совойства товара', 'idea', 'Перенести "список дополнительных своства товара" из отдельного нетерфейса в карточку товара', NULL, 5, 1383567784, NULL, 1383567784),
(39, 1, 2, NULL, 1, NULL, 'Картинки на сане как на БП', 'featurerequest', 'Убрать изображенние "изображение отсуствует" и сделать как на БП', NULL, 6, 1383567930, NULL, 1383567930),
(40, 6, 2, NULL, 1, NULL, 'Картинки в акции на БП и лининг', 'featurerequest', 'Убрать не загруженые картинки в акцииях', NULL, 7, 1383568059, NULL, 1383968484),
(41, 6, 3, NULL, 1, NULL, 'Не сохраняются баг', 'bug', 'при редактировании', 'зайти в редактирование нажать сохранить', 10, 1383568262, NULL, 1383953736),
(42, 1, 2, NULL, 1, NULL, 'На сане процедура заказа.', 'idea', 'Как на грейте', NULL, 8, 1383568372, NULL, 1383568372),
(43, 6, 2, NULL, 1, NULL, 'Баннер на главной странице на БП', 'featurerequest', 'Сделать что бы загруженые баннеры переключались каждый 15 сек', NULL, 9, 1383569457, NULL, 1383964491),
(44, 6, 3, NULL, 1, NULL, 'Дерево багов', 'idea', 'Строить дерево на зависимости багов', NULL, 11, 1383859655, NULL, 1384042097),
(45, 1, 3, NULL, 1, NULL, 'Виджет выбора иссуе', 'enhancement', 'Нуна сделать виджет позволяющий искать баги, с поиском и выбором', NULL, 12, 1383859737, NULL, 1383859737),
(46, 1, 3, NULL, 1, NULL, 'Доработать выбор пользователя на странице бага', 'featurerequest', 'Доработать выбор пользователя на странице бага', NULL, 13, 1383863204, NULL, 1383863204),
(47, 6, 3, NULL, 1, NULL, 'Не работает регистрация пользователей', 'bug', 'Не регистрирует', 'При сохранении', 14, 1383908578, NULL, 1383963124),
(48, 6, 3, NULL, 1, NULL, 'Капча в регистрацию', 'featurerequest', 'Капча в регистрации', NULL, 15, 1383908626, NULL, 1383966732),
(49, 6, 3, NULL, 1, NULL, 'Проверка сложности пароля при регистрации', 'featurerequest', '--', NULL, 16, 1383908654, NULL, 1383966727),
(50, 1, 3, NULL, 1, NULL, 'создание бага из списка заданий проекта', 'featurerequest', 'тп', NULL, 17, 1383920774, NULL, 1383920774),
(51, 6, 3, NULL, 1, NULL, 'При открытии персональной страницы пользователя ошибка', 'bug', 'При открытии персональной страницы пользователя ошибка', 'При открытии персональной страницы пользователя ошибка', 18, 1383952764, NULL, 1383961845),
(52, 6, 3, NULL, 1, NULL, 'Убрать все обяаательные поля при создании бага', 'enhancement', 'Убрать все обяаательные поля при создании бага\r\n', NULL, 19, 1383952824, NULL, 1384042593),
(53, 1, 3, NULL, 1, NULL, 'В закрытом баге запрещать давать исправлять поля', 'featurerequest', 'В закрытом баге запрещать давать исправлять поля', NULL, 20, 1383953784, NULL, 1383953784),
(54, 1, 3, NULL, 1, NULL, 'Под проеекты', 'idea', 'создавать для проекта дочерние проекты, что бы можно было отличать', NULL, 21, 1383958521, NULL, 1383958521),
(55, 6, 3, NULL, 1, NULL, 'На странице бага сделать кнопку редактирования', 'enhancement', 'На странице бага сделать кнопку редактирования', NULL, 22, 1383958954, NULL, 1384042725),
(56, 1, 3, NULL, 1, NULL, 'Приоритет для багов', 'idea', '', NULL, 23, 1383963201, NULL, 1383963201),
(57, 6, 3, NULL, 1, NULL, 'Скрывать описание бага когда оно не введено', 'bug', '', '', 24, 1383963225, NULL, 1384042615),
(58, 1, 3, NULL, 1, NULL, 'Добавить фильтрацию данных формы фильтров задач по проекту', 'enhancement', '', NULL, 25, 1384036361, NULL, 1384036361),
(59, 1, 3, NULL, 1, 54, 'Теги проекта', 'idea', 'облако тегов', NULL, 26, 1384042650, NULL, 1384042650),
(60, 1, 3, NULL, 1, 45, 'Виджет показа иссуе', 'featurerequest', 'Надо заменить на странице редактирования иссуе \r\nИ в дереве зависимостей иссуе на странице просмотре иссуе', NULL, 27, 1384042960, NULL, 1384042973),
(61, 1, 3, NULL, 1, 45, 'Выбор родительского иссуе на странице иссуе', 'featurerequest', '', NULL, 28, 1384043007, NULL, 1384043007),
(62, 1, 3, NULL, 1, NULL, 'Редактирование персональных данных пользователя', 'featurerequest', 'Имени и Email', NULL, 29, 1384043140, NULL, 1384043140),
(63, 1, 3, NULL, 1, NULL, 'Загрузка файлов для багов', 'enhancement', '', NULL, 30, 1384043205, NULL, 1384043205),
(64, 1, 3, NULL, 1, 33, 'Причесать страницу добавление пользователей в проект', 'bug', 'Поиск вынести  виджет\r\nВывод тоже вывести в виджет', 'На страицу проекта\r\nВыбор пользователей', 31, 1384043341, NULL, 1384043341),
(65, 2, 3, NULL, 1, 64, 'Виджет поиска пользователей', 'featurerequest', 'Со страницы добавление пользователей в проект вынестив отдельное попап окно и виджет', NULL, 32, 1384043405, NULL, 1384048753),
(66, 1, 3, NULL, 1, 33, 'Сделать интерфейс добавления приглашение пользователей по email', 'featurerequest', '', NULL, 33, 1384043523, NULL, 1384043523),
(67, 1, 3, NULL, 1, NULL, 'Ограничить количество багов на странице проекта', 'bug', 'И отсортировать по активности, может еще и вывести активность', '', 34, 1384043596, NULL, 1384043613),
(68, 1, 3, NULL, 1, 67, 'Вынести список багов в виджет', 'enhancement', '', NULL, 35, 1384043649, NULL, 1384043649),
(69, 1, 3, NULL, 1, NULL, 'Сделать изменение типа багов на странице бага', 'featurerequest', '', NULL, 36, 1384043742, NULL, 1384043742);

-- --------------------------------------------------------

--
-- Table structure for table `bugs_has_bugs`
--

DROP TABLE IF EXISTS `bugs_has_bugs`;
CREATE TABLE IF NOT EXISTS `bugs_has_bugs` (
  `bug_1` int(11) DEFAULT NULL,
  `bug_2` int(11) DEFAULT NULL,
  KEY `fk_bugs_has_bugs_bugs2` (`bug_2`),
  KEY `fk_bugs_has_bugs_bugs1` (`bug_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `bugs_id` int(11) DEFAULT NULL,
  `time` int(10) unsigned NOT NULL,
  `type` enum('user','system') NOT NULL DEFAULT 'system',
  `description` varchar(124) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_bugs1` (`bugs_id`),
  KEY `fk_comments_user1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=177 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `bugs_id`, `time`, `type`, `description`) VALUES
(1, 1, 6, 1373793326, 'system', 'Bug created'),
(2, 1, 7, 1373807023, 'system', 'Encantment created'),
(3, 1, 7, 1373812691, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(4, 1, 7, 1373812699, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(5, 1, 7, 1373812756, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(6, 1, 7, 1373812851, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(7, 1, 7, 1373812885, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(8, 1, 7, 1373813217, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(9, 1, 7, 1373829459, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(10, 1, 7, 1373829695, 'system', 'User <b>Jon Doe</b> change status from <b>Create</b>  to <b>Worked on</b> '),
(11, 1, 7, 1373829793, 'system', 'User <b>Jon Doe</b> change status from <b>Create</b>  to <b>Worked on</b> '),
(12, 1, 7, 1373829799, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(13, 1, 7, 1373829844, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(14, 1, 7, 1373830051, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(15, 1, 7, 1373830056, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(16, 1, 7, 1373830061, 'system', 'User <b>Jon Doe</b> set assigned user <b>lesik</b> '),
(17, 1, 7, 1373830230, 'system', 'User <b>Jon Doe</b> set assigned user <b>UNK</b> '),
(18, 1, 7, 1373831182, 'system', 'User <b>Jon Doe</b> change status from <b>Create</b>  to <b>Worked on</b> '),
(19, 1, 7, 1373831209, 'system', 'User <b>Jon Doe</b> change status from <b>Create</b>  to <b>Worked on</b> '),
(20, 1, 7, 1373831267, 'system', 'User <b>Jon Doe</b> change status from <b>Worked on</b>  to <b>Redy for testing</b> '),
(21, 1, 7, 1373872012, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(22, 1, 7, 1373872020, 'system', 'User <b>Jon Doe</b> set assigned user <b>UNK</b> '),
(23, 1, 7, 1373872144, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(24, 1, 7, 1373872212, 'system', 'User <b>Jon Doe</b> set assigned user <b>UNK</b> '),
(25, 1, 8, 1374757247, 'system', 'Bug created'),
(26, 1, 9, 1374757753, 'system', 'Encantment created'),
(27, 1, 10, 1374757770, 'system', 'Encantment created'),
(28, 1, 11, 1374757825, 'system', 'Encantment created'),
(29, 1, 12, 1374757827, 'system', 'Encantment created'),
(30, 1, 13, 1374757837, 'system', 'Encantment created'),
(31, 1, 14, 1374757948, 'system', 'Encantment created'),
(32, 1, 15, 1374757967, 'system', 'Encantment created'),
(33, 1, 16, 1374758374, 'system', 'Encantment created'),
(34, 1, 17, 1374758393, 'system', 'Encantment created'),
(35, 1, 16, 1374818623, 'system', 'User <b>Jon Doe</b> set assigned user <b>UNK</b> '),
(36, 1, 16, 1374818653, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(37, 1, 16, 1374819922, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(38, 1, 16, 1374819959, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(39, 1, 16, 1374819980, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(40, 1, 16, 1374819991, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(41, 1, 16, 1374820010, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(42, 1, 16, 1374820016, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(43, 1, 18, 1374821464, 'system', 'Idea created'),
(44, 1, 7, 1374824550, 'user', 'assdd'),
(45, 1, 7, 1374824828, 'user', 'Я всех на хую вертел'),
(46, 1, 7, 1374824966, 'user', 'Я твоя труба шатал'),
(47, 1, 18, 1374836266, 'system', 'User <b>Jon Doe</b> set assigned user <b>UNK</b> '),
(48, 1, 18, 1374836279, 'user', 'гнгсмп\r\nормо\r\nромрп'),
(49, 1, 19, 1378790806, 'system', 'Encantment created'),
(50, 1, 20, 1378790884, 'system', 'Bug created'),
(51, 1, 20, 1378790902, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(52, 1, 21, 1378790986, 'system', 'Bug created'),
(53, 1, 22, 1378795911, 'system', 'Featurerequest created'),
(54, 1, 23, 1378797509, 'system', 'Featurerequest created'),
(55, 1, 1, 1378797881, 'user', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(56, 1, 24, 1378797937, 'system', 'Encantment created'),
(57, 1, 21, 1378966035, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(58, 1, 21, 1378966040, 'user', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(59, 1, 22, 1378966281, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(60, 1, 25, 1378967606, 'system', 'Encantment created'),
(61, 1, 26, 1380794248, 'system', 'Encantment created'),
(62, 1, 27, 1381906394, 'system', 'Encantment created'),
(63, 1, 28, 1381907648, 'system', 'Encantment created'),
(64, 1, 26, 1381922629, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(65, 1, 26, 1381922635, 'user', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(66, 1, 29, 1381987127, 'system', 'Encantment created'),
(67, 1, 29, 1381989325, 'user', 'И не забыть удалять картинку при удалении агенства'),
(68, 1, 27, 1381990068, 'user', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(69, 1, 30, 1381990174, 'system', 'Bug created'),
(70, 1, 31, 1382094737, 'system', 'Encantment created'),
(71, 1, 20, 1383461506, 'user', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(72, 1, 20, 1383470047, 'system', 'Bug created'),
(73, 1, 20, 1383470105, 'system', 'Bug created'),
(74, 1, 20, 1383470232, 'system', 'Bug created'),
(75, 1, 20, 1383470291, 'system', 'Bug created'),
(76, 1, 20, 1383470308, 'system', 'Bug created'),
(77, 1, 20, 1383470352, 'system', 'Bug created'),
(78, 1, 20, 1383470441, 'system', 'Bug created'),
(79, 1, 20, 1383470465, 'system', 'Bug created'),
(80, 1, 20, 1383470468, 'system', 'Bug created'),
(81, 1, 20, 1383470522, 'system', 'Bug created'),
(82, 1, 20, 1383470551, 'system', 'Bug created'),
(83, 1, 20, 1383470562, 'system', 'Bug created'),
(84, 1, 20, 1383470619, 'system', 'Bug created'),
(85, 1, 20, 1383470629, 'system', 'Bug created'),
(86, 1, 20, 1383470729, 'system', 'Bug created'),
(87, 1, 20, 1383470734, 'system', 'Bug created'),
(88, 1, 20, 1383470902, 'system', 'Bug created'),
(89, 1, 20, 1383470902, 'system', 'Issue updated'),
(90, 1, 20, 1383471003, 'system', 'Bug created'),
(91, 1, 20, 1383471003, 'system', 'Issue updated'),
(92, 1, 20, 1383471114, 'system', 'Bug created'),
(93, 1, 20, 1383471114, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(94, 1, 20, 1383471315, 'system', 'Bug created'),
(95, 1, 20, 1383471315, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(96, 1, 20, 1383471442, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(97, 1, 20, 1383471847, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(98, 1, 20, 1383471908, 'user', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(99, 1, 20, 1383471957, 'user', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(100, 1, 20, 1383472039, 'system', 'User <b>Jon Doe</b> set status <b>Re open</b> '),
(101, 1, 20, 1383472238, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(102, 1, 24, 1383473283, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(103, 1, 30, 1383474103, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(104, 1, 21, 1383478230, 'system', 'User <b>Jon Doe</b> clear dead line '),
(105, 1, 21, 1383478259, 'system', 'User <b>Jon Doe</b> set dead line '),
(106, 1, 21, 1383478336, 'system', 'User <b>Jon Doe</b> clear dead line '),
(107, 1, 21, 1383478342, 'system', 'User <b>Jon Doe</b> set dead line '),
(108, 1, 25, 1383479076, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(109, 1, 32, 1383479214, 'system', 'Issue created'),
(110, 1, 32, 1383479254, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(111, 1, 33, 1383481284, 'system', 'Issue created'),
(112, 1, 34, 1383481329, 'system', 'Issue created'),
(113, 1, 35, 1383481373, 'system', 'Issue created'),
(114, 1, 35, 1383481383, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(115, 1, 21, 1383550722, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(116, 1, 21, 1383550729, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(117, 1, 34, 1383552149, 'user', 'Сделал открытую регистрацию'),
(118, 1, 34, 1383552171, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(119, 1, 35, 1383553105, 'user', 'Пробуем активность'),
(120, 1, 2, 1383553242, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(121, 1, 2, 1383553255, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(122, 1, 32, 1383558011, 'system', 'User <b>Jon Doe</b> set assigned user <b>Абдула</b> '),
(123, 1, 36, 1383567509, 'system', 'Issue created'),
(124, 1, 37, 1383567630, 'system', 'Issue created'),
(125, 1, 38, 1383567784, 'system', 'Issue created'),
(126, 1, 39, 1383567930, 'system', 'Issue created'),
(127, 1, 40, 1383568059, 'system', 'Issue created'),
(128, 1, 41, 1383568262, 'system', 'Issue created'),
(129, 1, 42, 1383568372, 'system', 'Issue created'),
(130, 1, 43, 1383569457, 'system', 'Issue created'),
(131, 1, 44, 1383859655, 'system', 'Issue created'),
(132, 1, 45, 1383859737, 'system', 'Issue created'),
(133, 1, 46, 1383863204, 'system', 'Issue created'),
(134, 1, 47, 1383908578, 'system', 'Issue created'),
(135, 1, 48, 1383908626, 'system', 'Issue created'),
(136, 1, 49, 1383908654, 'system', 'Issue created'),
(137, 1, 50, 1383920774, 'system', 'Issue created'),
(138, 1, 51, 1383952764, 'system', 'Issue created'),
(139, 1, 52, 1383952824, 'system', 'Issue created'),
(140, 1, 41, 1383953736, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(141, 1, 53, 1383953784, 'system', 'Issue created'),
(142, 1, 54, 1383958521, 'system', 'Issue created'),
(143, 1, 55, 1383958954, 'system', 'Issue created'),
(144, 1, 43, 1383959823, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(145, 1, 43, 1383959828, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(146, 1, 43, 1383959903, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(147, 1, 43, 1383959917, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(148, 1, 51, 1383961845, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(149, 1, 47, 1383962827, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(150, 1, 47, 1383963124, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(151, 1, 56, 1383963201, 'system', 'Issue created'),
(152, 1, 57, 1383963225, 'system', 'Issue created'),
(153, 1, 43, 1383964477, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(154, 1, 43, 1383964491, 'user', '750р )'),
(155, 1, 49, 1383966727, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(156, 1, 48, 1383966732, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(157, 1, 40, 1383968484, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(158, 1, 58, 1384036361, 'system', 'Issue created'),
(159, 1, 44, 1384042097, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(160, 1, 52, 1384042593, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(161, 1, 57, 1384042615, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(162, 1, 59, 1384042650, 'system', 'Issue created'),
(163, 1, 55, 1384042725, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(164, 1, 60, 1384042960, 'system', 'Issue created'),
(165, 1, 60, 1384042973, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(166, 1, 61, 1384043007, 'system', 'Issue created'),
(167, 1, 62, 1384043140, 'system', 'Issue created'),
(168, 1, 63, 1384043205, 'system', 'Issue created'),
(169, 1, 64, 1384043341, 'system', 'Issue created'),
(170, 1, 65, 1384043405, 'system', 'Issue created'),
(171, 1, 66, 1384043523, 'system', 'Issue created'),
(172, 1, 67, 1384043596, 'system', 'Issue created'),
(173, 1, 67, 1384043613, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(174, 1, 68, 1384043649, 'system', 'Issue created'),
(175, 1, 69, 1384043742, 'system', 'Issue created'),
(176, 1, 65, 1384048753, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> ');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned DEFAULT '1' COMMENT 'Владелец проекта',
  `name` varchar(128) NOT NULL,
  `code` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_user1` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `owner_id`, `name`, `code`, `description`) VALUES
(1, 1, 'Lodb', 'lodba', 'London escort DB'),
(2, 1, 'БП', 'greatbuy', NULL),
(3, 1, 'Грабли', 'grabli', 'Это этот проект\r\nЭто этот проект\r\nЭто этот проект');

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

DROP TABLE IF EXISTS `project_tags`;
CREATE TABLE IF NOT EXISTS `project_tags` (
  `tag_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

DROP TABLE IF EXISTS `steps`;
CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `title`, `code`, `description`, `color`) VALUES
(1, 'Create', 'create', 'Создание нового объекта', 'white'),
(2, 'Worked on', 'workedon', 'В работе', 'green'),
(3, 'Ready for testing', 'readyfortesting', 'Готов к проверке', 'blue'),
(4, 'Re work', 'rowork', 'Отправлен на доработку', 'orange'),
(5, 'Re open', 'reopen', 'Пере открыт', 'yellow'),
(6, 'Closed', 'closed', 'Закрыт', 'black');

-- --------------------------------------------------------

--
-- Table structure for table `steps_has_steps`
--

DROP TABLE IF EXISTS `steps_has_steps`;
CREATE TABLE IF NOT EXISTS `steps_has_steps` (
  `steps_from` int(11) DEFAULT NULL,
  `steps_to` int(11) NOT NULL,
  KEY `fk_steps_has_steps_steps2` (`steps_to`),
  KEY `fk_steps_has_steps_steps1` (`steps_from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps_has_steps`
--

INSERT INTO `steps_has_steps` (`steps_from`, `steps_to`) VALUES
(1, 2),
(4, 2),
(5, 2),
(2, 3),
(3, 4),
(6, 5),
(3, 6),
(1, 6),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1384364176);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('worked') NOT NULL DEFAULT 'worked',
  `last_activity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_user` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `owner_id`, `name`, `email`, `password`, `status`, `last_activity`) VALUES
(1, 1, 'Jon Doe', 'the.ilja@gmail.com', '123', 'worked', 0),
(2, 1, 'lesik', 'aa@ddd.www', '123', 'worked', 0),
(3, 1, 'UNK', 'the.ilja@gmail.com', '123', 'worked', 0),
(4, NULL, 'Абдула', 'vangel@yandex.ru', '123123', 'worked', 1383551729);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_projects`
--

DROP TABLE IF EXISTS `user_has_projects`;
CREATE TABLE IF NOT EXISTS `user_has_projects` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  KEY `fk_user_has_projects_projects1` (`project_id`),
  KEY `fk_user_has_projects_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_projects`
--

INSERT INTO `user_has_projects` (`user_id`, `project_id`) VALUES
(1, 1),
(3, 1),
(1, 2),
(1, 3),
(3, 3);
