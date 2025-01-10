<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sửa Thông Tin Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .form-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .input-group input:focus,
        .input-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSSinhvien/suadl">
        <div class="form-container">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <h2>Sửa Thông Tin Sinh Viên</h2>
            <!-- Mã Sinh Viên -->
            <div class="input-group">
                <label>Mã Sinh Viên</label>
                <input type="text" name="txtMaSV" value="<?php echo $row['ma_sinh_vien']; ?>" readonly>
            </div>

            <!-- Mã Khoa -->
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

            <!-- Mã Ngành -->
            <div class="input-group">
                <label for="ma_nganh">Chọn Ngành</label>
                <select name="txtMaNganh" id="ma_nganh" required>
                    <option value="">Chọn ngành</option>
                    <?php 
                    if (isset($data['nganhList']) && mysqli_num_rows($data['nganhList']) > 0) {
                        while ($r1 = mysqli_fetch_array($data['nganhList'])) {
                            $selected = ($r1['ma_nganh'] == $row['ma_nganh']) ? 'selected' : '';
                            echo '<option value="' . $r1['ma_nganh'] . '" ' . $selected . '>' . $r1['ten_nganh'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Họ Tên -->
            <div class="input-group">
                <label>Họ Tên</label>
                <input type="text" name="txtHoTen" value="<?php echo $row['ho_ten']; ?>" required>
            </div>

            <!-- Ngày Sinh -->
            <div class="input-group">
                <label>Ngày Sinh</label>
                <input type="date" name="txtNgaySinh" value="<?php echo $row['ngay_sinh']; ?>" required>
            </div>

            <!-- Giới Tính -->
            <div class="input-group">
                <label>Giới Tính</label>
                <select name="ddlGioiTinh" required>
                    <option value="Nam" <?php echo ($row['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($row['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>

            <!-- Quê Quán -->
            <div class="input-group">
                <label>Quê Quán</label>
                <input type="text" name="txtQueQuan" value="<?php echo $row['que_quan']; ?>" required>
            </div>

            <!-- Email -->
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="txtEmail" value="<?php echo $row['email']; ?>" required>
            </div>

            <!-- Số Điện Thoại -->
            <div class="input-group">
                <label>Số Điện Thoại</label>
                <input type="text" name="txtSoDienThoai" value="<?php echo $row['so_dien_thoai']; ?>" required>
            </div>

            <!-- Khóa Học -->
            <div class="input-group">
                <label>Khóa Học</label>
                <input type="text" name="txtKhoaHoc" value="<?php echo $row['khoa_hoc']; ?>" required>
            </div>

            <!-- Nút Lưu -->
            <button type="submit" name="btnLuu">Lưu</button>
            <?php
                }
            }
            ?>
        </div>
    </form>
</body>
</html>
