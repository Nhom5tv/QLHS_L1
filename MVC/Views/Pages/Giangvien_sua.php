<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Giảng Viên</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSGiangvien/suadl">
        <div class="content">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <div class="form-box login">
                <h2>Sửa Thông Tin Giảng Viên</h2>


                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <label>Mã Giảng Viên</label>
                    <input type="text" name="txtMaGV" value="<?php echo $row['ma_giang_vien']; ?>" readonly>
                </div>

                <!-- Mã Khoa -->
                <div class="input-group">
    <label for="ma_khoa">Chọn Khoa</label>
    <select name="txtMaKhoa" id="ma_khoa" required>
        <option value="">Chọn khoa</option>
        <?php 
            if (isset($data['khoaList']) && mysqli_num_rows($data['khoaList']) > 0) {
                while ($r1 = mysqli_fetch_array($data['khoaList'])) {
                    // Kiểm tra mã khoa hiện tại và đặt selected
                    $selected = ($r1['ma_khoa'] == $row['ma_khoa']) ? 'selected' : '';
                    echo '<option value="' . $r1['ma_khoa'] . '" ' . $selected . '>' . $r1['ten_khoa'] . '</option>';
                }
            }
        ?>
    </select>
</div>

                <!-- Mã Ngành -->

                <!-- Họ Tên -->
                <div class="input-box">
                    <label>Họ Tên</label>
                    <input type="text" name="txtHoTen" value="<?php echo $row['ho_ten']; ?>" required>
                </div>

                <!-- Email -->
                <div class="input-box">
                    <label>Email</label>
                    <input type="email" name="txtEmail" value="<?php echo $row['email']; ?>" required>
                </div>

                <!-- Số Điện Thoại -->
                <div class="input-box">
                    <label>Số Điện Thoại</label>
                    <input type="text" name="txtSoDienThoai" value="<?php echo $row['so_dien_thoai']; ?>" required>
                </div>

                <!-- Khóa Học -->
                <div class="input-box">
                    <label>Chuyên ngành </label>
                    <input type="text" name="txtChuyenNganh" value="<?php echo $row['chuyen_nganh']; ?>" required>
                </div>

                <!-- Nút Lưu -->
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </form>
</body>
</html>
