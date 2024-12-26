<?php
class ThongTinSinhVien_m extends connectDB {
    // Hàm lấy thông tin sinh viên cùng với ngành học theo mã sinh viên
    public function get_sinhvien_by_msv($maSV) {
        // Câu lệnh SQL
        $sql = "SELECT sv.ma_sinh_vien, sv.ho_ten, sv.ngay_sinh, sv.email, sv.so_dien_thoai, ng.ten_nganh
                FROM sinh_vien sv
                INNER JOIN nganh ng ON sv.ma_nganh = ng.ma_nganh
                WHERE sv.ma_sinh_vien = '$maSV'";
    
        // Trả về kết quả thực thi truy vấn
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật email và số điện thoại của sinh viên
    public function update_sinhvien($maSV, $email, $soDienThoai) {
        $sql = "UPDATE sinh_vien 
                SET email = '$email', so_dien_thoai = '$soDienThoai' 
                WHERE ma_sinh_vien = '$maSV'";
    
    return mysqli_query($this->con, $sql);
    }
    
}
?>
