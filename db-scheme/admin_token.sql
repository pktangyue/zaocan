USE `zaocan`;
CREATE TABLE `admin_token` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `uid` int(11) NOT NULL,
    `series` varchar(12) NOT NULL,
    `token` varchar(128) NOT NULL,
    `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uid_series` (`uid`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
