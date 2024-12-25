<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Môn Học</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/DSMonhoc/suadl">
    <div class="content">
    <?php
        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
            while ($row = mysqli_fetch_array($data['dulieu'])) {
    ?>
    <div class="form-box login">
        <h2>Sửa Môn Học</h2>
        <!-- thẻ ẩn lưu tt id -->
        <input type="hidden" name="txtMaMon" value="<?php echo $row['ma_mon'] ?>">     

        <div class="input-box">
            <span class="icon">
                <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
            </span>
            <input type="text" required name="txtTenMon" value="<?php echo $row['ten_mon'] ?>">
            <label>Tên Môn Học</label>
        </div>

        <div class="input-box">
            <span class="icon">
                <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
            </span>
            <input type="number" required name="txtMaNganh" value="<?php echo $row['ma_nganh'] ?>">
            <label>Mã ngành</label>
        </div>

        <div class="input-box">
            <span class="icon">
                <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
            </span>
            <input type="number" required name="txtSoTinChi" value="<?php echo $row['so_tin_chi'] ?>">
            <label>Số Tín Chỉ</label>
        </div>

        <div class="input-box">
            <span class="icon">
                <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
            </span>
            <input type="number" required name="txtSoTiet" value="<?php echo $row['so_tiet'] ?>">
            <label>Số Tiết</label>
        </div>


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
