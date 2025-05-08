-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 08, 2025 lúc 05:16 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlhssv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dang_ky_mon_hoc`
--

CREATE TABLE `dang_ky_mon_hoc` (
  `ma_dang_ky` int(11) NOT NULL,
  `ma_mon` varchar(10) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_lop` int(11) DEFAULT NULL,
  `lich_hoc_du_kien` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dang_ky_mon_hoc`
--

INSERT INTO `dang_ky_mon_hoc` (`ma_dang_ky`, `ma_mon`, `ma_sinh_vien`, `ma_lop`, `lich_hoc_du_kien`, `trang_thai`) VALUES
(57, 'BA101', 'SV001', 17, '8h30-10h30 thứ 2 ', 'Đã Duyệt'),
(58, 'CS101', 'SV001', 16, '10h35 -11h30 thứ 4', 'Đã Duyệt'),
(60, 'CS101', 'SV002', 16, '10h35 -11h30 thứ 4', 'Đã Duyệt'),
(61, 'CS103', 'SV002', NULL, '10h35 -11h30 thứ 4', 'Huỷ'),
(62, 'BA101', 'SV002', 17, '8h30-10h30 thứ 2 ', 'Đã Duyệt'),
(63, 'CS103', 'SV001', NULL, '10h35 -11h30 thứ 4', 'Huỷ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem_chi_tiet`
--

