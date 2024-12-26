<?php 
class Khoa_m extends connectDB{
    // Hàm thêm mới giang viên
    function khoa_ins($maKhoa,$tenKhoa, $lienHe,$ngayThanhLap,$tienMoiTinChi) {
        // Chuẩn bị câu SQL để thêm giang viên
        $sql = "INSERT INTO khoa (ma_khoa, ten_khoa, lien_he,ngay_thanh_lap, tien_moi_tin_chi)
                VALUES ('$maKhoa', '$tenKhoa', '$lienHe', '$ngayThanhLap', '$tienMoiTinChi')";
                 return mysqli_query($this->con, $sql);
    }
    // Hàm kiểm tra trùng mã giang viên
    function checktrungmaKhoa($maKhoa){
        $sql = "SELECT * FROM khoa WHERE ma_khoa='$maKhoa'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;
        }
        return $kq;
    }

    // Hàm tìm kiếm giang viên theo mã giang viên và họ tên
    function khoa_find($maKhoa, $tenKhoa){
        if (empty($maKhoa) && empty($tenKhoa)) {
            $sql = "SELECT * FROM khoa";
        } elseif (empty($tenKhoa)) {
            $sql = "SELECT * FROM khoa WHERE ma_khoa = '$maKhoa'";
        } else {
            $sql = "SELECT * FROM khoa WHERE ma_khoa LIKE '%$maKhoa%' AND ten_khoa LIKE '%$tenKhoa%'";
        }
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa giang viên
    function khoa_del($maKhoa){
        $sql = "DELETE FROM khoa WHERE ma_khoa='$maKhoa'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin giang viên
    function khoa_upd($maKhoa,$tenKhoa,$lienHe, $ngayThanhLap, $tienMoiTinChi){
        $sql = "UPDATE khoa 
                SET ten_khoa='$tenKhoa', lien_he='$lienHe',ngay_thanh_lap='$ngayThanhLap', tien_moi_tin_chi='$tienMoiTinChi'
                WHERE ma_khoa='$maKhoa'";
        return mysqli_query($this->con, $sql);
    }
}
?>
