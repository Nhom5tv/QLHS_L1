<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Ngành</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSNganh/suadl">
        <div class="content">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <div class="form-box login">
                <h2>Sửa Thông Tin Ngành </h2>


                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <label>Mã Ngành </label>
                    <input type="text" name="txtMaNganh" value="<?php echo $row['ma_nganh']; ?>" readonly>
                </div>

                <!-- Mã Khoa -->
                <div class="input-box">
                    <label>Tên Ngành</label>
                    <input type="text" name="txtTenNganh" value="<?php echo $row['ten_nganh']; ?>" required>
                </div>

                <!-- Mã Ngành -->

                <!-- Họ Tên -->
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
                <!-- Email -->
                <div class="input-box">
                    <label>Thời gian đào tạo</label>
                    <input type="text" name="txtThoiGianDaoTao" value="<?php echo $row['thoi_gian_dao_tao']; ?>" required>
                </div>

                <!-- Số Điện Thoại -->
                <div class="input-box">
                    <label>Bậc đào tạo</label>
                    <input type="text" name="txtBacDaoTao" value="<?php echo $row['bac_dao_tao']; ?>" required>
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
