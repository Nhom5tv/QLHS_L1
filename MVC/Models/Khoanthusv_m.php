<?php 
class Khoanthusv_m extends connectDB {
    // Hàm thêm mới khoản thu sinh viên
    function khoanthu_ins($maSinhVien, $soTienBanDau, $soTienMienGiam, $soTienPhaiNop, $trangThaiThanhToan) {
        $sql = "INSERT INTO khoan_thu_sinh_vien (ma_sinh_vien, so_tien_ban_dau, so_tien_mien_giam, so_tien_phai_nop, ma_mien_giam, trang_thai_thanh_toan) 
                VALUES ('$maSinhVien', '$soTienBanDau', '$soTienMienGiam', '$soTienPhaiNop',  N'$trangThaiThanhToan')";
        return mysqli_query($this->con, $sql);
    }

    // Hàm kiểm tra trùng khoản thu sinh viên (nếu cần)
    function checktrungkhoanthu($maSinhVien, $maKhoanThu) {
        $sql = "SELECT * FROM khoan_thu_sinh_vien 
                WHERE ma_sinh_vien = '$maSinhVien' AND ma_khoan_thu = '$maKhoanThu'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true; // Trùng lặp
        }
        return $kq;
    }
    

    // Hàm tìm kiếm theo mã sinh viên và trạng thái thanh toán
    function khoanthu_find($maSinhVien, $trangThaiThanhToan) {
        // Trường hợp tìm tất cả
        if (empty($maSinhVien) && empty($trangThaiThanhToan)) {
            $sql = "SELECT * FROM khoan_thu_sinh_vien";
        }
        // Trường hợp tìm theo mã sinh viên
        elseif (empty($trangThaiThanhToan)) {
            $sql = "SELECT * FROM khoan_thu_sinh_vien WHERE ma_sinh_vien LIKE '%$maSinhVien%'";
        }
        // Trường hợp tìm theo trạng thái thanh toán
        elseif (empty($maSinhVien)) {
            $sql = "SELECT * FROM khoan_thu_sinh_vien WHERE trang_thai_thanh_toan = N'$trangThaiThanhToan'";
        }
        // Trường hợp tìm theo cả mã sinh viên và trạng thái thanh toán
        else {
            $sql = "SELECT * FROM khoan_thu_sinh_vien WHERE ma_sinh_vien LIKE '%$maSinhVien%' AND trang_thai_thanh_toan = N'$trangThaiThanhToan'";
        }

        return mysqli_query($this->con, $sql);
    }
    function hienthidl(){
        $sql = "SELECT 
            ktsv.ma_khoan_thu, 
            kt.ten_khoan_thu, 
            ktsv.ma_sinh_vien, 
            ktsv.so_tien_ban_dau, 
            ktsv.so_tien_mien_giam, 
            ktsv.so_tien_phai_nop, 
            ktsv.trang_thai_thanh_toan
        FROM 
            khoan_thu_sinh_vien AS ktsv
        JOIN 
            khoan_thu AS kt ON ktsv.ma_khoan_thu = kt.ma_khoan_thu";
        return mysqli_query($this->con, $sql);
   
    }

    // Hàm xóa khoản thu sinh viên
    function khoanthu_del($maKhoanThu, $maSinhVien) {
        $sql = "DELETE FROM khoan_thu_sinh_vien 
                WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sql);
    }
    
    function sua_id($maKhoanThu,$maSinhVien){
        $sql = "SELECT * FROM khoan_thu_sinh_vien  WHERE ma_khoan_thu='$maKhoanThu' and ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin khoản thu sinh viên
    function khoanthu_upd($maKhoanThu, $maSinhVien, $soTienBanDau, $soTienMienGiam, $soTienPhaiNop, $trangThaiThanhToan) {
        // Câu lệnh UPDATE với điều kiện cụ thể cả ma_khoan_thu và ma_sinh_vien
        $sql = "UPDATE khoan_thu_sinh_vien 
                SET so_tien_ban_dau = '$soTienBanDau', 
                    so_tien_mien_giam = '$soTienMienGiam', 
                    so_tien_phai_nop = '$soTienPhaiNop', 
                    trang_thai_thanh_toan = N'$trangThaiThanhToan' 
                WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        
        return mysqli_query($this->con, $sql);
    }
    
}
?>
