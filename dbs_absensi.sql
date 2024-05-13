/*
 Navicat Premium Data Transfer

 Source Server         : My House
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : dbs_absensi

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 19/12/2023 08:50:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NULL DEFAULT NULL,
  `status_check` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=Tanpa Keterangan, 1=Masuk, 2=Pulang, 3= Dengan Keterangan',
  `status_attend` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=Alfa, 1=Hadir, 2=Izin, 3=Sakit',
  `date` date NULL DEFAULT NULL,
  `hour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1815 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attendance
-- ----------------------------
INSERT INTO `attendance` VALUES (1813, NULL, '1', '1', '2023-12-15', '08:16:17', '2023-12-15 21:13:28', '20000029', '2023-12-15 21:13:28', '0', NULL, NULL);
INSERT INTO `attendance` VALUES (1814, NULL, '1', '1', '2023-12-15', '08:40:38', '2023-12-15 21:37:46', '20000028', '2023-12-15 21:37:46', '0', NULL, NULL);

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES (1, '6 A', '2023-09-19 20:56:17', '2023-09-19 13:56:17');
INSERT INTO `class` VALUES (2, '6 B', '2023-09-16 01:22:13', NULL);
INSERT INTO `class` VALUES (3, '5 A', '2023-09-19 20:57:10', '2023-09-19 13:57:10');
INSERT INTO `class` VALUES (6, '5 B', '2023-09-19 20:57:04', '2023-09-19 13:57:04');

-- ----------------------------
-- Table structure for notification_log
-- ----------------------------
DROP TABLE IF EXISTS `notification_log`;
CREATE TABLE `notification_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `creted_by` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for parents
-- ----------------------------
DROP TABLE IF EXISTS `parents`;
CREATE TABLE `parents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `religion_id` int(11) NULL DEFAULT NULL,
  `born` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_birth` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tele_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parents
-- ----------------------------
INSERT INTO `parents` VALUES (5, 122, 'ORTU YUNITA', 1, 'Bogor', '2023-12-11', '2023-12-15 20:56:21', '2023-12-15 20:56:21', 'Ciherang', 'L', 791738529);

-- ----------------------------
-- Table structure for religion
-- ----------------------------
DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `religion_id` int(11) NULL DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `born` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_birth` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isconnect` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (7, 86, 1, NULL, '00000001', NULL, 'ABDUL MAULANA JAELANI', NULL, NULL, '2023-12-15 20:43:17', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (8, 87, 1, NULL, '00000002', NULL, 'AKSA MULYASARI', NULL, NULL, '2023-12-15 20:43:15', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (9, 88, 1, NULL, '00000003', NULL, 'ALDI ANDRIAN', NULL, NULL, '2023-12-15 20:42:32', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (10, 89, 1, NULL, '00000004', NULL, 'AULIA ROMADONI', NULL, NULL, '2023-12-15 20:43:12', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (11, 90, 1, NULL, '00000005', NULL, 'AZMI NURHIDAYAT', NULL, NULL, '2023-12-15 20:42:56', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (12, 91, 1, NULL, '00000006', NULL, 'INES YUDARIA', NULL, NULL, '2023-12-15 20:42:33', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (13, 92, 1, NULL, '00000007', NULL, 'KAILA NUR AULIA', NULL, NULL, '2023-12-15 20:42:55', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (14, 93, 1, NULL, '00000008', NULL, 'M NASRI AZYUMARDI', NULL, NULL, '2023-12-15 20:42:34', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (15, 94, 1, NULL, '00000009', NULL, 'MEGA MUSTIKA', NULL, NULL, '2023-12-15 20:42:54', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (16, 95, 1, NULL, '00000010', NULL, 'MOCHAMAD FAHRI', NULL, NULL, '2023-12-15 20:42:36', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (17, 96, 1, NULL, '00000011', NULL, 'MOCHAMMAD FADILAH', NULL, NULL, '2023-12-15 20:42:37', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (18, 97, 1, NULL, '00000012', NULL, 'MOH. ZIKRAN USTMAN SYABANI', NULL, NULL, '2023-12-15 20:42:38', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (19, 98, 1, NULL, '00000013', NULL, 'Morinho Hasiholan Sinaga', NULL, NULL, '2023-12-15 20:42:39', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (20, 99, 1, NULL, '00000014', NULL, 'MUHAMAD ALFAREZI', NULL, NULL, '2023-12-15 20:42:40', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (21, 100, 1, NULL, '00000015', NULL, 'MUHAMAD FAHRIZAL', NULL, NULL, '2023-12-15 20:42:41', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (22, 101, 1, NULL, '00000016', NULL, 'MUHAMAD IQBAL THYAL', NULL, NULL, '2023-12-15 20:42:41', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (23, 102, 1, NULL, '00000017', NULL, 'MUHAMAD PAHREZA PIRMANSAH', NULL, NULL, '2023-12-15 20:42:42', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (24, 103, 1, NULL, '00000018', NULL, 'MUHAMAD RAFI ALFARIZI', NULL, NULL, '2023-12-15 20:42:43', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (25, 104, 1, NULL, '00000019', NULL, 'MUHAMAD RIPKI APRIANSAH', NULL, NULL, '2023-12-15 20:42:43', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (26, 105, 1, NULL, '00000020', NULL, 'MUHAMD FIQRI MAULANA', NULL, NULL, '2023-12-15 20:42:44', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (27, 106, 1, NULL, '00000021', NULL, 'RIZQI NURALDIANSYAH', NULL, NULL, '2023-12-15 20:42:45', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (28, 107, 1, NULL, '00000022', NULL, 'SIFA AULIA ZAHRA', NULL, NULL, '2023-12-15 20:42:45', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (29, 108, 1, NULL, '00000023', NULL, 'SITI NENG SALMA', NULL, NULL, '2023-12-15 20:42:46', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (30, 109, 1, NULL, '00000024', NULL, 'SITI NURLIANA', NULL, NULL, '2023-12-15 20:42:47', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (31, 110, 1, NULL, '00000025', NULL, 'SITI SALWA ANZANIANSYAH', NULL, NULL, '2023-12-15 20:42:47', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (32, 111, 1, NULL, '00000026', NULL, 'SUSSY SEPTIANI', NULL, NULL, '2023-12-15 20:42:48', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (33, 112, 1, NULL, '00000027', NULL, 'VIRA NOPRI ANDRIYANI', NULL, NULL, '2023-12-15 20:42:50', NULL, NULL, NULL, NULL);
INSERT INTO `students` VALUES (34, 113, 1, 5, '20000028', 1, 'VIRDA AULIA NUGRAHA', 'Bogor', '2023-12-15', '2023-12-15 21:18:39', '2023-12-15 21:18:39', 'CIherang', 'L', 1);
INSERT INTO `students` VALUES (35, 114, 1, 5, '20000029', 1, 'YUNITA UTAMI', 'Bogor', '2023-12-11', '2023-12-15 21:03:16', '2023-12-15 21:03:16', 'Ciherang', 'P', 1);

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `religion_id` int(11) NULL DEFAULT NULL,
  `born` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_birth` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tele_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES (6, 13, 1, 'Wali Kelas', 'Guru 6A', 1, 'Bogor', '1996-04-12', '2023-12-11 07:35:52', 'Ciherang Satim No 22 (Samping Villa Salak) Rt 01/05, Pancawati, Caringin, Kab. Bogorss', '2023-12-06 20:46:58', 'L', 791738529);
INSERT INTO `teachers` VALUES (8, 119, 2, NULL, 'Guru 6b', 1, 'Bogor', '1996-12-04', '2023-12-15 21:22:41', 'sdsd', '2023-12-15 21:22:41', 'L', 123);
INSERT INTO `teachers` VALUES (9, 120, 3, NULL, 'Guru 5a', 1, 'Bogor', '2023-12-06', '2023-12-15 21:22:23', 're', '2023-12-15 21:22:23', 'L', NULL);
INSERT INTO `teachers` VALUES (10, 121, 6, NULL, 'Maulana Husnul', 1, 'Bogor', '2023-12-11', '2023-12-11 13:08:23', 'kp', '2023-12-11 13:08:23', 'L', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `user_type` int(255) NULL DEFAULT NULL COMMENT '0=admin,1=guru,2=murid,3=ortu,4=kepsek',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `phone_number` bigint(255) NULL DEFAULT NULL,
  `religion_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 123 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$nfXUKhlLxR7YgHgDduj.W.mxZwNwlU0QRIQ5/I4/De0NHmzv2a3CW', NULL, '2023-08-30 14:22:49', '2023-08-30 14:22:49', 0, NULL, NULL, NULL);
INSERT INTO `users` VALUES (13, 'Guru 6A', 'guru6a@gmail.com', NULL, '$2y$10$nfXUKhlLxR7YgHgDduj.W.mxZwNwlU0QRIQ5/I4/De0NHmzv2a3CW', NULL, '2023-09-18 15:53:12', '2023-12-06 20:46:58', 1, NULL, 89614731563, NULL);
INSERT INTO `users` VALUES (27, 'M Ramdani', 'rama@gmail.com', NULL, '$2y$10$k3K9ceN2Uz8zWh2gCjDEf.GMHZoGAB66q5SnA/2tIPtBaaAtB/PNu', NULL, '2023-09-22 17:33:49', '2023-09-22 17:36:22', 2, NULL, 435346345, NULL);
INSERT INTO `users` VALUES (86, 'ABDUL MAULANA JAELANI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (87, 'AKSA MULYASARI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (88, 'ALDI ANDRIAN', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (89, 'AULIA ROMADONI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (90, 'AZMI NURHIDAYAT', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (91, 'INES YUDARIA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (92, 'KAILA NUR AULIA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (93, 'M NASRI AZYUMARDI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (94, 'MEGA MUSTIKA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (95, 'MOCHAMAD FAHRI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (96, 'MOCHAMMAD FADILAH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (97, 'MOH. ZIKRAN USTMAN SYABANI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (98, 'Morinho Hasiholan Sinaga', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (99, 'MUHAMAD ALFAREZI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (100, 'MUHAMAD FAHRIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (101, 'MUHAMAD IQBAL THYAL', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (102, 'MUHAMAD PAHREZA PIRMANSAH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (103, 'MUHAMAD RAFI ALFARIZI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (104, 'MUHAMAD RIPKI APRIANSAH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (105, 'MUHAMD FIQRI MAULANA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (106, 'RIZQI NURALDIANSYAH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (107, 'SIFA AULIA ZAHRA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (108, 'SITI NENG SALMA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (109, 'SITI NURLIANA', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (110, 'SITI SALWA ANZANIANSYAH', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (111, 'SUSSY SEPTIANI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (112, 'VIRA NOPRI ANDRIYANI', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (113, 'VIRDA AULIA NUGRAHA', NULL, NULL, NULL, NULL, NULL, '2023-12-15 21:18:31', 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (114, 'YUNITA UTAMI', NULL, NULL, NULL, NULL, NULL, '2023-12-15 21:03:08', 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (116, 'KEPALA SEKOLAH', 'kepsek@gmail.com', NULL, '$10$nfXUKhlLxR7YgHgDduj.W.mxZwNwlU0QRIQ5/I4/De0NHmzv2a3CW', NULL, NULL, NULL, 4, NULL, NULL, NULL);
INSERT INTO `users` VALUES (119, 'Guru 6b', 'aullhakimww@gmail.com', NULL, '$2y$10$prh1c6QmyYKHRjLeV7LdveXyyHpwgB5syflSMZLMD9cBv56eskEay', NULL, '2023-12-06 20:43:09', '2023-12-15 21:22:41', 1, NULL, 89614731563, NULL);
INSERT INTO `users` VALUES (120, 'Guru 5a', 'admieeen@gmail.com', NULL, '$2y$10$LaoEJ/7DdYLf4IBMt/apQ.yGx7OuYocnJid9R23eluBNmC8jr2Oj2', NULL, '2023-12-06 20:47:31', '2023-12-15 21:22:23', 1, NULL, 89614731563, NULL);
INSERT INTO `users` VALUES (121, 'Maulana Husnul', 'maulana@gmail.com', NULL, '$2y$10$8IX2QGMrIxoKGuTGW8rOFuFJYc3yGMnIl3Q4iG4eBno0T/2L4UsRe', NULL, '2023-12-11 13:08:23', '2023-12-11 13:08:23', 1, NULL, 987654, NULL);
INSERT INTO `users` VALUES (122, 'ORTU YUNITA', 'ortuyunita@gmail.com', NULL, '$2y$10$f.nuMoDKy9B.XDrisOOvA.ETEZQOkdw2.U.s82Kh23pnVE3OzTvJq', NULL, '2023-12-11 13:10:25', '2023-12-15 20:56:21', 3, NULL, 89787656578, NULL);

SET FOREIGN_KEY_CHECKS = 1;