CREATE TABLE `diem_chi_tiet` (
  `ma_dct` int(11) NOT NULL,
  `ma_lop` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `lan_hoc` int(11) NOT NULL,
  `lan_thi` int(11) NOT NULL,
  `diem_chuyen_can` decimal(5,2) DEFAULT 0.00,
  `diem_giua_ky` decimal(5,2) DEFAULT 0.00,
  `diem_cuoi_ky` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diem_chi_tiet`
--

INSERT INTO `diem_chi_tiet` (`ma_dct`, `ma_lop`, `ma_sinh_vien`, `lan_hoc`, `lan_thi`, `diem_chuyen_can`, `diem_giua_ky`, `diem_cuoi_ky`) VALUES
(41, 16, 'SV001', 1, 1, 10.00, 10.00, 9.00),
(42, 16, 'SV002', 1, 2, 3.00, 1.00, 10.00),
(43, 17, 'SV001', 1, 1, NULL, NULL, NULL),
(44, 17, 'SV002', 1, 1, NULL, NULL, NULL),
(45, 16, 'SV002', 1, 1, 3.00, 1.00, 1.00);

--
-- Bẫy `diem_chi_tiet`
--
DELIMITER $$
CREATE TRIGGER `after_diem_chi_tiet_insert` AFTER INSERT ON `diem_chi_tiet` FOR EACH ROW BEGIN
    DECLARE new_diem_he_10 DOUBLE;
    DECLARE new_diem_he_4 DOUBLE;
    DECLARE new_diem_chu CHAR(2);
    DECLARE new_danh_gia VARCHAR(255);

    SET new_diem_he_10 = NEW.diem_chuyen_can * 0.1 + NEW.diem_giua_ky * 0.3 + NEW.diem_cuoi_ky * 0.6;

    -- Kiểm tra nếu diem_he_10 là NULL
    IF new_diem_he_10 IS NULL THEN
        SET new_diem_he_4 = NULL;
        SET new_diem_chu = NULL;
        SET new_danh_gia = NULL;
    ELSE
        -- Tính điểm và đánh giá nếu diem_he_10 có giá trị
        IF new_diem_he_10 >= 8.5 THEN
            SET new_diem_he_4 = 4.0;
            SET new_diem_chu = 'A';
        ELSEIF new_diem_he_10 >= 8.0 THEN
            SET new_diem_he_4 = 3.5;
            SET new_diem_chu = 'B+';
        ELSEIF new_diem_he_10 >= 7.0 THEN
            SET new_diem_he_4 = 3.0;
            SET new_diem_chu = 'B';
        ELSEIF new_diem_he_10 >= 6.0 THEN
            SET new_diem_he_4 = 2.5;
            SET new_diem_chu = 'C+';
        ELSEIF new_diem_he_10 >= 5.5 THEN
            SET new_diem_he_4 = 2.0;
            SET new_diem_chu = 'C';
        ELSEIF new_diem_he_10 >= 5.0 THEN
            SET new_diem_he_4 = 1.5;
            SET new_diem_chu = 'D+';
        ELSEIF new_diem_he_10 >= 4.0 THEN
            SET new_diem_he_4 = 1.0;
            SET new_diem_chu = 'D';
        ELSE
            SET new_diem_he_4 = 0.0;
            SET new_diem_chu = 'F';
        END IF;

        -- Đánh giá nếu diem_he_10 có giá trị
        IF new_diem_he_10 >= 4.0 THEN
            SET new_danh_gia = 'DAT';
        ELSEIF NEW.lan_thi = 2 THEN
            SET new_danh_gia = 'HOCLAI';
        ELSE
            SET new_danh_gia = 'THILAI';
        END IF;
    END IF;

    -- Chèn dữ liệu vào bảng diem_tong_hop
    INSERT INTO diem_tong_hop (ma_dct, diem_he_10, diem_he_4, diem_chu, danh_gia)
    VALUES (NEW.ma_dct, new_diem_he_10, new_diem_he_4, new_diem_chu, new_danh_gia);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_update_diem_chi_tiet` AFTER UPDATE ON `diem_chi_tiet` FOR EACH ROW BEGIN
    DECLARE diem_he_10 DECIMAL(5,2);
    DECLARE diem_he_4 DECIMAL(3,2);
    DECLARE diem_chu VARCHAR(2);
    DECLARE danh_gia VARCHAR(10);

    SET diem_he_10 = NEW.diem_chuyen_can * 0.1 + NEW.diem_giua_ky * 0.3 + NEW.diem_cuoi_ky * 0.6;

    IF diem_he_10 >= 8.5 THEN 
        SET diem_he_4 = 4.0; SET diem_chu = 'A';
    ELSEIF diem_he_10 >= 8.0 THEN 
        SET diem_he_4 = 3.5; SET diem_chu = 'B+';
    ELSEIF diem_he_10 >= 7.0 THEN 
        SET diem_he_4 = 3.0; SET diem_chu = 'B';
    ELSEIF diem_he_10 >= 6.0 THEN 
        SET diem_he_4 = 2.5; SET diem_chu = 'C+';
    ELSEIF diem_he_10 >= 5.5 THEN 
        SET diem_he_4 = 2.0; SET diem_chu = 'C';
    ELSEIF diem_he_10 >= 5.0 THEN 
        SET diem_he_4 = 1.5; SET diem_chu = 'D+';
    ELSEIF diem_he_10 >= 4.0 THEN 
        SET diem_he_4 = 1.0; SET diem_chu = 'D';
    ELSE 
        SET diem_he_4 = 0.0; SET diem_chu = 'F';
    END IF;

    IF diem_he_10 >= 4.0 THEN 
        SET danh_gia = 'DAT';
    ELSEIF NEW.lan_thi = 2 THEN 
        SET danh_gia = 'HOCLAI';
    ELSE 
        SET danh_gia = 'THILAI';
    END IF;

    UPDATE diem_tong_hop
    SET diem_he_10 = diem_he_10, diem_he_4 = diem_he_4, diem_chu = diem_chu, danh_gia = danh_gia
    WHERE ma_dct = NEW.ma_dct;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem_tong_hop`
--

CREATE TABLE `diem_tong_hop` (
  `ma_dth` int(11) NOT NULL,
  `ma_dct` int(11) NOT NULL,
  `diem_he_10` decimal(5,2) DEFAULT 0.00,
  `diem_he_4` decimal(5,2) DEFAULT 0.00,
  `diem_chu` varchar(2) DEFAULT NULL,
  `danh_gia` varchar(255) DEFAULT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diem_tong_hop`
--

INSERT INTO `diem_tong_hop` (`ma_dth`, `ma_dct`, `diem_he_10`, `diem_he_4`, `diem_chu`, `danh_gia`, `ghi_chu`) VALUES
(47, 41, 9.40, 4.00, 'A', 'DAT', NULL),
(48, 42, 6.60, 2.50, 'C+', 'DAT', NULL),
(49, 43, NULL, NULL, NULL, NULL, NULL),
(50, 44, NULL, NULL, NULL, NULL, NULL),
(51, 45, 1.20, 0.00, 'F', 'THILAI', NULL),
(52, 46, 6.60, 2.50, 'C+', 'DAT', NULL),
(53, 47, 6.60, 2.50, 'C+', 'DAT', NULL),
(54, 48, 6.60, 2.50, 'C+', 'DAT', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giang_vien`
--

CREATE TABLE `giang_vien` (
  `ma_giang_vien` varchar(10) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `chuyen_nganh` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giang_vien`
--

INSERT INTO `giang_vien` (`ma_giang_vien`, `ma_khoa`, `ho_ten`, `email`, `so_dien_thoai`, `chuyen_nganh`) VALUES
('GV101', 1, 'Nguyễn Văn GV', 'nguyenvangv@university.edu', '0913000001', 'Công nghệ phần mềm'),
('GV102', 1, 'Trần Thị GV', 'tranthigv@university.edu', '0913000002', 'Hệ thống thông tin'),
('GV103', 1, 'Phạm Văn GV', 'phamvangv@university.edu', '0913000003', 'Hệ thống thông tin'),
('GV201', 2, 'Lê Văn GV', 'levangv@university.edu', '0913000004', 'Quản trị kinh doanh'),
('GV202', 2, 'Hoàng Thị GV', 'hoangthigv@university.edu', '0913000005', 'Tài chính - Ngân hàng'),
('GV203', 2, 'Đỗ Thị GV', 'dothigv@university.edu', '0913000006', 'Tài chính - Ngân hàng'),
('GV301', 3, 'Vũ Trần GV', 'vutranhgv@university.edu', '0913000007', 'Y đa khoa'),
('GV302', 3, 'Phạm Thị GV', 'phamthigv@university.edu', '0913000008', 'Dược học'),
('GV303', 3, 'Ngô Văn GV', 'ngovangv@university.edu', '0913000009', 'Y đa khoa'),
('GV401', 4, 'Hoàng Văn GV', 'hoangvangv@university.edu', '0913000010', 'Kỹ thuật cơ khí'),
('GV402', 4, 'Trần Văn GV', 'tranvangv@university.edu', '0913000011', 'Kỹ thuật xây dựng'),
('GV403', 4, 'Lê Thị GV', 'lethigv@university.edu', '0913000012', 'Kỹ thuật xây dựng'),
('GV501', 5, 'Nguyễn Thị GV', 'nguyenthigv@university.edu', '0913000013', 'Ngôn ngữ Anh'),
('GV502', 5, 'Phạm Văn GV2', 'phamvangv2@university.edu', '0913000014', 'Ngôn ngữ Pháp'),
('GV503', 5, 'Bùi Văn GV', 'buivangv@university.edu', '0913000015', 'Ngôn ngữ Trung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hoa_don` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_khoan_thu` int(11) NOT NULL,
  `ngay_thanh_toan` date NOT NULL,
  `so_tien_da_nop` decimal(12,2) NOT NULL,
  `hinh_thuc_thanh_toan` varchar(50) DEFAULT NULL,
  `noi_dung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hoa_don`, `ma_sinh_vien`, `ma_khoan_thu`, `ngay_thanh_toan`, `so_tien_da_nop`, `hinh_thuc_thanh_toan`, `noi_dung`) VALUES
(3, 'SV001', 9, '2025-01-09', 800000.00, 'Chuyển khoản', 'nộp bhyt _sv001'),
(5, 'SV002', 10, '2025-01-10', 2100000.00, 'Chuyển khoản', 'nộp hp ki _sv002'),
(8, 'SV003', 9, '2025-01-09', 800000.00, 'Chuyển khoản', 'nộp bhyt _sv003'),
(9, 'SV004', 10, '2025-01-10', 800000.00, 'Chuyển khoản', 'nộp bhyt _sv004');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `ma_khoa` int(11) NOT NULL,
  `ten_khoa` varchar(100) NOT NULL,
  `lien_he` varchar(50) DEFAULT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `tien_moi_tin_chi` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`ma_khoa`, `ten_khoa`, `lien_he`, `ngay_thanh_lap`, `tien_moi_tin_chi`) VALUES
(1, 'Khoa Công nghệ Thông tin', 'it@university.edu', '2000-09-01', 350000.00),
(2, 'Khoa Kinh tế', 'economics@university.edu', '1998-03-15', 400000.00),
(3, 'Khoa Y Dược', 'medicine@university.edu', '2005-06-20', 500000.00),
(4, 'Khoa Kỹ thuật', 'engineering@university.edu', '1995-11-10', 300000.00),
(5, 'Khoa Ngoại ngữ', 'languages@university.edu', '2003-01-25', 250000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoan_thu`
--

CREATE TABLE `khoan_thu` (
  `ma_khoan_thu` int(11) NOT NULL,
  `ten_khoan_thu` varchar(255) NOT NULL,
  `loai_khoan_thu` varchar(50) DEFAULT NULL,
  `so_tien` decimal(12,2) NOT NULL,
  `ngay_tao` date DEFAULT NULL,
  `han_nop` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoan_thu`
--

INSERT INTO `khoan_thu` (`ma_khoan_thu`, `ten_khoan_thu`, `loai_khoan_thu`, `so_tien`, `ngay_tao`, `han_nop`) VALUES
(9, 'bhyt 2023_2024', 'BHYT', 800000.00, '2025-01-09', '2025-01-13'),
(10, 'học phí kỳ 1 2023_2024', 'Học phí', 0.00, '2025-01-09', '2025-01-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoan_thu_sinh_vien`
--

CREATE TABLE `khoan_thu_sinh_vien` (
  `ma_khoan_thu` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `so_tien_ban_dau` decimal(12,2) NOT NULL,
  `so_tien_mien_giam` decimal(12,2) DEFAULT NULL,
  `so_tien_phai_nop` decimal(12,2) DEFAULT NULL,
  `trang_thai_thanh_toan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoan_thu_sinh_vien`
--

INSERT INTO `khoan_thu_sinh_vien` (`ma_khoan_thu`, `ma_sinh_vien`, `so_tien_ban_dau`, `so_tien_mien_giam`, `so_tien_phai_nop`, `trang_thai_thanh_toan`) VALUES
(9, 'SV001', 800000.00, 0.00, 800000.00, 'Đã thanh toán'),
(9, 'SV002', 800000.00, 800000.00, 0.00, 'Đã thanh toán'),
(9, 'SV003', 800000.00, 0.00, 800000.00, 'Đã thanh toán'),
(9, 'SV004', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV005', 800000.00, 400000.00, 400000.00, 'Chưa thanh toán'),
(9, 'SV006', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV007', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV008', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV009', 800000.00, 800000.00, 0.00, 'Đã thanh toán'),
(9, 'SV010', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV011', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV012', 800000.00, 120000.00, 680000.00, 'Chưa thanh toán'),
(9, 'SV013', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV014', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV015', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV016', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV017', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV018', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV019', 800000.00, 0.00, 800000.00, 'Chưa thanh toán'),
(9, 'SV020', 800000.00, 400000.00, 400000.00, 'Chưa thanh toán'),
(10, 'SV001', 2100000.00, 1050000.00, 1050000.00, 'Chưa thanh toán'),
(10, 'SV002', 2100000.00, 0.00, 2100000.00, 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_hoc`
--

CREATE TABLE `lich_hoc` (
  `id_lich_hoc` int(11) NOT NULL,
  `ma_mon_hoc` varchar(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `so_luong_toi_da` int(11) DEFAULT NULL,
  `lich_hoc` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_hoc`
--

INSERT INTO `lich_hoc` (`id_lich_hoc`, `ma_mon_hoc`, `so_luong`, `so_luong_toi_da`, `lich_hoc`, `trang_thai`) VALUES
(15, 'CS101', 48, 50, '10h35 -11h30 thứ 4', 'Đóng'),
(16, 'CS103', 48, 50, '10h35 -11h30 thứ 4', 'Đóng'),
(17, 'BA101', 38, 40, '8h30-10h30 thứ 2 ', 'Đóng'),
(18, 'IS101', 50, 50, '10h35 -11h30 thứ 4', 'Đang Mở'),
(19, 'BA101', 50, 50, '8h30-10h30 thứ 2 ', 'Đang Mở'),
(20, 'FB101', 50, 50, '8h30-10h30 thứ 2 ', 'Đang Mở');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `ma_lop` int(11) NOT NULL,
  `ma_mon` varchar(10) NOT NULL,
  `hoc_ky` varchar(9) NOT NULL,
  `ma_giang_vien` varchar(10) NOT NULL,
  `lich_hoc` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`ma_lop`, `ma_mon`, `hoc_ky`, `ma_giang_vien`, `lich_hoc`, `trang_thai`) VALUES
(16, 'CS101', '2023_2024', 'GV101', '10h35 -11h30 thứ 4', 'Đang mở'),
(17, 'BA101', '2023_2024', 'GV102', 'Thứ 3,Thứ 6 Tiết 4,5,6', 'Đang mở');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mien_giam_sinh_vien`
--

CREATE TABLE `mien_giam_sinh_vien` (
  `ma_mien_giam` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `muc_tien` decimal(12,2) NOT NULL,
  `loai_mien_giam` varchar(50) DEFAULT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mien_giam_sinh_vien`
--

INSERT INTO `mien_giam_sinh_vien` (`ma_mien_giam`, `ma_sinh_vien`, `muc_tien`, `loai_mien_giam`, `ghi_chu`) VALUES
(9, 'SV001', 50.00, 'Học phí', 'Hộ nghèo, miễn giảm 50% học phí kỳ 1'),
(10, 'SV002', 100.00, 'BHYT', 'Gia đình chính sách, miễn giảm 100% phí bảo hiểm y tế'),
(11, 'SV003', 20.00, 'Học phí', 'Gia đình khó khăn, miễn giảm 20% học phí kỳ 2'),
(12, 'SV005', 50.00, 'BHYT', 'Khuyết tật, miễn giảm 50% phí bảo hiểm y tế'),
(13, 'SV007', 80.00, 'Học phí', 'Hộ nghèo, miễn giảm 80% học phí kỳ 1'),
(14, 'SV009', 100.00, 'BHYT', 'Gia đình chính sách, miễn giảm toàn bộ phí BHYT cho năm học 2020'),
(15, 'SV011', 70.00, 'Học phí', 'Khuyết tật, miễn giảm 70% học phí kỳ 2'),
(16, 'SV012', 15.00, 'BHYT', 'Gia đình khó khăn, hỗ trợ phí bảo hiểm y tế kỳ 1'),
(17, 'SV020', 50.00, 'BHYT', 'Học sinh nghèo vượt khổ'),
(18, 'SV019', 50.00, 'BHYT', 'Học sinh nghèo vượt khó');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `ma_mon` varchar(10) NOT NULL,
  `ten_mon` varchar(100) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `so_tin_chi` int(11) DEFAULT NULL,
  `so_tiet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mon`, `ten_mon`, `ma_nganh`, `so_tin_chi`, `so_tiet`) VALUES
('BA101', 'Kinh tế vi mô', 3, 3, 45),
('BA102', 'Quản trị doanh nghiệp', 3, 3, 45),
('BA103', 'Marketing căn bản', 3, 3, 45),
('BA104', 'Kế toán tài chính', 3, 3, 45),
('CS101', 'Lập trình cơ bản', 1, 3, 45),
('CS102', 'Cơ sở dữ liệu', 1, 3, 45),
('CS103', 'Cấu trúc dữ liệu và giải thuật', 1, 4, 60),
('CS104', 'Lập trình hướng đối tượng', 1, 3, 45),
('FB101', 'Nguyên lý tài chính', 4, 3, 45),
('FB102', 'Kế toán ngân hàng', 4, 3, 45),
('FB103', 'Quản trị rủi ro tài chính', 4, 3, 45),
('FB104', 'Phân tích đầu tư', 4, 4, 45),
('IS101', 'Phân tích hệ thống', 2, 3, 45),
('IS102', 'Quản trị cơ sở dữ liệu', 2, 3, 45),
('IS103', 'Hệ thống thông tin quản lý', 2, 3, 45),
('IS104', 'Thương mại điện tử', 2, 3, 45),
('MD101', 'Giải phẫu học', 5, 4, 60),
('MD102', 'Dược lý học', 5, 3, 45),
('MD103', 'Sinh lý học', 5, 3, 45),
('T01', 'Toán 1', 1, 3, 45);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `ma_nganh` int(11) NOT NULL,
  `ten_nganh` varchar(100) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `thoi_gian_dao_tao` float DEFAULT NULL,
  `bac_dao_tao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`ma_nganh`, `ten_nganh`, `ma_khoa`, `thoi_gian_dao_tao`, `bac_dao_tao`) VALUES
(1, 'Công nghệ phần mềm', 1, 4, 'Đại học'),
(2, 'Hệ thống thông tin', 1, 4, 'Đại học'),
(3, 'Quản trị kinh doanh', 2, 4, 'Đại học'),
(4, 'Tài chính - Ngân hàng', 2, 4, 'Đại học'),
(5, 'Y đa khoa', 3, 6, 'Đại học'),
(6, 'Dược học', 3, 5, 'Đại học'),
(7, 'Kỹ thuật cơ khí', 4, 4.5, 'Đại học'),
(8, 'Kỹ thuật xây dựng', 4, 4.5, 'Đại học'),
(9, 'Ngôn ngữ Anh', 5, 4, 'Đại học'),
(10, 'Ngôn ngữ Pháp', 5, 4, 'Đại học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(10) DEFAULT NULL,
  `que_quan` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `khoa_hoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien`
--

INSERT INTO `sinh_vien` (`ma_sinh_vien`, `ma_khoa`, `ma_nganh`, `ho_ten`, `ngay_sinh`, `gioi_tinh`, `que_quan`, `email`, `so_dien_thoai`, `khoa_hoc`) VALUES
('SV001', 1, 1, 'Nguyễn Văn A', '2000-01-01', 'Nam', 'Hà Nội', 'nguyenvana@student.edu', '0981000003', 2020),
('SV002', 1, 2, 'Trần Thị B', '2000-02-02', 'Nữ', 'Hà Nội', 'tranthib@student.edu', '0981000002', 2020),
('SV003', 2, 3, 'Phạm Văn C', '2000-03-03', 'Nam', 'Hà Nội', 'phamvanc@student.edu', '0981000003', 2020),
('SV004', 2, 4, 'Lê Văn D', '2000-04-04', 'Nam', 'Hải Phòng', 'levand@student.edu', '0981000004', 2020),
('SV005', 3, 5, 'Hoàng Thị E', '2000-05-05', 'Nữ', 'Đà Nẵng', 'hoangthie@student.edu', '0981000005', 2020),
('SV006', 3, 6, 'Đỗ Thị G', '2000-06-06', 'Nữ', 'Huế', 'dothig@student.edu', '0981000006', 2020),
('SV007', 4, 7, 'Vũ Trần H', '2000-07-07', 'Nam', 'Quảng Ninh', 'vutranh@student.edu', '0981000007', 2020),
('SV008', 4, 8, 'Nguyễn Thị K', '2000-08-08', 'Nữ', 'Nam Định', 'nguyenthik@student.edu', '0981000008', 2020),
('SV009', 5, 9, 'Lê Thị L', '2000-09-09', 'Nữ', 'Hòa Bình', 'lethil@student.edu', '0981000009', 2020),
('SV010', 5, 10, 'Hoàng Văn M', '2000-10-10', 'Nam', 'Hà Nội', 'hoangvanm@student.edu', '0981000010', 2020),
('SV011', 1, 1, 'Nguyễn Thị N', '2000-11-11', 'Nữ', 'Thái Bình', 'nguyenthin@student.edu', '0981000011', 2020),
('SV012', 1, 2, 'Phạm Văn O', '2000-12-12', 'Nam', 'Ninh Bình', 'phamvanto@student.edu', '0981000012', 2020),
('SV013', 2, 3, 'Nguyễn Thị P', '2001-01-01', 'Nữ', 'Hà Tĩnh', 'nguyenthit@student.edu', '0981000013', 2021),
('SV014', 2, 4, 'Trần Văn Q', '2001-02-02', 'Nam', 'Quảng Nam', 'tranvanu@student.edu', '0981000014', 2021),
('SV015', 3, 5, 'Lê Thị R', '2001-03-03', 'Nữ', 'Huế', 'lethiv@student.edu', '0981000015', 2021),
('SV016', 3, 6, 'Bùi Văn S', '2001-04-04', 'Nam', 'Nghệ An', 'buivanw@student.edu', '0981000016', 2021),
('SV017', 4, 7, 'Phạm Thị T', '2001-05-05', 'Nữ', 'Quảng Trị', 'phamthix@student.edu', '0981000017', 2021),
('SV018', 4, 8, 'Trần Văn U', '2001-06-06', 'Nam', 'Quảng Bình', 'tranvany@student.edu', '0981000018', 2021),
('SV019', 1, 1, 'Ngô Văn Z', '2004-02-18', 'Nam', 'Hưng Yên', 'ngovanz@student.edu', '0981000020', 2021),
('SV020', 5, 10, 'Đỗ Thị W', '2001-08-08', 'Nam', 'Hưng Yên', 'dothiaa@student.edu', '0981000020', 2021);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `ma_tai_khoan` varchar(10) NOT NULL,
  `ten_dang_nhap` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phan_quyen` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`ma_tai_khoan`, `ten_dang_nhap`, `mat_khau`, `email`, `phan_quyen`) VALUES
('ad001', 'admin', '1', 'admin@gmail.com', 'admin'),
('GV101', 'nguyenvangv', '123456', 'nguyenvangv@university.edu', 'giang_vien'),
('GV102', 'tranthigv', '123456', 'tranthigv@university.edu', 'giang_vien'),
('GV103', 'phamvangv', '123456', 'phamvangv@university.edu', 'giang_vien'),
('GV201', 'levangv', '123456', 'levangv@university.edu', 'giang_vien'),
('GV202', 'hoangthigv', '123456', 'hoangthigv@university.edu', 'giang_vien'),
('GV203', 'dothigv', '123456', 'dothigv@university.edu', 'giang_vien'),
('GV301', 'vutranhgv', '123456', 'vutranhgv@university.edu', 'giang_vien'),
('GV302', 'phamthigv', '123456', 'phamthigv@university.edu', 'giang_vien'),
('GV303', 'ngovangv', '123456', 'ngovangv@university.edu', 'giang_vien'),
('GV401', 'hoangvangv', '123456', 'hoangvangv@university.edu', 'giang_vien'),
('GV402', 'tranvangv', '123456', 'tranvangv@university.edu', 'giang_vien'),
('GV403', 'lethigv', '123456', 'lethigv@university.edu', 'giang_vien'),
('GV501', 'nguyenthigv', '123456', 'nguyenthigv@university.edu', 'giang_vien'),
('GV502', 'phamvangv2', '123456', 'phamvangv2@university.edu', 'giang_vien'),
('GV503', 'buivangv', '123456', 'buivangv@university.edu', 'giang_vien'),
('SV001', 'nguyenvana', '123456', 'nguyenvana@student.edu', 'sinh_vien'),
('SV002', 'tranthib', '123456', 'tranthib@student.edu', 'sinh_vien'),
('SV003', 'phamvanc', '123456', 'phamvanc@student.edu', 'sinh_vien'),
('SV004', 'levand', '123456', 'levand@student.edu', 'sinh_vien'),
('SV005', 'hoangthie', '123456', 'hoangthie@student.edu', 'sinh_vien'),
('SV006', 'dothig', '123456', 'dothig@student.edu', 'sinh_vien'),
('SV007', 'vutranh', '123456', 'vutranh@student.edu', 'sinh_vien'),
('SV008', 'nguyenthik', '123456', 'nguyenthik@student.edu', 'sinh_vien'),
('SV009', 'lethil', '123456', 'lethil@student.edu', 'sinh_vien'),
('SV010', 'hoangvanm', '123456', 'hoangvanm@student.edu', 'sinh_vien'),
('SV011', 'nguyenthin', '123456', 'nguyenthin@student.edu', 'sinh_vien'),
('SV012', 'phamvanto', '123456', 'phamvanto@student.edu', 'sinh_vien'),
('SV013', 'nguyenthit', '123456', 'nguyenthit@student.edu', 'sinh_vien'),
('SV014', 'tranvanu', '123456', 'tranvanu@student.edu', 'sinh_vien'),
('SV015', 'lethiv', '123456', 'lethiv@student.edu', 'sinh_vien'),
('SV016', 'buivanw', '123456', 'buivanw@student.edu', 'sinh_vien'),
('SV017', 'phamthix', '123456', 'phamthix@student.edu', 'sinh_vien'),
('SV018', 'tranvany', '123456', 'tranvany@student.edu', 'sinh_vien'),
('SV019', 'ngovanz', '123456', 'ngovanz@student.edu', 'sinh_vien'),
('SV020', 'dothiaa', '123456', 'dothiaaa@student.edu', 'sinh_vien');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dang_ky_mon_hoc`
--
ALTER TABLE `dang_ky_mon_hoc`
  ADD PRIMARY KEY (`ma_dang_ky`),
  ADD KEY `fk_dkmh_ma_mon` (`ma_mon`),
  ADD KEY `fk_dkmh_ma_lop` (`ma_lop`),
  ADD KEY `fk_dkmh_ma_sinh_vien` (`ma_sinh_vien`);

--
-- Chỉ mục cho bảng `diem_chi_tiet`
--
ALTER TABLE `diem_chi_tiet`
  ADD PRIMARY KEY (`ma_dct`) USING BTREE;

--
-- Chỉ mục cho bảng `diem_tong_hop`
--
ALTER TABLE `diem_tong_hop`
  ADD PRIMARY KEY (`ma_dth`),
  ADD KEY `fk_ma_dct` (`ma_dct`);

--
-- Chỉ mục cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`ma_giang_vien`),
  ADD KEY `fk_gv_ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hoa_don`),
  ADD KEY `fk_hd_ma_sinh_vien` (`ma_sinh_vien`),
  ADD KEY `fk_hd_ma_khoan_thu` (`ma_khoan_thu`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`ma_khoa`);

--
-- Chỉ mục cho bảng `khoan_thu`
--
ALTER TABLE `khoan_thu`
  ADD PRIMARY KEY (`ma_khoan_thu`);

--
-- Chỉ mục cho bảng `khoan_thu_sinh_vien`
--
ALTER TABLE `khoan_thu_sinh_vien`
  ADD PRIMARY KEY (`ma_khoan_thu`,`ma_sinh_vien`),
  ADD KEY `fk_kt_sv_ma_sinh_vien` (`ma_sinh_vien`);

--
-- Chỉ mục cho bảng `lich_hoc`
--
ALTER TABLE `lich_hoc`
  ADD PRIMARY KEY (`id_lich_hoc`),
  ADD KEY `fk_lich_hoc_ma_mon` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`),
  ADD KEY `fk_lop_ma_mon` (`ma_mon`),
  ADD KEY `fk_lop_ma_giang_vien` (`ma_giang_vien`);

--
-- Chỉ mục cho bảng `mien_giam_sinh_vien`
--
ALTER TABLE `mien_giam_sinh_vien`
  ADD PRIMARY KEY (`ma_mien_giam`),
  ADD KEY `fk_mg_sv_ma_sinh_vien` (`ma_sinh_vien`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`ma_mon`),
  ADD KEY `fk_mon_ma_nganh` (`ma_nganh`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`ma_nganh`),
  ADD KEY `fk_nganh_ma_khoa` (`ma_khoa`);

--
-- Chỉ mục cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`ma_sinh_vien`),
  ADD KEY `fk_sv_ma_khoa` (`ma_khoa`),
  ADD KEY `fk_sv_ma_nganh` (`ma_nganh`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`ma_tai_khoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dang_ky_mon_hoc`
--
ALTER TABLE `dang_ky_mon_hoc`
  MODIFY `ma_dang_ky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `diem_chi_tiet`
--
ALTER TABLE `diem_chi_tiet`
  MODIFY `ma_dct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `diem_tong_hop`
--
ALTER TABLE `diem_tong_hop`
  MODIFY `ma_dth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `ma_khoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khoan_thu`
--
ALTER TABLE `khoan_thu`
  MODIFY `ma_khoan_thu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `lich_hoc`
--
ALTER TABLE `lich_hoc`
  MODIFY `id_lich_hoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `ma_lop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `mien_giam_sinh_vien`
--
ALTER TABLE `mien_giam_sinh_vien`
  MODIFY `ma_mien_giam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `nganh`
--
ALTER TABLE `nganh`
  MODIFY `ma_nganh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dang_ky_mon_hoc`
--
ALTER TABLE `dang_ky_mon_hoc`
  ADD CONSTRAINT `fk_dkmh_ma_lop` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`),
  ADD CONSTRAINT `fk_dkmh_ma_mon` FOREIGN KEY (`ma_mon`) REFERENCES `mon_hoc` (`ma_mon`),
  ADD CONSTRAINT `fk_dkmh_ma_sinh_vien` FOREIGN KEY (`ma_sinh_vien`) REFERENCES `sinh_vien` (`ma_sinh_vien`);

--
-- Các ràng buộc cho bảng `diem_tong_hop`
--
ALTER TABLE `diem_tong_hop`
  ADD CONSTRAINT `fk_ma_dct` FOREIGN KEY (`ma_dct`) REFERENCES `diem_chi_tiet` (`ma_dct`);

--
-- Các ràng buộc cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD CONSTRAINT `fk_gv_ma_khoa` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`ma_khoa`),
  ADD CONSTRAINT `fk_gv_ma_tai_khoan` FOREIGN KEY (`ma_giang_vien`) REFERENCES `tai_khoan` (`ma_tai_khoan`);

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `fk_hd_ma_khoan_thu` FOREIGN KEY (`ma_khoan_thu`) REFERENCES `khoan_thu` (`ma_khoan_thu`),
  ADD CONSTRAINT `fk_hd_ma_sinh_vien` FOREIGN KEY (`ma_sinh_vien`) REFERENCES `sinh_vien` (`ma_sinh_vien`);

--
-- Các ràng buộc cho bảng `khoan_thu_sinh_vien`
--
ALTER TABLE `khoan_thu_sinh_vien`
  ADD CONSTRAINT `fk_kt_sv_ma_khoan_thu` FOREIGN KEY (`ma_khoan_thu`) REFERENCES `khoan_thu` (`ma_khoan_thu`),
  ADD CONSTRAINT `fk_kt_sv_ma_sinh_vien` FOREIGN KEY (`ma_sinh_vien`) REFERENCES `sinh_vien` (`ma_sinh_vien`);

--
-- Các ràng buộc cho bảng `lich_hoc`
--
ALTER TABLE `lich_hoc`
  ADD CONSTRAINT `fk_lich_hoc_ma_mon` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon`);

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `fk_lop_ma_giang_vien` FOREIGN KEY (`ma_giang_vien`) REFERENCES `giang_vien` (`ma_giang_vien`),
  ADD CONSTRAINT `fk_lop_ma_mon` FOREIGN KEY (`ma_mon`) REFERENCES `mon_hoc` (`ma_mon`);

--
-- Các ràng buộc cho bảng `mien_giam_sinh_vien`
--
ALTER TABLE `mien_giam_sinh_vien`
  ADD CONSTRAINT `fk_mg_sv_ma_sinh_vien` FOREIGN KEY (`ma_sinh_vien`) REFERENCES `sinh_vien` (`ma_sinh_vien`);

--
-- Các ràng buộc cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD CONSTRAINT `fk_mon_ma_nganh` FOREIGN KEY (`ma_nganh`) REFERENCES `nganh` (`ma_nganh`);

--
-- Các ràng buộc cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `fk_nganh_ma_khoa` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`ma_khoa`);

--
-- Các ràng buộc cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `fk_sv_ma_khoa` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`ma_khoa`),
  ADD CONSTRAINT `fk_sv_ma_nganh` FOREIGN KEY (`ma_nganh`) REFERENCES `nganh` (`ma_nganh`),
  ADD CONSTRAINT `fk_sv_ma_tai_khoan` FOREIGN KEY (`ma_sinh_vien`) REFERENCES `tai_khoan` (`ma_tai_khoan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
