-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 03:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlhssv`
--

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_mon_hoc`
--

CREATE TABLE `dang_ky_mon_hoc` (
  `ma_dang_ky` int(11) NOT NULL,
  `ma_mon` varchar(10) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_lop` int(11) DEFAULT NULL,
  `lich_hoc_du_kien` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT 'Chờ duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_chi_tiet`
--

CREATE TABLE `diem_chi_tiet` (
  `ma_dth` int(11) NOT NULL,
  `ma_lop` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `diem_chuyen_can` decimal(5,2) DEFAULT 0.00,
  `diem_giua_ky` decimal(5,2) DEFAULT 0.00,
  `diem_cuoi_ky` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_tong_hop`
--

CREATE TABLE `diem_tong_hop` (
  `ma_dth` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_mon` varchar(10) NOT NULL,
  `hoc_ky` varchar(20) NOT NULL,
  `diem_he_10` decimal(5,2) DEFAULT 0.00,
  `diem_he_4` decimal(5,2) DEFAULT 0.00,
  `diem_chu` varchar(2) DEFAULT NULL,
  `lan_thi` int(11) DEFAULT 1,
  `lan_hoc` int(11) DEFAULT 1,
  `danh_gia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giang_vien`
--

CREATE TABLE `giang_vien` (
  `ma_giang_vien` varchar(10) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(15) NOT NULL,
  `chuyen_nganh` varchar(50) NOT NULL,
  `ma_tai_khoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `so_phieu` int(11) NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `ngay_thu` date DEFAULT NULL,
  `phuong_thuc` varchar(50) DEFAULT NULL,
  `chi_tiet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `ma_khoa` int(11) NOT NULL,
  `ten_khoa` varchar(100) NOT NULL,
  `lien_he` varchar(50) DEFAULT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `tien_moi_tin_chi` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `ma_lop` int(11) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `hoc_ky` varchar(9) NOT NULL,
  `ma_giang_vien` varchar(10) NOT NULL,
  `lich_hoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `ma_mon` varchar(10) NOT NULL,
  `ten_mon` varchar(100) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `so_tin_chi` int(11) NOT NULL,
  `so_tiet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `ma_nganh` int(11) NOT NULL,
  `ten_nganh` varchar(100) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `thoi_gian_dao_tao` int(11) NOT NULL,
  `bac_dao_tao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `ma_sinh_vien` varchar(10) NOT NULL,
  `ma_khoa` int(11) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `que_quan` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(15) NOT NULL,
  `khoa_hoc` int(11) NOT NULL,
  `ma_tai_khoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tai_chinh`
--

CREATE TABLE `tai_chinh` (
  `ma_tai_chinh` int(11) NOT NULL,
  `ma_sinh_vien` varchar(10) NOT NULL,
  `hoc_ky` varchar(20) DEFAULT NULL,
  `ngay_tao` date DEFAULT curdate(),
  `han_nop` date DEFAULT NULL,
  `loai_khoan` varchar(50) DEFAULT NULL,
  `noi_dung` varchar(255) DEFAULT NULL,
  `so_tien_tong` decimal(10,2) DEFAULT NULL,
  `so_tien_mien_giam` decimal(10,2) DEFAULT NULL,
  `so_tien_phai_nop` decimal(10,2) DEFAULT NULL,
  `so_tien_da_nop` decimal(10,2) DEFAULT NULL,
  `tinh_trang` varchar(20) DEFAULT NULL,
  `so_phieu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `ma_tai_khoan` int(11) NOT NULL,
  `ten_dang_nhap` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phan_quyen` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dang_ky_mon_hoc`
--
ALTER TABLE `dang_ky_mon_hoc`
  ADD PRIMARY KEY (`ma_dang_ky`);

--
-- Indexes for table `diem_chi_tiet`
--
ALTER TABLE `diem_chi_tiet`
  ADD PRIMARY KEY (`ma_dth`);

--
-- Indexes for table `diem_tong_hop`
--
ALTER TABLE `diem_tong_hop`
  ADD PRIMARY KEY (`ma_dth`);

--
-- Indexes for table `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`ma_giang_vien`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`so_phieu`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`ma_khoa`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Indexes for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`ma_mon`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`ma_nganh`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`ma_sinh_vien`);

--
-- Indexes for table `tai_chinh`
--
ALTER TABLE `tai_chinh`
  ADD PRIMARY KEY (`ma_tai_chinh`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`ma_tai_khoan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dang_ky_mon_hoc`
--
ALTER TABLE `dang_ky_mon_hoc`
  MODIFY `ma_dang_ky` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_chi_tiet`
--
ALTER TABLE `diem_chi_tiet`
  MODIFY `ma_dth` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_tong_hop`
--
ALTER TABLE `diem_tong_hop`
  MODIFY `ma_dth` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `so_phieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `ma_khoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `ma_lop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nganh`
--
ALTER TABLE `nganh`
  MODIFY `ma_nganh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tai_chinh`
--
ALTER TABLE `tai_chinh`
  MODIFY `ma_tai_chinh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `ma_tai_khoan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
