-- --------------------------------------------------------
-- 主机:                           192.168.10.10
-- 服务器版本:                        5.7.28-0ubuntu0.18.04.4 - (Ubuntu)
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 sixue.admin_menu 结构
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_menu 的数据：~9 rows (大约)
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, '后台首页', 'fa-bar-chart', '/', NULL, NULL, '2020-07-09 03:11:14'),
	(2, 0, 2, '系统管理', 'fa-tasks', NULL, NULL, NULL, '2020-07-09 03:00:44'),
	(3, 2, 3, '管理员', 'fa-users', 'auth/users', NULL, NULL, '2020-07-09 03:01:09'),
	(4, 2, 4, '角色', 'fa-user', 'auth/roles', NULL, NULL, '2020-07-09 03:01:23'),
	(5, 2, 5, '权限', 'fa-ban', 'auth/permissions', NULL, NULL, '2020-07-09 03:01:39'),
	(6, 2, 6, '菜单', 'fa-bars', 'auth/menu', NULL, NULL, '2020-07-09 03:01:53'),
	(7, 2, 7, '日志', 'fa-history', 'auth/logs', NULL, NULL, '2020-07-09 03:02:10'),
	(8, 0, 0, '用户管理', 'fa-users', '/users', NULL, '2020-07-09 03:40:37', '2020-07-09 03:40:37'),
	(9, 0, 0, '商品管理', 'fa-cubes', '/products', NULL, '2020-07-10 02:03:02', '2020-07-10 02:03:02');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

