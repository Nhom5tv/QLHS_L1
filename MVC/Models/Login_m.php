<?php
class Login_m extends connectDB{
    function login($email){
        $sql = "SELECT * FROM tai_khoan WHERE email = '$email'";

        return mysqli_query($this->con,$sql);
    }
}
?>