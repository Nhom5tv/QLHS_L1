<?php 
class Taikhoan_m extends connectDB{
    function taikhoan_ins($ma_tai_khoan,$tendn,$mk,$email,$quyen){
        $sql="INSERT INTO tai_khoan (ma_tai_khoan, ten_dang_nhap, mat_khau, email, phan_quyen)  VALUES ('$ma_tai_khoan','$tendn','$mk','$email',N'$quyen')";
        return mysqli_query($this->con,$sql);
    }
     // hàm thêm mới

    function checktrungemail($email){
        $sql="SELECT * FROM tai_khoan WHERE Email='$email'";
        $dl=mysqli_query($this->con,$sql);
        $kq=false;
        if(mysqli_num_rows($dl)>0){
            $kq=true;
        }
        return $kq;
    }
    function taikhoan_find($id,$quyen){
        // trường hợp loaddata
        if (empty($id) && empty($quyen)) {
            $sql = "SELECT * FROM tai_khoan";
        } 
        // trường hợp sửa dl
        elseif (empty($quyen)) {
            $sql = "SELECT * FROM tai_khoan WHERE ma_tai_khoan = '$id'";
        }
        // trường hợp tìm kiếm
         else {
            $sql = "SELECT * FROM tai_khoan WHERE ma_tai_khoan LIKE '%$id%' AND phan_quyen LIKE '%$quyen%'";
        }
        
        return mysqli_query($this->con, $sql);
    }
    
    function taikhoan_del($id){
        $sql="DELETE FROM tai_khoan WHERE ma_tai_khoan ='$id'";
        return mysqli_query($this->con,$sql);
    }
    function taikhoan_upd($id,$tendn,$mk,$email,$quyen){
        $sql="UPDATE tai_khoan SET ten_dang_nhap='$tendn', mat_khau='$mk',email='$email',phan_quyen='$quyen'
        WHERE ma_tai_khoan ='$id'";
        return mysqli_query($this->con,$sql);
    }
}
?>
