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
    <form id="myForm" method="post" action="./monhoc/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm Môn Học</h2>
            <form action="#">

                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon" value="<?php if(isset($data['mon_hoc'])) echo $data['mon_hoc']?>">
                    <label>Mã Môn Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmasinhvien" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']?>">
                    <label>Mã Sinh Viên</label>
                </div>
                <!-- <div class="input-box">
                    
                    <input type="text" name="txtmalop" value="<?php if(isset($data['ma_lop'])) echo $data['ma_lop']?>">
                    <label>Mã Lớp</label>
                </div> -->
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>

                    <input type="date" name="txtlichhocdukien" value="<?php echo date('Y-m-d'); ?>" />

                    <label>Lịch Học Dự Kiến</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <!-- <input type="text" required name="txttrangthai" value=""> -->
                    <select required name="txttrangthai" class="dd4">
                    <option  value="Chọn Trạng Thái">Chọn Trạng Thái</option>
                      <option  value="Còn Chỗ Trống">Còn Chỗ Trống</option>
                      <option  value="Đã Đủ Sinh Viên">Đã Đủ Sinh Viên</option>
                      <option  value="Đã Đóng Đăng Ký">Đã Đóng Đăng Ký</option>          
                    </select>
                    
                </div>
                
               
                </div>
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/qlhs/dsmonhoc">Quay lại</a>
                </div>
                
                
                
            
        </div>
        </div>
    </form>
    
</body>
</html>