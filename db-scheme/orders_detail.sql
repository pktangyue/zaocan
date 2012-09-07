USE `zaocan`;
CREATE TABLE `orders_detail` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `oid` int(11) NOT NULL,
    `gid` int(11) NOT NULL,
    `name` varchar(32) NOT NULL,
    `price` float(11,2) NOT NULL,
    `number` int(11) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
