-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 15 2014 г., 17:57
-- Версия сервера: 5.5.29
-- Версия PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `plitka_bt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bugs`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

--
-- Дамп данных таблицы `bugs`
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
(34, 1, 3, 1, 1, NULL, 'Регистрация пользователей', 'featurerequest', 'Регистрация пользователей только по приглашениям из формы', NULL, 8, 1383481328, NULL, 1384475344),
(35, 1, 3, 1, 1, NULL, 'Связывание заданий', 'featurerequest', 'Связывание заданий', NULL, 9, 1383481373, NULL, 1384475298),
(36, 6, 2, NULL, 1, NULL, 'Две строке в заголовок товара на сане.', 'task', 'Подумать на тему увеличения строк в шапке товара при выводе его в списке товаров к каталоге на сане', NULL, 3, 1383567509, NULL, 1384634395),
(37, 6, 2, NULL, 1, NULL, 'Пакетная обработка товаров на сан', 'idea', 'Нужно сделать:\r\n1. Перемещение по категориям', NULL, 4, 1383567630, NULL, 1392473833),
(38, 4, 2, NULL, 1, NULL, 'Дополнительные совойства товара', 'idea', 'Перенести "список дополнительных своства товара" из отдельного нетерфейса в карточку товара', NULL, 5, 1383567784, NULL, 1385929683),
(39, 6, 2, NULL, 1, NULL, 'Картинки на сане как на БП', 'featurerequest', 'Убрать изображенние "изображение отсуствует" и сделать как на БП', NULL, 6, 1383567930, NULL, 1384638410),
(40, 6, 2, NULL, 1, NULL, 'Картинки в акции на БП и лининг', 'featurerequest', 'Убрать не загруженые картинки в акцииях', NULL, 7, 1383568059, NULL, 1383968484),
(41, 6, 3, NULL, 1, NULL, 'Не сохраняются баг', 'bug', 'при редактировании', 'зайти в редактирование нажать сохранить', 10, 1383568262, NULL, 1383953736),
(42, 4, 2, NULL, 1, NULL, 'На сане процедура заказа.', 'idea', 'Как на грейте', NULL, 8, 1383568372, NULL, 1399636598),
(43, 6, 2, NULL, 1, NULL, 'Баннер на главной странице на БП', 'featurerequest', 'Сделать что бы загруженые баннеры переключались каждый 15 сек', NULL, 9, 1383569457, NULL, 1383964491),
(44, 6, 3, NULL, 1, NULL, 'Дерево багов', 'idea', 'Строить дерево на зависимости багов', NULL, 11, 1383859655, NULL, 1384042097),
(45, 6, 3, NULL, 1, NULL, 'Виджет выбора иссуе', 'enhancement', 'Нуна сделать виджет позволяющий искать баги, с поиском и выбором', NULL, 12, 1383859737, NULL, 1384474523),
(46, 1, 3, NULL, 1, NULL, 'Доработать выбор пользователя на странице бага', 'featurerequest', 'Доработать выбор пользователя на странице бага', NULL, 13, 1383863204, NULL, 1383863204),
(47, 6, 3, NULL, 1, NULL, 'Не работает регистрация пользователей', 'bug', 'Не регистрирует', 'При сохранении', 14, 1383908578, NULL, 1383963124),
(48, 6, 3, NULL, 1, NULL, 'Капча в регистрацию', 'featurerequest', 'Капча в регистрации', NULL, 15, 1383908626, NULL, 1383966732),
(49, 6, 3, NULL, 1, NULL, 'Проверка сложности пароля при регистрации', 'featurerequest', '--', NULL, 16, 1383908654, NULL, 1383966727),
(50, 1, 3, NULL, 1, NULL, 'создание бага из списка заданий проекта', 'featurerequest', 'тп', NULL, 17, 1383920774, NULL, 1383920774),
(51, 6, 3, NULL, 1, NULL, 'При открытии персональной страницы пользователя ошибка', 'bug', 'При открытии персональной страницы пользователя ошибка', 'При открытии персональной страницы пользователя ошибка', 18, 1383952764, NULL, 1383961845),
(52, 6, 3, NULL, 1, NULL, 'Убрать все обяаательные поля при создании бага', 'enhancement', 'Убрать все обяаательные поля при создании бага\r\n', NULL, 19, 1383952824, NULL, 1384042593),
(53, 6, 3, NULL, 1, NULL, 'В закрытом баге запрещать давать исправлять поля', 'featurerequest', 'В закрытом баге запрещать давать исправлять поля', NULL, 20, 1383953784, NULL, 1384311918),
(54, 6, 3, NULL, 1, NULL, 'Под проеекты', 'idea', 'создавать для проекта дочерние проекты, что бы можно было отличать', NULL, 21, 1383958521, NULL, 1384645034),
(55, 6, 3, NULL, 1, NULL, 'На странице бага сделать кнопку редактирования', 'enhancement', 'На странице бага сделать кнопку редактирования', NULL, 22, 1383958954, NULL, 1384042725),
(56, 1, 3, NULL, 1, NULL, 'Приоритет для багов', 'idea', '', NULL, 23, 1383963201, NULL, 1383963201),
(57, 6, 3, NULL, 1, NULL, 'Скрывать описание бага когда оно не введено', 'bug', '', '', 24, 1383963225, NULL, 1384042615),
(58, 1, 3, NULL, 1, NULL, 'Добавить фильтрацию данных формы фильтров задач по проекту', 'enhancement', '', NULL, 25, 1384036361, NULL, 1384036361),
(59, 1, 3, NULL, 1, 54, 'Теги проекта', 'idea', 'облако тегов', NULL, 26, 1384042650, NULL, 1384042650),
(60, 1, 3, NULL, 1, 45, 'Виджет показа иссуе', 'featurerequest', 'Надо заменить на странице редактирования иссуе \r\nИ в дереве зависимостей иссуе на странице просмотре иссуе', NULL, 27, 1384042960, NULL, 1384042973),
(61, 6, 3, NULL, 1, 45, 'Выбор родительского иссуе на странице иссуе', 'featurerequest', '', NULL, 28, 1384043007, NULL, 1384474510),
(62, 1, 3, NULL, 1, NULL, 'Редактирование персональных данных пользователя', 'featurerequest', 'Имени и Email', NULL, 29, 1384043140, NULL, 1384043140),
(63, 2, 3, NULL, 1, NULL, 'Загрузка файлов для багов', 'featurerequest', '', NULL, 30, 1384043205, NULL, 1384475584),
(64, 6, 3, NULL, 1, 33, 'Причесать страницу добавление пользователей в проект', 'bug', 'Поиск вынести  виджет\r\nВывод тоже вывести в виджет', 'На страицу проекта\r\nВыбор пользователей', 31, 1384043341, NULL, 1384312022),
(65, 6, 3, NULL, 1, 64, 'Виджет поиска пользователей', 'featurerequest', 'Со страницы добавление пользователей в проект вынестив отдельное попап окно и виджет', NULL, 32, 1384043405, NULL, 1384312056),
(66, 1, 3, NULL, 1, 33, 'Сделать интерфейс добавления приглашение пользователей по email', 'featurerequest', '', NULL, 33, 1384043523, NULL, 1384043523),
(67, 6, 3, NULL, 1, NULL, 'Ограничить количество багов на странице проекта', 'bug', 'И отсортировать по активности, может еще и вывести активность', '', 34, 1384043596, NULL, 1384154058),
(68, 1, 3, NULL, 1, 67, 'Вынести список багов в виджет', 'enhancement', '', NULL, 35, 1384043649, NULL, 1384043649),
(69, 1, 3, NULL, 1, NULL, 'Сделать изменение типа багов на странице бага', 'featurerequest', '', NULL, 36, 1384043742, NULL, 1384043742),
(70, 1, 3, NULL, 1, NULL, 'Миграции', 'enhancement', '', NULL, 37, 1384382716, NULL, 1384382716),
(71, 1, 3, NULL, 1, 70, 'Перенести текщие таблицы в первую миграцию', 'enhancement', '', NULL, 38, 1384382776, NULL, 1384382776),
(72, 1, 3, NULL, 1, NULL, 'Переделать вывод цвета шага на примере исползования типа бага', 'enhancement', 'т.е убрать color из таблицы и переделать на стили css', NULL, 39, 1384386719, NULL, 1384386719),
(73, 1, 3, NULL, 1, NULL, 'пройтись по командам помылаемым со страницы отображения бага', 'enhancement', '', NULL, 40, 1384425041, NULL, 1384425041),
(74, 1, 3, NULL, 1, NULL, 'Открытые проекты', 'featurerequest', '', NULL, 41, 1384425066, NULL, 1384425066),
(75, 1, 3, NULL, 1, 74, 'Блокировать управление багом при просмотре открытого проекта', 'featurerequest', 'Редактировать могут только участники проекта\r\n', NULL, 42, 1384425105, NULL, 1384425105),
(76, 1, 3, NULL, 1, 60, 'В списке тасков заменить вид отображение таска на виджет', 'enhancement', '', NULL, 43, 1384425244, NULL, 1384425244),
(77, 6, 3, NULL, 1, NULL, 'Не создаются проекты', 'bug', 'Не моздаются новые проекты', '', 44, 1384570523, NULL, 1384644980),
(78, 6, 3, NULL, 1, 77, 'Проверить создание/редактирвоание проекта', 'featurerequest', '', NULL, 45, 1384570852, NULL, 1384644975),
(79, 2, 4, 6, 5, NULL, 'Что то не так как надо', 'bug', 'Что то не работает как иму положено и надо сделать так что бы все было ок.', 'Заходим сюда\r\nПототм сюда', 1, 1384643696, NULL, 1384643776),
(80, 1, 4, 5, 6, NULL, 'Создать новый проект', 'featurerequest', 'Что бы создать новый проект надо зайти в раздел "Projects"', NULL, 2, 1384643870, NULL, 1384644062),
(81, 1, 4, NULL, 6, 80, 'Добавить пользователей в проект', 'task', 'После создания проекта, пользователь будет перенаправлен на страницу проекта.', NULL, 3, 1384644017, NULL, 1384644017),
(82, 6, 2, NULL, 1, 42, 'Учесть оплату безналом при совершении заказа', 'featurerequest', 'Показывать стоимость при оплате безналом в процедуре заказа order2', NULL, 10, 1385865289, NULL, 1399643816),
(83, 6, 2, NULL, 1, NULL, 'Проверить коллекции для товаров', 'other', 'http://liningspb.ru/good/13428/\r\nhttp://liningspb.ru/good/10256/\r\nhttp://liningspb.ru/good/3688/\r\nhttp://liningspb.ru/good/10393/\r\nhttp://liningspb.ru/good/3521/\r\nhttp://liningspb.ru/good/9035/', NULL, 11, 1385929502, NULL, 1399643941),
(84, 4, 2, NULL, 1, NULL, 'На Сане поиск товаров в админке', 'featurerequest', 'как на лилинге', NULL, 12, 1385929615, NULL, 1392472704),
(85, 4, 2, NULL, 1, NULL, 'Пакетный операции в корзине на сане', 'featurerequest', 'Нужна пакетка на сане в удаленных товарах что их можно было от туда\r\nудалять разом', NULL, 13, 1385929744, NULL, 1399643997),
(86, 6, 2, NULL, 1, NULL, 'Проверить добавление товара в корзину на лининге', 'task', 'Рандомно товары из категории 3d панелей', NULL, 14, 1385954020, NULL, 1385967494),
(87, 1, 2, NULL, 1, NULL, 'Ленивая загрузка товаров на товаров на лининге на странице товара.', 'featurerequest', 'Долго загружается страница товароа если в тойже коллекцие много товаров \r\nhttp://www.liningspb.ru/good/790/', NULL, 15, 1386151341, NULL, 1386151341),
(88, 1, 2, NULL, 1, NULL, 'Проверить все картинки на линиге и на сане и пожать их', 'featurerequest', 'Загружены большие картинки', NULL, 16, 1386151450, NULL, 1386151863),
(89, 1, 2, NULL, 1, 88, 'Сделать сжатие изображений при загрузке товаров на лининг', 'featurerequest', '', NULL, 17, 1386151521, NULL, 1386151521),
(90, 1, 2, NULL, 1, NULL, 'В редактор текста попробовать убрать цветовое оформление', 'featurerequest', 'Что бы на сане заносимый товар очищал стили цвета, оставлял только часть форматирования.\r\n\r\nЗадача два это добавить цвет сана в список цветов.', NULL, 18, 1386152212, NULL, 1386152212),
(91, 6, 2, NULL, 1, NULL, 'Добавить фавикон на сан в админку', 'featurerequest', '', NULL, 19, 1386152242, NULL, 1392472741),
(92, 6, 2, NULL, 1, NULL, 'На сане сделать фильтрацию по производителю в рамках одного раздела.', 'featurerequest', '', NULL, 20, 1386153543, NULL, 1399644025),
(93, 6, 2, NULL, 1, NULL, 'На лининге не работает корзина', 'bug', '[13:49:46] Максим: слуша покопался на лининенге\r\n[13:52:38] Максим: там вот такая история товары у которых включен калькулятор карзина не пашет а у которых калькулятор не включен все работает я имею ввиду в карточке товара\r\n[13:52:58] Илья: о, слушай вот это реально дельное замечание\r\n[13:53:03] Максим: к примеру http://liningspb.ru/good/14358/\r\n[13:53:13] Максим: этот работает\r\n[13:53:43] Максим: http://liningspb.ru/good/11330/\r\n[13:53:52] Максим: а этот уже нет\r\n[13:54:46] Максим: еще вопрос как можно на линенге кеш принудительно обновить\r\n[13:54:57] Максим: что бы ночи не ждать\r\n', 'Нет последовательности', 21, 1386640582, NULL, 1392473881),
(94, 6, 3, NULL, 1, NULL, 'Глюк с классом прочности', 'bug', '[14:10:54] Максим: http://liningspb.ru/good/14358/\r\n[14:11:20] Максим: еще глюк класс прочности не выбран а выводит значение 0\r\n[14:11:37] Максим: я тебе вчера на почту писал по этому поводу\r\n[14:11:53] Максим: правдо этот глюк не везде вылазит\r\n[14:12:05] Максим: не понятно с чем связанно\r\n', '', 46, 1386641830, NULL, 1386742154),
(95, 6, 2, NULL, 1, NULL, 'Глюк с классом прочности', 'bug', '[14:10:54] Максим: http://liningspb.ru/good/14358/\r\n[14:11:20] Максим: еще глюк класс прочности не выбран а выводит значение 0\r\n[14:11:37] Максим: я тебе вчера на почту писал по этому поводу\r\n[14:11:53] Максим: правдо этот глюк не везде вылазит\r\n[14:12:05] Максим: не понятно с чем связанно', '', 22, 1386742181, NULL, 1399644052),
(96, 1, 5, NULL, 1, NULL, 'Дополнительные поля для матчей', 'enhancement', 'status - "canceled", "finished"\r\nfinish_time \r\n\r\nBets is_canceled\r\ncanceled_time\r\n\r\n', NULL, 1, 1387484012, NULL, 1387484012),
(97, 1, 5, NULL, 1, NULL, 'Доработать парсер', 'bug', 'В парсере не выводить матчи если результат победы одно команды над другой больше 5', 'Парсер', 2, 1387484083, NULL, 1387484083),
(98, 4, 2, NULL, 1, NULL, 'Пакетное удаление товаров из корзины на сане', 'featurerequest', 'Решили сделать кнопку очитски', NULL, 23, 1389060041, NULL, 1392473192),
(99, 1, 5, NULL, 1, NULL, 'Содержание email', 'task', 'Переписать сообщения, \r\n- регистрации\r\n- восстановление пароля', NULL, 3, 1391722964, NULL, 1391722964),
(100, 1, 5, NULL, 1, NULL, 'Проверять статус пользователя при регистрации и при запрое нового пароля', 'enhancement', '', NULL, 4, 1391759226, NULL, 1391759226),
(101, 3, 5, NULL, 1, NULL, 'При регистрации давать денег', 'featurerequest', '', NULL, 5, 1391759403, NULL, 1392646954),
(102, 1, 5, NULL, 1, NULL, 'Добавить капчу на восстановление пароля', 'featurerequest', '', NULL, 6, 1391759423, NULL, 1391759423),
(103, 3, 5, NULL, 1, NULL, 'Регистрация, восстановление пароля', 'featurerequest', '', NULL, 7, 1391759483, NULL, 1391759512),
(104, 6, 5, NULL, 1, NULL, 'dotabet.pro', 'enhancement', '', NULL, 8, 1392452876, NULL, 1392646875),
(105, 1, 5, NULL, 1, NULL, 'dotabet.pro', 'enhancement', '', NULL, 9, 1392453006, NULL, 1392453006),
(106, 1, 5, NULL, 1, NULL, 'На странице информаци о пользователе вывести баланс', 'featurerequest', 'И кнопку пополнить баланс которая будет вести на страницу "хочу сто !00$"', NULL, 10, 1392453126, NULL, 1392453291),
(107, 1, 5, NULL, 1, NULL, 'ПЕредлать ставки на три столбка', 'featurerequest', '', NULL, 11, 1392453529, NULL, 1392453529),
(108, 1, 5, NULL, 1, NULL, 'Переаод писем на инглиш', 'featurerequest', '', NULL, 12, 1392453567, NULL, 1392453567),
(109, 1, 5, NULL, 1, NULL, 'Анансирование о матчах по потче', 'featurerequest', 'За три часа до начала приемма ставок.', NULL, 13, 1392453706, NULL, 1392453706),
(110, 1, 5, NULL, 1, NULL, 'Дизайн писем', 'featurerequest', 'О расылке', NULL, 14, 1392453768, NULL, 1392453768),
(111, 1, 5, NULL, 1, NULL, 'Страница команды', 'featurerequest', 'со всеми матчами команды', NULL, 15, 1392454400, NULL, 1392454400),
(112, 1, 5, NULL, 1, NULL, 'ПЕренос ставок между матчами', 'featurerequest', 'Очень аккуратно, чтобы небыло коллизий', NULL, 16, 1392454603, NULL, 1392454603),
(113, 1, 5, NULL, 1, NULL, 'О не состоявшемся матче', 'featurerequest', 'Если матч не состоялся тогда перенаправлять на другой матч', NULL, 17, 1392454675, NULL, 1392455056),
(114, 4, 2, NULL, 1, NULL, 'Купить в один клик на сане', 'featurerequest', 'Два поля для ввода 1. Телефон 2. Коментарий для имя, количества и ????', NULL, 24, 1392472955, NULL, 1399644099),
(115, 1, 2, NULL, 1, NULL, 'Сделать скидки по акциям по времени суток ', 'idea', 'Например акция будет действовать с 18-10 утра', NULL, 25, 1392473085, NULL, 1392473085),
(116, 1, 2, 1, 1, NULL, 'Цены по запросы на сан', 'featurerequest', 'Чек бокс ставим и цена не показыватся, в корзину такие товары не добавляются!', NULL, 26, 1392474084, NULL, 1399645451),
(117, 1, 2, NULL, 1, NULL, 'на сане что бы картинка качалась так же как на БП', 'featurerequest', 'тоесть что бы картинка предварительного просмотра и основное изображение', NULL, 27, 1392474211, NULL, 1392474211),
(118, 1, 2, NULL, 1, NULL, 'На всех сатах сделать свободный ввод города в процедуре заказа', 'featurerequest', '', NULL, 28, 1392474343, NULL, 1392474343),
(119, 6, 2, NULL, 1, NULL, 'На сане при выборе производщителя в категории при переходе на вторую страницу сбрасывает выбор производителля', 'bug', 'На сане при выборе производщителя в категории при переходе на вторую страницу сбрасывает выбор производителля', 'Зайти в категрию\r\nВыьрать произвозителя так что бы было больше 1 страницы\r\nПерейти на страницу 2\r\nВуаля производитель сбросился', 29, 1392474605, NULL, 1399644239),
(120, 1, 2, NULL, 1, 42, 'Округлять цены на всех сайтах', 'featurerequest', 'Цены округлять по "умному"', NULL, 30, 1392474783, NULL, 1392474783),
(121, 6, 2, NULL, 1, NULL, 'НЕ печатается двоеточие', 'bug', 'В дополнительных свойствах товара при вывода в списке товаров и на странице товара', 'http://sanspb.ru/good.aspx?id=1048', 31, 1392474954, NULL, 1399644880),
(122, 6, 2, NULL, 1, NULL, 'На сане в админке при фильтрации товарор по производителю убрать выаод ид из спика', 'bug', '', '', 32, 1392475317, NULL, 1399644923),
(123, 6, 2, NULL, 1, NULL, 'На саине в спике товаров который в акции нет выравнивания по высоте', 'bug', ',Проверить акции на линиге и сане', '', 33, 1392475548, NULL, 1399645055),
(124, 3, 6, NULL, 1, NULL, 'Изменить форму заказа топлива', 'task', 'сабж', NULL, 1, 1395898314, NULL, 1395904910),
(125, 1, 6, NULL, 1, NULL, 'Спросить про цветовую картинку', 'other', '', NULL, 2, 1395904934, NULL, 1395904934),
(126, 1, 6, NULL, 1, NULL, 'При открытии картинки в галерее открывать в плагине просмотра изображений', 'task', '', NULL, 3, 1396675480, NULL, 1396675480),
(127, 1, 2, NULL, 1, NULL, 'На сане в админке в заказах', 'enhancement', 'На странице показа инофрмации о заказзе вывести информациб о пользователе совершившем заказ', NULL, 34, 1399634633, NULL, 1399636522),
(128, 6, 2, NULL, 1, 42, 'На сане в корзине если ты не авторизован каша с информацией', 'bug', 'На сане в корзине если ты не авторизован каша с информацией', 'На сане в корзине если ты не авторизован каша с информацией', 35, 1399636282, NULL, 1401789442),
(129, 6, 2, NULL, 1, 42, 'Не работает изменение количество товаров в корзине если ты не авторизован', 'bug', 'Не работает изменение количество товаров в корзине если ты не авторизован', 'Не работает изменение количество товаров в корзине если ты не авторизован', 36, 1399636324, NULL, 1401789295),
(130, 6, 2, NULL, 1, 42, 'После заказа не очищается корзина', 'bug', '', '', 37, 1399636459, NULL, 1401789422),
(131, 1, 2, NULL, 1, NULL, 'Выравнивание высоты товаров, в товахколлекции', 'bug', 'http://liningspb.ru/good/3521/', 'Проверить остальные места.', 38, 1399643927, NULL, 1399643927),
(132, 1, 2, NULL, 1, NULL, 'На сане в акциях кнопка добавить в "корзину" не правитльная', 'bug', 'Счасс ввиде ссылки на надо в виде кнопки', '', 39, 1399645151, NULL, 1399645151),
(133, 1, 2, NULL, 1, NULL, 'На сайне в админке сделат глобальный поиск по имени и артикулу', 'enhancement', '', NULL, 40, 1399645266, NULL, 1399645266),
(134, 1, 2, NULL, 1, NULL, 'На грейте и лининге и вдоме надо убрать meta данные из карточки редактирования товара', 'enhancement', 'н', NULL, 41, 1399646043, NULL, 1402810749),
(135, 1, 2, NULL, 1, NULL, 'Облагородить форму фильтрации товаров в каталоге на сане ', 'enhancement', 'НАДО НАЙТИ КАРТИНКУ', NULL, 42, 1399647833, NULL, 1399647833),
(136, 3, 2, NULL, 1, NULL, 'На сане удрать регистрацию, вместо регистрации вставить обратный звонок', 'enhancement', '', NULL, 43, 1399647985, NULL, 1402747251),
(137, 6, 2, NULL, 1, NULL, 'На БП и лининге', 'enhancement', '1. В корзине на кнопках управления сделать курсор как на ссылках.\r\n2. В процедуре заказа "назад к корзине" починить и курсор тоже\r\n3. Съехавшая картинка\r\n4. Вывести цену при "оплате по безналичному расчету или банковской картой" \r\n5. Фразу про оплату надо вывести и на сане', NULL, 44, 1399649651, NULL, 1401789279),
(138, 3, 2, NULL, 1, NULL, 'На лининге на и грейте вместо выбора города сделать свободное поле обязательное', 'enhancement', '', NULL, 45, 1401789229, NULL, 1402810190),
(139, 3, 2, NULL, 1, NULL, 'на грейте в корзине на странице result нет оплаты безналом', 'featurerequest', 'на ', NULL, 46, 1401790283, NULL, 1402760733),
(140, 3, 2, NULL, 1, NULL, 'На лининге на странице результ, переходы на редактирование каждого пункта', 'featurerequest', '', NULL, 47, 1401790322, NULL, 1402747191),
(141, 3, 2, NULL, 1, NULL, 'на грейте в заказе', 'featurerequest', 'на странице результатов теляется форматирование пунктов оплаты и доставки', NULL, 48, 1401790554, NULL, 1402746426),
(142, 3, 2, NULL, 1, NULL, 'на грейте в акциях сделать пункты автоматически форматирование по высоте', 'featurerequest', '', NULL, 49, 1401790634, NULL, 1402745601),
(143, 3, 2, NULL, 1, NULL, 'На лининге сделать главную страницу так что бы было можно ее заполнять', 'enhancement', '', NULL, 50, 1401795138, NULL, 1402737999),
(144, 6, 2, NULL, 1, 141, 'на грейте в процедуре заказа везде вывести оплату безналом', 'enhancement', '', NULL, 51, 1402745645, NULL, 1402746492),
(145, 1, 3, NULL, 1, NULL, 'Прикрутить вики разметку к описаниям и коментам багов', 'featurerequest', '', NULL, 47, 1402808155, NULL, 1402808155);

