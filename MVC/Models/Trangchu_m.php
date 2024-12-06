<?php
class Trangchu_m extends connectDB{
    function doanhthungay(){
        $sql="SELECT Ngaydathang,
       SUM(amount_paid) AS TongTienTrongNgay
        FROM orders
        WHERE Trangthaidonhang = 'Thành công'
        GROUP BY Ngaydathang;";
        
        return mysqli_query($this->con,$sql);
    }
}

?>