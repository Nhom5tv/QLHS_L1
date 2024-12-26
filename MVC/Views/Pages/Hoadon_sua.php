<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Hóa Đơn</title>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>

<body>
    <form method="post" action="http://localhost/QLHS_L1/DSHoadon/suadl">
        <div class="content">
            <?php
                if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                    while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
                        <div class="form-box login">
                            <h2>Sửa Hóa Đơn</h2>
                            <form action="#">
                                <!-- Thẻ ẩn lưu ID của hóa đơn -->
                                <input type="hidden" name="txtId" value="<?php echo $row['ma_hoa_don']; ?>">

                                <!-- Mã Sinh Viên -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                                    </span>
                                    <input type="text" required name="txtMasinhvien" value="<?php echo $row['ma_sinh_vien']; ?>">
                                    <label>Mã Sinh Viên</label>
                                </div>

                                <!-- Mã Khoản Thu -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                                    </span>
                                    <input type="text" required name="txtMakhoanthu" value="<?php echo $row['ma_khoan_thu']; ?>">
                                    <label>Mã Khoản Thu</label>
                                </div>

                                <!-- Ngày Thanh Toán -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/calendar.png" alt="" width="15px">
                                    </span>
                                    <input type="date" required name="txtNgaythanhtoan" value="<?php echo $row['ngay_thanh_toan']; ?>">
                                    <label>Ngày Thanh Toán</label>
                                </div>

                                <!-- Số Tiền Đã Nộp -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                                    </span>
                                    <input type="number" required name="txtSotien" value="<?php echo $row['so_tien_da_nop']; ?>">
                                    <label>Số Tiền Đã Nộp</label>
                                </div>

                                <!-- Hình Thức Thanh Toán -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/payment.png" alt="" width="15px">
                                    </span>
                                    <input type="text" required name="txtHinhthucthanhtoan" value="<?php echo $row['hinh_thuc_thanh_toan']; ?>">
                                    <label>Hình Thức Thanh Toán</label>
                                </div>

                                <!-- Nội Dung -->
                                <div class="input-box">
                                    <span class="icon">
                                        <img src="./Public/Picture/Pic_login/payment.png" alt="" width="15px">
                                    </span>
                                    <input type="text" required name="txtNoidung" value="<?php echo $row['noi_dung']; ?>">
                                    <label>Nội dung</label>
                                </div>

                                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                            </form>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </form>
</body>

</html>
