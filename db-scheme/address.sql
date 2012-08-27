USE `zaocan`;
CREATE TABLE `address` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `uid` int(11) NOT NULL,
    `one` varchar(64) NOT NULL,
    `two` varchar(64) NOT NULL,
    `three` varchar(64) NOT NULL,
    `is_current` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
