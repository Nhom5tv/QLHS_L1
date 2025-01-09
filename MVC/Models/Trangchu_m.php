<?php 
class Trangchu_m extends connectDB {
    // Thống kê loại học viên dựa trên điểm GPA
    function thongkeloaihocvien() {
        $sql = "SELECT 
                    CASE
                        WHEN diem_he_10 >= 8 THEN 'Xuất sắc'
                        WHEN diem_he_10 >= 6.5 THEN 'Khá'
                        WHEN diem_he_10 >= 5 THEN 'Trung bình'
                        ELSE 'Kém'
                    END AS PhanLoai,
                    COUNT(*) AS SoLuong
                FROM diem_tong_hop
                GROUP BY PhanLoai;";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            error_log("Lỗi truy vấn SQL: " . mysqli_error($this->con));
            return [];
        }
    
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    
        return $data; // Trả về mảng dữ liệu
    }

    // Đếm tổng số giảng viên
    function thongkegiangvien() {
        $sql = "SELECT COUNT(*) AS TongGiangVien FROM giang_vien;";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);

        return $data['TongGiangVien'] ?? 0;
    }
}
?>
