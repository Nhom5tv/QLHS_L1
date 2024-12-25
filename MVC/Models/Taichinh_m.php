<?php
class Taichinh_m extends connectDB {

    // Lấy danh sách hóa đơn theo mã sinh viên
    function getHoaDonBySinhVien($maSinhVien) {
        $sql = "SELECT 
                    hd.ma_hoa_don, 
                    kt.ten_khoan_thu, 
                    hd.so_tien_da_nop, 
                    hd.ngay_thanh_toan, 
                    hd.hinh_thuc_thanh_toan, 
                    hd.noi_dung 
                FROM 
                    hoa_don AS hd
                JOIN 
                    khoan_thu AS kt ON hd.ma_khoan_thu = kt.ma_khoan_thu
                WHERE 
                    hd.ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sql);
    }

    // Lấy thông tin các khoản phải nộp theo mã sinh viên
    function getThongTinPhaiNopBySinhVien($maSinhVien) {
        $sql = "SELECT 
                    kt.ten_khoan_thu, 
                    kt.ngay_tao, 
                    kt.han_nop, 
                    ktsv.so_tien_ban_dau, 
                    ktsv.so_tien_mien_giam, 
                    ktsv.so_tien_phai_nop, 
                    ktsv.trang_thai_thanh_toan 
                FROM 
                    khoan_thu_sinh_vien AS ktsv
                JOIN 
                    khoan_thu AS kt ON ktsv.ma_khoan_thu = kt.ma_khoan_thu
                WHERE 
                    ktsv.ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sql);
    }
}
?>
