<?php 
class Giangvien_m extends connectDB {
    // Hàm thêm mới giảng viên
    function giangvien_ins($maGiangVien, $hoTen, $email, $soDienThoai, $chuyenNganh) {
        $sql = "INSERT INTO Giangvien (ma_giang_vien, ho_ten, email, so_dien_thoai, chuyen_nganh) 
                VALUES ('$maGiangVien', '$hoTen', '$email', '$soDienThoai', N'$chuyenNganh')";
        return mysqli_query($this->con, $sql);
    }

    // Hàm kiểm tra trùng mã giảng viên
    function checkTrungMaGiangVien($maGiangVien) {
        $sql = "SELECT * FROM Giangvien WHERE ma_giang_vien='$maGiangVien'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  // Trả về true nếu mã giảng viên đã tồn tại
        }
        return $kq;
    }

    // Hàm tìm kiếm giảng viên
    function giangvien_find($maGiangVien, $hoTen) {
        // Trường hợp loaddata (không có điều kiện tìm kiếm)
        if (empty($maGiangVien) && empty($hoTen)) {
            $sql = "SELECT * FROM Giangvien";
        } 
        // Trường hợp tìm kiếm theo mã giảng viên
        elseif (empty($hoTen)) {
            $sql = "SELECT * FROM Giangvien WHERE ma_giang_vien LIKE '%$maGiangVien%'";
        }
        // Trường hợp tìm kiếm theo tên giảng viên
        elseif (empty($maGiangVien)) {
            $sql = "SELECT * FROM Giangvien WHERE ho_ten LIKE '%$hoTen%'";
        }
        // Trường hợp tìm kiếm theo cả mã giảng viên và tên giảng viên
        else {
            $sql = "SELECT * FROM Giangvien WHERE ma_giang_vien LIKE '%$maGiangVien%' AND ho_ten LIKE '%$hoTen%'";
        }
        
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa giảng viên theo mã giảng viên
    function giangvien_del($maGiangVien) {
        $sql = "DELETE FROM Giangvien WHERE ma_giang_vien='$maGiangVien'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin giảng viên
    function giangvien_upd($maGiangVien, $hoTen, $email, $soDienThoai, $chuyenNganh) {
        $sql = "UPDATE Giangvien SET ho_ten='$hoTen', email='$email', so_dien_thoai='$soDienThoai', chuyen_nganh=N'$chuyenNganh'
                WHERE ma_giang_vien='$maGiangVien'";
        return mysqli_query($this->con, $sql);
    }
}
?>
