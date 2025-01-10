<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Khoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .form-container {
            max-width: 900px; /* Tăng chiều rộng form */
            margin: auto;
            padding: 30px; /* Tăng padding */
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Đổ bóng lớn hơn */
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            font-size: 28px; /* Tăng kích thước tiêu đề */
            margin-bottom: 30px;
        }
        .input-box {
            margin-bottom: 20px; /* Tăng khoảng cách giữa các trường */
        }
        .input-box label {
            font-weight: bold;
            color: #333;
            font-size: 18px; /* Tăng kích thước chữ label */
            display: block;
            margin-bottom: 10px;
        }
        .input-box input {
            width: 100%;
            padding: 15px; /* Tăng padding của input */
            font-size: 16px; /* Tăng kích thước chữ input */
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .input-box input:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            display: block;
            width: 100%;
            padding: 15px; /* Tăng chiều cao nút */
            background-color: #007bff;
            color: white;
            font-size: 18px; /* Tăng font chữ nút */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSKhoa/suadl">
        <div class="form-container">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <h2>Sửa Thông Tin Khoa</h2>

            <!-- Mã Khoa -->
            <div class="input-box">
                <label>Mã Khoa</label>
                <input type="text" name="txtMaKhoa" value="<?php echo $row['ma_khoa']; ?>" readonly>
            </div>

            <!-- Tên Khoa -->
            <div class="input-box">
                <label>Tên Khoa</label>
                <input type="text" name="txtTenKhoa" value="<?php echo $row['ten_khoa']; ?>" required>
            </div>

            <!-- Liên Hệ -->
            <div class="input-box">
                <label>Liên Hệ</label>
                <input type="text" name="txtLienHe" value="<?php echo $row['lien_he']; ?>" required>
            </div>

            <!-- Ngày Thành Lập -->
            <div class="input-box">
                <label>Ngày Thành Lập</label>
                <input type="date" name="txtNgayThanhLap" value="<?php echo $row['ngay_thanh_lap']; ?>" required>
            </div>

            <!-- Tiền Mỗi Tín Chỉ -->
            <div class="input-box">
                <label>Tiền Mỗi Tín Chỉ</label>
                <input type="text" name="txtTienMoiTinChi" value="<?php echo $row['tien_moi_tin_chi']; ?>" required>
            </div>

            <!-- Nút Lưu -->
            <button type="submit" class="btn" name="btnLuu">Lưu</button>
            <?php
                }
            }
            ?>
        </div>
    </form>
</body>
</html>
