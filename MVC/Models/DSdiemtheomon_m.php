<?php 
class DSdiemtheomon_m extends connectDB {

    // function getClassesByLecturer($ma_giang_vien) {
    //     $sql = "SELECT * FROM lop WHERE ma_giang_vien = '$ma_giang_vien'";
    //     $result = mysqli_query($this->con, $sql);
    //     // Kiểm tra nếu có kết quả
    //     if (!$result) {
    //         echo "Lỗi truy vấn: " . mysqli_error($this->con);
    //         return [];
    //     }

    //     return $result;
    // }
    function getClassesByLecturer($ma_giang_vien) {
        $sql = "SELECT ma_lop FROM lop WHERE ma_giang_vien = '$ma_giang_vien'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return null; // Nếu có lỗi, trả về mảng rỗng
        }
        return $result; // Trả về đối tượng mysqli_result
    }
    
    function getStudentScoresByClass($ma_lop) {
        $sql = "SELECT 
                    DISTINCT dct.ma_dct, 
                    dct.ma_sinh_vien, 
                    sv.ho_ten,
                    dct.lan_hoc,
                    dct.lan_thi,
                    dct.diem_chuyen_can,
                    dct.diem_giua_ky,
                    dct.diem_cuoi_ky
                FROM diem_chi_tiet dct
           
                JOIN sinh_vien sv ON dct.ma_sinh_vien = sv.ma_sinh_vien
                WHERE dct.ma_lop = '$ma_lop'";
        $result = mysqli_query($this->con, $sql);
        // Kiểm tra nếu có kết quả
        if (!$result) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return [];
        }
        return $result;
        
    }
   
    // // Hàm thêm mới điểm chi tiết
    // function diemtungmon_ins($ma_lop, $ma_sinh_vien, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky) {
    //     $sql = "INSERT INTO diem_chi_tiet (ma_lop, ma_sinh_vien, lan_hoc, lan_thi, diem_chuyen_can, diem_giua_ky, diem_cuoi_ky) 
    //             VALUES ('$ma_lop', '$ma_sinh_vien', '$lan_hoc', '$lan_thi', '$diem_chuyen_can', '$diem_giua_ky', '$diem_cuoi_ky')";
    //             echo $sql;
    //     return mysqli_query($this->con, $sql);
    // }

    // Hàm cập nhật điểm chi tiết
    function diemtungmon_upd($ma_dct, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky) {
        // Bước 1: Tìm dữ liệu cũ của bản ghi
        $sql_find = "SELECT * FROM diem_chi_tiet WHERE ma_dct = '$ma_dct'";
        $result_find = mysqli_query($this->con, $sql_find);
        
        if (!$result_find) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return false;
        }
    
        // Bước 2: Kiểm tra xem có kết quả không
        $data = mysqli_fetch_assoc($result_find);
        if (!$data) {
            echo "Không tìm thấy bản ghi";
            return false;
        }
    
        // Bước 3: Nếu lần thi là 2, cần sao chép dữ liệu hiện tại (để giữ nguyên dữ liệu cũ)
        if ($lan_thi == 2) {
            // Lưu bản sao dữ liệu vào bảng diem_chi_tiet (trước khi cập nhật)
            $sql_insert = "INSERT INTO diem_chi_tiet (ma_lop, ma_sinh_vien, lan_hoc, lan_thi, diem_chuyen_can, diem_giua_ky, diem_cuoi_ky) 
                           VALUES ('".$data['ma_lop']."', '".$data['ma_sinh_vien']."', '".$data['lan_hoc']."', '1', '".$data['diem_chuyen_can']."', '".$data['diem_giua_ky']."', '".$data['diem_cuoi_ky']."')";
            $result_insert = mysqli_query($this->con, $sql_insert);
            
            if (!$result_insert) {
                echo "Lỗi chèn bản sao: " . mysqli_error($this->con);
                return false;
            }
        }
    
        // Bước 4: Cập nhật thông tin lần thi mới (lan_thi = 2)
        $sql_update = "UPDATE diem_chi_tiet 
                       SET lan_hoc='$lan_hoc', lan_thi='$lan_thi', diem_chuyen_can='$diem_chuyen_can', diem_giua_ky='$diem_giua_ky', diem_cuoi_ky='$diem_cuoi_ky' 
                       WHERE ma_dct='$ma_dct'";
        $result_update = mysqli_query($this->con, $sql_update);
        
        if (!$result_update) {
            echo "Lỗi cập nhật dữ liệu: " . mysqli_error($this->con);
            return false;
        }
    
        return true;
    }

    // Hàm lấy danh sách điểm chi tiết
    // function getAlldiemtungmon() {
    //     $sql = "SELECT 
    //                 dct.ma_sinh_vien, 
    //                 sv.ho_ten,
    //                 dct.lan_hoc,
    //                 dct.lan_thi,
    //                 dct.diem_chuyen_can,
    //                 dct.diem_giua_ky,
    //                 dct.diem_cuoi_ky
    //             FROM diem_chi_tiet dct
    //             JOIN dang_ky_mon_hoc dk ON dk.ma_lop = dct.ma_lop
    //             JOIN sinh_vien sv ON dk.ma_sinh_vien = sv.ma_sinh_vien";
    //     return mysqli_query($this->con, $sql);
    // }

    // // Hàm xóa điểm chi tiết
    // function diemtungmon_del($ma_dct) {
    //     $sql = "DELETE FROM diem_chi_tiet WHERE ma_dct='$ma_dct'";
    //     return mysqli_query($this->con, $sql);
    // }

    // function diemtungmon_find($ma_dct) {
    //     $sql = "SELECT * FROM diem_chi_tiet WHERE ma_dct = '$ma_dct'";
    //     return mysqli_query($this->con, $sql);
    // }
    function diemtungmon_find($ma_lop, $ma_sinh_vien = null, $ho_ten = null ) {
        // Bắt đầu xây dựng câu SQL tìm kiếm
        $sql = "SELECT DISTINCT dct.ma_dct, 
                            dct.ma_sinh_vien, 
                            sv.ho_ten,
                            dct.lan_hoc,
                            dct.lan_thi,
                            dct.diem_chuyen_can,
                            dct.diem_giua_ky,
                            dct.diem_cuoi_ky
                FROM diem_chi_tiet dct
                JOIN sinh_vien sv ON dct.ma_sinh_vien = sv.ma_sinh_vien
                WHERE dct.ma_lop = '$ma_lop'";
    
        // Kiểm tra nếu có mã sinh viên thì thêm điều kiện tìm kiếm
        if ($ma_sinh_vien) {
            $sql .= " AND dct.ma_sinh_vien LIKE '%$ma_sinh_vien%'";
        }
    
        // Kiểm tra nếu có họ tên thì thêm điều kiện tìm kiếm
        if ($ho_ten) {
            $sql .= " AND sv.ho_ten LIKE '%$ho_ten%'";
        }
       
        // Thực thi truy vấn
        $result = mysqli_query($this->con, $sql);
    
        // Kiểm tra lỗi truy vấn
        if (!$result) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return [];
        }
    
        return $result; // Trả về kết quả tìm kiếm
    }
}
?>
