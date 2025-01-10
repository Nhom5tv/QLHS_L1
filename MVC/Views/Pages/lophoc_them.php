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
    <form id="myForm" method="post" action="./lophoc/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm Lớp Học</h2>
            <form action="#">
            <label>Mã Môn Học</label>
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
                   $sql = "SELECT ma_mon
FROM mon_hoc
WHERE ma_mon IN (
    SELECT ma_mon
    FROM dang_ky_mon_hoc
    WHERE trang_thai = 'Đang Chờ Duyệt')";
                   $result = $conn->query($sql);
                   ?>
                   <!-- Tạo dropdown -->
<select name="txtmanganh" required>
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

                   
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txthocky" value="<?php if(isset($data['hoc_ky'])) echo $data['hoc_ky']?>">
                    <label>Học Kỳ</label>
                </div>
                <label>Mã Giảng Viên</label>
                <div class="input-box">
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
                   $sql = "SELECT ma_giang_vien from giang_vien";
                   $result = $conn->query($sql);
                   ?>
                   <!-- Tạo dropdown -->
<select name="txtmagiangvien" required>
    <option value="">-- Chọn mã giảng viên --</option>
    <?php
    if ($result->num_rows > 0) {
        // Lặp qua kết quả truy vấn và tạo các option
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ma_giang_vien'] . '">' . $row['ma_giang_vien'] . '</option>';
        }
    } else {
        echo '<option value="">Không có dữ liệu</option>';
    }
    ?>
</select>
                   
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>

                    <input type="text" name="txtlichhoc" value="<?php if(isset($data['lich_hoc'])) echo $data['lich_hoc'] ?>" />

                    <label>Lịch Học</label>
                </div>
                <label>Trạng thái lớp học</label>
                <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang mở" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang mở') echo 'selected'; ?>>Đang Mở</option>
                        <option value="Đã kết thúc" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đã kết thúc') echo 'selected'; ?>>Đóng</option>
                        </select>
</div>
<button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/QLHS/dslophoc">Quay lại</a>
                </div>
               
                </div>
             
                
                
                
            
        </div>
        </div>
    </form>
    
</body>
</html>