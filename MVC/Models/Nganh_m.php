<?php 
class Nganh_m extends connectDB{
    // Hàm thêm mới giang viên
    function nganh_ins($maNganh,$tenNganh, $maKhoa,$thoiGianDaoTao,$bacDaoTao) {
        // Chuẩn bị câu SQL để thêm giang viên
        $sql = "INSERT INTO nganh (ma_nganh, ten_nganh, ma_khoa, thoi_gian_dao_tao, bac_dao_tao)
                VALUES ('$maNganh', '$tenNganh', '$maKhoa', '$thoiGianDaoTao', '$bacDaoTao')";
                 return mysqli_query($this->con, $sql);
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
    
    
    

    // Hàm kiểm tra trùng mã giang viên
    function checktrungmanganh($maNganh){
        $sql = "SELECT * FROM nganh WHERE ma_nganh='$maNganh'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;
        }
        return $kq;
    }

    // Hàm tìm kiếm giang viên theo mã giang viên và họ tên
    function nganh_find($maNganh, $tenNganh){
        if (empty($maNganh) && empty($tenNganh)) {
            $sql = "SELECT * FROM nganh";
        } elseif (empty($tenNganh)) {
            $sql = "SELECT * FROM nganh WHERE ma_nganh = '$maNganh'";
        } else {
            $sql = "SELECT * FROM nganh WHERE ma_nganh LIKE '%$maNganh%' AND ten_nganh LIKE '%$tenNganh%'";
        }
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa giang viên
    function nganh_del($maNganh){
        $sql = "DELETE FROM nganh WHERE ma_nganh='$maNganh'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin giang viên
    function nganh_upd($maNganh,$tenNganh,$maKhoa, $thoiGianDaoTao, $bacDaoTao){
        $sql = "UPDATE nganh 
                SET ten_nganh='$tenNganh', ma_khoa='$maKhoa', thoi_gian_dao_tao='$thoiGianDaoTao', bac_dao_tao='$bacDaoTao'
                WHERE ma_nganh='$maNganh'";
        return mysqli_query($this->con, $sql);
    }
}
?>
