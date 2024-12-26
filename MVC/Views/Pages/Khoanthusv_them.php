<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khoản Thu Sinh Viên</title>
    <style>
        .quaylai {
            text-align: center;
            justify-content: center;
            padding-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>
<body>
    <form id="myForm" method="post" action="./themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Khoản Thu Sinh Viên</h2>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtId" value="<?php if(isset($data['ma_khoan_thu'])) echo $data['ma_khoan_thu']; ?>">
                    <label>Mã Khoản thu</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMaSV" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']; ?>">
                    <label>Mã Sinh Viên</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTienBanDau" value="<?php if(isset($data['so_tien_ban_dau'])) echo $data['so_tien_ban_dau']; ?>">
                    <label>Số Tiền Ban Đầu</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTienMienGiam" value="<?php if(isset($data['so_tien_mien_giam'])) echo $data['so_tien_mien_giam']; ?>">
                    <label>Số Tiền Miễn Giảm</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTienPhaiNop" value="<?php if(isset($data['so_tien_phai_nop'])) echo $data['so_tien_phai_nop']; ?>">
                    <label>Số Tiền Phải Nộp</label>
                </div>

               

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/status.png" alt="" width="15px">
                    </span>
                    <select name="txtTrangThaiThanhToan" required>
                        <option value="" disabled selected>Chọn trạng thái</option>
                        <option value="Chưa thanh toán" <?php if(isset($data['trang_thai_thanh_toan']) && $data['trang_thai_thanh_toan'] == "Chưa thanh toán") echo "selected"; ?>>Chưa thanh toán</option>
                        <option value="Đã thanh toán" <?php if(isset($data['trang_thai_thanh_toan']) && $data['trang_thai_thanh_toan'] == "Đã thanh toán") echo "selected"; ?>>Đã thanh toán</option>
                    </select>
                    <label>Trạng Thái Thanh Toán</label>
                </div>

                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                    <a href="http://localhost/QLHS_L1/DSKhoanthu">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
