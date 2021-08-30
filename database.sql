/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : chanlemomo

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 03/05/2021 22:09:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts_momo
-- ----------------------------
DROP TABLE IF EXISTS `accounts_momo`;
CREATE TABLE `accounts_momo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sdt` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `max` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_vietnamese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts_momo
-- ----------------------------

-- ----------------------------
-- Table structure for bang_xep_hang
-- ----------------------------
DROP TABLE IF EXISTS `bang_xep_hang`;
CREATE TABLE `bang_xep_hang`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sdt` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_vietnamese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bang_xep_hang
-- ----------------------------
INSERT INTO `bang_xep_hang` VALUES (1, '0947838128', 1100000);
INSERT INTO `bang_xep_hang` VALUES (2, '0947838122', 2000);

-- ----------------------------
-- Table structure for momo
-- ----------------------------
DROP TABLE IF EXISTS `momo`;
CREATE TABLE `momo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tranId` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL,
  `partnerId` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL,
  `partnerName` text CHARACTER SET utf16 COLLATE utf16_vietnamese_ci NULL,
  `amount` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL,
  `gettime` datetime(0) NULL DEFAULT NULL,
  `status` varchar(32) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT 'xuly',
  `time` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `paid` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of momo
-- ----------------------------

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `value` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_vietnamese_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES (54, 'token-momo', '');
INSERT INTO `options` VALUES (55, 'chiet-khau-win', '10');
INSERT INTO `options` VALUES (56, 'password-momo', '');
INSERT INTO `options` VALUES (57, 'min-chan-le', '1000');
INSERT INTO `options` VALUES (58, 'max-chan-le', '100000');
INSERT INTO `options` VALUES (59, 'title', 'CHANLEMOMO.CLUB');
INSERT INTO `options` VALUES (60, 'favicon', 'https://i.imgur.com/g1ddU7w.png');
INSERT INTO `options` VALUES (61, 'status_demo', 'OFF');
INSERT INTO `options` VALUES (62, 'sdt-momo', '0947838128');
INSERT INTO `options` VALUES (63, 'name-momo', 'NGUYEN TAN THANH');
INSERT INTO `options` VALUES (64, 'description', 'Hệ thống chơi chẵn lẻ MOMO tự động');
INSERT INTO `options` VALUES (65, 'keywords', '');
INSERT INTO `options` VALUES (66, 'logo', 'https://i.imgur.com/g1ddU7w.png');
INSERT INTO `options` VALUES (67, 'image', '');
INSERT INTO `options` VALUES (68, 'thong-bao', '');
INSERT INTO `options` VALUES (69, 'status', 'ON');
INSERT INTO `options` VALUES (71, 'luu-y-chan-le', '<p><b>Lưu ý:</b></p><ul><li>Hệ thống sẽ lấy số cuối của mã giao dịch để làm kết quả chẵn hoặc lẻ</li><li>Nếu số cuối mã giao dịch là: 0, 2, 4, 6, 8 thì kết quả là chẵn (C)</li><li>Nếu số cuối mã giao dịch là: 1, 3, 5, 7, 9 thì kết quả là lẻ (L)</li><li>Hệ thống sẽ tự động hoàn tiền về tài khoản MOMO quý khách nếu mức cược không hợp lệ.</li><li>Bạn sẽ nhận được 180% số tiền đặt cược nếu chiến thắng, trả thưởng tự động về ví MOMO quý khách.</li></ul>');
INSERT INTO `options` VALUES (72, 'views', '1699');
INSERT INTO `options` VALUES (73, 'show_statistics', 'ON');
INSERT INTO `options` VALUES (74, 'script_live_chat', '');
INSERT INTO `options` VALUES (75, 'status_hoan_tien_chan_le', 'OFF');
INSERT INTO `options` VALUES (76, 'show_top', 'ON');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `money` int NOT NULL DEFAULT 0,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `banned` int NOT NULL DEFAULT 0,
  `createdate` datetime(0) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `daily` int NULL DEFAULT 0,
  `otp` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `chietkhau` float NULL DEFAULT 0,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `total_money` int NOT NULL DEFAULT 0,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `used_money` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_vietnamese_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'ZEgeLCYXQVyswWDankcJTbihxumRKofdPMABGzOpqUtHajrNvFIlS', 1000000, 'admin', 0, '2021-01-20 08:38:05', 'ntt2001811@gmail.com', '', 0, '', NULL, 0, NULL, 2000000, '0947838128', 'Nguyễn Tấn Thành', 60000);

SET FOREIGN_KEY_CHECKS = 1;
