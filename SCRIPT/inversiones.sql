/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : inversiones

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 27/10/2024 16:25:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cuentahabiente
-- ----------------------------
DROP TABLE IF EXISTS `cuentahabiente`;
CREATE TABLE `cuentahabiente`  (
  `id_cuentahabiente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_cuentahabiente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuentahabiente
-- ----------------------------
INSERT INTO `cuentahabiente` VALUES (1, 'armando', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (2, 'angel', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (3, 'xd', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (4, 'armandoasdsf', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (5, 'angelfdfweeqw', 'a2r5armando@gmail.com', '3214124');
INSERT INTO `cuentahabiente` VALUES (6, 'eadasd', 'jose.rosado@seq.edu.mx', '9878007434');
INSERT INTO `cuentahabiente` VALUES (7, 'eadasdrgadg', 'jose.rosado@seq.edu.mx', '9878007434');
INSERT INTO `cuentahabiente` VALUES (8, 'angelfdf', 'a2r5armando@gmail.com', '2342');

-- ----------------------------
-- Table structure for inversion
-- ----------------------------
DROP TABLE IF EXISTS `inversion`;
CREATE TABLE `inversion`  (
  `id_inversion` int NOT NULL AUTO_INCREMENT,
  `id_cuentahabiente` int NULL DEFAULT NULL,
  `monto` float NOT NULL,
  `plazo` int NOT NULL,
  `interes_ganado` float NULL DEFAULT NULL,
  PRIMARY KEY (`id_inversion`) USING BTREE,
  INDEX `id_cuentahabiente`(`id_cuentahabiente` ASC) USING BTREE,
  CONSTRAINT `inversion_ibfk_1` FOREIGN KEY (`id_cuentahabiente`) REFERENCES `cuentahabiente` (`id_cuentahabiente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `inversion_chk_1` CHECK (`monto` >= 5000),
  CONSTRAINT `inversion_chk_2` CHECK (`plazo` between 1 and 365)
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inversion
-- ----------------------------
INSERT INTO `inversion` VALUES (1, 1, 56789, 365, 3407.34);
INSERT INTO `inversion` VALUES (2, 2, 567893000000, 365, 34073600000);
INSERT INTO `inversion` VALUES (3, 3, 5000, 365, 300);
INSERT INTO `inversion` VALUES (4, 4, 356776, 365, 21406.6);
INSERT INTO `inversion` VALUES (5, 5, 421312, 365, 25278.7);
INSERT INTO `inversion` VALUES (6, 6, 325245, 34, 1817.81);
INSERT INTO `inversion` VALUES (7, 7, 325245, 34, 1817.81);
INSERT INTO `inversion` VALUES (8, 8, 21213100, 45, 156919);

SET FOREIGN_KEY_CHECKS = 1;
