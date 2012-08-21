USE `zaocan`;
CREATE TABLE `goods` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(32) NOT NULL,
    `price` float(11,2) NOT NULL,
    `is_set` tinyint(1) DEFAULT '0',
    `is_delete` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
