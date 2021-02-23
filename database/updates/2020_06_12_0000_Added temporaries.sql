SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for temporaries
-- ----------------------------
DROP TABLE IF EXISTS `temporaries`;
CREATE TABLE `temporaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `temporaries` (`id`, `key`, `display_name`, `value`) VALUES (1, 'promotores_asignables', 'Promotores Asignables', NULL);
INSERT INTO `temporaries` (`id`, `key`, `display_name`, `value`) VALUES (2, 'promotores_reasignables_1_2', 'Promotores re-asignables status 1 a 2', NULL);
INSERT INTO `temporaries` (`id`, `key`, `display_name`, `value`) VALUES (3, 'promotores_reasignables_2_3', 'Promotores re-asignables status 2 a 3', NULL);
