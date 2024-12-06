<?php
class Login_m extends connectDB{
    function login($email){
        $sql = "SELECT * FROM taikhoan WHERE Email = '$email'";

        return mysqli_query($this->con,$sql);
    }
    function doanhthungay(){
        $sql="SELECT Ngaydathang,
       SUM(amount_paid) AS TongTienTrongNgay
        FROM orders
        GROUP BY Ngaydathang;";
       
        
        return mysqli_query($this->con,$sql);
    }
}
?>