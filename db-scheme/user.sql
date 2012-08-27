USE `zaocan`;
CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(16) NOT NULL,
    `name` varchar(16) DEFAULT NULL,
    `password` varchar(32) DEFAULT NULL,
    `is_register` tinyint(1) DEFAULT '0',
    `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
