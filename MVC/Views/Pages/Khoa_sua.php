<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Khoa</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSKhoa/suadl">
        <div class="content">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
            <div class="form-box login">
                <h2>Sửa Thông Tin Khoa </h2>


                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <label>Mã Khoa </label>
                    <input type="text" name="txtMaKhoa" value="<?php echo $row['ma_khoa']; ?>" readonly>
                </div>

                <!-- Mã Khoa -->
                <div class="input-box">
                    <label>Tên Khoa</label>
                    <input type="text" name="txtTenKhoa" value="<?php echo $row['ten_khoa']; ?>" required>
                </div>

                <!-- Mã Khoa -->

                <!-- Họ Tên -->
                <div class="input-box">
                    <label>Liên hệ </label>
                    <input type="text" name="txtLienHe" value="<?php echo $row['lien_he']; ?>" required>
                </div>

                <!-- Email -->
                <div class="input-box">
                    <label>Ngày thành lập</label>
                    <input type="date" name="txtNgayThanhLap" value="<?php echo $row['ngay_thanh_lap']; ?>" required>
                </div>

                <!-- Số Điện Thoại -->
                <div class="input-box">
                    <label>Tiền mỗi tín chỉ</label>
                    <input type="text" name="txtTienMoiTinChi" value="<?php echo $row['tien_moi_tin_chi']; ?>" required>
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
