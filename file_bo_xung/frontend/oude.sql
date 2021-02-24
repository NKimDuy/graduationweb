-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.22 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for new_oude
CREATE DATABASE IF NOT EXISTS `new_oude` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `new_oude`;

-- Dumping structure for table new_oude.ho_so_sinh_vien
DROP TABLE IF EXISTS `ho_so_sinh_vien`;
CREATE TABLE IF NOT EXISTS `ho_so_sinh_vien` (
  `mssv` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã số sinh viên',
  `id_dan_toc` int DEFAULT NULL COMMENT 'id dân tộc',
  `id_noi_sinh` int DEFAULT NULL COMMENT 'id nơi sinh',
  `id_quoc_tich` int DEFAULT NULL COMMENT 'id quốc tịch',
  `id_dvlk` int DEFAULT NULL COMMENT 'id đơn vị liên kết',
  `id_nganh` int DEFAULT NULL COMMENT 'id ngành',
  `id_htdt` int DEFAULT NULL COMMENT 'id hình thức đào tạo',
  PRIMARY KEY (`mssv`),
  CONSTRAINT `ho_so_sinh_vien_ibfk_1` FOREIGN KEY (`mssv`) REFERENCES `sinh_vien` (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table new_oude.ho_so_sinh_vien: ~0 rows (approximately)
/*!40000 ALTER TABLE `ho_so_sinh_vien` DISABLE KEYS */;
/*!40000 ALTER TABLE `ho_so_sinh_vien` ENABLE KEYS */;

-- Dumping structure for table new_oude.sinh_vien
DROP TABLE IF EXISTS `sinh_vien`;
CREATE TABLE IF NOT EXISTS `sinh_vien` (
  `mssv` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã số sinh viên',
  `ho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'họ có dấu',
  `ho_kd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'họ không dấu',
  `ten` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên có dấu',
  `ten_kd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tẻn không có dấu',
  `ngay_sinh` date DEFAULT NULL COMMENT 'ngày sinh',
  `gioi_tinh` tinyint(1) DEFAULT NULL COMMENT 'giới tính',
  PRIMARY KEY (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table new_oude.sinh_vien: ~0 rows (approximately)
/*!40000 ALTER TABLE `sinh_vien` DISABLE KEYS */;
INSERT INTO `sinh_vien` (`mssv`, `ho`, `ho_kd`, `ten`, `ten_kd`, `ngay_sinh`, `gioi_tinh`) VALUES
	('1651010030', 'nguyễn kim', 'nguyen kim', 'duy', 'duy', '1998-02-27', 1),
	('1651010163', 'Phạm Minh', 'Pham Minh', 'Viễn', 'vien', '1996-06-06', 1);
/*!40000 ALTER TABLE `sinh_vien` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