-- 导出  表 sixue.admin_operation_log 结构
CREATE TABLE IF NOT EXISTS `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_operation_log 的数据：~138 rows (大约)
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-09 02:41:26', '2020-07-09 02:41:26'),
	(2, 1, 'admin', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 02:41:39', '2020-07-09 02:41:39'),
	(3, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 02:47:54', '2020-07-09 02:47:54'),
	(4, 1, 'admin/auth/menu/1/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 02:59:58', '2020-07-09 02:59:58'),
	(5, 1, 'admin/auth/menu/1', 'PUT', '192.168.10.1', '{"parent_id":"0","title":"\\u9996\\u9875","icon":"fa-bar-chart","uri":"\\/","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:00:14', '2020-07-09 03:00:14'),
	(6, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:00:15', '2020-07-09 03:00:15'),
	(7, 1, 'admin/auth/menu/2/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:00:24', '2020-07-09 03:00:24'),
	(8, 1, 'admin/auth/menu/2', 'PUT', '192.168.10.1', '{"parent_id":"0","title":"\\u7cfb\\u7edf\\u7ba1\\u7406","icon":"fa-tasks","uri":null,"roles":["1",null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:00:44', '2020-07-09 03:00:44'),
	(9, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:00:45', '2020-07-09 03:00:45'),
	(10, 1, 'admin/auth/menu/3/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:00:52', '2020-07-09 03:00:52'),
	(11, 1, 'admin/auth/menu/3', 'PUT', '192.168.10.1', '{"parent_id":"2","title":"\\u7ba1\\u7406\\u5458","icon":"fa-users","uri":"auth\\/users","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:01:08', '2020-07-09 03:01:08'),
	(12, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:01:10', '2020-07-09 03:01:10'),
	(13, 1, 'admin/auth/menu/4/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:01:14', '2020-07-09 03:01:14'),
	(14, 1, 'admin/auth/menu/4', 'PUT', '192.168.10.1', '{"parent_id":"2","title":"\\u89d2\\u8272","icon":"fa-user","uri":"auth\\/roles","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:01:23', '2020-07-09 03:01:23'),
	(15, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:01:24', '2020-07-09 03:01:24'),
	(16, 1, 'admin/auth/menu/5/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:01:29', '2020-07-09 03:01:29'),
	(17, 1, 'admin/auth/menu/5', 'PUT', '192.168.10.1', '{"parent_id":"2","title":"\\u6743\\u9650","icon":"fa-ban","uri":"auth\\/permissions","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:01:38', '2020-07-09 03:01:38'),
	(18, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:01:40', '2020-07-09 03:01:40'),
	(19, 1, 'admin/auth/menu/6/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:01:45', '2020-07-09 03:01:45'),
	(20, 1, 'admin/auth/menu/6', 'PUT', '192.168.10.1', '{"parent_id":"2","title":"\\u83dc\\u5355","icon":"fa-bars","uri":"auth\\/menu","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:01:53', '2020-07-09 03:01:53'),
	(21, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:01:55', '2020-07-09 03:01:55'),
	(22, 1, 'admin/auth/menu/7/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:02:01', '2020-07-09 03:02:01'),
	(23, 1, 'admin/auth/menu/7', 'PUT', '192.168.10.1', '{"parent_id":"2","title":"\\u65e5\\u5fd7","icon":"fa-history","uri":"auth\\/logs","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:02:10', '2020-07-09 03:02:10'),
	(24, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:02:11', '2020-07-09 03:02:11'),
	(25, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:02:18', '2020-07-09 03:02:18'),
	(26, 1, 'admin/auth/menu/1/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:11:04', '2020-07-09 03:11:04'),
	(27, 1, 'admin/auth/menu/1', 'PUT', '192.168.10.1', '{"parent_id":"0","title":"\\u540e\\u53f0\\u9996\\u9875","icon":"fa-bar-chart","uri":"\\/","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/menu"}', '2020-07-09 03:11:14', '2020-07-09 03:11:14'),
	(28, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:11:15', '2020-07-09 03:11:15'),
	(29, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:33:36', '2020-07-09 03:33:36'),
	(30, 1, 'admin/auth/menu', 'POST', '192.168.10.1', '{"parent_id":"0","title":"\\u7528\\u6237\\u7ba1\\u7406","icon":"fa-users","uri":"\\/users","roles":[null],"permission":null,"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW"}', '2020-07-09 03:40:37', '2020-07-09 03:40:37'),
	(31, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-09 03:40:39', '2020-07-09 03:40:39'),
	(32, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:40:49', '2020-07-09 03:40:49'),
	(33, 1, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:41:13', '2020-07-09 03:41:13'),
	(34, 1, 'admin/users', 'GET', '192.168.10.1', '[]', '2020-07-09 03:55:07', '2020-07-09 03:55:07'),
	(35, 1, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:57:00', '2020-07-09 03:57:00'),
	(36, 1, 'admin', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:57:03', '2020-07-09 03:57:03'),
	(37, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:57:16', '2020-07-09 03:57:16'),
	(38, 1, 'admin/auth/menu/8/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:59:16', '2020-07-09 03:59:16'),
	(39, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 03:59:41', '2020-07-09 03:59:41'),
	(40, 1, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:01:35', '2020-07-09 04:01:35'),
	(41, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:09:22', '2020-07-09 04:09:22'),
	(42, 1, 'admin/auth/permissions/1/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:09:37', '2020-07-09 04:09:37'),
	(43, 1, 'admin/auth/permissions/1', 'PUT', '192.168.10.1', '{"slug":"*","name":"\\u6240\\u6709\\u6743\\u9650","http_method":[null],"http_path":"*","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:09:50', '2020-07-09 04:09:50'),
	(44, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:09:51', '2020-07-09 04:09:51'),
	(45, 1, 'admin/auth/permissions/2/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:10:20', '2020-07-09 04:10:20'),
	(46, 1, 'admin/auth/permissions/2', 'PUT', '192.168.10.1', '{"slug":"dashboard","name":"\\u540e\\u53f0\\u9996\\u9875","http_method":["GET",null],"http_path":"\\/","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:10:34', '2020-07-09 04:10:34'),
	(47, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:10:36', '2020-07-09 04:10:36'),
	(48, 1, 'admin/auth/permissions/3/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:10:51', '2020-07-09 04:10:51'),
	(49, 1, 'admin/auth/permissions/3', 'PUT', '192.168.10.1', '{"slug":"auth.login","name":"\\u767b\\u5f55\\u767b\\u51fa","http_method":[null],"http_path":"\\/auth\\/login\\r\\n\\/auth\\/logout","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:11:06', '2020-07-09 04:11:06'),
	(50, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:11:07', '2020-07-09 04:11:07'),
	(51, 1, 'admin/auth/permissions/5/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:12:33', '2020-07-09 04:12:33'),
	(52, 1, 'admin/auth/permissions/5', 'PUT', '192.168.10.1', '{"slug":"auth.management","name":"\\u7cfb\\u7edf\\u7ba1\\u7406","http_method":[null],"http_path":"\\/auth\\/roles\\r\\n\\/auth\\/permissions\\r\\n\\/auth\\/menu\\r\\n\\/auth\\/logs","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:12:49', '2020-07-09 04:12:49'),
	(53, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:12:50', '2020-07-09 04:12:50'),
	(54, 1, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:13:11', '2020-07-09 04:13:11'),
	(55, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:15:57', '2020-07-09 04:15:57'),
	(56, 1, 'admin/auth/permissions/4/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:16:09', '2020-07-09 04:16:09'),
	(57, 1, 'admin/auth/permissions/4', 'PUT', '192.168.10.1', '{"slug":"auth.setting","name":"\\u8d85\\u7ba1\\u8bbe\\u7f6e","http_method":["GET","PUT",null],"http_path":"\\/auth\\/setting","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:16:34', '2020-07-09 04:16:34'),
	(58, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:16:35', '2020-07-09 04:16:35'),
	(59, 1, 'admin/auth/permissions/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:17:16', '2020-07-09 04:17:16'),
	(60, 1, 'admin/auth/permissions', 'POST', '192.168.10.1', '{"slug":"users","name":"\\u7528\\u6237\\u7ba1\\u7406","http_method":[null],"http_path":"\\/users\\/*","_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:18:20', '2020-07-09 04:18:20'),
	(61, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:18:22', '2020-07-09 04:18:22'),
	(62, 1, 'admin/auth/roles', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:18:54', '2020-07-09 04:18:54'),
	(63, 1, 'admin/auth/roles/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:19:01', '2020-07-09 04:19:01'),
	(64, 1, 'admin/auth/roles', 'POST', '192.168.10.1', '{"slug":"operation","name":"\\u8fd0\\u8425","permissions":["2","3","4","6",null],"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/roles"}', '2020-07-09 04:21:06', '2020-07-09 04:21:06'),
	(65, 1, 'admin/auth/roles', 'GET', '192.168.10.1', '[]', '2020-07-09 04:21:09', '2020-07-09 04:21:09'),
	(66, 1, 'admin/auth/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:21:49', '2020-07-09 04:21:49'),
	(67, 1, 'admin/auth/users/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:21:53', '2020-07-09 04:21:53'),
	(68, 1, 'admin/auth/users/create', 'GET', '192.168.10.1', '[]', '2020-07-09 04:25:13', '2020-07-09 04:25:13'),
	(69, 1, 'admin/auth/users/create', 'GET', '192.168.10.1', '[]', '2020-07-09 04:25:22', '2020-07-09 04:25:22'),
	(70, 1, 'admin/auth/users', 'POST', '192.168.10.1', '{"username":"opertor","name":"\\u8fd0\\u8425","password":"admin","password_confirmation":"admin","roles":["2",null],"permissions":[null],"_token":"93vL3toxDWDwVr4Qm2mnvc7ZqgGL9lLtS5IBsmKW"}', '2020-07-09 04:26:06', '2020-07-09 04:26:06'),
	(71, 1, 'admin/auth/users', 'GET', '192.168.10.1', '[]', '2020-07-09 04:26:08', '2020-07-09 04:26:08'),
	(72, 1, 'admin/auth/logout', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:26:19', '2020-07-09 04:26:19'),
	(73, 2, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-09 04:26:50', '2020-07-09 04:26:50'),
	(74, 2, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:27:00', '2020-07-09 04:27:00'),
	(75, 2, 'admin', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:27:05', '2020-07-09 04:27:05'),
	(76, 2, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:28:20', '2020-07-09 04:28:20'),
	(77, 2, 'admin/users', 'GET', '192.168.10.1', '[]', '2020-07-09 04:30:05', '2020-07-09 04:30:05'),
	(78, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:30:20', '2020-07-09 04:30:20'),
	(79, 2, 'admin/auth/setting', 'PUT', '192.168.10.1', '{"name":"\\u8fd0\\u8425","password":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","password_confirmation":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","_token":"NQNE45eVrAIA5NnrO7HsfhhQ4J2gqHGDcyuR90iu","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/users"}', '2020-07-09 04:30:41', '2020-07-09 04:30:41'),
	(80, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:30:42', '2020-07-09 04:30:42'),
	(81, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:30:52', '2020-07-09 04:30:52'),
	(82, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:31:10', '2020-07-09 04:31:10'),
	(83, 2, 'admin/auth/setting', 'PUT', '192.168.10.1', '{"name":"\\u8fd0\\u8425","password":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","password_confirmation":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","_token":"NQNE45eVrAIA5NnrO7HsfhhQ4J2gqHGDcyuR90iu","_method":"PUT"}', '2020-07-09 04:31:43', '2020-07-09 04:31:43'),
	(84, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:31:44', '2020-07-09 04:31:44'),
	(85, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:31:53', '2020-07-09 04:31:53'),
	(86, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:35:50', '2020-07-09 04:35:50'),
	(87, 2, 'admin/auth/setting', 'PUT', '192.168.10.1', '{"name":"\\u8fd0\\u8425","password":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","password_confirmation":"$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi","_token":"NQNE45eVrAIA5NnrO7HsfhhQ4J2gqHGDcyuR90iu","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/login"}', '2020-07-09 04:36:05', '2020-07-09 04:36:05'),
	(88, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:36:06', '2020-07-09 04:36:06'),
	(89, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:36:15', '2020-07-09 04:36:15'),
	(90, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:36:21', '2020-07-09 04:36:21'),
	(91, 2, 'admin/auth/setting', 'GET', '192.168.10.1', '[]', '2020-07-09 04:36:43', '2020-07-09 04:36:43'),
	(92, 2, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:37:24', '2020-07-09 04:37:24'),
	(93, 2, 'admin/auth/logout', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:37:30', '2020-07-09 04:37:30'),
	(94, 1, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-09 04:37:48', '2020-07-09 04:37:48'),
	(95, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:37:59', '2020-07-09 04:37:59'),
	(96, 1, 'admin/auth/roles', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:38:30', '2020-07-09 04:38:30'),
	(97, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:39:04', '2020-07-09 04:39:04'),
	(98, 1, 'admin/auth/permissions/6/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:39:21', '2020-07-09 04:39:21'),
	(99, 1, 'admin/auth/permissions/6', 'PUT', '192.168.10.1', '{"slug":"users","name":"\\u7528\\u6237\\u7ba1\\u7406","http_method":[null],"http_path":"\\/users*","_token":"493vE2U3wPVJob6auzjppQvwSSmzOZaRJtELwhAG","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:39:29', '2020-07-09 04:39:29'),
	(100, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:39:30', '2020-07-09 04:39:30'),
	(101, 1, 'admin/auth/permissions/4/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:40:06', '2020-07-09 04:40:06'),
	(102, 1, 'admin/auth/permissions/4', 'PUT', '192.168.10.1', '{"slug":"auth.setting","name":"\\u8d85\\u7ba1\\u8bbe\\u7f6e","http_method":["GET","PUT",null],"http_path":"\\/auth\\/setting","_token":"493vE2U3wPVJob6auzjppQvwSSmzOZaRJtELwhAG","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/auth\\/permissions"}', '2020-07-09 04:43:36', '2020-07-09 04:43:36'),
	(103, 1, 'admin/auth/permissions', 'GET', '192.168.10.1', '[]', '2020-07-09 04:43:39', '2020-07-09 04:43:39'),
	(104, 1, 'admin/auth/logout', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:43:48', '2020-07-09 04:43:48'),
	(105, 2, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-09 04:44:08', '2020-07-09 04:44:08'),
	(106, 2, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-09 04:44:15', '2020-07-09 04:44:15'),
	(107, 2, 'admin/auth/logout', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:01:40', '2020-07-10 02:01:40'),
	(108, 1, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-10 02:01:59', '2020-07-10 02:01:59'),
	(109, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:02:06', '2020-07-10 02:02:06'),
	(110, 1, 'admin/auth/menu', 'POST', '192.168.10.1', '{"parent_id":"0","title":"\\u5546\\u54c1\\u7ba1\\u7406","icon":"fa-cubes","uri":"\\/products","roles":[null],"permission":null,"_token":"txI5wVFLle5Hngu4Tiuo4iUoMWBRcea6ZmSqaf0L"}', '2020-07-10 02:03:02', '2020-07-10 02:03:02'),
	(111, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2020-07-10 02:03:03', '2020-07-10 02:03:03'),
	(112, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:03:15', '2020-07-10 02:03:15'),
	(113, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 02:09:46', '2020-07-10 02:09:46'),
	(114, 1, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:50:31', '2020-07-10 02:50:31'),
	(115, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:51:06', '2020-07-10 02:51:06'),
	(116, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 02:56:53', '2020-07-10 02:56:53'),
	(117, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:57:00', '2020-07-10 02:57:00'),
	(118, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:58:03', '2020-07-10 02:58:03'),
	(119, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 02:58:10', '2020-07-10 02:58:10'),
	(120, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:07:15', '2020-07-10 03:07:15'),
	(121, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:13:02', '2020-07-10 03:13:02'),
	(122, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:14:17', '2020-07-10 03:14:17'),
	(123, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:14:23', '2020-07-10 03:14:23'),
	(124, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:22:54', '2020-07-10 03:22:54'),
	(125, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:23:01', '2020-07-10 03:23:01'),
	(126, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:23:06', '2020-07-10 03:23:06'),
	(127, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:23:10', '2020-07-10 03:23:10'),
	(128, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:23:48', '2020-07-10 03:23:48'),
	(129, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:23:55', '2020-07-10 03:23:55'),
	(130, 1, 'admin/products', 'POST', '192.168.10.1', '{"title":"iphone X","description":"<p>\\u4ef7\\u683c\\u4f18\\u60e0\\uff0c\\u72ec\\u6b64\\u4e00\\u5bb6<\\/p>","on_sale":"on","skus":{"new_1":{"title":null,"description":null,"price":null,"stock":null,"id":null,"_remove_":"0"}},"_token":"txI5wVFLle5Hngu4Tiuo4iUoMWBRcea6ZmSqaf0L"}', '2020-07-10 03:27:08', '2020-07-10 03:27:08'),
	(131, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2020-07-10 03:27:11', '2020-07-10 03:27:11'),
	(132, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 03:27:22', '2020-07-10 03:27:22'),
	(133, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 03:27:38', '2020-07-10 03:27:38'),
	(134, 1, 'admin/products', 'POST', '192.168.10.1', '{"title":"iphone X","description":"<p>FDSAFDSA<\\/p>","on_sale":"on","_token":"txI5wVFLle5Hngu4Tiuo4iUoMWBRcea6ZmSqaf0L","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-10 03:28:05', '2020-07-10 03:28:05'),
	(135, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 03:28:07', '2020-07-10 03:28:07'),
	(136, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 03:28:31', '2020-07-10 03:28:31'),
	(137, 1, 'admin/products', 'POST', '192.168.10.1', '{"title":"\\u5c0f\\u7c73 9","description":"<p>\\u8303\\u5fb7\\u8428\\u8303\\u5fb7\\u8428<\\/p>","on_sale":"on","skus":{"new_1":{"title":"\\u7070\\u827264G","description":"\\u5c0f\\u7c73 9 \\u7070\\u827264G","price":"799","stock":"100","id":null,"_remove_":"0"},"new_2":{"title":"\\u7070\\u8272 256G","description":"\\u5c0f\\u7c73 9 \\u7070\\u8272256G","price":"1100","stock":"200","id":null,"_remove_":"0"}},"_token":"txI5wVFLle5Hngu4Tiuo4iUoMWBRcea6ZmSqaf0L","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-10 03:30:19', '2020-07-10 03:30:19'),
	(138, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 03:30:21', '2020-07-10 03:30:21'),
	(139, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 05:58:43', '2020-07-10 05:58:43'),
	(140, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 05:59:08', '2020-07-10 05:59:08'),
	(141, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 06:04:49', '2020-07-10 06:04:49'),
	(142, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2020-07-10 06:06:27', '2020-07-10 06:06:27'),
	(143, 1, 'admin/products/1', 'PUT', '192.168.10.1', '{"title":"iphone X","description":"<p><br><\\/p>","on_sale":"on","_token":"ady7DFgtcBTjn5846pH2d9TB8xO1cJfnusU8lcZG","_method":"PUT"}', '2020-07-10 06:06:49', '2020-07-10 06:06:49'),
	(144, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 06:06:52', '2020-07-10 06:06:52'),
	(145, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 06:07:04', '2020-07-10 06:07:04'),
	(146, 1, 'admin/products/2', 'PUT', '192.168.10.1', '{"title":"\\u5c0f\\u7c73 9","description":"<p>\\u4ef7\\u683c\\u4f18\\u60e0\\uff0c\\u4ec5\\u6b64\\u4e00\\u5bb6<\\/p>","on_sale":"on","skus":{"1":{"title":"\\u7070\\u827264G","description":"\\u5c0f\\u7c73 9 \\u7070\\u827264G","price":"799.00","stock":"100","id":"1","_remove_":"0"},"2":{"title":"\\u7070\\u8272 256G","description":"\\u5c0f\\u7c73 9 \\u7070\\u8272256G","price":"1100.00","stock":"200","id":"2","_remove_":"0"}},"_token":"ady7DFgtcBTjn5846pH2d9TB8xO1cJfnusU8lcZG","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-10 06:07:23', '2020-07-10 06:07:23'),
	(147, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-10 06:07:25', '2020-07-10 06:07:25'),
	(148, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 06:07:32', '2020-07-10 06:07:32'),
	(149, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-10 06:08:42', '2020-07-10 06:08:42'),
	(150, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-11 11:40:22', '2020-07-11 11:40:22'),
	(151, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-12 16:53:31', '2020-07-12 16:53:31'),
	(152, 1, 'admin/products', 'POST', '192.168.10.1', '{"title":"\\u5c0f\\u7c73 9","description":"<p><br><\\/p>","on_sale":"on","_token":"TIEqkJkKXNU1KHf07JRJ2zRPqyZbKZzjijORCtT5","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-12 16:54:13', '2020-07-12 16:54:13'),
	(153, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-12 16:54:15', '2020-07-12 16:54:15'),
	(154, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-12 16:54:22', '2020-07-12 16:54:22'),
	(155, 1, 'admin/products', 'POST', '192.168.10.1', '{"title":"\\u5c0f\\u7c7310","description":"<p><br><\\/p>","on_sale":"on","_token":"TIEqkJkKXNU1KHf07JRJ2zRPqyZbKZzjijORCtT5","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-12 16:55:09', '2020-07-12 16:55:09'),
	(156, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-12 16:55:11', '2020-07-12 16:55:11'),
	(157, 1, 'admin/products/create', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-14 14:36:07', '2020-07-14 14:36:07'),
	(158, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-14 14:37:47', '2020-07-14 14:37:47'),
	(159, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-14 14:37:55', '2020-07-14 14:37:55'),
	(160, 1, 'admin/products/1', 'PUT', '192.168.10.1', '{"title":"iphone X","description":"<p><br><\\/p>","on_sale":"on","skus":{"new_1":{"title":"\\u6708\\u6155\\u767d","description":"\\u989c\\u8272","price":"2990","stock":"232","id":null,"_remove_":"0"},"new_2":{"title":"\\u661f\\u5e7b\\u7d2b","description":"\\u989c\\u8272","price":"1100","stock":"55","id":null,"_remove_":"0"},"new_3":{"title":"\\u5929\\u9645\\u84dd","description":"\\u989c\\u8272","price":"18.9","stock":"1000","id":null,"_remove_":"0"},"new_4":{"title":"\\u592a\\u7a7a\\u7070","description":"\\u989c\\u8272","price":"123","stock":"123","id":null,"_remove_":"0"},"new_5":{"title":"128G","description":"\\u5bb9\\u91cf","price":"111","stock":"100","id":null,"_remove_":"0"}},"_token":"s8pJ4pAiP9vw8dGUKHYVxX66pEsBBDxsa8eUWeHX","_method":"PUT","_previous_":"http:\\/\\/sixue.com\\/admin\\/products"}', '2020-07-14 14:41:15', '2020-07-14 14:41:15'),
	(161, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2020-07-14 14:41:18', '2020-07-14 14:41:18'),
	(162, 1, 'admin/products/4/edit', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-15 07:18:37', '2020-07-15 07:18:37'),
	(163, 1, 'admin/products/3/edit', 'GET', '192.168.10.1', '[]', '2020-07-15 07:18:53', '2020-07-15 07:18:53'),
	(164, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '[]', '2020-07-15 07:19:05', '2020-07-15 07:19:05'),
	(165, 1, 'admin', 'GET', '192.168.10.1', '[]', '2020-07-28 19:20:30', '2020-07-28 19:20:30'),
	(166, 1, 'admin/products', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-28 19:20:41', '2020-07-28 19:20:41'),
	(167, 1, 'admin/users', 'GET', '192.168.10.1', '{"_pjax":"#pjax-container"}', '2020-07-28 19:20:53', '2020-07-28 19:20:53');
/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;

-- 导出  表 sixue.admin_permissions 结构
CREATE TABLE IF NOT EXISTS `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_permissions 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
	(1, '所有权限', '*', '', '*', NULL, '2020-07-09 04:09:50'),
	(2, '后台首页', 'dashboard', 'GET', '/', NULL, '2020-07-09 04:10:35'),
	(3, '登录登出', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, '2020-07-09 04:11:07'),
	(4, '超管设置', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, '2020-07-09 04:16:34'),
	(5, '系统管理', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, '2020-07-09 04:12:49'),
	(6, '用户管理', 'users', '', '/users*', '2020-07-09 04:18:20', '2020-07-09 04:39:29');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;

