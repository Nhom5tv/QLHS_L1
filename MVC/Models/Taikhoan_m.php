<!-- truy van sql -->
<?php 
class Taikhoan_m extends connectDB{
    function taikhoan_ins($email,$mk,$quyen){
        $sql="INSERT INTO taikhoan (Email, Matkhau, Quyen)  VALUES ('$email','$mk',N'$quyen')";
        return mysqli_query($this->con,$sql);
    }
     // hàm thêm mới

    function checktrungemail($email){
        $sql="SELECT * FROM taikhoan WHERE Email='$email'";
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
            $sql = "SELECT * FROM taikhoan";
        } 
        // trường hợp sửa dl
        elseif (empty($quyen)) {
            $sql = "SELECT * FROM taikhoan WHERE Id = '$id'";
        }
        // trường hợp tìm kiếm
         else {
            $sql = "SELECT * FROM taikhoan WHERE Id LIKE '%$id%' AND Quyen LIKE '%$quyen%'";
        }
       
        return mysqli_query($this->con,$sql);
    }
    
    function taikhoan_del($id){
        $sql="DELETE FROM taikhoan WHERE Id='$id'";
        return mysqli_query($this->con,$sql);
    }
    function taikhoan_upd($id,$email,$quyen,$mk){
        $sql="UPDATE taikhoan SET Email='$email',quyen='$quyen',Matkhau='$mk'
        WHERE Id='$id'";
        return mysqli_query($this->con,$sql);
    }
    
    
}
?>
