<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Sinh Viên</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSSinhvien/suadl">
        <div class="content">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <div class="form-box login">
                <h2>Sửa Thông Tin Sinh Viên</h2>


                <!-- Mã Sinh Viên -->
                <div class="input-box">
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
                    // Kiểm tra mã khoa hiện tại và đặt selected
                    $selected = ($r1['ma_khoa'] == $row['ma_khoa']) ? 'selected' : '';
                    echo '<option value="' . $r1['ma_khoa'] . '" ' . $selected . '>' . $r1['ten_khoa'] . '</option>';
                }
            }
        ?>
    </select>
</div>
   <!-- Mã Ngành -->
   <div class="input-group">
    <label for="ma_nganh">Chọn  ngành</label>
    <select name="txtMaNganh" id="ma_nganh" required>
        <option value="">Chọn ngành</option>
        <?php 
            if (isset($data['nganhList']) && mysqli_num_rows($data['nganhList']) > 0) {
                while ($r1 = mysqli_fetch_array($data['nganhList'])) {
                    // Kiểm tra mã khoa hiện tại và đặt selected
                    $selected = ($r1['ma_nganh'] == $row['ma_nganh']) ? 'selected' : '';
                    echo '<option value="' . $r1['ma_nganh'] . '" ' . $selected . '>' . $r1['ten_nganh'] . '</option>';
                }
            }
        ?>
    </select>
</div>

                <!-- Họ Tên -->
                <div class="input-box">
                    <label>Họ Tên</label>
                    <input type="text" name="txtHoTen" value="<?php echo $row['ho_ten']; ?>" required>
                </div>

                <!-- Ngày Sinh -->
                <div class="input-box">
                    <label>Ngày Sinh</label>
                    <input type="date" name="txtNgaySinh" value="<?php echo $row['ngay_sinh']; ?>" required>
                </div>

                <!-- Giới Tính -->
                <div class="input-box">
                    <label>Giới Tính</label>
                    <select name="ddlGioiTinh" required>
                        <option value="Nam" <?php echo ($row['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo ($row['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    </select>
                </div>

                <!-- Quê Quán -->
                <div class="input-box">
                    <label>Quê Quán</label>
                    <input type="text" name="txtQueQuan" value="<?php echo $row['que_quan']; ?>" required>
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
                    <label>Khóa Học</label>
                    <input type="text" name="txtKhoaHoc" value="<?php echo $row['khoa_hoc']; ?>" required>
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