-- 导出  表 sixue.admin_roles 结构
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_roles 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2020-07-09 02:40:19', '2020-07-09 02:40:19'),
	(2, '运营', 'operation', '2020-07-09 04:21:07', '2020-07-09 04:21:07');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

-- 导出  表 sixue.admin_role_menu 结构
CREATE TABLE IF NOT EXISTS `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_role_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
	(1, 2, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

-- 导出  表 sixue.admin_role_permissions 结构
CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_role_permissions 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(2, 2, NULL, NULL),
	(2, 3, NULL, NULL),
	(2, 4, NULL, NULL),
	(2, 6, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

-- 导出  表 sixue.admin_role_users 结构
CREATE TABLE IF NOT EXISTS `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_role_users 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(2, 2, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

-- 导出  表 sixue.admin_users 结构
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_users 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$RUuaWgLg4/LsQ6YjHCkWf.vN2wnyyfCCnyx0NQ3DhFFZeWYUMngcW', 'Administrator', NULL, 'Xk3lkAlsofkwRPmjviiiCBEZJrQ2tT2jzMn6chTDW3ozJ4XB4hEyIHS9xKJl', '2020-07-09 02:40:18', '2020-07-09 02:40:18'),
	(2, 'opertor', '$2y$10$9H1hYj44SZqj4r6AChEmpeEhvh0pS5.bzourJhjXlvAEoOfFXWDzi', '运营', 'images/avatar.jpg', 'Iht5frOEsLEhWcrWNNezymHWodvjzp0mdiCdI5Qu1diHf9b3znWPd8vsjOJh', '2020-07-09 04:26:07', '2020-07-09 04:36:05');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

-- 导出  表 sixue.admin_user_permissions 结构
CREATE TABLE IF NOT EXISTS `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.admin_user_permissions 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;

-- 导出  表 sixue.cart_items 结构
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '关联购买用户',
  `product_sku_id` bigint(20) unsigned NOT NULL COMMENT '关联加入的单品',
  `amount` int(10) unsigned NOT NULL COMMENT '加入单品的数量',
  PRIMARY KEY (`id`),
  KEY `cart_items_user_id_foreign` (`user_id`),
  KEY `cart_items_product_sku_id_foreign` (`product_sku_id`),
  CONSTRAINT `cart_items_product_sku_id_foreign` FOREIGN KEY (`product_sku_id`) REFERENCES `product_skus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.cart_items 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` (`id`, `user_id`, `product_sku_id`, `amount`) VALUES
	(3, 24, 6, 4);
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;

-- 导出  表 sixue.failed_jobs 结构
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.failed_jobs 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- 导出  表 sixue.migrations 结构
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.migrations 的数据：~9 rows (大约)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_07_03_041847_create_user_addresses_table', 2),
	(5, '2016_01_04_173148_create_admin_tables', 3),
	(6, '2020_07_09_062701_create_products_table', 4),
	(7, '2020_07_09_063014_create_product_skus_table', 4),
	(8, '2020_07_15_122617_create_user_favorite_products', 5),
	(9, '2020_07_16_150411_create_cart_items_table', 6),
	(10, '2020_07_22_000844_create_orders_table', 7),
	(11, '2020_07_22_004404_create_order_items_table', 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- 导出  表 sixue.orders 结构
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单流水号',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '下单用户',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址',
  `total_amount` decimal(10,2) NOT NULL COMMENT '订单总金额',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '订单备注',
  `paid_at` datetime DEFAULT NULL COMMENT '支付时间',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付方式',
  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付流水号',
  `refund_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '退单状态',
  `refund_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '退单流水号',
  `closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单是否关闭',
  `reviewed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单是否评价',
  `ship_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '物流状态',
  `ship_data` text COLLATE utf8mb4_unicode_ci COMMENT '物流信息',
  `extra` text COLLATE utf8mb4_unicode_ci COMMENT '其他信息',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_no_unique` (`no`),
  UNIQUE KEY `orders_refund_no_unique` (`refund_no`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.orders 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `no`, `user_id`, `address`, `total_amount`, `remark`, `paid_at`, `payment_method`, `payment_no`, `refund_status`, `refund_no`, `closed`, `reviewed`, `ship_status`, `ship_data`, `extra`, `created_at`, `updated_at`) VALUES
	(3, '20200727071940061209', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 2514.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-27 07:19:40', '2020-07-27 07:19:40'),
	(4, '20200727123049886386', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 111.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 1, 0, 'pending', NULL, NULL, '2020-07-27 12:30:49', '2020-07-27 12:31:49'),
	(5, '20200727123409167492', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 111.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 1, 0, 'pending', NULL, NULL, '2020-07-27 12:34:09', '2020-07-27 12:35:11'),
	(6, '20200728160311152141', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 222.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-28 16:03:11', '2020-07-28 16:03:12'),
	(8, '20200730002757507343', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 492.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-30 00:27:57', '2020-07-30 00:27:57'),
	(9, '20200730003607451836', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 492.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-30 00:36:07', '2020-07-30 00:36:08'),
	(10, '20200730003644770593', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 492.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-30 00:36:44', '2020-07-30 00:36:44'),
	(11, '20200730003734631381', 24, '{"address":"\\u6cb3\\u5317\\u7701\\u77f3\\u5bb6\\u5e84\\u5e02\\u957f\\u5b89\\u533a\\u7b2c63\\u8857\\u9053\\u7b2c939\\u53f7","contact_name":"Rafael Rogahn","contact_phone":"(210) 836-2061 x97375"}', 492.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-30 00:37:34', '2020-07-30 00:37:34'),
	(12, '20200730004026889217', 24, '{"address":"\\u6c5f\\u82cf\\u7701\\u5357\\u4eac\\u5e02\\u6d66\\u53e3\\u533a\\u7b2c40\\u8857\\u9053\\u7b2c539\\u53f7","contact_name":"Prof. Gretchen Towne","contact_phone":"15244866654"}', 492.00, '无备注', NULL, NULL, NULL, 'pending', NULL, 0, 0, 'pending', NULL, NULL, '2020-07-30 00:40:26', '2020-07-30 00:40:27');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- 导出  表 sixue.order_items 结构
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单',
  `product_id` bigint(20) unsigned NOT NULL COMMENT '商品',
  `product_sku_id` bigint(20) unsigned NOT NULL COMMENT '单品',
  `amount` int(10) unsigned NOT NULL COMMENT '数量',
  `price` decimal(10,2) NOT NULL COMMENT '单价',
  `rating` int(10) unsigned DEFAULT NULL COMMENT '评分',
  `review` text COLLATE utf8mb4_unicode_ci COMMENT '评价',
  `review_at` timestamp NULL DEFAULT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_product_sku_id_foreign` (`product_sku_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_sku_id_foreign` FOREIGN KEY (`product_sku_id`) REFERENCES `product_skus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.order_items 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_sku_id`, `amount`, `price`, `rating`, `review`, `review_at`) VALUES
	(1, 3, 1, 6, 5, 123.00, NULL, NULL, NULL),
	(2, 3, 2, 1, 1, 799.00, NULL, NULL, NULL),
	(3, 3, 2, 2, 1, 1100.00, NULL, NULL, NULL),
	(4, 4, 1, 7, 1, 111.00, NULL, NULL, NULL),
	(5, 5, 1, 7, 1, 111.00, NULL, NULL, NULL),
	(6, 6, 1, 7, 2, 111.00, NULL, NULL, NULL),
	(8, 8, 1, 6, 4, 123.00, NULL, NULL, NULL),
	(9, 9, 1, 6, 4, 123.00, NULL, NULL, NULL),
	(10, 10, 1, 6, 4, 123.00, NULL, NULL, NULL),
	(11, 11, 1, 6, 4, 123.00, NULL, NULL, NULL),
	(12, 12, 1, 6, 4, 123.00, NULL, NULL, NULL);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- 导出  表 sixue.password_resets 结构
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.password_resets 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- 导出  表 sixue.products 结构
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品详情',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品封面',
  `on_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商品是否上架',
  `rating` double(8,2) NOT NULL DEFAULT '5.00' COMMENT '商品平均评分',
  `review_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品评价总数',
  `sold_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品总销量',
  `price` decimal(10,2) NOT NULL COMMENT '商品sku最低价格',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.products 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `title`, `description`, `img`, `on_sale`, `rating`, `review_count`, `sold_count`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'iphone X', '<p><br></p>', 'images/sj1.jpg', 1, 5.00, 0, 0, 18.90, '2020-07-10 03:28:06', '2020-07-14 14:41:16'),
	(2, '小米 9', '<p>价格优惠，仅此一家</p>', 'images/sj17.jpg', 1, 5.00, 0, 0, 799.00, '2020-07-10 03:30:19', '2020-07-10 06:07:24'),
	(3, '小米 9', '<p><br></p>', 'images/sj8.jpg', 1, 5.00, 0, 0, 0.00, '2020-07-12 16:54:14', '2020-07-12 16:54:14'),
	(4, '小米10', '<p><br></p>', 'images/sj9.jpg', 1, 5.00, 0, 0, 0.00, '2020-07-12 16:55:10', '2020-07-12 16:55:10');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- 导出  表 sixue.product_skus 结构
CREATE TABLE IF NOT EXISTS `product_skus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sku名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sku描述',
  `price` decimal(10,2) NOT NULL COMMENT 'sku价格',
  `stock` int(10) unsigned NOT NULL COMMENT 'sku库存',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'sku所属商品id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_skus_product_id_foreign` (`product_id`),
  CONSTRAINT `product_skus_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.product_skus 的数据：~7 rows (大约)
/*!40000 ALTER TABLE `product_skus` DISABLE KEYS */;
INSERT INTO `product_skus` (`id`, `title`, `description`, `price`, `stock`, `product_id`, `created_at`, `updated_at`) VALUES
	(1, '灰色64G', '小米 9 灰色64G', 799.00, 99, 2, '2020-07-10 03:30:19', '2020-07-27 07:19:40'),
	(2, '灰色 256G', '小米 9 灰色256G', 1100.00, 199, 2, '2020-07-10 03:30:19', '2020-07-27 07:19:40'),
	(3, '月慕白', '颜色', 2990.00, 232, 1, '2020-07-14 14:41:16', '2020-07-14 14:41:16'),
	(4, '星幻紫', '颜色', 1100.00, 55, 1, '2020-07-14 14:41:16', '2020-07-14 14:41:16'),
	(5, '天际蓝', '颜色', 18.90, 1000, 1, '2020-07-14 14:41:16', '2020-07-14 14:41:16'),
	(6, '太空灰', '颜色', 123.00, 98, 1, '2020-07-14 14:41:16', '2020-07-30 00:40:26'),
	(7, '128G', '容量', 111.00, 98, 1, '2020-07-14 14:41:16', '2020-07-28 16:03:11');
/*!40000 ALTER TABLE `product_skus` ENABLE KEYS */;

-- 导出  表 sixue.users 结构
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.users 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `introduction`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(24, NULL, NULL, '18586259405', NULL, NULL, NULL, '$2y$10$rc2yKd/bvoxXT2k887X4xOUMDGMaCu55TZhWBCxeGbqAANDqnJZeq', NULL, '2020-06-28 06:33:44', '2020-06-28 06:33:44'),
	(25, NULL, NULL, '15326062575', NULL, NULL, NULL, '$2y$10$4an0JDkbtKhc49LBDqVZNemOX01Q2pjR.Q76aeadLBFyJ7K3gEDda', NULL, '2020-06-28 06:54:01', '2020-06-28 06:54:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- 导出  表 sixue.user_addresses 结构
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收件人姓名',
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收件人电话',
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址省',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址市',
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址区',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址详细地址',
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收货地址标签，家庭/公司。。',
  `last_used_at` datetime DEFAULT NULL COMMENT '最后使用时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.user_addresses 的数据：~18 rows (大约)
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` (`id`, `user_id`, `contact_name`, `contact_phone`, `province`, `city`, `district`, `address`, `tag`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(7, 24, 'Prof. Gretchen Towne', '15244866654', '江苏省', '南京市', '浦口区', '第40街道第539号', '公司', '2006-11-21 18:23:43', '2020-07-06 02:36:10', '2020-07-08 07:15:48'),
	(9, 24, 'Rafael Rogahn', '(210) 836-2061 x97375', '河北省', '石家庄市', '长安区', '第63街道第939号', '公司', '1994-08-04 12:02:54', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(11, 25, 'Ottis Macejkovic', '637.400.8602 x74840', '江苏省', '南京市', '浦口区', '第95街道第422号', '公司', '1997-07-11 19:41:31', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(12, 25, 'Adelia Witting', '453-546-2597', '河北省', '石家庄市', '长安区', '第46街道第524号', '公司', '1995-11-27 22:48:50', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(13, 24, 'Prof. Aiden Kohler', '1-614-619-3958 x458', '北京市', '市辖区', '东城区', '第14街道第132号', '公司', '2015-03-29 22:19:21', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(14, 24, 'Madison Mitchell', '860.226.5554', '广东省', '深圳市', '福田区', '第76街道第407号', '公司', '1975-04-24 06:28:00', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(15, 24, 'Mr. Herbert Bogisich', '(736) 717-1389', '江苏省', '苏州市', '相城区', '第97街道第338号', '公司', '1996-12-04 14:28:04', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(16, 25, 'Green Howe Sr.', '+15687022095', '江苏省', '南京市', '浦口区', '第2街道第975号', '公司', '1997-12-27 13:04:25', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(17, 24, '马云', '16688886666', '广东省', '深圳市', '福田区', '第69街道第346号', '公司', '2000-02-08 02:55:05', '2020-07-06 02:36:10', '2020-07-08 05:11:06'),
	(18, 25, 'Maximus Anderson', '608.521.3967 x096', '广东省', '深圳市', '福田区', '第29街道第18号', '公司', '1988-10-26 18:54:46', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(19, 25, 'Ariane Funk DVM', '350.890.8037', '河北省', '石家庄市', '长安区', '第11街道第892号', '公司', '2001-11-13 11:45:30', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(20, 25, 'Micheal Wunsch', '1-696-793-6070 x543', '广东省', '深圳市', '福田区', '第51街道第253号', '公司', '2012-04-10 00:56:11', '2020-07-06 02:36:10', '2020-07-06 02:36:10'),
	(21, 24, '特朗普', '13352545425', '北京市', '市辖区', '朝阳区', '白宫', '别墅', NULL, '2020-07-07 14:58:39', '2020-07-08 05:11:37'),
	(22, 24, '刘德华', '15544856675', '天津市', '市辖区', '河西区', '河西大街，香园家园6号楼 2单元3楼东户', '家庭', NULL, '2020-07-07 15:01:44', '2020-07-07 15:01:44'),
	(23, 24, '小红', '18866668888', '北京市', '市辖区', '西城区', '水帘洞 火锅山', '家庭', NULL, '2020-07-07 15:03:14', '2020-07-08 05:10:00'),
	(24, 24, '小明', '15844686684', '北京市', '市辖区', '西城区', '大学东路36号', '学校', NULL, '2020-07-08 04:16:00', '2020-07-08 04:16:00'),
	(25, 24, '测试', '15625525525', '河北省', '秦皇岛市', '海港区', '范德萨', '范德萨', NULL, '2020-07-08 05:19:05', '2020-07-08 05:19:05'),
	(26, 24, '脑瓜疼', '13244586658', '天津市', '市辖区', '河东区', '灵霄宝殿', '别墅', NULL, '2020-07-08 07:15:22', '2020-07-08 07:15:22'),
	(27, 24, '范德萨', '范德萨', '内蒙古自治区', '包头市', '东河区', '范德萨', '范德萨', NULL, '2020-07-08 07:16:10', '2020-07-08 07:16:10');
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;

-- 导出  表 sixue.user_favorite_products 结构
CREATE TABLE IF NOT EXISTS `user_favorite_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '关联用户id',
  `product_id` bigint(20) unsigned NOT NULL COMMENT '关联商品id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_favorite_products_user_id_foreign` (`user_id`),
  KEY `user_favorite_products_product_id_foreign` (`product_id`),
  CONSTRAINT `user_favorite_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_favorite_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  sixue.user_favorite_products 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `user_favorite_products` DISABLE KEYS */;
INSERT INTO `user_favorite_products` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
	(4, 24, 2, '2020-07-16 10:04:04', '2020-07-16 10:04:04');
/*!40000 ALTER TABLE `user_favorite_products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
