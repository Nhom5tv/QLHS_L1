<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .quaylai {
    text-align: center;
    justify-content: center;
    padding-top: 5px;
}
    </style>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form id="myForm" method="post" action="./lichhoc/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm Môn Học</h2>
            <form action="#">

                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon" value="<?php if(isset($data['ma_mon'])) echo $data['ma_mon']?>">
                    <label>Mã Môn Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtsoluong" value="<?php if(isset($data['so_luong'])) echo $data['so_luong']?>">
                    <label>Số Lượng</label>
                </div>
                <div class="input-box">
                    
                    <input type="text" name="txtmaxsoluong" value="<?php if(isset($data['so_luong_toi_da'])) echo $data['so_luong_toi_da']?>">
                    <label>Số Lượng Tối Đa</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>

                    <input type="date" name="txtlichhoc" value="<?php echo date('Y-m-d'); ?>" />

                    <label>Lịch Học</label>
                </div>
                <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang Mở" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang Mở') echo 'selected'; ?>>Đang Mở</option>
                        <option value="Đóng" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đóng') echo 'selected'; ?>>Đóng</option>
                        </select>
</div>
                
                
               
                </div>
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/qllhoc/dslichhoc">Quay lại</a>
                </div>
                
                
                
            
        </div>
        </div>
    </form>
    
</body>
</html>