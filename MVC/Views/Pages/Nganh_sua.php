<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Ngành</title>
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
        .input-box, .input-group {
            margin-bottom: 20px; /* Tăng khoảng cách giữa các trường */
        }
        .input-box label,
        .input-group label {
            font-weight: bold;
            color: #333;
            font-size: 18px; /* Tăng kích thước chữ label */
            display: block;
            margin-bottom: 10px;
        }
        .input-box input,
        .input-group select {
            width: 100%;
            padding: 15px; /* Tăng padding của input */
            font-size: 16px; /* Tăng kích thước chữ input */
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .input-box input:focus,
        .input-group select:focus {
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
    <form method="post" action="http://localhost/qlhs/DSNganh/suadl">
        <div class="form-container">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <h2>Sửa Thông Tin Ngành</h2>
            
            <!-- Mã Ngành -->
            <div class="input-box">
                <label>Mã Ngành</label>
                <input type="text" name="txtMaNganh" value="<?php echo $row['ma_nganh']; ?>" readonly>
            </div>

            <!-- Tên Ngành -->
            <div class="input-box">
                <label>Tên Ngành</label>
                <input type="text" name="txtTenNganh" value="<?php echo $row['ten_nganh']; ?>" required>
            </div>

            <!-- Chọn Khoa -->
            <div class="input-group">
                <label for="ma_khoa">Chọn Khoa</label>
                <select name="txtMaKhoa" id="ma_khoa" required>
                    <option value="">Chọn khoa</option>
                    <?php 
                    if (isset($data['khoaList']) && mysqli_num_rows($data['khoaList']) > 0) {
                        while ($r1 = mysqli_fetch_array($data['khoaList'])) {
                            $selected = ($r1['ma_khoa'] == $row['ma_khoa']) ? 'selected' : '';
                            echo '<option value="' . $r1['ma_khoa'] . '" ' . $selected . '>' . $r1['ten_khoa'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Thời Gian Đào Tạo -->
            <div class="input-box">
                <label>Thời Gian Đào Tạo</label>
                <input type="text" name="txtThoiGianDaoTao" value="<?php echo $row['thoi_gian_dao_tao']; ?>" required>
            </div>

            <!-- Bậc Đào Tạo -->
            <div class="input-box">
                <label>Bậc Đào Tạo</label>
                <input type="text" name="txtBacDaoTao" value="<?php echo $row['bac_dao_tao']; ?>" required>
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
