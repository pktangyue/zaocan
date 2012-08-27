USE `zaocan`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `uid` int(11) NOT NULL,
    `aid` int(11) NOT NULL,
    `total_price` float(11,2) NOT NULL,
    `status` enum('waiting','deleted','completed') DEFAULT 'waiting',
    `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
