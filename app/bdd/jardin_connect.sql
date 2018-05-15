DROP TABLE IF EXISTS `waterlevels`;

CREATE TABLE `waterlevels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  `waterlevel` int(11) DEFAULT NULL,
  `waterlevel_date` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;