-- --------------------------------------------------------

--
-- Структура таблицы `bugs_has_bugs`
--

CREATE TABLE IF NOT EXISTS `bugs_has_bugs` (
  `bug_1` int(11) DEFAULT NULL,
  `bug_2` int(11) DEFAULT NULL,
  KEY `fk_bugs_has_bugs_bugs2` (`bug_2`),
  KEY `fk_bugs_has_bugs_bugs1` (`bug_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=408 ;

--
-- Дамп данных таблицы `comments`
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
(176, 1, 65, 1384048753, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(177, 1, 67, 1384154058, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(178, 1, 53, 1384311918, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(179, 1, 64, 1384312022, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(180, 1, 65, 1384312050, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(181, 1, 65, 1384312056, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(182, 1, 45, 1384319205, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(183, 1, 70, 1384382716, 'system', 'Issue created'),
(184, 1, 71, 1384382776, 'system', 'Issue created'),
(185, 1, 72, 1384386719, 'system', 'Issue created'),
(186, 1, 73, 1384425041, 'system', 'Issue created'),
(187, 1, 74, 1384425066, 'system', 'Issue created'),
(188, 1, 75, 1384425105, 'system', 'Issue created'),
(189, 1, 76, 1384425244, 'system', 'Issue created'),
(190, 1, 45, 1384425265, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(191, 1, 61, 1384474510, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(192, 1, 45, 1384474520, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(193, 1, 45, 1384474523, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(194, 1, 35, 1384475298, 'system', 'User <b>Jon Doe</b> change issue type to <b>Feature request</b> '),
(195, 1, 34, 1384475344, 'system', 'User <b>Jon Doe</b> change issue type to <b>Feature request</b> '),
(196, 1, 63, 1384475361, 'system', 'User <b>Jon Doe</b> change issue type to <b>Feature request</b> '),
(197, 1, 63, 1384475584, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(198, 1, 77, 1384570523, 'system', 'Issue created'),
(199, 1, 78, 1384570852, 'system', 'Issue created'),
(200, 1, 36, 1384634395, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(201, 1, 39, 1384638410, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(202, 5, 79, 1384643696, 'system', 'Issue created'),
(203, 5, 79, 1384643741, 'system', 'User <b>demo</b> set status <b>Worked on</b> '),
(204, 5, 79, 1384643776, 'system', 'User <b>demo</b> set assigned user <b>User</b> '),
(205, 6, 80, 1384643870, 'system', 'Issue created'),
(206, 6, 81, 1384644017, 'system', 'Issue created'),
(207, 6, 80, 1384644046, 'system', 'User <b>User</b> set assigned user <b>User</b> '),
(208, 6, 80, 1384644062, 'system', 'User <b>User</b> set assigned user <b>demo</b> '),
(209, 1, 78, 1384644975, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(210, 1, 77, 1384644980, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(211, 1, 54, 1384645034, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(212, 1, 38, 1385171102, 'user', '2000р'),
(213, 1, 38, 1385171108, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(214, 1, 38, 1385171112, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(215, 1, 37, 1385185094, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(216, 1, 37, 1385185099, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(217, 1, 37, 1385185184, 'user', '- перемещение по категориям\r\n- скрытие \r\n- отображение\r\n- удаление\r\n\r\n2000р'),
(218, 1, 42, 1385864050, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(219, 1, 42, 1385864073, 'user', 'На сане проверить глюк с пропаданием корзины'),
(220, 1, 82, 1385865289, 'system', 'Issue created'),
(221, 1, 83, 1385929502, 'system', 'Issue created'),
(222, 1, 84, 1385929615, 'system', 'Issue created'),
(223, 1, 38, 1385929675, 'user', 'Можно переместить доп. свойства в карточке товара в админке повыше\r\nНапример под текстовый редактор или заголовок там где ти'),
(224, 1, 38, 1385929683, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(225, 1, 85, 1385929744, 'system', 'Issue created'),
(226, 1, 86, 1385954020, 'system', 'Issue created'),
(227, 1, 86, 1385967486, 'user', 'Проверил в хроме, фф, и на планшете.\r\nНа планшете медленно но все равно работает.\r\n\r\n250р'),
(228, 1, 86, 1385967494, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(229, 1, 83, 1385968480, 'user', 'Поправил вывод коллекций.\r\nПоследсвия изменившегося алгоритма вывода \r\n\r\n250р'),
(230, 1, 83, 1385968491, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(231, 1, 83, 1385968494, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(232, 1, 87, 1386151341, 'system', 'Issue created'),
(233, 1, 88, 1386151450, 'system', 'Issue created'),
(234, 1, 89, 1386151521, 'system', 'Issue created'),
(235, 1, 88, 1386151863, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(236, 1, 90, 1386152212, 'system', 'Issue created'),
(237, 1, 91, 1386152242, 'system', 'Issue created'),
(238, 1, 92, 1386153543, 'system', 'Issue created'),
(239, 1, 93, 1386640582, 'system', 'Issue created'),
(240, 1, 93, 1386641792, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(241, 1, 94, 1386641830, 'system', 'Issue created'),
(242, 1, 93, 1386742057, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(243, 1, 93, 1386742061, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(244, 1, 94, 1386742154, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(245, 1, 95, 1386742181, 'system', 'Issue created'),
(246, 1, 95, 1386742367, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(247, 1, 95, 1386742370, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(248, 1, 82, 1387270674, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(249, 1, 82, 1387270678, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(250, 1, 42, 1387270723, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(251, 1, 42, 1387276289, 'user', '1. Вместо выбора города сделать свободное поле для ввода города.\r\n2. Убрать способы оплаты совсем.\r\n3. Если выбран самовывоз'),
(252, 1, 42, 1387276332, 'user', '3. Если выбран самовывоз блокировать поля об адресе.\r\n4. Отсылать емаил о заказе с информацией о заказе.\r\n"для уведомления п'),
(253, 1, 42, 1387276355, 'user', '"для уведомления по почте"\r\n5. Внизу рядом с ценой выводить так же стоимость при оплате безналом.\r\n'),
(254, 1, 37, 1387276521, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(255, 1, 37, 1387276544, 'user', 'доделать пакетное обновление цены'),
(256, 1, 96, 1387484012, 'system', 'Issue created'),
(257, 1, 97, 1387484083, 'system', 'Issue created'),
(258, 1, 37, 1389059890, 'user', 'доделал пакетную обработки цены товара\r\n1000р'),
(259, 1, 37, 1389059913, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(260, 1, 37, 1389059918, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(261, 1, 98, 1389060041, 'system', 'Issue created'),
(262, 1, 98, 1389061832, 'user', 'Кнопку очистки корзины сделал \r\n500\r\nСам проверить не могу, надо всеста с парнями'),
(263, 1, 98, 1389061839, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(264, 1, 98, 1389061843, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(265, 1, 91, 1389062802, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(266, 1, 91, 1389062806, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(267, 1, 84, 1389071166, 'user', 'сделал 2000'),
(268, 1, 84, 1389071181, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(269, 1, 84, 1389071185, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(270, 1, 99, 1391722964, 'system', 'Issue created'),
(271, 1, 100, 1391759226, 'system', 'Issue created'),
(272, 1, 101, 1391759403, 'system', 'Issue created'),
(273, 1, 102, 1391759423, 'system', 'Issue created'),
(274, 1, 103, 1391759483, 'system', 'Issue created'),
(275, 1, 103, 1391759508, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(276, 1, 103, 1391759512, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(277, 1, 101, 1392452628, 'user', 'С возможностью изменить из админки.'),
(278, 1, 104, 1392452876, 'system', 'Issue created'),
(279, 1, 105, 1392453006, 'system', 'Issue created'),
(280, 1, 106, 1392453126, 'system', 'Issue created'),
(281, 1, 106, 1392453291, 'user', 'Рядом с балансом вывести последние операции и кнопку перехода к полному списку.'),
(282, 1, 107, 1392453529, 'system', 'Issue created'),
(283, 1, 108, 1392453567, 'system', 'Issue created'),
(284, 1, 109, 1392453706, 'system', 'Issue created'),
(285, 1, 110, 1392453768, 'system', 'Issue created'),
(286, 1, 111, 1392454400, 'system', 'Issue created'),
(287, 1, 112, 1392454603, 'system', 'Issue created'),
(288, 1, 113, 1392454675, 'system', 'Issue created'),
(289, 1, 113, 1392455056, 'user', 'При отмене матча отменять ставки'),
(290, 1, 84, 1392472656, 'user', 'Глобальный поиск товаров в админке на сане'),
(291, 1, 84, 1392472663, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(292, 1, 84, 1392472704, 'user', 'Поиск по артиулу'),
(293, 1, 91, 1392472741, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(294, 1, 114, 1392472955, 'system', 'Issue created'),
(295, 1, 115, 1392473085, 'system', 'Issue created'),
(296, 1, 98, 1392473185, 'user', 'Подумать что делать с кешем странице при удалении всех товаров из корзины'),
(297, 1, 98, 1392473192, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(298, 1, 37, 1392473833, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(299, 1, 93, 1392473881, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(300, 1, 116, 1392474084, 'system', 'Issue created'),
(301, 1, 117, 1392474211, 'system', 'Issue created'),
(302, 1, 118, 1392474343, 'system', 'Issue created'),
(303, 1, 119, 1392474605, 'system', 'Issue created'),
(304, 1, 120, 1392474783, 'system', 'Issue created'),
(305, 1, 121, 1392474954, 'system', 'Issue created'),
(306, 1, 122, 1392475317, 'system', 'Issue created'),
(307, 1, 123, 1392475548, 'system', 'Issue created'),
(308, 1, 104, 1392646875, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(309, 1, 101, 1392646918, 'user', 'Не давать т.к. будет кнопка добавить'),
(310, 1, 101, 1392646950, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(311, 1, 101, 1392646954, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(312, 1, 124, 1395898314, 'system', 'Issue created'),
(313, 1, 124, 1395904906, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(314, 1, 124, 1395904910, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(315, 1, 125, 1395904934, 'system', 'Issue created'),
(316, 1, 126, 1396675480, 'system', 'Issue created'),
(317, 1, 119, 1398582956, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(318, 1, 119, 1398582960, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(319, 1, 114, 1398583013, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(320, 1, 114, 1398583016, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(321, 1, 92, 1398583101, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(322, 1, 92, 1398583104, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(323, 1, 85, 1398583342, 'user', 'Имеется в виду кнопка очистки корзины'),
(324, 1, 85, 1398583470, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(325, 1, 85, 1398583474, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(326, 1, 122, 1398587105, 'user', 'http://sanspb.ru/admin/shop/item.aspx?catalog=45&parrent=1'),
(327, 1, 122, 1398587124, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(328, 1, 122, 1398587128, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(329, 1, 123, 1398588592, 'user', 'http://sanspb.ru/hot_show.aspx?id=65'),
(330, 1, 123, 1398588597, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(331, 1, 123, 1398588601, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(332, 1, 121, 1398588707, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(333, 1, 121, 1398588989, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(334, 1, 127, 1399634633, 'system', 'Issue created'),
(335, 1, 128, 1399636282, 'system', 'Issue created'),
(336, 1, 129, 1399636324, 'system', 'Issue created'),
(337, 1, 130, 1399636459, 'system', 'Issue created'),
(338, 1, 127, 1399636522, 'system', 'Issue updated by  <b>Jon Doe</b> '),
(339, 1, 42, 1399636598, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(340, 1, 82, 1399643816, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(341, 1, 131, 1399643927, 'system', 'Issue created'),
(342, 1, 83, 1399643941, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(343, 1, 85, 1399643975, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(344, 1, 85, 1399643997, 'user', 'После очистки корзины не происходит обновления страницы.'),
(345, 1, 92, 1399644025, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(346, 1, 95, 1399644052, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(347, 1, 114, 1399644099, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(348, 1, 119, 1399644239, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(349, 1, 121, 1399644880, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(350, 1, 122, 1399644923, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(351, 1, 123, 1399645055, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(352, 1, 132, 1399645151, 'system', 'Issue created'),
(353, 1, 133, 1399645266, 'system', 'Issue created'),
(354, 1, 116, 1399645374, 'user', 'На всех сайтах'),
(355, 1, 116, 1399645451, 'system', 'User <b>Jon Doe</b> set assigned user <b>Jon Doe</b> '),
(356, 1, 134, 1399646043, 'system', 'Issue created'),
(357, 1, 135, 1399647833, 'system', 'Issue created'),
(358, 1, 136, 1399647985, 'system', 'Issue created'),
(359, 1, 137, 1399649651, 'system', 'Issue created'),
(360, 1, 129, 1399817860, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(361, 1, 129, 1399817866, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(362, 1, 128, 1399817873, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(363, 1, 128, 1399817885, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(364, 1, 130, 1399817893, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(365, 1, 130, 1399817898, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(366, 1, 137, 1401251912, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(367, 1, 137, 1401517634, 'user', 'Куча мелких изменений'),
(368, 1, 137, 1401517792, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(369, 1, 136, 1401517845, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(370, 1, 136, 1401517856, 'user', 'Обратный звонок?'),
(371, 1, 136, 1401776804, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(372, 1, 138, 1401789229, 'system', 'Issue created'),
(373, 1, 136, 1401789254, 'user', 'Ченить придумать в внешним видом'),
(374, 1, 136, 1401789261, 'system', 'User <b>Jon Doe</b> set status <b>Re work</b> '),
(375, 1, 137, 1401789279, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(376, 1, 129, 1401789295, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(377, 1, 130, 1401789422, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(378, 1, 128, 1401789442, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(379, 1, 139, 1401790283, 'system', 'Issue created'),
(380, 1, 140, 1401790322, 'system', 'Issue created'),
(381, 1, 141, 1401790554, 'system', 'Issue created'),
(382, 1, 142, 1401790634, 'system', 'Issue created'),
(383, 1, 143, 1401795138, 'system', 'Issue created'),
(384, 1, 143, 1402737996, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(385, 1, 143, 1402737999, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(386, 1, 142, 1402745597, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(387, 1, 142, 1402745601, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(388, 1, 144, 1402745645, 'system', 'Issue created'),
(389, 1, 141, 1402746404, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(390, 1, 141, 1402746407, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(391, 1, 141, 1402746426, 'user', 'тоже самое сделал на линиге'),
(392, 1, 144, 1402746462, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(393, 1, 144, 1402746466, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(394, 1, 144, 1402746469, 'system', 'User <b>Jon Doe</b> set status <b>Closed</b> '),
(395, 1, 144, 1402746492, 'user', 'дублирование с #46'),
(396, 1, 140, 1402747188, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(397, 1, 140, 1402747191, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(398, 1, 136, 1402747244, 'user', 'чето придумал с внешним видом'),
(399, 1, 136, 1402747248, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(400, 1, 136, 1402747251, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(401, 1, 139, 1402760729, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(402, 1, 139, 1402760733, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(403, 1, 138, 1402808097, 'user', 'Выводить что ни по дефолту? \r\nНадо посмотреть как у других сделано.'),
(404, 1, 145, 1402808155, 'system', 'Issue created'),
(405, 1, 138, 1402810186, 'system', 'User <b>Jon Doe</b> set status <b>Worked on</b> '),
(406, 1, 138, 1402810190, 'system', 'User <b>Jon Doe</b> set status <b>Ready for testing</b> '),
(407, 1, 134, 1402810749, 'user', 'на грейте и лининге сделал, надо еще не сане');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned DEFAULT '1' COMMENT 'Владелец проекта',
  `name` varchar(128) NOT NULL,
  `code` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_user1` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `owner_id`, `name`, `code`, `description`) VALUES
(1, 1, 'Lodb', 'lodba', 'London escort DB'),
(2, 1, 'БП', 'greatbuy', 'по сайтам:\r\nsanspb.ru\r\ngreatbuy.ru (большаяпокупка.рф)\r\nliningspb.ru\r\nsexvdom.ru'),
(3, 1, 'Грабли', 'grabli', 'Это этот проект\r\nЭто этот проект\r\nЭто этот проект'),
(4, 5, 'Demo project', 'demoproject', 'Пробный проект'),
(5, 1, 'Дота Бет', 'dotabett', 'Букмекерский сайт по доте'),
(6, 1, 'tk-unioil.com', 'unioil', 'Сайт для макса');

-- --------------------------------------------------------

--
-- Структура таблицы `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `color` varchar(20) NOT NULL,
  `order_by` int(5) unsigned NOT NULL COMMENT 'Sort order',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `steps`
--

INSERT INTO `steps` (`id`, `name`, `code`, `description`, `color`, `order_by`) VALUES
(1, 'Create', 'create', 'New issue', 'white', 10),
(2, 'Worked on', 'workedon', 'in work', 'green', 20),
(3, 'Ready for testing', 'readyfortesting', 'Ready for testing', 'blue', 30),
(4, 'Re work', 'rework', 'Re working', 'orange', 40),
(5, 'Re open', 'reopen', 'Reopened', 'yellow', 50),
(6, 'Closed', 'closed', 'Closed', 'black', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `steps_has_steps`
--

CREATE TABLE IF NOT EXISTS `steps_has_steps` (
  `steps_from` int(11) DEFAULT NULL,
  `steps_to` int(11) NOT NULL,
  KEY `fk_steps_has_steps_steps2` (`steps_to`),
  KEY `fk_steps_has_steps_steps1` (`steps_from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `steps_has_steps`
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
-- Структура таблицы `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `abbreviation` varchar(3) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `order_by` int(5) unsigned NOT NULL COMMENT 'Sort order',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `name`, `abbreviation`, `code`, `description`, `order_by`) VALUES
(1, 'Bug', 'B', 'bug', 'bug', 10),
(2, 'Feature request', 'Fr', 'featurerequest', 'Feature request', 20),
(3, 'Enhancement', 'E', 'enhancement', 'Enhancement', 30),
(4, 'Task', 'T', 'task', 'Task', 40),
(5, 'Idea', 'I', 'idea', 'Idea', 50),
(6, 'Other', 'O', 'other', 'Other', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `owner_id`, `name`, `email`, `password`, `status`, `last_activity`) VALUES
(1, 1, 'Jon Doe', 'the.ilja@gmail.com', '123', 'worked', 0),
(2, 1, 'lesik', 'aa@ddd.www', '123', 'worked', 0),
(3, 1, 'UNK', 'the.ilja@gmail.com', '123', 'worked', 0),
(4, NULL, 'Абдула', 'vangel@yandex.ru', '123123', 'worked', 1383551729),
(5, NULL, 'demo', 'demo@demo.demo', 'demo', 'worked', 1384643566),
(6, NULL, 'User', 'user@demo.demo', 'user', 'worked', 1384643030);

-- --------------------------------------------------------

--
-- Структура таблицы `user_has_projects`
--

CREATE TABLE IF NOT EXISTS `user_has_projects` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  KEY `fk_user_has_projects_projects1` (`project_id`),
  KEY `fk_user_has_projects_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_has_projects`
--

INSERT INTO `user_has_projects` (`user_id`, `project_id`) VALUES
(1, 1),
(3, 1),
(1, 2),
(1, 3),
(4, 3),
(5, 4),
(6, 4),
(1, 5),
(1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
