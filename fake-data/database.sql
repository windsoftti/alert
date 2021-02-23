/*
Navicat MySQL Data Transfer

Source Server         : root@localhost (XAMPP)
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : root_admin_prospectos

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-08-06 15:27:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for assignments
-- ----------------------------
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of assignments
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', null, '1', 'Category 1', 'category-1', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `categories` VALUES ('2', null, '1', 'Category 2', 'category-2', '2020-05-15 15:25:46', '2020-05-15 15:25:46');

-- ----------------------------
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of chats
-- ----------------------------
INSERT INTO `chats` VALUES ('1', 'hola', '1', '1', '5', '2020-06-18 16:26:38', '2020-06-18 09:35:54');
INSERT INTO `chats` VALUES ('9', 'ddd', null, null, '0', '2020-06-19 15:48:22', null);
INSERT INTO `chats` VALUES ('10', 'hola', null, '40', '6', '2020-06-19 16:04:07', '2020-06-19 16:04:07');
INSERT INTO `chats` VALUES ('11', '¡Buen día, Bienvenido a Sueños Multiva! Apoyo bajo Convenio Federal, dirigido a Pensionados y Jubilados del IMSS. Para poderle ofrecer más información y detalles necesitamos saber: ¿Cuál es su nombre completo?', null, '40', '5', '2020-06-19 16:04:07', '2020-06-19 16:04:07');
INSERT INTO `chats` VALUES ('13', 'hola', null, '40', '6', '2020-06-20 10:15:24', '2020-06-20 10:15:24');
INSERT INTO `chats` VALUES ('14', 'hola', null, '40', '6', '2020-06-20 10:16:58', '2020-06-20 10:16:58');
INSERT INTO `chats` VALUES ('15', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 10:16:59', '2020-06-20 10:16:59');
INSERT INTO `chats` VALUES ('16', 'hola', null, '40', '6', '2020-06-20 10:17:33', '2020-06-20 10:17:33');
INSERT INTO `chats` VALUES ('17', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 10:17:33', '2020-06-20 10:17:33');
INSERT INTO `chats` VALUES ('18', 'hola', null, '40', '6', '2020-06-20 10:19:41', '2020-06-20 10:19:41');
INSERT INTO `chats` VALUES ('19', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 10:19:41', '2020-06-20 10:19:41');
INSERT INTO `chats` VALUES ('20', 'hola', null, '40', '6', '2020-06-20 10:21:06', '2020-06-20 10:21:06');
INSERT INTO `chats` VALUES ('21', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 10:21:06', '2020-06-20 10:21:06');
INSERT INTO `chats` VALUES ('22', 'hola', null, '40', '6', '2020-06-20 12:20:20', '2020-06-20 12:20:20');
INSERT INTO `chats` VALUES ('23', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 12:20:20', '2020-06-20 12:20:20');
INSERT INTO `chats` VALUES ('24', 'hola', null, '40', '6', '2020-06-20 12:22:28', '2020-06-20 12:22:28');
INSERT INTO `chats` VALUES ('25', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 12:22:28', '2020-06-20 12:22:28');
INSERT INTO `chats` VALUES ('26', 'hola', null, '40', '6', '2020-06-20 12:25:46', '2020-06-20 12:25:46');
INSERT INTO `chats` VALUES ('27', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 12:25:46', '2020-06-20 12:25:46');
INSERT INTO `chats` VALUES ('28', 'hola', null, '40', '6', '2020-06-20 13:29:15', '2020-06-20 13:29:15');
INSERT INTO `chats` VALUES ('29', 'hola', null, '40', '6', '2020-06-20 14:03:06', '2020-06-20 14:03:06');
INSERT INTO `chats` VALUES ('30', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:03:06', '2020-06-20 14:03:06');
INSERT INTO `chats` VALUES ('31', 'hola', null, '40', '6', '2020-06-20 14:03:44', '2020-06-20 14:03:44');
INSERT INTO `chats` VALUES ('32', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:03:45', '2020-06-20 14:03:45');
INSERT INTO `chats` VALUES ('33', 'hola', null, '40', '6', '2020-06-20 14:05:17', '2020-06-20 14:05:17');
INSERT INTO `chats` VALUES ('34', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:05:18', '2020-06-20 14:05:18');
INSERT INTO `chats` VALUES ('35', 'hola', null, '40', '6', '2020-06-20 14:05:53', '2020-06-20 14:05:53');
INSERT INTO `chats` VALUES ('36', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:05:53', '2020-06-20 14:05:53');
INSERT INTO `chats` VALUES ('37', 'hola', null, '40', '6', '2020-06-20 14:06:38', '2020-06-20 14:06:38');
INSERT INTO `chats` VALUES ('38', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:06:38', '2020-06-20 14:06:38');
INSERT INTO `chats` VALUES ('39', 'hola', null, '40', '6', '2020-06-20 14:07:22', '2020-06-20 14:07:22');
INSERT INTO `chats` VALUES ('40', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:07:23', '2020-06-20 14:07:23');
INSERT INTO `chats` VALUES ('41', 'hola', null, '40', '6', '2020-06-20 14:09:52', '2020-06-20 14:09:52');
INSERT INTO `chats` VALUES ('42', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:09:52', '2020-06-20 14:09:52');
INSERT INTO `chats` VALUES ('43', 'hola', null, '40', '6', '2020-06-20 14:12:14', '2020-06-20 14:12:14');
INSERT INTO `chats` VALUES ('44', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:12:14', '2020-06-20 14:12:14');
INSERT INTO `chats` VALUES ('45', 'hola', null, '40', '6', '2020-06-20 14:15:34', '2020-06-20 14:15:34');
INSERT INTO `chats` VALUES ('46', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:15:35', '2020-06-20 14:15:35');
INSERT INTO `chats` VALUES ('47', 'perfecto', null, '40', '6', '2020-06-20 14:18:13', '2020-06-20 14:18:13');
INSERT INTO `chats` VALUES ('48', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:18:14', '2020-06-20 14:18:14');
INSERT INTO `chats` VALUES ('49', 'perfecto', null, '40', '6', '2020-06-20 14:42:18', '2020-06-20 14:42:18');
INSERT INTO `chats` VALUES ('50', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:42:19', '2020-06-20 14:42:19');
INSERT INTO `chats` VALUES ('51', 'perfectos', null, '40', '6', '2020-06-20 14:42:38', '2020-06-20 14:42:38');
INSERT INTO `chats` VALUES ('52', '¿Me puede repetir su número celular a 10 digitos, por favor?', null, '40', '5', '2020-06-20 14:42:38', '2020-06-20 14:42:38');
INSERT INTO `chats` VALUES ('53', 'perfectos3', '1', '40', '6', '2020-06-20 14:46:50', '2020-06-20 14:46:50');
INSERT INTO `chats` VALUES ('54', 'perfectos3', '1', '40', '6', '2020-06-20 14:47:38', '2020-06-20 14:47:38');
INSERT INTO `chats` VALUES ('55', 'perfectos4', '1', '40', '6', '2020-06-20 15:00:10', '2020-06-20 15:00:10');
INSERT INTO `chats` VALUES ('56', 'perfectos5', '1', '40', '6', '2020-06-20 15:00:52', '2020-06-20 15:00:52');
INSERT INTO `chats` VALUES ('57', 'perfectos6', '1', '40', '6', '2020-06-20 15:08:23', '2020-06-20 15:08:23');
INSERT INTO `chats` VALUES ('59', 'perfectos7', '1', '40', '6', '2020-06-20 15:09:21', '2020-06-20 15:09:21');
INSERT INTO `chats` VALUES ('61', 'perfectos8', '1', '40', '6', '2020-06-20 15:11:40', '2020-06-20 15:11:40');
INSERT INTO `chats` VALUES ('62', 'perfectos9', '1', '40', '6', '2020-06-20 15:14:35', '2020-06-20 15:14:35');
INSERT INTO `chats` VALUES ('63', 'perfectos10', '1', '40', '6', '2020-06-20 15:17:17', '2020-06-20 15:17:17');
INSERT INTO `chats` VALUES ('64', 'perfectos11', '1', '40', '6', '2020-06-20 15:17:55', '2020-06-20 15:17:55');
INSERT INTO `chats` VALUES ('65', 'perfectos12', '1', '40', '6', '2020-06-20 15:21:05', '2020-06-20 15:21:05');
INSERT INTO `chats` VALUES ('66', 'perfectos13', '1', '40', '6', '2020-06-20 15:22:20', '2020-06-20 15:22:20');
INSERT INTO `chats` VALUES ('68', 'perfectos14', '1', '40', '6', '2020-06-20 15:29:01', '2020-06-20 15:29:01');
INSERT INTO `chats` VALUES ('69', 'perfectos15', '1', '40', '6', '2020-06-20 15:29:35', '2020-06-20 15:29:35');
INSERT INTO `chats` VALUES ('70', 'perfectos15', '1', '40', '6', '2020-06-20 15:33:54', '2020-06-20 15:33:54');
INSERT INTO `chats` VALUES ('71', 'perfectos15', '1', '40', '6', '2020-06-20 15:36:34', '2020-06-20 15:36:34');
INSERT INTO `chats` VALUES ('73', 'perfectos15', '1', '40', '6', '2020-06-20 15:41:55', '2020-06-20 15:41:55');
INSERT INTO `chats` VALUES ('74', 'hola', '1', '40', '5', '2020-06-20 15:42:09', '2020-06-20 15:42:09');
INSERT INTO `chats` VALUES ('75', 'Hola Señores', '1', '40', '5', '2020-06-20 15:42:39', '2020-06-20 15:42:39');
INSERT INTO `chats` VALUES ('76', 'perfectos15', '1', '40', '6', '2020-06-20 15:43:10', '2020-06-20 15:43:10');
INSERT INTO `chats` VALUES ('77', 'muy bien hermano', '1', '40', '5', '2020-06-20 16:15:08', '2020-06-20 16:15:08');
INSERT INTO `chats` VALUES ('78', 'holas', '1', '40', '6', '2020-06-20 16:37:36', '2020-06-20 16:37:36');
INSERT INTO `chats` VALUES ('79', 'saliente', '1', '40', '5', '2020-06-20 16:43:09', '2020-06-20 16:43:09');
INSERT INTO `chats` VALUES ('80', 'entrante', '1', '40', '6', '2020-06-20 16:43:24', '2020-06-20 16:43:24');
INSERT INTO `chats` VALUES ('81', 'Que hay', '1', '40', '5', '2020-06-20 16:48:23', '2020-06-20 16:48:23');
INSERT INTO `chats` VALUES ('82', 'entrante2', '1', '40', '6', '2020-06-20 16:54:35', '2020-06-20 16:54:35');
INSERT INTO `chats` VALUES ('83', 'hola', '1', '40', '5', '2020-06-24 15:20:15', '2020-06-24 15:20:15');
INSERT INTO `chats` VALUES ('84', 'hola', '1', '40', '5', '2020-06-24 15:20:39', '2020-06-24 15:20:39');
INSERT INTO `chats` VALUES ('85', 'hola', '1', '40', '5', '2020-06-24 15:22:22', '2020-06-24 15:22:22');
INSERT INTO `chats` VALUES ('86', 'adios', '1', '33', '5', '2020-06-24 15:22:31', '2020-06-24 15:22:31');
INSERT INTO `chats` VALUES ('87', 'adios', '1', '33', '5', '2020-06-24 15:22:44', '2020-06-24 15:22:44');
INSERT INTO `chats` VALUES ('88', 'hola', '1', '29', '5', '2020-06-24 15:22:53', '2020-06-24 15:22:53');

-- ----------------------------
-- Table structure for data_rows
-- ----------------------------
DROP TABLE IF EXISTS `data_rows`;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of data_rows
-- ----------------------------
INSERT INTO `data_rows` VALUES ('1', '1', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('2', '1', 'name', 'text', 'Name', '1', '1', '1', '1', '1', '1', null, '2');
INSERT INTO `data_rows` VALUES ('3', '1', 'email', 'text', 'Email', '1', '1', '1', '1', '1', '1', null, '3');
INSERT INTO `data_rows` VALUES ('4', '1', 'password', 'password', 'Password', '1', '0', '0', '1', '1', '0', null, '4');
INSERT INTO `data_rows` VALUES ('5', '1', 'remember_token', 'text', 'Remember Token', '0', '0', '0', '0', '0', '0', null, '5');
INSERT INTO `data_rows` VALUES ('6', '1', 'created_at', 'timestamp', 'Created At', '0', '1', '1', '0', '0', '0', null, '6');
INSERT INTO `data_rows` VALUES ('7', '1', 'updated_at', 'timestamp', 'Updated At', '0', '0', '0', '0', '0', '0', null, '7');
INSERT INTO `data_rows` VALUES ('8', '1', 'avatar', 'image', 'Avatar', '0', '1', '1', '1', '1', '1', null, '8');
INSERT INTO `data_rows` VALUES ('9', '1', 'user_belongsto_role_relationship', 'relationship', 'Role', '0', '1', '1', '1', '1', '0', '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', '10');
INSERT INTO `data_rows` VALUES ('10', '1', 'user_belongstomany_role_relationship', 'relationship', 'Roles', '0', '1', '1', '1', '1', '0', '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', '11');
INSERT INTO `data_rows` VALUES ('11', '1', 'settings', 'hidden', 'Settings', '0', '0', '0', '0', '0', '0', null, '12');
INSERT INTO `data_rows` VALUES ('12', '2', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('13', '2', 'name', 'text', 'Name', '1', '1', '1', '1', '1', '1', null, '2');
INSERT INTO `data_rows` VALUES ('14', '2', 'created_at', 'timestamp', 'Created At', '0', '0', '0', '0', '0', '0', null, '3');
INSERT INTO `data_rows` VALUES ('15', '2', 'updated_at', 'timestamp', 'Updated At', '0', '0', '0', '0', '0', '0', null, '4');
INSERT INTO `data_rows` VALUES ('16', '3', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('17', '3', 'name', 'text', 'Name', '1', '1', '1', '1', '1', '1', null, '2');
INSERT INTO `data_rows` VALUES ('18', '3', 'created_at', 'timestamp', 'Created At', '0', '0', '0', '0', '0', '0', null, '3');
INSERT INTO `data_rows` VALUES ('19', '3', 'updated_at', 'timestamp', 'Updated At', '0', '0', '0', '0', '0', '0', null, '4');
INSERT INTO `data_rows` VALUES ('20', '3', 'display_name', 'text', 'Display Name', '1', '1', '1', '1', '1', '1', null, '5');
INSERT INTO `data_rows` VALUES ('21', '1', 'role_id', 'text', 'Role', '1', '1', '1', '1', '1', '1', null, '9');
INSERT INTO `data_rows` VALUES ('22', '4', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('23', '4', 'parent_id', 'select_dropdown', 'Parent', '0', '0', '1', '1', '1', '1', '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', '2');
INSERT INTO `data_rows` VALUES ('24', '4', 'order', 'text', 'Order', '1', '1', '1', '1', '1', '1', '{\"default\":1}', '3');
INSERT INTO `data_rows` VALUES ('25', '4', 'name', 'text', 'Name', '1', '1', '1', '1', '1', '1', null, '4');
INSERT INTO `data_rows` VALUES ('26', '4', 'slug', 'text', 'Slug', '1', '1', '1', '1', '1', '1', '{\"slugify\":{\"origin\":\"name\"}}', '5');
INSERT INTO `data_rows` VALUES ('27', '4', 'created_at', 'timestamp', 'Created At', '0', '0', '1', '0', '0', '0', null, '6');
INSERT INTO `data_rows` VALUES ('28', '4', 'updated_at', 'timestamp', 'Updated At', '0', '0', '0', '0', '0', '0', null, '7');
INSERT INTO `data_rows` VALUES ('29', '5', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('30', '5', 'author_id', 'text', 'Author', '1', '0', '1', '1', '0', '1', null, '2');
INSERT INTO `data_rows` VALUES ('31', '5', 'category_id', 'text', 'Category', '1', '0', '1', '1', '1', '0', null, '3');
INSERT INTO `data_rows` VALUES ('32', '5', 'title', 'text', 'Title', '1', '1', '1', '1', '1', '1', null, '4');
INSERT INTO `data_rows` VALUES ('33', '5', 'excerpt', 'text_area', 'Excerpt', '1', '0', '1', '1', '1', '1', null, '5');
INSERT INTO `data_rows` VALUES ('34', '5', 'body', 'rich_text_box', 'Body', '1', '0', '1', '1', '1', '1', null, '6');
INSERT INTO `data_rows` VALUES ('35', '5', 'image', 'image', 'Post Image', '0', '1', '1', '1', '1', '1', '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', '7');
INSERT INTO `data_rows` VALUES ('36', '5', 'slug', 'text', 'Slug', '1', '0', '1', '1', '1', '1', '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', '8');
INSERT INTO `data_rows` VALUES ('37', '5', 'meta_description', 'text_area', 'Meta Description', '1', '0', '1', '1', '1', '1', null, '9');
INSERT INTO `data_rows` VALUES ('38', '5', 'meta_keywords', 'text_area', 'Meta Keywords', '1', '0', '1', '1', '1', '1', null, '10');
INSERT INTO `data_rows` VALUES ('39', '5', 'status', 'select_dropdown', 'Status', '1', '1', '1', '1', '1', '1', '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', '11');
INSERT INTO `data_rows` VALUES ('40', '5', 'created_at', 'timestamp', 'Created At', '0', '1', '1', '0', '0', '0', null, '12');
INSERT INTO `data_rows` VALUES ('41', '5', 'updated_at', 'timestamp', 'Updated At', '0', '0', '0', '0', '0', '0', null, '13');
INSERT INTO `data_rows` VALUES ('42', '5', 'seo_title', 'text', 'SEO Title', '0', '1', '1', '1', '1', '1', null, '14');
INSERT INTO `data_rows` VALUES ('43', '5', 'featured', 'checkbox', 'Featured', '1', '1', '1', '1', '1', '1', null, '15');
INSERT INTO `data_rows` VALUES ('44', '6', 'id', 'number', 'ID', '1', '0', '0', '0', '0', '0', null, '1');
INSERT INTO `data_rows` VALUES ('45', '6', 'author_id', 'text', 'Author', '1', '0', '0', '0', '0', '0', null, '2');
INSERT INTO `data_rows` VALUES ('46', '6', 'title', 'text', 'Title', '1', '1', '1', '1', '1', '1', null, '3');
INSERT INTO `data_rows` VALUES ('47', '6', 'excerpt', 'text_area', 'Excerpt', '1', '0', '1', '1', '1', '1', null, '4');
INSERT INTO `data_rows` VALUES ('48', '6', 'body', 'rich_text_box', 'Body', '1', '0', '1', '1', '1', '1', null, '5');
INSERT INTO `data_rows` VALUES ('49', '6', 'slug', 'text', 'Slug', '1', '0', '1', '1', '1', '1', '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', '6');
INSERT INTO `data_rows` VALUES ('50', '6', 'meta_description', 'text', 'Meta Description', '1', '0', '1', '1', '1', '1', null, '7');
INSERT INTO `data_rows` VALUES ('51', '6', 'meta_keywords', 'text', 'Meta Keywords', '1', '0', '1', '1', '1', '1', null, '8');
INSERT INTO `data_rows` VALUES ('52', '6', 'status', 'select_dropdown', 'Status', '1', '1', '1', '1', '1', '1', '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', '9');
INSERT INTO `data_rows` VALUES ('53', '6', 'created_at', 'timestamp', 'Created At', '1', '1', '1', '0', '0', '0', null, '10');
INSERT INTO `data_rows` VALUES ('54', '6', 'updated_at', 'timestamp', 'Updated At', '1', '0', '0', '0', '0', '0', null, '11');
INSERT INTO `data_rows` VALUES ('55', '6', 'image', 'image', 'Page Image', '0', '1', '1', '1', '1', '1', null, '12');
INSERT INTO `data_rows` VALUES ('56', '7', 'id', 'number', 'Id', '1', '1', '1', '1', '1', '1', '{}', '1');
INSERT INTO `data_rows` VALUES ('57', '7', 'nombre', 'text', 'Nombre', '1', '1', '1', '1', '1', '1', '{}', '2');
INSERT INTO `data_rows` VALUES ('58', '9', 'id', 'number', 'Id', '1', '1', '1', '0', '0', '0', '{}', '1');
INSERT INTO `data_rows` VALUES ('59', '9', 'nombre', 'text', 'Nombre', '1', '1', '1', '1', '1', '1', '{}', '2');
INSERT INTO `data_rows` VALUES ('60', '9', 'recurso', 'text', 'Recurso', '1', '1', '1', '1', '1', '1', '{}', '3');
INSERT INTO `data_rows` VALUES ('61', '10', 'id', 'number', 'Id', '1', '1', '1', '0', '0', '0', '{}', '1');
INSERT INTO `data_rows` VALUES ('62', '10', 'nombre', 'text', 'Nombre', '0', '1', '1', '1', '1', '1', '{}', '2');
INSERT INTO `data_rows` VALUES ('63', '10', 'celular', 'text', 'Celular', '0', '1', '1', '1', '1', '1', '{}', '3');
INSERT INTO `data_rows` VALUES ('64', '10', 'name', 'text', 'Name', '0', '1', '1', '1', '1', '1', '{}', '4');
INSERT INTO `data_rows` VALUES ('65', '10', 'number', 'text', 'Number', '0', '1', '1', '1', '1', '1', '{}', '5');
INSERT INTO `data_rows` VALUES ('66', '10', 'id_mensaje', 'text', 'Id Mensaje', '0', '1', '1', '1', '1', '1', '{}', '6');
INSERT INTO `data_rows` VALUES ('67', '10', 'mensaje', 'text', 'Mensaje', '0', '1', '1', '1', '1', '1', '{}', '7');
INSERT INTO `data_rows` VALUES ('68', '10', 'tipo_aplicacion', 'text', 'Tipo Aplicacion', '0', '1', '1', '1', '1', '1', '{}', '8');
INSERT INTO `data_rows` VALUES ('69', '10', 'tipo_mensaje', 'text', 'Tipo Mensaje', '0', '1', '1', '1', '1', '1', '{}', '9');
INSERT INTO `data_rows` VALUES ('70', '10', 'id_unico', 'text', 'Id Unico', '0', '1', '1', '1', '1', '1', '{}', '10');
INSERT INTO `data_rows` VALUES ('71', '10', 'proyecto_id', 'text', 'Proyecto Id', '0', '1', '1', '1', '1', '1', '{}', '11');
INSERT INTO `data_rows` VALUES ('72', '10', 'asignado_id', 'number', 'Asignado Id', '0', '1', '1', '1', '1', '1', '{}', '12');
INSERT INTO `data_rows` VALUES ('73', '10', 'fecha_hora', 'text', 'Fecha Hora', '0', '1', '1', '1', '1', '1', '{}', '13');
INSERT INTO `data_rows` VALUES ('74', '10', 'seguimiento_id', 'number', 'Seguimiento Id', '0', '1', '1', '1', '1', '1', '{}', '14');
INSERT INTO `data_rows` VALUES ('75', '10', 'fecha_cambio', 'text', 'Fecha Cambio', '0', '1', '1', '1', '1', '1', '{}', '15');
INSERT INTO `data_rows` VALUES ('76', '10', 'status_id', 'number', 'Status Id', '1', '1', '1', '1', '1', '1', '{}', '16');
INSERT INTO `data_rows` VALUES ('77', '10', 'created_at', 'timestamp', 'Created At', '0', '1', '1', '0', '0', '0', '{}', '17');
INSERT INTO `data_rows` VALUES ('78', '10', 'updated_at', 'timestamp', 'Updated At', '0', '1', '1', '0', '0', '0', '{}', '18');
INSERT INTO `data_rows` VALUES ('79', '8', 'id', 'number', 'Id', '1', '1', '1', '0', '0', '0', '{}', '1');
INSERT INTO `data_rows` VALUES ('80', '8', 'nombre', 'text', 'Nombre', '1', '1', '1', '1', '1', '1', '{}', '2');
INSERT INTO `data_rows` VALUES ('81', '8', 'recurso', 'text', 'Recurso', '1', '1', '1', '1', '1', '1', '{}', '3');

-- ----------------------------
-- Table structure for data_types
-- ----------------------------
DROP TABLE IF EXISTS `data_types`;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of data_types
-- ----------------------------
INSERT INTO `data_types` VALUES ('1', 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', '1', '0', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `data_types` VALUES ('2', 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', null, '', '', '1', '0', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `data_types` VALUES ('3', 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', null, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', '1', '0', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `data_types` VALUES ('4', 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', null, '', '', '1', '0', null, '2020-05-15 15:25:45', '2020-05-15 15:25:45');
INSERT INTO `data_types` VALUES ('5', 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', '1', '0', null, '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `data_types` VALUES ('6', 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', null, '', '', '1', '0', null, '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `data_types` VALUES ('7', 'segumientos', 'segumientos', 'Segumiento', 'Segumientos', 'voyager-file-text', 'App\\Segumiento', null, null, null, '1', '0', '{\"order_column\":\"id\",\"order_display_column\":\"id\",\"order_direction\":\"asc\",\"default_search_key\":\"nombre\",\"scope\":null}', '2020-05-15 23:53:55', '2020-05-16 00:29:19');
INSERT INTO `data_types` VALUES ('8', 'status', 'status', 'Status', 'Status', 'voyager-ticket', 'App\\Status', null, null, null, '1', '0', '{\"order_column\":\"id\",\"order_display_column\":\"id\",\"order_direction\":\"asc\",\"default_search_key\":\"nombre\",\"scope\":null}', '2020-05-15 23:54:58', '2020-05-16 00:12:00');
INSERT INTO `data_types` VALUES ('9', 'tipos', 'tipos', 'Tipo', 'Tipos', 'voyager-window-list', 'App\\Tipo', null, null, null, '1', '0', '{\"order_column\":\"id\",\"order_display_column\":\"id\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-15 23:56:39', '2020-05-16 00:10:11');
INSERT INTO `data_types` VALUES ('10', 'prospectos', 'prospectos', 'Prospecto', 'Prospectos', 'voyager-mail', 'App\\Prospecto', null, null, null, '1', '0', '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-16 00:01:36', '2020-05-16 00:05:39');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'admin', '2020-05-15 15:25:44', '2020-05-15 15:25:44');

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_items
-- ----------------------------
INSERT INTO `menu_items` VALUES ('1', '1', 'Dashboard', '', '_self', 'voyager-boat', null, null, '1', '2020-05-15 15:25:44', '2020-05-15 15:25:44', 'voyager.dashboard', null);
INSERT INTO `menu_items` VALUES ('2', '1', 'Media', '', '_self', 'voyager-images', null, '5', '5', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.media.index', null);
INSERT INTO `menu_items` VALUES ('3', '1', 'Users', '', '_self', 'voyager-person', null, null, '2', '2020-05-15 15:25:44', '2020-05-15 23:57:59', 'voyager.users.index', null);
INSERT INTO `menu_items` VALUES ('4', '1', 'Roles', '', '_self', 'voyager-lock', null, '5', '4', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.roles.index', null);
INSERT INTO `menu_items` VALUES ('5', '1', 'Tools', '', '_self', 'voyager-tools', null, null, '5', '2020-05-15 15:25:44', '2020-05-16 00:03:18', null, null);
INSERT INTO `menu_items` VALUES ('6', '1', 'Menu Builder', '', '_self', 'voyager-list', null, '5', '6', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.menus.index', null);
INSERT INTO `menu_items` VALUES ('7', '1', 'Database', '', '_self', 'voyager-data', null, '5', '7', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.database.index', null);
INSERT INTO `menu_items` VALUES ('8', '1', 'Compass', '', '_self', 'voyager-compass', null, '5', '8', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.compass.index', null);
INSERT INTO `menu_items` VALUES ('9', '1', 'BREAD', '', '_self', 'voyager-bread', null, '5', '9', '2020-05-15 15:25:44', '2020-05-15 23:59:11', 'voyager.bread.index', null);
INSERT INTO `menu_items` VALUES ('10', '1', 'Settings', '', '_self', 'voyager-settings', null, null, '4', '2020-05-15 15:25:44', '2020-05-16 00:03:18', 'voyager.settings.index', null);
INSERT INTO `menu_items` VALUES ('11', '1', 'Categories', '', '_self', 'voyager-categories', null, '5', '13', '2020-05-15 15:25:45', '2020-05-15 23:59:11', 'voyager.categories.index', null);
INSERT INTO `menu_items` VALUES ('12', '1', 'Posts', '', '_self', 'voyager-news', null, '5', '12', '2020-05-15 15:25:46', '2020-05-15 23:59:11', 'voyager.posts.index', null);
INSERT INTO `menu_items` VALUES ('13', '1', 'Pages', '', '_self', 'voyager-file-text', null, '5', '11', '2020-05-15 15:25:46', '2020-05-15 23:59:11', 'voyager.pages.index', null);
INSERT INTO `menu_items` VALUES ('14', '1', 'Hooks', '', '_self', 'voyager-hook', null, '5', '10', '2020-05-15 15:25:46', '2020-05-15 23:59:11', 'voyager.hooks', null);
INSERT INTO `menu_items` VALUES ('15', '1', 'Segumientos', '', '_self', 'voyager-file-text', null, '5', '3', '2020-05-15 23:53:55', '2020-05-15 23:59:11', 'voyager.segumientos.index', null);
INSERT INTO `menu_items` VALUES ('16', '1', 'Statuses', '', '_self', 'voyager-ticket', null, '5', '1', '2020-05-15 23:54:58', '2020-05-15 23:59:06', 'voyager.status.index', null);
INSERT INTO `menu_items` VALUES ('17', '1', 'Tipos', '', '_self', 'voyager-window-list', null, '5', '2', '2020-05-15 23:56:39', '2020-05-15 23:59:09', 'voyager.tipos.index', null);
INSERT INTO `menu_items` VALUES ('18', '1', 'Prospectos', '', '_self', 'voyager-mail', null, null, '3', '2020-05-16 00:01:37', '2020-05-16 00:02:05', 'voyager.prospectos.index', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_01_01_000000_add_voyager_user_fields', '1');
INSERT INTO `migrations` VALUES ('4', '2016_01_01_000000_create_data_types_table', '1');
INSERT INTO `migrations` VALUES ('5', '2016_05_19_173453_create_menu_table', '1');
INSERT INTO `migrations` VALUES ('6', '2016_10_21_190000_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('7', '2016_10_21_190000_create_settings_table', '1');
INSERT INTO `migrations` VALUES ('8', '2016_11_30_135954_create_permission_table', '1');
INSERT INTO `migrations` VALUES ('9', '2016_11_30_141208_create_permission_role_table', '1');
INSERT INTO `migrations` VALUES ('10', '2016_12_26_201236_data_types__add__server_side', '1');
INSERT INTO `migrations` VALUES ('11', '2017_01_13_000000_add_route_to_menu_items_table', '1');
INSERT INTO `migrations` VALUES ('12', '2017_01_14_005015_create_translations_table', '1');
INSERT INTO `migrations` VALUES ('13', '2017_01_15_000000_make_table_name_nullable_in_permissions_table', '1');
INSERT INTO `migrations` VALUES ('14', '2017_03_06_000000_add_controller_to_data_types_table', '1');
INSERT INTO `migrations` VALUES ('15', '2017_04_21_000000_add_order_to_data_rows_table', '1');
INSERT INTO `migrations` VALUES ('16', '2017_07_05_210000_add_policyname_to_data_types_table', '1');
INSERT INTO `migrations` VALUES ('17', '2017_08_05_000000_add_group_to_settings_table', '1');
INSERT INTO `migrations` VALUES ('18', '2017_11_26_013050_add_user_role_relationship', '1');
INSERT INTO `migrations` VALUES ('19', '2017_11_26_015000_create_user_roles_table', '1');
INSERT INTO `migrations` VALUES ('20', '2018_03_11_000000_add_user_settings', '1');
INSERT INTO `migrations` VALUES ('21', '2018_03_14_000000_add_details_to_data_types_table', '1');
INSERT INTO `migrations` VALUES ('22', '2018_03_16_000000_make_settings_value_nullable', '1');
INSERT INTO `migrations` VALUES ('23', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('24', '2016_01_01_000000_create_pages_table', '2');
INSERT INTO `migrations` VALUES ('25', '2016_01_01_000000_create_posts_table', '2');
INSERT INTO `migrations` VALUES ('26', '2016_02_15_204651_create_categories_table', '2');
INSERT INTO `migrations` VALUES ('27', '2017_04_11_000000_alter_post_nullable_fields_table', '2');
INSERT INTO `migrations` VALUES ('28', '2020_05_15_141642_create_webhook_calls_table', '3');
INSERT INTO `migrations` VALUES ('29', '2020_05_21_175019_create_sessions_table', '4');
INSERT INTO `migrations` VALUES ('30', '2020_06_19_183409_create_websockets_statistics_entries_table', '5');
INSERT INTO `migrations` VALUES ('41', '2020_07_17_143825_add_types_dates_to_seguimientos_table', '6');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', '0', 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2020-05-15 15:25:46', '2020-05-15 15:25:46');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('hyfa@mailinator.net', '$2y$10$Xh2anJtEewBeeZzyFwIxEeI6bqH5IMrvnzrjAMUFASdrrcb8JTAFO', '2020-05-27 16:26:25');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'browse_admin', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('2', 'browse_bread', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('3', 'browse_database', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('4', 'browse_media', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('5', 'browse_compass', null, '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('6', 'browse_menus', 'menus', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('7', 'read_menus', 'menus', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('8', 'edit_menus', 'menus', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('9', 'add_menus', 'menus', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('10', 'delete_menus', 'menus', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('11', 'browse_roles', 'roles', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('12', 'read_roles', 'roles', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('13', 'edit_roles', 'roles', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('14', 'add_roles', 'roles', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('15', 'delete_roles', 'roles', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('16', 'browse_users', 'users', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('17', 'read_users', 'users', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('18', 'edit_users', 'users', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('19', 'add_users', 'users', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('20', 'delete_users', 'users', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('21', 'browse_settings', 'settings', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('22', 'read_settings', 'settings', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('23', 'edit_settings', 'settings', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('24', 'add_settings', 'settings', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('25', 'delete_settings', 'settings', '2020-05-15 15:25:44', '2020-05-15 15:25:44');
INSERT INTO `permissions` VALUES ('26', 'browse_categories', 'categories', '2020-05-15 15:25:45', '2020-05-15 15:25:45');
INSERT INTO `permissions` VALUES ('27', 'read_categories', 'categories', '2020-05-15 15:25:45', '2020-05-15 15:25:45');
INSERT INTO `permissions` VALUES ('28', 'edit_categories', 'categories', '2020-05-15 15:25:45', '2020-05-15 15:25:45');
INSERT INTO `permissions` VALUES ('29', 'add_categories', 'categories', '2020-05-15 15:25:45', '2020-05-15 15:25:45');
INSERT INTO `permissions` VALUES ('30', 'delete_categories', 'categories', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('31', 'browse_posts', 'posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('32', 'read_posts', 'posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('33', 'edit_posts', 'posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('34', 'add_posts', 'posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('35', 'delete_posts', 'posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('36', 'browse_pages', 'pages', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('37', 'read_pages', 'pages', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('38', 'edit_pages', 'pages', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('39', 'add_pages', 'pages', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('40', 'delete_pages', 'pages', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('41', 'browse_hooks', null, '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `permissions` VALUES ('42', 'browse_status', 'status', '2020-05-15 23:54:58', '2020-05-15 23:54:58');
INSERT INTO `permissions` VALUES ('43', 'read_status', 'status', '2020-05-15 23:54:58', '2020-05-15 23:54:58');
INSERT INTO `permissions` VALUES ('44', 'edit_status', 'status', '2020-05-15 23:54:58', '2020-05-15 23:54:58');
INSERT INTO `permissions` VALUES ('45', 'add_status', 'status', '2020-05-15 23:54:58', '2020-05-15 23:54:58');
INSERT INTO `permissions` VALUES ('46', 'delete_status', 'status', '2020-05-15 23:54:58', '2020-05-15 23:54:58');
INSERT INTO `permissions` VALUES ('47', 'browse_tipos', 'tipos', '2020-05-15 23:56:39', '2020-05-15 23:56:39');
INSERT INTO `permissions` VALUES ('48', 'read_tipos', 'tipos', '2020-05-15 23:56:39', '2020-05-15 23:56:39');
INSERT INTO `permissions` VALUES ('49', 'edit_tipos', 'tipos', '2020-05-15 23:56:39', '2020-05-15 23:56:39');
INSERT INTO `permissions` VALUES ('50', 'add_tipos', 'tipos', '2020-05-15 23:56:39', '2020-05-15 23:56:39');
INSERT INTO `permissions` VALUES ('51', 'delete_tipos', 'tipos', '2020-05-15 23:56:39', '2020-05-15 23:56:39');
INSERT INTO `permissions` VALUES ('52', 'browse_prospectos', 'prospectos', '2020-05-16 00:05:40', '2020-05-16 00:05:40');
INSERT INTO `permissions` VALUES ('53', 'read_prospectos', 'prospectos', '2020-05-16 00:05:40', '2020-05-16 00:05:40');
INSERT INTO `permissions` VALUES ('54', 'edit_prospectos', 'prospectos', '2020-05-16 00:05:40', '2020-05-16 00:05:40');
INSERT INTO `permissions` VALUES ('55', 'add_prospectos', 'prospectos', '2020-05-16 00:05:40', '2020-05-16 00:05:40');
INSERT INTO `permissions` VALUES ('56', 'delete_prospectos', 'prospectos', '2020-05-16 00:05:40', '2020-05-16 00:05:40');
INSERT INTO `permissions` VALUES ('57', 'browse_segumientos', 'segumientos', '2020-05-16 00:05:58', '2020-05-16 00:05:58');
INSERT INTO `permissions` VALUES ('58', 'read_segumientos', 'segumientos', '2020-05-16 00:05:58', '2020-05-16 00:05:58');
INSERT INTO `permissions` VALUES ('59', 'edit_segumientos', 'segumientos', '2020-05-16 00:05:58', '2020-05-16 00:05:58');
INSERT INTO `permissions` VALUES ('60', 'add_segumientos', 'segumientos', '2020-05-16 00:05:58', '2020-05-16 00:05:58');
INSERT INTO `permissions` VALUES ('61', 'delete_segumientos', 'segumientos', '2020-05-16 00:05:58', '2020-05-16 00:05:58');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '1');
INSERT INTO `permission_role` VALUES ('2', '1');
INSERT INTO `permission_role` VALUES ('3', '1');
INSERT INTO `permission_role` VALUES ('4', '1');
INSERT INTO `permission_role` VALUES ('5', '1');
INSERT INTO `permission_role` VALUES ('6', '1');
INSERT INTO `permission_role` VALUES ('7', '1');
INSERT INTO `permission_role` VALUES ('8', '1');
INSERT INTO `permission_role` VALUES ('9', '1');
INSERT INTO `permission_role` VALUES ('10', '1');
INSERT INTO `permission_role` VALUES ('11', '1');
INSERT INTO `permission_role` VALUES ('12', '1');
INSERT INTO `permission_role` VALUES ('13', '1');
INSERT INTO `permission_role` VALUES ('14', '1');
INSERT INTO `permission_role` VALUES ('15', '1');
INSERT INTO `permission_role` VALUES ('16', '1');
INSERT INTO `permission_role` VALUES ('17', '1');
INSERT INTO `permission_role` VALUES ('18', '1');
INSERT INTO `permission_role` VALUES ('19', '1');
INSERT INTO `permission_role` VALUES ('20', '1');
INSERT INTO `permission_role` VALUES ('21', '1');
INSERT INTO `permission_role` VALUES ('22', '1');
INSERT INTO `permission_role` VALUES ('23', '1');
INSERT INTO `permission_role` VALUES ('24', '1');
INSERT INTO `permission_role` VALUES ('25', '1');
INSERT INTO `permission_role` VALUES ('26', '1');
INSERT INTO `permission_role` VALUES ('27', '1');
INSERT INTO `permission_role` VALUES ('28', '1');
INSERT INTO `permission_role` VALUES ('29', '1');
INSERT INTO `permission_role` VALUES ('30', '1');
INSERT INTO `permission_role` VALUES ('31', '1');
INSERT INTO `permission_role` VALUES ('32', '1');
INSERT INTO `permission_role` VALUES ('33', '1');
INSERT INTO `permission_role` VALUES ('34', '1');
INSERT INTO `permission_role` VALUES ('35', '1');
INSERT INTO `permission_role` VALUES ('36', '1');
INSERT INTO `permission_role` VALUES ('37', '1');
INSERT INTO `permission_role` VALUES ('38', '1');
INSERT INTO `permission_role` VALUES ('39', '1');
INSERT INTO `permission_role` VALUES ('40', '1');
INSERT INTO `permission_role` VALUES ('41', '1');
INSERT INTO `permission_role` VALUES ('42', '1');
INSERT INTO `permission_role` VALUES ('43', '1');
INSERT INTO `permission_role` VALUES ('44', '1');
INSERT INTO `permission_role` VALUES ('45', '1');
INSERT INTO `permission_role` VALUES ('46', '1');
INSERT INTO `permission_role` VALUES ('47', '1');
INSERT INTO `permission_role` VALUES ('48', '1');
INSERT INTO `permission_role` VALUES ('49', '1');
INSERT INTO `permission_role` VALUES ('50', '1');
INSERT INTO `permission_role` VALUES ('51', '1');
INSERT INTO `permission_role` VALUES ('52', '1');
INSERT INTO `permission_role` VALUES ('53', '1');
INSERT INTO `permission_role` VALUES ('54', '1');
INSERT INTO `permission_role` VALUES ('55', '1');
INSERT INTO `permission_role` VALUES ('56', '1');
INSERT INTO `permission_role` VALUES ('57', '1');
INSERT INTO `permission_role` VALUES ('58', '1');
INSERT INTO `permission_role` VALUES ('59', '1');
INSERT INTO `permission_role` VALUES ('60', '1');
INSERT INTO `permission_role` VALUES ('61', '1');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '0', null, 'Lorem Ipsum Post', null, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/post1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', '0', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `posts` VALUES ('2', '0', null, 'My Sample Post', null, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', '0', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `posts` VALUES ('3', '0', null, 'Latest Post', null, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', '0', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `posts` VALUES ('4', '0', null, 'Yarr Post', null, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', '0', '2020-05-15 15:25:46', '2020-05-15 15:25:46');

-- ----------------------------
-- Table structure for prospectos
-- ----------------------------
DROP TABLE IF EXISTS `prospectos`;
CREATE TABLE `prospectos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_mensaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_aplicacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_mensaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_unico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proyecto_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asignado_id` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `seguimiento_id` int(11) DEFAULT NULL,
  `fecha_cambio` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of prospectos
-- ----------------------------
INSERT INTO `prospectos` VALUES ('1', 'tengo una duda', '7751292783', null, 'FB-3553738504642817', null, 'tengo una duda', '1', '1', '678991', '7436', '22', '2020-06-11 10:00:25', '9', '2020-06-11 10:00:25', '3', '2020-05-24 16:55:48', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('28', null, '7751292783', null, 'FB-3182330665163323', null, 'tengo una duda', '1', '1', '678992', '7436', '11', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:56:36', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('29', null, '7751292783', null, 'FB-3182330665163324', null, 'tengo una duda', '1', '1', '678992', '7436', '10', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:56:41', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('30', null, '7751292783', null, 'FB-3182330665163325', null, 'tengo una duda', '1', '1', '678992', '7436', '13', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:56:45', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('31', null, '7751292783', null, 'FB-3182330665163326', null, 'tengo una duda', '1', '1', '678992', '7436', '9', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:56:50', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('32', null, '7751292783', null, 'FB-3182330665163327', null, 'tengo una duda', '1', '1', '678992', '7436', '10', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:57:07', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('33', null, '7751292783', null, 'FB-3182330665163328', null, 'tengo una duda', '1', '1', '678992', '7436', '11', '2020-06-11 10:00:25', '10', '2020-06-11 10:00:25', '3', '2020-05-24 16:57:12', '2020-06-11 10:00:25');
INSERT INTO `prospectos` VALUES ('34', null, '7751292783', null, 'FB-3182330665163329', null, 'tengo una duda', '1', '1', '678992', '7436', '13', '2020-06-11 10:06:10', '1', '2020-06-11 10:06:10', '3', '2020-05-24 16:57:17', '2020-06-11 10:06:10');
INSERT INTO `prospectos` VALUES ('35', 'Informes', '7751292783', null, 'FB-3182330665163330', null, 'tengo una duda', '1', '1', '678992', '7436', '14', '2020-06-11 10:06:10', '1', '2020-06-11 10:06:10', '3', '2020-05-24 16:57:22', '2020-06-11 10:06:10');
INSERT INTO `prospectos` VALUES ('36', 'Adal', '7751292783', null, 'FB-3182330665163331', null, 'Informes', '1', '1', '678992', '7436', '15', '2020-06-11 10:06:10', '1', '2020-06-11 10:06:10', '3', '2020-06-02 12:09:08', '2020-06-11 10:06:10');
INSERT INTO `prospectos` VALUES ('37', 'Adal vragra', '775 129 27 83', null, 'FB-3182330665163333', null, 'Quiero más detalles.', '1', '1', '678992', '7436', '16', '2020-06-11 10:06:10', '1', '2020-06-11 10:06:10', '3', '2020-06-04 15:49:17', '2020-06-11 10:06:10');
INSERT INTO `prospectos` VALUES ('38', 'Raíl velzaques', '7984561325', null, null, null, null, null, null, null, null, '15', null, null, null, '3', '2020-06-11 10:19:02', '2020-06-11 10:19:02');
INSERT INTO `prospectos` VALUES ('39', 'Roberto Perea', '48596791325', null, null, null, null, null, null, null, null, '15', null, '2', null, '3', '2020-06-11 10:19:30', '2020-06-11 10:19:30');
INSERT INTO `prospectos` VALUES ('40', 'hola', null, null, 'FB-9182330665163333', null, 'hola', '1', '1', '678992', '7436', '1', null, null, null, '3', '2020-06-19 16:04:07', '2020-06-20 10:15:24');
INSERT INTO `prospectos` VALUES ('41', 'Eduardo', '7894561235', null, null, null, null, null, null, null, null, '14', null, '2', null, '3', '2020-06-19 16:46:40', '2020-06-19 16:46:40');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', 'Administrador', '2020-05-15 15:25:44', '2020-05-16 00:16:10');
INSERT INTO `roles` VALUES ('2', 'user', 'Usuario', '2020-05-15 15:25:44', '2020-05-16 00:20:35');

-- ----------------------------
-- Table structure for seguimientos
-- ----------------------------
DROP TABLE IF EXISTS `seguimientos`;
CREATE TABLE `seguimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type_id` int(10) unsigned NOT NULL DEFAULT 33,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of seguimientos
-- ----------------------------
INSERT INTO `seguimientos` VALUES ('1', '1', 'Asignado', 'asignado', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('2', '2', 'Contactado', 'contactado', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('3', '3', 'Evaluado', 'evaluado', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('4', '4', 'Entregó documentos', 'entrego-documentos', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('5', '5', 'Llenado de Solicitud', 'llenado-de-solicitud', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('9', '6', 'No Califica', 'no-califica', '34', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('10', '7', 'Reasignado', 'reasignado', '33', null, '2020-07-24 21:10:18', null);
INSERT INTO `seguimientos` VALUES ('11', '8', 'Concretado', 'concretado', '34', null, '2020-07-24 21:10:18', null);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('xzwUDGM2bQaBhKbt9nY610GtZFKQL4YZ28THjbL0', '1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTUdad0NLaWJFN0g2VnhQQ2VRTENqS1ByUnN2VUdNeld0WkN3T2RmUCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUxOiJodHRwOi8vYWRtaW4tcHJvc3BlY3Rvcy5sb2NhbGhvc3QvaG9tZS9zZWd1aW1pZW50b3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', '1595703746');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'site.title', 'Site Title', 'Prospectos Multiva', '', 'text', '1', 'Site');
INSERT INTO `settings` VALUES ('2', 'site.description', 'Site Description', 'Administración de Prospectos Multiva', '', 'text', '2', 'Site');
INSERT INTO `settings` VALUES ('3', 'site.logo', 'Site Logo', 'settings\\May2020\\3HZPayzCYRl5wcz9jb30.png', '', 'image', '3', 'Site');
INSERT INTO `settings` VALUES ('4', 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', null, '', 'text', '4', 'Site');
INSERT INTO `settings` VALUES ('5', 'admin.bg_image', 'Admin Background Image', '', '', 'image', '5', 'Admin');
INSERT INTO `settings` VALUES ('6', 'admin.title', 'Admin Title', 'Prospectos', '', 'text', '1', 'Admin');
INSERT INTO `settings` VALUES ('7', 'admin.description', 'Admin Description', 'Prospectos', '', 'text', '2', 'Admin');
INSERT INTO `settings` VALUES ('8', 'admin.loader', 'Admin Loader', '', '', 'image', '3', 'Admin');
INSERT INTO `settings` VALUES ('9', 'admin.icon_image', 'Admin Icon Image', '', '', 'image', '4', 'Admin');
INSERT INTO `settings` VALUES ('10', 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', null, '', 'text', '1', 'Admin');
INSERT INTO `settings` VALUES ('11', 'site.modo_asignacion_prospectos', 'Modo de Asignación de Prospectos', 'equirandom', '{\"default\":\"no_asignar\",\"options\":{\"no_asignar\":\"No Asignar\",\"random\":\"Promotores Conectados Aleatorio\",\"equirandom\":\"Cualquier Promotor Equitativo Aleatorio\"}}', 'select_dropdown', '6', 'Site');
INSERT INTO `settings` VALUES ('12', 'site.inicio_asignaciones', 'Inicio de Asignaciones', '6:00', '{\r\n    \"format\" : \"%H:%i\"\r\n}', 'text', '7', 'Site');
INSERT INTO `settings` VALUES ('13', 'site.fin_asignaciones', 'Fin de Asignaciones', '11:59', null, 'text', '8', 'Site');
INSERT INTO `settings` VALUES ('14', 'site.mode_reasign_leads', 'Modo de Re-asignación de prospectos', 'any_random_promotor', '{\"default\":\"not_reassign\",\"options\":{\"not_reassign\":\"No Re-asignar\",\"special_promotors_group\":\"Promotores Especiales Aleatorios del Grupo\",\"any_random_promotor\":\"Cualquier Promotor Aleatorio\"}}', 'select_dropdown', '9', 'Site');
INSERT INTO `settings` VALUES ('16', 'site.token_picky_assist', 'Token Picky Assist', '69e391569d39e6961e22152faa25a2e352951046', null, 'text', '10', 'Site');
INSERT INTO `settings` VALUES ('17', 'site.assign_chat_delay', 'Retraso en minutos para asignar chat de visitante', '10', null, 'text', '11', 'Site');
INSERT INTO `settings` VALUES ('18', 'site.chat_window', 'Ventana de tiempo en minutos para habilitar chat', '1440', null, 'text', '12', 'Site');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recurso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'Activo', 'Users');
INSERT INTO `status` VALUES ('2', 'Desactivo', 'Users');
INSERT INTO `status` VALUES ('3', 'Activo', 'Prospectos');
INSERT INTO `status` VALUES ('4', 'Desactivo', 'Prospectos');

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

-- ----------------------------
-- Records of temporaries
-- ----------------------------
INSERT INTO `temporaries` VALUES ('1', 'promotores_asignables', 'Promotores Asignables', '{\"8\":19,\"9\":22}');
INSERT INTO `temporaries` VALUES ('2', 'promotores_reasignables_1_2', 'Promotores re-asignables status 1 a 2', '{\"7\":16,\"8\":19}');
INSERT INTO `temporaries` VALUES ('3', 'promotores_reasignables_2_3', 'Promotores re-asignables status 2 a 3', null);

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
INSERT INTO `tipos` VALUES ('5', 'Saliente', 'Chats');
INSERT INTO `tipos` VALUES ('6', 'Entrante', 'Chats');
INSERT INTO `tipos` VALUES ('33', 'En progreso', 'Seguimientos');
INSERT INTO `tipos` VALUES ('34', 'Finalizado', 'Seguimientos');

-- ----------------------------
-- Table structure for translations
-- ----------------------------
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of translations
-- ----------------------------
INSERT INTO `translations` VALUES ('1', 'data_types', 'display_name_singular', '5', 'pt', 'Post', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('2', 'data_types', 'display_name_singular', '6', 'pt', 'Página', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('3', 'data_types', 'display_name_singular', '1', 'pt', 'Utilizador', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('4', 'data_types', 'display_name_singular', '4', 'pt', 'Categoria', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('5', 'data_types', 'display_name_singular', '2', 'pt', 'Menu', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('6', 'data_types', 'display_name_singular', '3', 'pt', 'Função', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('7', 'data_types', 'display_name_plural', '5', 'pt', 'Posts', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('8', 'data_types', 'display_name_plural', '6', 'pt', 'Páginas', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('9', 'data_types', 'display_name_plural', '1', 'pt', 'Utilizadores', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('10', 'data_types', 'display_name_plural', '4', 'pt', 'Categorias', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('11', 'data_types', 'display_name_plural', '2', 'pt', 'Menus', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('12', 'data_types', 'display_name_plural', '3', 'pt', 'Funções', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('13', 'categories', 'slug', '1', 'pt', 'categoria-1', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('14', 'categories', 'name', '1', 'pt', 'Categoria 1', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('15', 'categories', 'slug', '2', 'pt', 'categoria-2', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('16', 'categories', 'name', '2', 'pt', 'Categoria 2', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('17', 'pages', 'title', '1', 'pt', 'Olá Mundo', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('18', 'pages', 'slug', '1', 'pt', 'ola-mundo', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('19', 'pages', 'body', '1', 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('20', 'menu_items', 'title', '1', 'pt', 'Painel de Controle', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('21', 'menu_items', 'title', '2', 'pt', 'Media', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('22', 'menu_items', 'title', '12', 'pt', 'Publicações', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('23', 'menu_items', 'title', '3', 'pt', 'Utilizadores', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('24', 'menu_items', 'title', '11', 'pt', 'Categorias', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('25', 'menu_items', 'title', '13', 'pt', 'Páginas', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('26', 'menu_items', 'title', '4', 'pt', 'Funções', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('27', 'menu_items', 'title', '5', 'pt', 'Ferramentas', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('28', 'menu_items', 'title', '6', 'pt', 'Menus', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('29', 'menu_items', 'title', '7', 'pt', 'Base de dados', '2020-05-15 15:25:46', '2020-05-15 15:25:46');
INSERT INTO `translations` VALUES ('30', 'menu_items', 'title', '10', 'pt', 'Configurações', '2020-05-15 15:25:46', '2020-05-15 15:25:46');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asignado_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'Admin', 'admin@adlnetworks.com', 'users/11595699396.png', null, '$2y$10$ygfhuA/2b1a1PEQnNK5wMeGxsPbl0qQf69UeN.r9Z9mMVqTEexsxq', null, null, '2020-05-15 15:25:46', '2020-07-25 12:49:56', '7751292785', '1', '1', '1', null);
INSERT INTO `users` VALUES ('3', '1', 'Jonah Harding', 'hyfa@mailinator.net', 'users/default.png', null, '$2y$10$SThvID8ciiFlcppyRerNLuh72ig5loqGQXcIMscfV.5H1ZlppUHxK', 'js87fvMFSDexGxsT5crBEbH7m6ixtdvB97EAe5etK1TZneDWuuBajPRcujeq', null, '2020-05-18 17:36:49', '2020-06-01 11:43:23', '4654', '1', '1', '1', null);
INSERT INTO `users` VALUES ('4', '1', 'Xanthus Berg', 'gomuta@mailinator.net', 'users/default.png', null, '$2y$10$Re.fJ/V4lOA2z0IQVdY1yelD.aHuzLwrr9xXNGjHOQRheMtgkfsq2', null, null, '2020-05-18 19:06:30', '2020-06-01 11:43:24', '654654', '1', '1', '2', null);
INSERT INTO `users` VALUES ('5', '1', 'Alexa Shepherd', 'rivylume@mailinator.net', 'users/default.png', null, '$2y$10$q359CqCmbF4ZG3Sb437wRO9VH0MFMUMYK6Ms4CFJ1WGvbxHiQeYja', null, null, '2020-05-18 19:58:41', '2020-06-01 11:43:25', '6546', '1', '1', '1', null);
INSERT INTO `users` VALUES ('6', '1', 'Jermaine Villarreal', 'satyjopamy@mailinator.net', 'users/default.png', null, '$2y$10$my5mMZ/4P4DHITA4s4w9c.evSjVaysD4pWX29y.B5ok0FuOL6KrZm', null, null, '2020-05-18 19:58:54', '2020-06-01 11:43:26', '54654654', '3', '1', '2', null);
INSERT INTO `users` VALUES ('7', '1', 'Xantha Vance', 'hisab@mailinator.net', 'users/default.png', null, '$2y$10$eloYeMpdCq/SEuSnMIhVMeUlRnXmP6DECYHUOaIDdWXuVW50RkzhK', null, null, '2020-05-18 19:59:10', '2020-06-01 11:43:27', '654654', '5', '1', '2', null);
INSERT INTO `users` VALUES ('8', '1', 'Mufutau Sawyer', 'wiceby@mailinator.com', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 19:59:26', '2020-05-18 19:59:26', '54654', '6', '1', '2', null);
INSERT INTO `users` VALUES ('9', '1', 'Felicia Gonzalez', 'lyqyz@mailinator.net', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:00:02', '2020-05-18 20:00:02', '654654', '7', '1', '3', null);
INSERT INTO `users` VALUES ('10', '1', 'Byron Haynes', 'vywixap@mailinator.com', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:00:16', '2020-05-18 20:00:16', '564654', '8', '1', '3', null);
INSERT INTO `users` VALUES ('11', '1', 'Martena Deleon', 'leqi@mailinator.net', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:00:32', '2020-05-20 03:44:19', '123 4654 654', '6', '1', '3', null);
INSERT INTO `users` VALUES ('12', '1', 'Jordan Steele', 'vohefapi@mailinator.net', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:00:44', '2020-05-18 20:00:44', '546456', '7', '1', '3', null);
INSERT INTO `users` VALUES ('13', '1', 'Cade Woodard', 'fogasyz@mailinator.net', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:00:56', '2020-05-18 20:00:56', '54654', '8', '1', '3', null);
INSERT INTO `users` VALUES ('14', '1', 'Anika Nelson', 'nohywyguli@mailinator.com', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:01:11', '2020-05-20 04:55:20', '5465465', '4', '1', '4', null);
INSERT INTO `users` VALUES ('15', '1', 'Yuli Williamson', 'xelonyqe@mailinator.net', 'users/151595699355.jpg', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:01:28', '2020-07-25 12:49:15', '54654655674', '4', '1', '3', null);
INSERT INTO `users` VALUES ('16', '1', 'Rebekah Wall', 'cuqazyk@mailinator.com', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-18 20:01:42', '2020-05-20 04:55:20', '546465', '4', '1', '4', null);
INSERT INTO `users` VALUES ('18', '1', 'Gerardo Gómez Ponde', 'gerardogerente@gmail.com', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-20 05:43:34', '2020-05-20 09:03:58', null, '18', '1', '2', null);
INSERT INTO `users` VALUES ('19', '1', 'Pedro Pérez Canoso', 'pedro@gmail.com', 'users/default.png', null, '$2y$10$e4lMWqSecWIV/C9g8uYLq.WnieqB1PTbOz9EkbG/ooQpG8ZuOakLi', null, null, '2020-05-20 06:27:52', '2020-06-01 14:52:38', '7984561238', '18', '1', '4', null);
INSERT INTO `users` VALUES ('20', '1', 'Amena Hodges Lorea', 'qewi@mailinator.net', 'users/default.png', null, '$2y$10$zCQxx0jExeEIYI6VDpdFAe5bvH8j0ovNx55jO7TY8j1zAO3FY64A6', null, null, '2020-05-20 08:20:27', '2020-06-01 12:32:55', 'Eligendi praesentium', '18', '1', '3', '2020-06-01 12:32:55');
INSERT INTO `users` VALUES ('21', '1', 'Plato Zimmerman', 'xuba@mailinator.net', 'users/default.png', null, '$2y$10$QwLXUA7Q892Cv0TQVcfN7eWCJ8i.4pAMoZPiABYcs95Ox7TzRHKpa', null, null, '2020-06-02 14:16:10', '2020-06-02 14:16:10', 'Ut minus aliquam aut', '1', '1', '2', null);
INSERT INTO `users` VALUES ('22', '1', 'Cassidy Cooke', 'tiso@mailinator.net', 'users/default.png', null, '$2y$10$7Oia4bw6oSwvvuoh3SgfLO0aCIV2fxg2hdt2694BbJO3gc7U0AdUO', null, null, '2020-06-02 14:16:33', '2020-06-02 14:16:33', 'Sit aut voluptate il', '4', '1', '4', null);
INSERT INTO `users` VALUES ('23', '1', 'Madonna Saunders', 'nuzixafajo@mailinator.com', 'users/default.png', null, '$2y$10$7dIsDkw56D8dJh4.02SGGOPnVcn4ORdnY4A6mvHlzvQhBh4aRh8w6', null, null, '2020-07-25 11:42:25', '2020-07-25 11:42:25', 'Adipisci cumque adip', '8', '1', '3', null);
INSERT INTO `users` VALUES ('24', '1', 'Tyrone Nichols', 'cakevaki@mailinator.com', 'users/1595699602.png', null, '$2y$10$xxgj63g/JPoaUNkE0KRV8OeyBavJUzwWnoxtmedR4H2K8okpqgHKy', null, null, '2020-07-25 12:53:22', '2020-07-25 12:53:22', 'Quo vel necessitatib', '7', '1', '4', null);
INSERT INTO `users` VALUES ('25', '1', 'Isabelle Barry', 'fikecagyf@mailinator.com', 'users/default.png', null, '$2y$10$b2O8QXaqrhQmvT.enngeiOPELQD0bODVEKw49bEo1BiLXpEdPTzje', null, null, '2020-07-25 12:55:00', '2020-07-25 12:55:00', 'Veritatis ut reprehe', '1', '1', '2', null);

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_roles
-- ----------------------------

-- ----------------------------
-- Table structure for websockets_statistics_entries
-- ----------------------------
DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of websockets_statistics_entries
-- ----------------------------
