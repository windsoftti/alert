/*
Navicat MySQL Data Transfer

Source Server         : root@localhost (XAMPP)
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : root_admin_prospectos

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-08-06 13:55:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tipos
-- ----------------------------
DROP TABLE IF EXISTS `tipos`;
CREATE TABLE `tipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recurso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tipos
-- ----------------------------
INSERT INTO `tipos` VALUES ('1', 'Administrador', 'Users');
INSERT INTO `tipos` VALUES ('2', 'Gerente', 'Users');
INSERT INTO `tipos` VALUES ('3', 'Promotor', 'Users');
INSERT INTO `tipos` VALUES ('4', 'Promotor Especial', 'Users');
