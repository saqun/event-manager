--
-- 'custom_events' table
--
DROP TABLE IF EXISTS `custom_events`;
CREATE TABLE IF NOT EXISTS `custom_events` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT FALSE,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `custom_events` (`name`, `description`, `start`, `finish`, `location`, `category`, `private`) VALUES
('Learning how to bike', 'A first attempt to be comfortable on a bike', '2018-09-01 10:00:00', '2018-09-01 12:00:00', 'Chicago', 'Sport', FALSE),
('How to make cocktail', 'Some secret recipes on how to make astonishing cocktails', '2018-09-15 15:00:00', '2018-09-15 18:00:00', 'Los Angeles', 'Hospitality', FALSE),
('Kayaking', 'First trip in kayak', '2020-12-01 09:00:00', '2020-12-01 12:00:00', 'Los Angeles', 'Sport', TRUE),
('A perfect serving', 'Learn all the ins and outs of serving in a fancy bar or restaurant', '2021-03-20 18:00:00', '2021-03-20 20:00:00', 'New York', 'Hospitality', FALSE),
('Improve your swimming experience', 'Swimming can be energy consuming if not done properly, you will learn how to swim for hours without any effort', '2022-07-08 11:00:00', '2022-07-08 12:00:00', 'New York', 'Sport', FALSE),
('L.A. music festival', 'The most underground music festival in California', '2022-08-15 16:00:00', '2022-08-16 01:00:00', 'Los Angeles', 'Music', FALSE),
('Horse riding', 'A horse excursion in a beautiful western-like area', '2022-10-25 14:00:00', '2022-10-25 17:00:00', 'Houston', 'Sport', TRUE);