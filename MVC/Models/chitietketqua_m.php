<?php
class DSSinhvienModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách sinh viên và điểm
    public function getAllSinhVien() {
        $query = "SELECT * FROM diem_chi_tiet"; // 'dct' là tên bảng trong database
        $stmt = $this->conn->query($query);
        return $stmt;
    }

    // // Tìm kiếm theo mã sinh viên
    // public function searchByMaSV($maSinhVien) {
    //     $query = "SELECT * FROM diem_chi_tiet WHERE ma_sinh_vien LIKE ?";
    //     $stmt = $this->conn->prepare($query);
    //     $search = "%$maSinhVien%";
    //     $stmt->bind_param("s", $search);
    //     $stmt->execute();
    //     return $stmt->get_result();
    // }

    // // Tìm kiếm theo mã môn học
    // public function searchByMaMon($maMonHoc) {
    //     $query = "SELECT * FROM dct WHERE ma_lop LIKE ?";
    //     $stmt = $this->conn->prepare($query);
    //     $search = "%$maMonHoc%";
    //     $stmt->bind_param("s", $search);
    //     $stmt->execute();
    //     return $stmt->get_result();
    // }

    // Lấy thông tin chi tiết của một sinh viên
    public function getSinhVienById($ma_dct) {
        $query = "SELECT * FROM diem_chi_tiet WHERE ma_dct = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $ma_dct);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Cập nhật thông tin điểm của sinh viên
    public function updateSinhVien($ma_dct, $lanHoc, $lanThi, $diemChuyenCan, $diemGiuaKy, $diemCuoiKy) {
        $query = "UPDATE diem_chi_tiet SET lan_hoc = ?, lan_thi = ?, diem_chuyen_can = ?, diem_giua_ky = ?, diem_cuoi_ky = ? WHERE ma_dct = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iidddi", $lanHoc, $lanThi, $diemChuyenCan, $diemGiuaKy, $diemCuoiKy, $ma_dct);
        return $stmt->execute();
    }
}
?>
