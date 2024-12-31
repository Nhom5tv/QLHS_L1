<!-- truy van sql -->
<?php 
class qllophoc extends connectDB{
    function lophoc_ins($ma_mon,$hoc_ky,$ma_giang_vien,$lich_hoc){
        $sql="INSERT INTO lop(ma_mon,hoc_ky,ma_giang_vien,lich_hoc) VALUES ('$ma_mon','$hoc_ky','$ma_giang_vien','$lich_hoc')";
         return mysqli_query($this->con,$sql);
        
    }
    function capNhatMaLopVaoDangKy($ma_lop, $ma_mon) {
        $sql = "UPDATE dang_ky_mon_hoc 
                SET ma_lop = '$ma_lop' , trang_thai = N'Đã Duyệt'
                WHERE ma_mon = '$ma_mon' AND trang_thai = N'Đang Chờ Duyệt'";
        return mysqli_query($this->con, $sql);
    }
    function themDiemChiTiet($ma_lop, $ma_mon) {
        // Lấy danh sách các sinh viên từ bảng dang_ky_mon_hoc có trạng thái "Đã Duyệt"
        $sql_select = "SELECT ma_sinh_vien 
                       FROM dang_ky_mon_hoc 
                       WHERE ma_lop = '$ma_lop' AND ma_mon = '$ma_mon' AND trang_thai = N'Đã Duyệt'";
        $result_select = mysqli_query($this->con, $sql_select);
    
        if ($result_select && mysqli_num_rows($result_select) > 0) {
            while ($row = mysqli_fetch_assoc($result_select)) {
                $ma_sinh_vien = $row['ma_sinh_vien'];
    
                // Kiểm tra nếu bản ghi đã tồn tại trong diem_chi_tiet
                $sql_check = "SELECT * FROM diem_chi_tiet 
                              WHERE ma_lop = '$ma_lop' AND ma_sinh_vien = '$ma_sinh_vien'";
                $result_check = mysqli_query($this->con, $sql_check);
    
                if (mysqli_num_rows($result_check) == 0) {
                    // Chèn dữ liệu nếu chưa tồn tại
                    $sql_insert = "INSERT INTO diem_chi_tiet (ma_lop, ma_sinh_vien, lan_hoc, lan_thi, diem_chuyen_can, diem_giua_ky, diem_cuoi_ky)
                                   VALUES ('$ma_lop', '$ma_sinh_vien', 1, 1, 0, 0, 0)";
                    mysqli_query($this->con, $sql_insert);
                }
            }
            return true; // Trả về true nếu thành công
        }
    
        return false; // Trả về false nếu không có bản ghi nào được chèn
    }
    
    function getLastInsertedId() {
        return mysqli_insert_id($this->con);
    }
    // function checktrungmamon($manhanvien){
    //     $sql="SELECT * FROM qlnhanvien WHERE Manhanvien='$manhanvien'";
    //     $dl=mysqli_query($this->con,$sql);
    //     $kq=false;
    //     if(mysqli_num_rows($dl)>0){
    //         $kq=true;
    //     }
    //     return $kq;
    // }
    function lophoc_find($ma_mon,$ma_giang_vien){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
            $sql = "SELECT * FROM lop WHERE ma_mon LIKE '%$ma_mon%' AND ma_giang_vien LIKE '%$ma_giang_vien%'";
       
       
        return mysqli_query($this->con,$sql);
    }

    function lophoc_findsua($ma_lop){
        $sql1 = "SELECT * FROM lop WHERE ma_lop = '$ma_lop'";
       
       
        return mysqli_query($this->con,$sql1);
     }
    
    function lophoc_del($ma_lop){
        $sql="DELETE FROM lop WHERE ma_lop ='$ma_lop'";
        return mysqli_query($this->con,$sql);
    }
    function lophoc_upd($ma_lop,$ma_mon,$hoc_ky,$ma_giang_vien,$lich_hoc){
        $sql="UPDATE lop SET ma_mon= '$ma_mon' , hoc_ky= '$hoc_ky' , ma_giang_vien= '$ma_giang_vien' , lich_hoc= N'$lich_hoc'  
        WHERE ma_lop='$ma_lop'";
        return mysqli_query($this->con,$sql);
    }
    
}
?>