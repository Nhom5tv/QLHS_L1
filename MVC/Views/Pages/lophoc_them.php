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
    <form id="myForm" method="post" action="./lophoc/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm Môn Học</h2>
            <form action="#">

                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmanganh" value="<?php if(isset($data['ma_nganh'])) echo $data['ma_nganh']?>">
                    <label>Mã Ngành Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txthocky" value="<?php if(isset($data['hoc_ky'])) echo $data['hoc_ky']?>">
                    <label>Học Kỳ</label>
                </div>
                <div class="input-box">
                    
                    <input type="text" name="txtmagiangvien" value="<?php if(isset($data['ma_giang_vien'])) echo $data['ma_giang_vien']?>">
                    <label>Mã Giảng Viên</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>

                    <input type="date" name="txtlichhoc" value="<?php echo date('Y-m-d'); ?>" />

                    <label>Lịch Học</label>
                </div>
                
               
                </div>
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/qlhs/qllophoc">Quay lại</a>
                </div>
                
                
                
            
        </div>
        </div>
    </form>
    
</body>
</html>