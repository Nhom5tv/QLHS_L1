<?php 
class Sinhvien_m extends connectDB{
    // Hàm thêm mới sinh viên
    function sinhvien_ins($maSV, $maKhoa, $maNganh, $hoTen, $ngaySinh, $gioiTinh, $queQuan, $email, $soDienThoai, $khoaHoc, $maTaiKhoan) {
        // Chuẩn bị câu SQL để thêm sinh viên
        $sql = "INSERT INTO sinh_vien (ma_sinh_vien, ma_khoa, ma_nganh, ho_ten, ngay_sinh, gioi_tinh, que_quan, email, so_dien_thoai, khoa_hoc, ma_tai_khoan)
                VALUES ('$maSV', '$maKhoa', '$maNganh', '$hoTen', '$ngaySinh', '$gioiTinh', '$queQuan', '$email', '$soDienThoai', '$khoaHoc', '$maTaiKhoan')";
                 return mysqli_query($this->con, $sql);
    }
    // Hàm kiểm tra trùng mã sinh viên
    function checktrungmasv($maSV){
        $sql = "SELECT * FROM sinh_vien WHERE ma_sinh_vien='$maSV'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;
        }
        return $kq;
    }
    function getKhoa() {
        $sql = "SELECT * FROM khoa";
        $result = mysqli_query($this->con, $sql);
        
        // Kiểm tra kết quả truy vấn
        if (!$result) {
            echo "Lỗi truy vấn SQL: " . mysqli_error($this->con);
        }
    
        return $result; // Trả về kết quả truy vấn
    }
    function getNganh() {
        $sql = "SELECT * FROM nganh";
        $result = mysqli_query($this->con, $sql);
        
        // Kiểm tra kết quả truy vấn
        if (!$result) {
            echo "Lỗi truy vấn SQL: " . mysqli_error($this->con);
        }
    
        return $result; // Trả về kết quả truy vấn
    }

    // Hàm tìm kiếm sinh viên theo mã sinh viên và họ tên
    function sinhvien_find($maSV, $hoTen){
        if (empty($maSV) && empty($hoTen)) {
            $sql = "SELECT * FROM sinh_vien";
        } elseif (empty($hoTen)) {
            $sql = "SELECT * FROM sinh_vien WHERE ma_sinh_vien = '$maSV'";
        } else {
            $sql = "SELECT * FROM sinh_vien WHERE ma_sinh_vien LIKE '%$maSV%' AND ho_ten LIKE '%$hoTen%'";
        }
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa sinh viên
    function sinhvien_del($maSV){
        $sql = "DELETE FROM sinh_vien WHERE ma_sinh_vien='$maSV'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin sinh viên
    function sinhvien_upd($maSV, $maKhoa, $maNganh, $hoTen, $ngaySinh, $gioiTinh, $queQuan, $email, $soDienThoai, $khoaHoc, $maTaiKhoan){
        $sql = "UPDATE sinh_vien 
                SET ma_khoa='$maKhoa', ma_nganh='$maNganh', ho_ten='$hoTen', ngay_sinh='$ngaySinh', gioi_tinh='$gioiTinh', 
                    que_quan=N'$queQuan', email='$email', so_dien_thoai='$soDienThoai', khoa_hoc='$khoaHoc', ma_tai_khoan='$maTaiKhoan' 
                WHERE ma_sinh_vien='$maSV'";
        return mysqli_query($this->con, $sql);
    }
}
?>
