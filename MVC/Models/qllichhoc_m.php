<!-- truy van sql -->
<?php 
class qllichhoc_m extends connectDB{
    function lichhoc_ins($ma_mon_hoc,$so_luong,$so_luong_toi_da,$lich_hoc,$trang_thai){
        $sql="INSERT INTO lich_hoc(ma_mon_hoc,so_luong,so_luong_toi_da,lich_hoc,trang_thai) VALUES ('$ma_mon_hoc','$so_luong','$so_luong_toi_da','$lich_hoc','$trang_thai')";
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
    function lichhoc_cls(){
        $sql="UPDATE lich_hoc
SET trang_thai = 'Đóng'
WHERE trang_thai = 'Đang Mở';
";
        return mysqli_query($this->con,$sql);
    }
    function capNhatSoLuong($ma_mon_hoc) {
    // Câu lệnh SQL để cập nhật số lượng
    $sql = "UPDATE lich_hoc 
            SET so_luong = so_luong_toi_da - (
                SELECT COUNT(*) 
                FROM dang_ky_mon_hoc 
                WHERE ma_mon = '$ma_mon_hoc' AND trang_thai = 'Đang Chờ duyệt'
            )
            WHERE ma_mon_hoc = '$ma_mon_hoc'";

    // Thực thi câu lệnh SQL
    return mysqli_query($this->con, $sql);
}
    function lichhoc_find($ma_mon_hoc,$lich_hoc){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
            $sql = "SELECT * FROM lich_hoc WHERE ma_mon_hoc LIKE '%$ma_mon_hoc%' AND lich_hoc LIKE '%$lich_hoc%'";
       
       
        return mysqli_query($this->con,$sql);
    }

    function lichhoc_findsua($id_lich_hoc){
        $sql1 = "SELECT * FROM lich_hoc WHERE id_lich_hoc = '$id_lich_hoc'";
       
       
        return mysqli_query($this->con,$sql1);
     }
    
    function lichhoc_del($id_lich_hoc){
        $sql="DELETE FROM lich_hoc WHERE id_lich_hoc ='$id_lich_hoc'";
        return mysqli_query($this->con,$sql);
    }
    function lichhoc_upd($id_lich_hoc,$ma_mon_hoc,$so_luong,$so_luong_toi_da,$lich_hoc,$trang_thai){
        $sql="UPDATE lich_hoc SET ma_mon_hoc= '$ma_mon_hoc' , so_luong= '$so_luong' , so_luong_toi_da= '$so_luong_toi_da' , lich_hoc= '$lich_hoc', trang_thai= N'$trang_thai'  
        WHERE id_lich_hoc= $id_lich_hoc";
        return mysqli_query($this->con,$sql);
    }
    
}
?>