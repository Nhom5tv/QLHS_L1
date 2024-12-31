<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Điểm Chi Tiết</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Form sửa điểm chi tiết -->
    <form method="post" action="http://localhost/qlhs/DSdiemtungmon_gv/suadl">
        <div class="content">
            <?php
            // Kiểm tra xem dữ liệu có tồn tại
            
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
                    ?>
                    <div class="form-box login">
                        <h2>Sửa Điểm Chi Tiết</h2>


                        <!-- ID Điểm Chi Tiết (thẻ ẩn) -->
                        <input type="hidden" name="txtId" value="<?php echo $row['ma_dct']; ?>">

                     
                            <input type="hidden" id="txtMaLop" name="txtMaLop" value="<?= $row['ma_lop'] ?>" readonly>
              

                            <input type="hidden" id="txtMaSinhVien" name="txtMaSinhVien" value="<?= $row['ma_sinh_vien'] ?>" readonly>
                            <input type="hidden" name="class_id" value="<?= $data['class_id'] ?>"> <!-- Lấy class_id từ $data -->
                        
                        <!-- Lần học -->
                        <div class="input-box">
                            <input type="number" required name="txtLanHoc" value="<?php echo $row['lan_hoc']; ?>">
                            <label>Lần Học</label>
                        </div>

                        <!-- Lần thi -->
                        <div class="input-box">
                            <input type="number" required name="txtLanThi" value="<?php echo $row['lan_thi']; ?>">
                            <label>Lần Thi</label>
                        </div>

                        <!-- Điểm chuyên cần -->
                        <div class="input-box">
                            <input type="number" step="0.1" required name="txtDiemChuyenCan" value="<?php echo $row['diem_chuyen_can']; ?>">
                            <label>Điểm Chuyên Cần</label>
                        </div>

                        <!-- Điểm giữa kỳ -->
                        <div class="input-box">
                            <input type="number" step="0.1" required name="txtDiemGiuaKy" value="<?php echo $row['diem_giua_ky']; ?>">
                            <label>Điểm Giữa Kỳ</label>
                        </div>

                        <!-- Điểm cuối kỳ -->
                        <div class="input-box">
                            <input type="number" step="0.1" required name="txtDiemCuoiKy" value="<?php echo $row['diem_cuoi_ky']; ?>">
                            <label>Điểm Cuối Kỳ</label>
                        </div>

                        <button type="submit" class="btn" name="btnLuu">Lưu</button>
                    </div>
                <?php }
            } ?>
        </div>
    </form>
</body>

</html>
