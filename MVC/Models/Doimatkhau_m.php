<?php
class Doimatkhau_m extends connectDB{
    function doimatkhau($email,$mk){
        $sql="UPDATE taikhoan SET Matkhau='$mk'
        WHERE Email='$email'";
        echo $sql;
        return mysqli_query($this->con,$sql);
    }
}


?>