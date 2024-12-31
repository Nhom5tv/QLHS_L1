<?php
class Diemtonghop_m extends connectDB {

    // Lấy tất cả dữ liệu từ bảng diem_chi_tiet
    public function getAllDetailedScores() {
        // Cập nhật truy vấn SQL để lấy trường lan_thi
        $query = "SELECT ma_dct, diem_chuyen_can, diem_giua_ky, diem_cuoi_ky, lan_thi FROM diem_chi_tiet";
        $result = $this->con->query($query);
        return $result;
    }
    
   

    // Xóa tất cả dữ liệu trong bảng diem_tong_hop (để làm mới)
    public function clearDiemTongHop() {
        $query = "DELETE FROM diem_tong_hop";
        return $this->con->query($query);
    }

    // Chèn dữ liệu vào bảng diem_tong_hop
    public function insertDiemTongHop($ma_dct, $diem_he_10, $diem_he_4, $diem_chu, $danh_gia) {
        $query = "INSERT INTO diem_tong_hop (ma_dct, diem_he_10, diem_he_4, diem_chu, danh_gia) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("iddss", $ma_dct, $diem_he_10, $diem_he_4, $diem_chu, $danh_gia);
        return $stmt->execute();
    }

    // Lấy dữ liệu từ bảng diem_tong_hop kết hợp với thông tin từ bảng diem_chi_tiet
    public function getAllSummaryScores($id) {
        $query = "SELECT 
                    dt.ma_dct, 
                    mh.ma_mon,
                    mh.ten_mon,
                    mh.so_tin_chi,
                    dc.lan_hoc, 
                    dc.lan_thi, 
                    dt.diem_he_10, 
                    dt.diem_he_4, 
                    dt.diem_chu, 
                    dt.danh_gia,
                    dt.ghi_chu
                  FROM diem_tong_hop dt
                  JOIN diem_chi_tiet dc ON dt.ma_dct = dc.ma_dct
                  JOIN lop l ON l.ma_lop = dc.ma_lop
                  JOIN mon_hoc mh ON mh.ma_mon = l.ma_mon
                  Where ma_sinh_vien = '$id'";

        $result = mysqli_query($this->con, $query);
        return $result;
    }
}
?>
