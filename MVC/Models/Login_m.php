<?php
class Login_m extends connectDB{
    function login($ten_dang_nhap){
        $sql = "SELECT * FROM tai_khoan WHERE ten_dang_nhap = '$ten_dang_nhap'";

        return mysqli_query($this->con,$sql);
    }
}
?>