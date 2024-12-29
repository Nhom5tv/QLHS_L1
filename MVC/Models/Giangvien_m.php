<?php 
class Giangvien_m extends connectDB{
    // Hàm thêm mới giang viên
    function giangvien_ins($maGV, $maKhoa,$hoTen,$email,$soDienThoai, $chuyenNganh,$maTaiKhoan) {
        // Chuẩn bị câu SQL để thêm giang viên
        $sql = "INSERT INTO giang_vien (ma_giang_vien, ma_khoa, ho_ten, email, so_dien_thoai, chuyen_nganh, ma_tai_khoan)
                VALUES ('$maGV', '$maKhoa', '$hoTen', '$email', '$soDienThoai', '$chuyenNganh', '$maTaiKhoan')";
                 return mysqli_query($this->con, $sql);
    }
    // Hàm kiểm tra trùng mã giang viên
    function checktrungmagV($maGV){
        $sql = "SELECT * FROM giang_vien WHERE ma_giang_vien='$maGV'";
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
    

    // Hàm tìm kiếm giang viên theo mã giang viên và họ tên
    function giangvien_find($maGV, $hoTen){
        if (empty($maGV) && empty($hoTen)) {
            $sql = "SELECT * FROM giang_vien";
        } elseif (empty($hoTen)) {
            $sql = "SELECT * FROM giang_vien WHERE ma_giang_vien = '$maGV'";
        } else {
            $sql = "SELECT * FROM giang_vien WHERE ma_giang_vien LIKE '%$maGV%' AND ho_ten LIKE '%$hoTen%'";
        }
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa giang viên
    function giangvien_del($maGV){
        $sql = "DELETE FROM giang_vien WHERE ma_giang_vien='$maGV'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin giang viên
    function giangvien_upd($maGV, $maKhoa, $hoTen, $email, $soDienThoai, $chuyenNganh, $maTaiKhoan){
        $sql = "UPDATE giang_vien 
                SET ma_khoa='$maKhoa', ho_ten='$hoTen', email='$email', so_dien_thoai='$soDienThoai', chuyen_nganh='$chuyenNganh', ma_tai_khoan='$maTaiKhoan' 
                WHERE ma_giang_vien='$maGV'";
        return mysqli_query($this->con, $sql);
    }
}
?>
