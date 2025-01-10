<!-- truy van sql -->
<?php 
class qlmonhoc extends connectDB{
    function qldkmonhoc_ins($ma_mon,$ma_sinh_vien,$lich_hoc_du_kien,$trang_thai){
        $sql="INSERT INTO dang_ky_mon_hoc(ma_mon,ma_sinh_vien,lich_hoc_du_kien,trang_thai) VALUES ('$ma_mon','$ma_sinh_vien','$lich_hoc_du_kien',N'$trang_thai')";
         return mysqli_query($this->con,$sql);
        
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
    function capNhatSoLuong($ma_mon) {
        // Câu lệnh SQL để cập nhật số lượng
        $sql = "UPDATE lich_hoc 
                SET so_luong = so_luong_toi_da - (
                    SELECT COUNT(*) 
                    FROM dang_ky_mon_hoc 
                    WHERE ma_mon = '$ma_mon' AND trang_thai = N'Đang Chờ duyệt'
                )
                WHERE ma_mon_hoc = '$ma_mon'";
    
        // Thực thi câu lệnh SQL
        return mysqli_query($this->con, $sql);
    }
    function qldkmonhoc_find($ma_mon,$ma_sinh_vien){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
            $sql = "SELECT * FROM dang_ky_mon_hoc WHERE ma_mon LIKE '%$ma_mon%' AND ma_sinh_vien LIKE '%$ma_sinh_vien%'";
       
       
        return mysqli_query($this->con,$sql);
    }
    function qldkmonhoc_findsua($ma_dang_ky){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
            $sql = "SELECT * FROM dang_ky_mon_hoc WHERE ma_dang_ky ='$ma_dang_ky'";
       
       
        return mysqli_query($this->con,$sql);
    }
    function qldkmonhoc_cnl(){
        $sql="UPDATE dang_ky_mon_hoc
SET trang_thai = 'Huỷ'
WHERE trang_thai = 'Đang Chờ Duyệt';
";
        return mysqli_query($this->con,$sql);
    }
    
    function qldkmonhoc_del($ma_dang_ky){
        $sql="DELETE FROM dang_ky_mon_hoc WHERE ma_dang_ky ='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    function qldkmonhoc_upd($ma_dang_ky,$ma_mon,$ma_sinh_vien,$ma_lop,$lich_hoc_du_kien,$trang_thai){
        $sql="UPDATE dang_ky_mon_hoc SET ma_mon= '$ma_mon' , ma_sinh_vien= '$ma_sinh_vien' , ma_lop= '$ma_lop' , lich_hoc_du_kien= '$lich_hoc_du_kien' , trang_thai= N'$trang_thai'  
        WHERE ma_dang_ky='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    
}
?>