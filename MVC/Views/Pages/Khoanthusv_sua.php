<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Khoản Thu Sinh Viên</title>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>
<body>
    <form method="post" action="http://localhost/QLHS_L1/DSKhoanthusv/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                while($row = mysqli_fetch_array($data['dulieu'])){
    ?>
                        
    <div class="form-box login">
            <h2>Sửa Khoản Thu Sinh Viên</h2>
            <!-- Thẻ ẩn lưu ID của khoản thu -->
            <input type="hidden" name="txtId" value="<?php echo $row['ma_khoan_thu'] ?>">     
                 
            <div class="input-box">
                <span class="icon">
                    <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                </span>
                <input type="text" required name="txtMaSV" value="<?php echo $row['ma_sinh_vien'] ?>">
                <label>Mã Sinh Viên</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <img src="./Public/Picture/Pic_login/so_tien.png" alt="" width="15px">
                </span>
                <input type="number" required name="txtSoTienBanDau" value="<?php echo $row['so_tien_ban_dau'] ?>">
                <label>Số Tiền Ban Đầu</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <img src="./Public/Picture/Pic_login/so_tien.png" alt="" width="15px">
                </span>
                <input type="number" required name="txtSoTienMienGiam" value="<?php echo $row['so_tien_mien_giam'] ?>">
                <label>Số Tiền Miễn Giảm</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <img src="./Public/Picture/Pic_login/so_tien.png" alt="" width="15px">
                </span>
                <input type="number" required name="txtSoTienPhaiNop" value="<?php echo $row['so_tien_phai_nop'] ?>">
                <label>Số Tiền Phải Nộp</label>
            </div>

          
            <label>Trạng Thái Thanh Toán</label>
            <div class="input-box">
                <span class="icon">
                    <img src="./Public/Picture/Pic_login/status.png" alt="" width="15px">
                </span>
                <select name="txtTrangThaiThanhToan" required>
                    <option value="Chưa thanh toán" <?php if($row['trang_thai_thanh_toan'] == "Chưa thanh toán") echo "selected"; ?>>Chưa thanh toán</option>
                    <option value="Đã thanh toán" <?php if($row['trang_thai_thanh_toan'] == "Đã thanh toán") echo "selected"; ?>>Đã thanh toán</option>
                    <option value="Thanh toán 1 phần" <?php if($row['trang_thai_thanh_toan'] == "Thanh toán 1 phần") echo "selected"; ?>>Thanh toán 1 phần</option>
                </select>
                
            </div>

            <button type="submit" class="btn" name="btnLuu">Lưu</button>
    <?php
                }
            }
    ?> 
            
        </div>
        </div>
    </form>
</body>
</html>
