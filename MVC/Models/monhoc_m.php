<!-- truy van sql -->
<?php 
class Monhoc_m extends connectDB {
    // Hàm thêm mới môn học
    function monhoc_ins($ma_mon, $ten_mon, $ma_nganh, $so_tin_chi, $so_tiet) {
        $sql = "INSERT INTO mon_hoc (ma_mon, ten_mon, ma_nganh, so_tin_chi, so_tiet) 
                VALUES ('$ma_mon', N'$ten_mon',$ma_nganh, $so_tin_chi, $so_tiet)";
        return mysqli_query($this->con, $sql);
    }

    // Hàm kiểm tra mã môn học có bị trùng không
    function checktrungmamon($ma_mon) {
        $sql = "SELECT * FROM mon_hoc WHERE ma_mon = '$ma_mon'";
        $dl=mysqli_query($this->con,$sql);
        $kq=false;
        if(mysqli_num_rows($dl)>0){
            $kq=true;
        }
        return $kq;
    }

    // Hàm tìm kiếm hoặc lấy danh sách môn học
    function monhoc_find($ma_mon, $ten_mon) {
       // trường hợp loaddata
        if (empty($ma_mon) && empty($ten_mon)) {
            $sql = "SELECT * FROM mon_hoc";
        } 
        // trường hợp sửa dl
        elseif (empty($ten_mon)) {
            $sql = "SELECT * FROM mon_hoc WHERE ma_mon LIKE '%$ma_mon%'";
        }
        // trường hợp tìm kiếm
         else {
            $sql = "SELECT * FROM mon_hoc WHERE ma_mon LIKE '%$ma_mon%' AND ten_mon LIKE '%$ten_mon%'";
        }
       
        return mysqli_query($this->con,$sql);
    }

    // Hàm xóa môn học
    function monhoc_del($ma_mon) {
        $sql = "DELETE FROM mon_hoc WHERE ma_mon = '$ma_mon'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin môn học
    function monhoc_upd($ma_mon, $ten_mon, $ma_nganh, $so_tin_chi, $so_tiet){
        $sql="UPDATE mon_hoc SET ten_mon='$ten_mon', ma_nganh='$ma_nganh',so_tin_chi='$so_tin_chi',so_tiet='$so_tiet'
        WHERE ma_mon ='$ma_mon'";
        return mysqli_query($this->con,$sql);
    }
}
?>
