<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .quaylai {
    text-align: center;
    justify-content: center;
    padding-top: 5px;
}
    </style>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form id="myForm" method="post" action="./qldkmonhoc/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm Môn Học</h2>
            <form action="#">

                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <?php
                   // Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlhssv"; // Thay bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
                   $sql = "SELECT ma_mon FROM mon_hoc";
                   $result = $conn->query($sql);
                   ?>
                   <!-- Tạo dropdown -->
<select name="txtmamon" required>
    <option value="">-- Chọn mã môn --</option>
    <?php
    if ($result->num_rows > 0) {
        // Lặp qua kết quả truy vấn và tạo các option
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ma_mon'] . '">' . $row['ma_mon'] . '</option>';
        }
    } else {
        echo '<option value="">Không có dữ liệu</option>';
    }
    ?>
</select>
                    <label>Mã Môn Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmasinhvien" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']?>">
                    <label>Mã Sinh Viên</label>
                </div>
                <!-- <div class="input-box">
                    
                    <input type="text" name="txtmalop" value="<?php if(isset($data['ma_lop'])) echo $data['ma_lop']?>">
                    <label>Mã Lớp</label>
                </div> -->
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>

                    <input type="text" name="txtlichhocdukien" value="<?php if(isset($data['lich_hoc_du_kien'])) echo $data['lich_hoc_du_kien'] ?>" />

                    <label>Lịch Học Dự Kiến</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <!-- <input type="text" required name="txttrangthai" value=""> -->
                    <select required name="txttrangthai" class="dd4">
                    <option  value="Chọn Trạng Thái">Chọn Trạng Thái</option>
                      <option  value="Còn Chỗ Trống">Còn Chỗ Trống</option>
                      <option  value="Đã Đủ Sinh Viên">Đã Đủ Sinh Viên</option>
                      <option  value="Đã Đóng Đăng Ký">Đã Đóng Đăng Ký</option>          
                    </select>
                    
                </div>
                
               
                </div>
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/qlhs/dsmonhoc">Quay lại</a>
                </div>
                
                
                
            
        </div>
        </div>
    </form>
    
</body>
</html>