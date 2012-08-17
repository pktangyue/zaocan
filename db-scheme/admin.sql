USE `zaocan`;
CREATE TABLE `admin` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(16) NOT NULL,
    `password` varchar(32) NOT NULL,
    `token` varchar(128) DEFAULT NULL,
    `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into admin (name,password) values ('pktangyue','f4be50f49d25982f4acdd1a98d51b4e0');
