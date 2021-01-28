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


-- Dumping database structure for graduationdb
CREATE DATABASE IF NOT EXISTS `graduationdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `graduationdb`;

-- Dumping structure for table graduationdb.tb_dan_toc
CREATE TABLE IF NOT EXISTS `tb_dan_toc` (
  `ma_dt` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã dân tộc',
  `ten_dan_toc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên dân tộc',
  PRIMARY KEY (`ma_dt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_dan_toc: ~61 rows (approximately)
/*!40000 ALTER TABLE `tb_dan_toc` DISABLE KEYS */;
INSERT INTO `tb_dan_toc` (`ma_dt`, `ten_dan_toc`) VALUES
	('0', 'Khác Kinh'),
	('1', 'Kinh'),
	('10', 'Ngái'),
	('11', 'Sán Chay'),
	('12', 'Chăm'),
	('13', 'Sán Diu'),
	('14', 'Vân Kiều'),
	('15', 'Thổ'),
	('16', 'Giáy'),
	('17', 'Cơ Tu'),
	('18', 'Khơ Mú'),
	('19', 'Ta Ôi'),
	('2', 'Tày'),
	('20', 'Kháng'),
	('21', 'Lào'),
	('22', 'La Chí'),
	('23', 'Phù Lá'),
	('24', 'Lô Lô'),
	('25', 'Pà Thẻn'),
	('26', 'Cơ Lao'),
	('27', 'Bố Y'),
	('28', 'Si La'),
	('29', 'Pu Péo'),
	('3', 'Thái'),
	('30', 'Khác'),
	('31', 'Gia Rai'),
	('32', 'Ê Đê'),
	('33', 'Ba Na'),
	('34', 'Xơ Đăng'),
	('35', 'Cơ Ho'),
	('36', 'Hrê'),
	('37', 'Mnông'),
	('38', 'Jrai'),
	('39', 'Xtiêng'),
	('4', 'Hoa'),
	('40', 'Giê Triêng'),
	('41', 'Mạ'),
	('42', 'Khơ Mú'),
	('43', 'Co'),
	('44', 'Chơ Ro'),
	('45', 'Xinh Mun'),
	('46', 'Hà Nhi'),
	('47', 'Chu Ru'),
	('48', 'La Ha'),
	('49', 'La Hủ'),
	('5', 'Khmer'),
	('50', 'Lự'),
	('51', 'Chứt'),
	('52', 'Mảng'),
	('53', 'Cống'),
	('54', 'Brâu'),
	('55', 'Ơ Đu'),
	('56', 'Rơ Măm'),
	('57', 'Cao Lan'),
	('58', 'Ngạn'),
	('59', 'Dáy'),
	('6', 'Mường'),
	('60', 'Nước ngoài'),
	('7', 'Nùng'),
	('8', 'Hmông'),
	('9', 'Dao');
/*!40000 ALTER TABLE `tb_dan_toc` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_don_vi_lk
CREATE TABLE IF NOT EXISTS `tb_don_vi_lk` (
  `ma_dvlk` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã đơn vị liên kết',
  `ten_dvlk` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên đơn vị liên kết',
  PRIMARY KEY (`ma_dvlk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_don_vi_lk: ~132 rows (approximately)
/*!40000 ALTER TABLE `tb_don_vi_lk` DISABLE KEYS */;
INSERT INTO `tb_don_vi_lk` (`ma_dvlk`, `ten_dvlk`) VALUES
	('_K', 'Mã địa phương tạm dùng bảo trì dữ liệu'),
	('_T', 'Đại học Mở Tp.HCM - VLVH'),
	('AA', ''),
	('AG', 'TT GDTX An Giang'),
	('AP', 'An Phú - GDTX An Giang'),
	('B0', 'Bình Long-Bình Phước'),
	('BA', 'Ban Chỉ Huy Quân sự Huyện Bình Chánh'),
	('BC', 'Trường trung cấp nghề Trần Đại Nghĩa'),
	('BD', 'TT GDTX Bình Định'),
	('BE', 'TT GDNN - GDTX Huyện Nhà Bè'),
	('BH', 'Tr. TC KTKT Số 2 Biên Hòa'),
	('BI', 'Ban Chỉ Huy Quân sự Quận Bình Tân'),
	('BL', 'TT GDTX Bạc Liêu'),
	('BO', 'TT GDTX Bình Long - BPhước'),
	('BP', 'TT GDTX Bình Phước'),
	('BR', 'Trường TC KT Kỹ thuật Công Đoàn BR VT'),
	('BT', 'TT GDTX Bến Tre'),
	('BV', 'TT BDCT Quận Gò Vấp'),
	('CC', 'Trường trung cấp nghề Củ Chi'),
	('CD', 'Châu Đốc - GDTX An Giang'),
	('CG', 'TT KT TH HN Cần Giờ'),
	('CH', 'TT GDTX Chơn Thành-BPhước'),
	('CL', 'Trường CĐCĐ Đồng Tháp'),
	('CM', 'Trường CĐCĐ Cà Mau'),
	('CN', 'TT GDNN - GDTX Q.Thốt Nốt'),
	('CR', 'TT GDTX Khánh Hòa - Cam ranh'),
	('CT', 'Trường ĐH KT Công Nghệ Cần Thơ'),
	('CV', 'TT GDTX và HN Côn Đảo'),
	('DA', 'Trường Trung cấp Nghề Dĩ An'),
	('DB', 'Trường Đại Học Bạc Liêu'),
	('DD', 'TT GDTX Đắk Nông - Tuy Đức'),
	('DG', 'TT GDTX Đắk Nông'),
	('DH', 'Cao đẳng Nghề long An ( Cơ sở Đức Hòa )'),
	('DK', 'TT GDTX ĐAK LAK'),
	('DM', 'TT GDTX Đắk Nông - Đăk Mil'),
	('DN', 'TT NN-TH Phan Chu Trinh'),
	('DR', 'TT GDTX Đắk Nông - Đăk R\'Lấp'),
	('DT', 'TT BD CT -TP Cao Lãnh'),
	('EA', 'CTy Cao Su EaH\'Leo'),
	('GC', 'TT TH KT TH HN Cần Giờ'),
	('GD', 'TT GDTX Gia Định'),
	('GI', 'TT GDNN & GDTX H. Ia Grai - Gia Lai'),
	('GL', 'TT GDTX Gia Lai'),
	('GM', 'TT GDNN -GDTX Huyện Mang Yang - Gia Lai'),
	('GN', 'TT GDTX Đắk Nông - Gia Nghĩa'),
	('GO', 'TT GDTX Huyện Đăk Pơ - Gia Lai'),
	('GP', 'TT GDTX Huyện Chư Păh - Gia Lai'),
	('GQ', 'Gò Quao-CĐCĐ Kiên Giang'),
	('GR', 'TT GDTX Bạc Liêu-Giá Rai'),
	('GS', 'TT GDTX Huyện Chư Sê - Gia Lai'),
	('GU', 'TT GDNN-GDTX Chư Pưh - Gia Lai'),
	('GV', 'Quận Đoàn Gò Vấp'),
	('HB', 'TT GDTX Bạc Liêu-Hồng Dân'),
	('HD', 'TT GDTX Bạc Liêu-Đông Hải'),
	('HG', 'TT GDTX Hậu Giang'),
	('HM', 'Trường Trung cấp Bách nghệ TP.HCM'),
	('HN', 'Trường CĐ CĐ Hà Nội'),
	('HU', 'Hội Liên Hiệp Phụ Nữ TPHCM'),
	('HV', 'Học viện chính trị khu vực 2'),
	('HX', 'Liên minh Hợp tác xã Tp.Hồ Chí Minh'),
	('KG', 'Trường CĐ Kiên Giang'),
	('KH', 'TT GDTX Khánh Hòa'),
	('LA', 'TT GDTX Long An'),
	('LB', 'Cơ sở 2 Long Bình'),
	('LD', 'Trường Chính trị Lâm Đồng'),
	('LG', 'TT GDTX - GDNN Tx. Lagi - Bình Thuận'),
	('LH', 'TT GDTX H. Đức Hòa - Long An'),
	('LN', 'TT GDTX Lộc Ninh-BPhước'),
	('MC', 'Chợ Mới - GDTX An Giang'),
	('MD', 'TT BD CT H. Đầm Dơi - Cà mau'),
	('NB', 'TT GDTX Tỉnh Ninh Bình'),
	('NH', 'Cơ Sở 5 - Ninh Hoà'),
	('NT', 'Tốt nghiệp'),
	('NT001', ''),
	('NU', 'Phân hiệu Học viện Phụ Nữ Việt Nam'),
	('NV', 'TT BD CB CC-VC Vũng Tàu'),
	('NX', 'TT GDTX Thanh Niên Xung Phong'),
	('OM', 'TT GDTX Quận Ô Môn'),
	('PB', 'TT GDTX Bạc Liêu-Phước Long'),
	('PD', 'TT GD XHLĐ Phú Đức'),
	('PG', 'TT GDTX Huyện Cần Giờ'),
	('PL', 'TT GDTX Phước Long-BPhước'),
	('PN', 'TT BDCT Q.Phú Nhuận'),
	('PQ', 'Phú Quốc-CĐ Kiên Giang'),
	('PT', 'TT BDCT Quận Tân Phú'),
	('PV', 'Phú Văn - GDTX Gia Định'),
	('PY', 'TT GDTX Phú Yên'),
	('Q1', 'TT BDCT Quận 1'),
	('Q2', 'Trường CĐN Thủ Thiêm - TPHCM'),
	('Q4', 'Ban Chỉ Huy Quân sự Quận 4'),
	('Q5', 'TT BDCT Quận 5'),
	('Q6', 'TT GDNN - GDTX Quận 6'),
	('Q8', 'TT BDCT Quận 8'),
	('Q9', 'Vĩnh Long - QK9'),
	('QH', 'Ban Chỉ Huy Quân sự Huyện Hóc Môn'),
	('SB', 'Cơ Sở 3 Bình Dương'),
	('SD', 'Trường CT Đồng Tháp'),
	('SG', 'Trường TC DL và KS Sài Gòn Tourist'),
	('T1', 'Trường ĐT-GQVL Số 1'),
	('T2', 'Trường ĐT-GQVL Số 2'),
	('T3', 'Trường ĐT-GQVL Số 3'),
	('T6', 'Trường ĐT-GQVL Số 6'),
	('TA', 'TT DN H.Tánh Linh - B.Thuận'),
	('TB', 'TT BDCT Quận Tân Bình'),
	('TC', 'Tân Châu - GDTX An Giang'),
	('TD', 'Công Ty Cao Su Dau Tieng'),
	('TE', 'Trường Trung cấp Tây Nguyên'),
	('TG', 'TT GDTX Tiền Giang'),
	('TH', 'Tr.CĐCĐ Bình Thuận'),
	('TL', 'TT GDTX Q.Thới Lai - Cần Thơ'),
	('TM', 'Cao đẳng Nghề long An ( Cơ sở Đồng Tháp Mười )'),
	('TN', 'TT GDTX Tây Ninh'),
	('TP', 'Trường Đại Học Mở TP.HCM'),
	('TR', 'TT GDTX Nhơn Trạch - ĐNai'),
	('TT', 'TT GDTX Tôn Đức Thắng, TP.HCM'),
	('TU', 'Trường ĐT-GQVL Số 4'),
	('TV', 'Trường ĐH Trà Vinh'),
	('TW', 'TT GDTX Quận 12'),
	('UB', 'UBDS BM & TE'),
	('UT', 'Trường TC Nghề Tân Uyên'),
	('VD', 'Trường Cao đẳng Viễn Đông'),
	('VL', 'Trường CĐCĐ Vĩnh Long'),
	('VM', 'Trường Cao đẳng Việt - Mỹ'),
	('VT', 'TT GDTX Vũng Tàu'),
	('WT', 'Trường DN Quận 12'),
	('XL', 'TT Dạy Nghề H. Xuân Lộc (ĐN)'),
	('XN', 'Liên Minh HTX Đồng Nai'),
	('XO', 'TT DN H.Thống Nhất-ĐNai'),
	('XP', 'Trường ĐT Và GQVL Số 5'),
	('XT', 'Liên Minh HTX Đồng Tháp'),
	('YB', 'TT ĐTBDCBDS-Bộ Y Tế (B.Tre)'),
	('YK', 'TT ĐTBDCBDS-Bộ Y Tế (K.Giang)'),
	('YT', 'TT ĐTBDCB Dân Số - Y Tế');
/*!40000 ALTER TABLE `tb_don_vi_lk` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_hk_tot_nghiep
CREATE TABLE IF NOT EXISTS `tb_hk_tot_nghiep` (
  `ma_hk` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã học kì',
  `chi_tiet_hk` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'chi tiết học kì',
  PRIMARY KEY (`ma_hk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_hk_tot_nghiep: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_hk_tot_nghiep` DISABLE KEYS */;
INSERT INTO `tb_hk_tot_nghiep` (`ma_hk`, `chi_tiet_hk`) VALUES
	('tn_193', 'Năm 2020 - đợt 1'),
	('tn_194', 'Năm 2020 - đợt 2');
/*!40000 ALTER TABLE `tb_hk_tot_nghiep` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_ho_so_sv
CREATE TABLE IF NOT EXISTS `tb_ho_so_sv` (
  `mssv` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã số sinh viên',
  `ma_dan_toc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã dân tộc',
  `ma_noi_sinh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã nơi sinh',
  `ma_quoc_tich` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã quốc tịch',
  `ma_dvlk` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã đơn vị liên kết',
  `ma_nganh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã ngành',
  `ma_htdt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã hình thức đào tạo',
  PRIMARY KEY (`mssv`),
  KEY `ma_dan_toc` (`ma_dan_toc`),
  KEY `ma_noi_sinh` (`ma_noi_sinh`),
  KEY `ma_quoc_tich` (`ma_quoc_tich`),
  KEY `ma_dvlk` (`ma_dvlk`),
  KEY `ma_nganh` (`ma_nganh`),
  KEY `ma_htdt` (`ma_htdt`),
  CONSTRAINT `tb_ho_so_sv_ibfk_1` FOREIGN KEY (`mssv`) REFERENCES `tb_sinh_vien` (`mssv`),
  CONSTRAINT `tb_ho_so_sv_ibfk_2` FOREIGN KEY (`ma_dan_toc`) REFERENCES `tb_dan_toc` (`ma_dt`),
  CONSTRAINT `tb_ho_so_sv_ibfk_3` FOREIGN KEY (`ma_noi_sinh`) REFERENCES `tb_tinh_thanh` (`ma_tinh_thanh`),
  CONSTRAINT `tb_ho_so_sv_ibfk_4` FOREIGN KEY (`ma_quoc_tich`) REFERENCES `tb_quoc_tich` (`ma_qt`),
  CONSTRAINT `tb_ho_so_sv_ibfk_5` FOREIGN KEY (`ma_dvlk`) REFERENCES `tb_don_vi_lk` (`ma_dvlk`),
  CONSTRAINT `tb_ho_so_sv_ibfk_6` FOREIGN KEY (`ma_nganh`) REFERENCES `tb_nganh` (`ma_nganh`),
  CONSTRAINT `tb_ho_so_sv_ibfk_7` FOREIGN KEY (`ma_htdt`) REFERENCES `tb_ht_dao_tao` (`ma_hinh_thuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_ho_so_sv: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_ho_so_sv` DISABLE KEYS */;
INSERT INTO `tb_ho_so_sv` (`mssv`, `ma_dan_toc`, `ma_noi_sinh`, `ma_quoc_tich`, `ma_dvlk`, `ma_nganh`, `ma_htdt`) VALUES
	('1651010030', '1', '1', 'VN', 'VT', '32', '2'),
	('32163009VT2', '1', '1', 'VN', 'VT', '32', '2'),
	('32163013VT2', '1', '2', 'VN', 'VT', '32', '2');
/*!40000 ALTER TABLE `tb_ho_so_sv` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_ht_dao_tao
CREATE TABLE IF NOT EXISTS `tb_ht_dao_tao` (
  `ma_hinh_thuc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ten_hinh_thuc_ex` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên hình thức đào tạo',
  `ten_hinh_thuc_at` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ma_hinh_thuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_ht_dao_tao: ~14 rows (approximately)
/*!40000 ALTER TABLE `tb_ht_dao_tao` DISABLE KEYS */;
INSERT INTO `tb_ht_dao_tao` (`ma_hinh_thuc`, `ten_hinh_thuc_ex`, `ten_hinh_thuc_at`) VALUES
	('1', 'Học từ xa', 'Đào tạo từ xa'),
	('2', 'Học từ xa (Bằng thứ hai)', 'Đào tạo từ xa - Văn bằng 2'),
	('3', 'Vừa làm vừa học', 'Vừa làm vừa học'),
	('4', 'Vừa làm vừa học (Bằng thứ hai)', 'Vừa làm vừa học - Văn bằng 2'),
	('5', 'Học từ xa', 'Đào tạo từ xa (LT từ CĐ lên ĐH)'),
	('6', 'Học từ xa (Văn bằng 2 chính quy)', ''),
	('7', 'Học từ xa (Chính qui Đại học)', ''),
	('8', 'Học từ xa (Vừa làm vừa học)', 'Đào tạo từ xa (VLVH chuyển qua)'),
	('9', 'Vừa làm vừa học (Liên thông từ Cao đẳng)', 'Vừa làm vừa học (LT từ CĐ lên ĐH)'),
	('9T', 'Vừa làm vừa học (Liên thông từ Trung cấp)', ''),
	('E1', 'Học từ xa', ''),
	('E2', 'Học từ xa', ''),
	('E5', 'Học từ xa', ''),
	('SD', 'Học từ xa', '');
/*!40000 ALTER TABLE `tb_ht_dao_tao` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_nganh
CREATE TABLE IF NOT EXISTS `tb_nganh` (
  `ma_nganh` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã ngành',
  `ten_nganh` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên ngành',
  PRIMARY KEY (`ma_nganh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_nganh: ~73 rows (approximately)
/*!40000 ALTER TABLE `tb_nganh` DISABLE KEYS */;
INSERT INTO `tb_nganh` (`ma_nganh`, `ten_nganh`) VALUES
	('11', 'Khoa học máy tính'),
	('12', 'Công nghiệp'),
	('13', 'Công nghệ sinh học'),
	('14', 'Khoa học máy tính chuyên ngành Mạng máy tính'),
	('15', 'Khoa học máy tính chuyên ngành Cơ sở dữ liệu'),
	('16', 'Khoa học máy tính chuyên ngành Đồ họa máy tính'),
	('17', 'Hệ thống thông tin quản lý'),
	('18', 'Công nghệ sinh học CN Công nghệ thực phẩm'),
	('19', 'Công nghệ sinh học CN Quản lý môi trường'),
	('21', 'Công Nghệ KT CT Xây Dựng chuyên ngành XD dân dụng & CN'),
	('22', ''),
	('23', 'Quản lý xây dựng'),
	('24', 'Xây dựng chuyên ngành KT Đô thị & Môi trường'),
	('31', 'Kinh tế chuyên ngành Kinh tế Luật'),
	('32', 'Luật Kinh tế'),
	('33', 'Kinh tế'),
	('34', 'Luật'),
	('35', 'Kinh tế chuyên ngành Quản lý công'),
	('41', 'Quản trị kinh doanh'),
	('42', 'Quản trị kinh doanh chuyên ngành Luật Kinh Doanh'),
	('422', 'Quản Trị KD-Chuyên Ngành:Luật KD'),
	('429', 'Quản Trị KD-Chuyên Ngành: Luật KD'),
	('43', 'Quản trị kinh doanh chuyên ngành Quản trị nhân lực'),
	('431', 'Quản trị nhân lực'),
	('44', 'Quản trị kinh doanh chuyên ngành Quản trị Marketing'),
	('45', 'Quản trị kinh doanh chuyên ngành Kinh Doanh Quốc Tế'),
	('451', 'Kinh doanh quốc tế'),
	('46', 'Quản trị kinh doanh chuyên ngành Quản Trị Vận Hành'),
	('47', 'Quản trị kinh doanh chuyên ngành Quản Trị Dịch Vụ'),
	('48', 'Quản trị kinh doanh chuyên ngành Quản trị du lịch'),
	('49', 'Quản trị kinh doanh chuyên ngành Kế toán doanh nghiệp'),
	('499', 'Quản Trị KD-Chuyên Ngành: Kế Toán'),
	('51', 'Đông Nam á học'),
	('511', 'Đông Nam á Học'),
	('52', 'Đông Nam á học'),
	('61', 'Xã hội học'),
	('62', 'Công tác xã hội'),
	('63', 'Công tác xã hội chuyên ngành Công tác xã hội - Luật'),
	('64', 'Xã hội học chuyên ngành Giới và Phát Triển'),
	('65', 'Xã hội học chuyên ngành Công tác XH và Phát Triển Cộng Đồng'),
	('66', 'Xã hội học chuyên ngành XH học tổ chức và quản lý nhân sự'),
	('70', 'Ngôn ngữ Anh'),
	('71', 'Ngôn ngữ Anh chuyên ngành Phương Pháp Giảng Dạy'),
	('711', 'Tiếng Anh'),
	('72', 'Ngôn ngữ Anh chuyên ngành Biên Phiên Dịch TMDL'),
	('73', 'Ngôn ngữ Anh chuyên ngành Tiếng Anh Thương Mại'),
	('74', 'Ngôn ngữ Nhật'),
	('75', 'Ngôn ngữ Trung Quốc'),
	('76', 'Ngôn ngữ Hàn Quốc'),
	('81', 'Kế toán'),
	('82', 'Kế toán chuyên ngành Kiểm toán'),
	('821', 'Kiểm toán'),
	('90', 'Tài chính - Ngân hàng'),
	('91', 'Tài chính - Ngân hàng'),
	('92', 'Tài chính - Ngân hàng chuyên ngành Tài chính nhà nước'),
	('93', 'Tài chính - Ngân hàng chuyên ngành Tài chính doanh nghiệp'),
	('94', 'Tài chính - Ngân hàng chuyên ngành Bảo hiểm'),
	('95', 'Tài chính - Ngân hàng chuyên ngành Tài chính'),
	('96', 'Tài chính - Ngân hàng chuyên ngành Ngân hàng'),
	('E', 'Các môn thi Đào tạo qua mạng'),
	('E32', 'Luật Kinh tế'),
	('E34', 'Luật'),
	('E41', 'Quản trị kinh doanh'),
	('E43', 'Quản trị nhân lực'),
	('E44', 'Marketing'),
	('E45', 'Kinh doanh quốc tế'),
	('E70', 'Ngôn ngữ Anh'),
	('E81', 'Kế toán'),
	('E82', 'Kiểm toán'),
	('E91', 'Tài chính - Ngân hàng'),
	('TT', 'Các môn học do Trung Tâm đào tạo trực tuyến tổ chức'),
	('TX', 'Các môn thi trả nợ (HT ĐTTX)'),
	('VL', 'Các môn học trả nợ');
/*!40000 ALTER TABLE `tb_nganh` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_quoc_tich
CREATE TABLE IF NOT EXISTS `tb_quoc_tich` (
  `ma_qt` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã quốc tịch',
  `ten_quoc_tich` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên quốc tịch',
  PRIMARY KEY (`ma_qt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_quoc_tich: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_quoc_tich` DISABLE KEYS */;
INSERT INTO `tb_quoc_tich` (`ma_qt`, `ten_quoc_tich`) VALUES
	('VN', 'Việt Nam');
/*!40000 ALTER TABLE `tb_quoc_tich` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_sinh_vien
CREATE TABLE IF NOT EXISTS `tb_sinh_vien` (
  `mssv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã số sinh viên',
  `ho` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'họ có dấu',
  `ho_kd` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'họ không dấu',
  `ten` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên có dấu',
  `ten_kd` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tẻn không có dấu',
  `ngay_sinh` date DEFAULT NULL COMMENT 'ngày sinh',
  `gioi_tinh` tinyint(1) DEFAULT NULL COMMENT 'giới tính (1: nam, 0: nữ)',
  PRIMARY KEY (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_sinh_vien: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_sinh_vien` DISABLE KEYS */;
INSERT INTO `tb_sinh_vien` (`mssv`, `ho`, `ho_kd`, `ten`, `ten_kd`, `ngay_sinh`, `gioi_tinh`) VALUES
	('1651010030', 'Nguyễn Kim', 'Nguyen Kim', 'Duy', 'Duy', '1998-02-27', 1),
	('32163009VT2', 'Trần Hữu', 'Tran Huu', 'Thọ', 'Tho', '1989-01-05', 1),
	('32163013VT2', 'Nguyễn Huỳnh Đăng', 'Nguyen Huynh Dang', 'Vương', 'Vuong', '1989-01-05', 1);
/*!40000 ALTER TABLE `tb_sinh_vien` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_sv_hk
CREATE TABLE IF NOT EXISTS `tb_sv_hk` (
  `mssv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã số sinh viên',
  `ma_hk` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã học kì',
  `diem` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'điểm',
  `xep_loai` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'xếp loại',
  `dk_tn` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT ' điều kiện tốt nghiệp',
  `giay_ks` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'giấy khai sinh',
  `bang_cap` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'bằng cấp',
  `hinh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình',
  `phiếu_dkxcb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'phiếu đăng kí xét cấp bằng',
  `ct-dt` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'chương trình đào tạo',
  PRIMARY KEY (`mssv`,`ma_hk`),
  KEY `ma_hk` (`ma_hk`),
  CONSTRAINT `tb_sv_hk_ibfk_1` FOREIGN KEY (`mssv`) REFERENCES `tb_sinh_vien` (`mssv`),
  CONSTRAINT `tb_sv_hk_ibfk_2` FOREIGN KEY (`ma_hk`) REFERENCES `tb_hk_tot_nghiep` (`ma_hk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_sv_hk: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_sv_hk` DISABLE KEYS */;
INSERT INTO `tb_sv_hk` (`mssv`, `ma_hk`, `diem`, `xep_loai`, `dk_tn`, `giay_ks`, `bang_cap`, `hinh`, `phiếu_dkxcb`, `ct-dt`) VALUES
	('1651010030', 'tn_193', '3.28', 'Giỏi', 'Đủ điều kiện', 'CHƯA HỢP LỆ', '2016 - ĐẠI HỌC', 'HỢP LỆ', 'HỢP LỆ', 'HỢP LỆ'),
	('1651010030', 'tn_194', '3.28', 'Giỏi', 'Đủ điều kiện', 'HỢP LỆ', '2016 - ĐẠI HỌC', 'HỢP LỆ', 'HỢP LỆ', 'HỢP LỆ'),
	('32163009VT2', 'tn_193', '2.45', 'Trung bình', 'Đủ điều kiện', 'HỢP LỆ', '2012 - ĐẠI HỌC', 'HỢP LỆ', 'HỢP LỆ', 'HỢP LỆ'),
	('32163013VT2', 'tn_193', '2.35', 'Trung bình', 'Đủ điều kiện', 'HỢP LỆ', '2013 - ĐẠI HỌC', 'HỢP LỆ', 'HỢP LỆ', 'HỢP LỆ');
/*!40000 ALTER TABLE `tb_sv_hk` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_tinh_thanh
CREATE TABLE IF NOT EXISTS `tb_tinh_thanh` (
  `ma_tinh_thanh` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã tỉnh thành',
  `ten_tinh_thanh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên tỉnh thành',
  `ten_tinh_thanh_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên tỉnh thành có trong file excel của anh Thi',
  PRIMARY KEY (`ma_tinh_thanh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_tinh_thanh: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_tinh_thanh` DISABLE KEYS */;
INSERT INTO `tb_tinh_thanh` (`ma_tinh_thanh`, `ten_tinh_thanh`, `ten_tinh_thanh_at`) VALUES
	('1', 'Bình Định', 'Bình Định'),
	('2', 'Phú Yên', 'Phú Yên');
/*!40000 ALTER TABLE `tb_tinh_thanh` ENABLE KEYS */;

-- Dumping structure for table graduationdb.tb_upload
CREATE TABLE IF NOT EXISTS `tb_upload` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table graduationdb.tb_upload: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_upload` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
