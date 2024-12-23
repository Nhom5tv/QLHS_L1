<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khoản Thu</title>
    <style>
        .quaylai {
            text-align: center;
            justify-content: center;
            padding-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form id="myForm" method="post" action="./themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Khoản Thu</h2>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtTenkhoanthu" value="<?php if(isset($data['ten_khoan_thu'])) echo $data['ten_khoan_thu']; ?>">
                    <label>Tên Khoản Thu</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtLoaikhoanthu" value="<?php if(isset($data['loai_khoan_thu'])) echo $data['loai_khoan_thu']; ?>">
                    <label>Loại Khoản Thu</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTien" value="<?php if(isset($data['so_tien'])) echo $data['so_tien']; ?>">
                    <label>Số Tiền</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/calendar.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtNgaytao" style="padding: 0px 5px 0 90px" value="<?php if(isset($data['ngay_tao'])) echo $data['ngay_tao']; ?>">
                    <label>Ngày Tạo</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/calendar.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtHannop"  style="padding: 0px 5px 0 90px" value="<?php if(isset($data['han_nop'])) echo $data['han_nop']; ?>">
                    <label>Hạn Nộp</label>
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
