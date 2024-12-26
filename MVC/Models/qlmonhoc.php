<!-- truy van sql -->
<?php 
class qlmonhoc extends connectDB{
    function monhoc_ins($ma_mon,$ma_sinh_vien,$lich_hoc_du_kien,$trang_thai){
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
    function monhoc_find($ma_mon,$ma_sinh_vien){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
            $sql = "SELECT * FROM dang_ky_mon_hoc WHERE ma_mon LIKE '%$ma_mon%' AND ma_sinh_vien LIKE '%$ma_sinh_vien%'";
       
       
        return mysqli_query($this->con,$sql);
    }
    
    function monhoc_del($ma_dang_ky){
        $sql="DELETE FROM dang_ky_mon_hoc WHERE ma_dang_ky ='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    function monhoc_upd($ma_dang_ky,$ma_mon,$ma_sinh_vien,$ma_lop,$lich_hoc_du_kien,$trang_thai){
        $sql="UPDATE dang_ky_mon_hoc SET ma_mon= '$ma_mon' , ma_sinh_vien= '$ma_sinh_vien' , ma_lop= '$ma_lop' , lich_hoc_du_kien= '$lich_hoc_du_kien' , trang_thai= N'$trang_thai'  
        WHERE ma_dang_ky='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    
}
?>