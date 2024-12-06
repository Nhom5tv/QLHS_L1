<?php
class Dangky_m extends connectDB{
    function dangky_ins($email,$mk){
        $sql="INSERT INTO taikhoan (Email, Matkhau, Quyen)  VALUES ('$email','$mk',N'Khách hàng')";
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
    function getId($email){
        $sql = "SELECT Id FROM taikhoan Where Email='$email'";
        return  mysqli_query($this->con,$sql); 
        
    }
}
?>