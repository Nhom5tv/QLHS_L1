<?php 
class Diemtheomon_m extends connectDB {
   
    // Hàm thêm mới điểm chi tiết
    function diemchitiet_ins($ma_lop, $ma_sinh_vien, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky) {
        $sql = "INSERT INTO diem_chi_tiet (ma_lop, ma_sinh_vien, lan_hoc, lan_thi, diem_chuyen_can, diem_giua_ky, diem_cuoi_ky) 
                VALUES ('$ma_lop', '$ma_sinh_vien', '$lan_hoc', '$lan_thi', '$diem_chuyen_can', '$diem_giua_ky', '$diem_cuoi_ky')";
                echo $sql;
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật điểm chi tiết
    function diemchitiet_upd($ma_dct, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky) {
        $sql = "UPDATE diem_chi_tiet 
                SET lan_hoc='$lan_hoc', lan_thi='$lan_thi', diem_chuyen_can='$diem_chuyen_can', diem_giua_ky='$diem_giua_ky', diem_cuoi_ky='$diem_cuoi_ky' 
                WHERE ma_dct='$ma_dct'";
                echo $sql;
        return mysqli_query($this->con, $sql);
    }

    // Hàm lấy danh sách điểm chi tiết
    function getAllDiemChiTiet($ma_sinh_vien) {
        $sql = "SELECT * FROM diem_chi_tiet where ma_sinh_vien = '$ma_sinh_vien'";
        return mysqli_query($this->con, $sql);
    }

    // // Hàm xóa điểm chi tiết
    // function diemchitiet_del($ma_dct) {
    //     $sql = "DELETE FROM diem_chi_tiet WHERE ma_dct='$ma_dct'";
    //     return mysqli_query($this->con, $sql);
    // }

    function diemchitiet_find($ma_dct) {
        $sql = "SELECT * FROM diem_chi_tiet WHERE ma_dct = '$ma_dct'";
        return mysqli_query($this->con, $sql);
    }
}
?>
