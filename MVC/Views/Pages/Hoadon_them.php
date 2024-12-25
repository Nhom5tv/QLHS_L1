<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hóa Đơn</title>
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
    <form id="myForm" method="post" action="http://localhost/QLHS_L1/DSHoadon/themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Hóa Đơn</h2>

                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMasinhvien" value="<?php if (isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']; ?>">
                    <label>Mã Sinh Viên</label>
                </div>

                <!-- Khoản Thu -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMakhoanthu" value="<?php if (isset($data['ma_khoan_thu'])) echo $data['ma_khoan_thu']; ?>">
                    <label>Mã Khoản Thu</label>
                </div>

                <!-- Ngày Thanh Toán -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/calendar.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtNgaythanhtoan" style="padding: 0px 5px 0 90px" value="<?php if (isset($data['ngay_thanh_toan'])) echo $data['ngay_thanh_toan']; ?>">
                    <label>Ngày Thanh Toán</label>
                </div>

                <!-- Số Tiền Đã Nộp -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSotien" value="<?php if (isset($data['so_tien_da_nop'])) echo $data['so_tien_da_nop']; ?>">
                    <label>Số Tiền Đã Nộp</label>
                </div>

                <!-- Hình Thức Thanh Toán -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/payment.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtHinhthucthanhtoan" value="<?php if (isset($data['hinh_thuc_thanh_toan'])) echo $data['hinh_thuc_thanh_toan']; ?>">
                    <label>Hình Thức Thanh Toán</label>
                </div>

                <!-- Nội Dung -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/payment.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtNoidung" value="<?php if (isset($data['noi_dung'])) echo $data['noi_dung']; ?>">
                    <label>Nội dung</label>
                </div>

                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                    <a href="http://localhost/QLHS_L1/DSHoadon">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
