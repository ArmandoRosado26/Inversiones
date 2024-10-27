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

 Date: 27/10/2024 18:15:55
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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuentahabiente
-- ----------------------------
INSERT INTO `cuentahabiente` VALUES (1, 'Armando Rosado', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (2, 'Angel', '191k0040@itscarrillopuerto.edu.mx', '9878007323');
INSERT INTO `cuentahabiente` VALUES (3, 'Alberto', 'a2r5armando@gmail.com', '9878007434');
INSERT INTO `cuentahabiente` VALUES (4, 'Roger', 'ejemploe@gmail.com', '232424');
INSERT INTO `cuentahabiente` VALUES (5, 'nuevo', 'ejemploe@gmail.com', '232424323');
INSERT INTO `cuentahabiente` VALUES (6, 'Ultimo', 'ejemploe@gmail.com', '123223');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inversion
-- ----------------------------
INSERT INTO `inversion` VALUES (1, 1, 5600, 365, 336);
INSERT INTO `inversion` VALUES (2, 2, 6000, 120, 118.356);
INSERT INTO `inversion` VALUES (3, 3, 25600000, 365, 1536000);
INSERT INTO `inversion` VALUES (4, 4, 5000, 362, 297.534);
INSERT INTO `inversion` VALUES (5, 5, 5000, 365, 300);
INSERT INTO `inversion` VALUES (6, 6, 62432, 365, 3745.92);

SET FOREIGN_KEY_CHECKS = 1;
