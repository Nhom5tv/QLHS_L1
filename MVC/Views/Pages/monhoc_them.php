<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Môn Học</title>
    <style>
        .quaylai {
            text-align: center;
            justify-content: center;
            padding-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>
<body>
    <form id="myForm" method="post" action="./Monhoc/themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Môn Học</h2>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMaMon" value="<?php if (isset($data['ma_mon'])) echo $data['ma_mon']; ?>">
                    <label>Mã Môn</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtTenMon" value="<?php if (isset($data['ten_mon'])) echo $data['ten_mon']; ?>">
                    <label>Tên Môn</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMaNganh" value="<?php if (isset($data['ma_nganh'])) echo $data['ma_nganh']; ?>">
                    <label>Mã ngành</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTinChi" value="<?php if (isset($data['so_tin_chi'])) echo $data['so_tin_chi']; ?>">
                    <label>Số Tín Chỉ</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTiet" value="<?php if (isset($data['so_tiet'])) echo $data['so_tiet']; ?>">
                    <label>Số Tiết</label>
                </div>

                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                    <a href="http://localhost/qlhs/DSMonhoc">Quay lại</a>
                </div>

            </div>
        </div>
    </form>
</body>
</html>
