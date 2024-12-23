<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Miễn Giảm</title>
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
                <h2>Thêm Miễn Giảm</h2>

                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMasinhvien" style="text-align: center" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']; ?>">
                    <label>Mã Sinh Viên</label>
                </div>

                <!-- Mức Tiền -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" max="100"  style="text-align: center" required name="txtMuctien" value="<?php if(isset($data['muc_tien'])) echo $data['muc_tien']; ?>">
                    <label>Mức Tiền(0-100%)</label>
                </div>

                <!-- Loại Miễn Giảm -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtLoaimiengiam" style="text-align: center" value="<?php if(isset($data['loai_mien_giam'])) echo $data['loai_mien_giam']; ?>">
                    <label>Loại Miễn Giảm</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtGhichu" style="text-align: center" value="<?php if(isset($data['ghi_chu'])) echo $data['ghi_chu']; ?>">
                    <label>Ghi chú</label>
                </div>

                

                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                    <a href="http://localhost/QLHS_L1/DSMiengiam">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
