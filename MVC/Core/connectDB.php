<?php
class connectDB {
    public $con;
    
    // Constructor để kết nối cơ sở dữ liệu
    function __construct() {
        // Kết nối cơ sở dữ liệu
        $this->con = mysqli_connect('localhost', 'root', '', 'qlhssv');
        
        // Kiểm tra kết nối
        if (mysqli_connect_errno()) {
            echo "Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error();
            exit();
        }

        // Đặt charset UTF-8 cho kết nối
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
}
?>
