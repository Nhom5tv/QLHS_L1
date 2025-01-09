<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/dslophoc/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Thông Tin Lớp Học</h2>
            <form action="#">
            <input type="hidden" name="txtmalop" value="<?php echo $row['ma_lop'] ?>"> 
            <label>Mã Môn Học</label> 
            <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmanganh" readonly value="<?php  echo $row['ma_mon']?>">
                  
                </div>    
                <label>Học Kỳ</label>        
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txthocky" readonly  value="<?php  echo $row['hoc_ky']?>">
                    
                </div>
                <label>Mã Giảng Viên</label>
                <div class="input-box">
                    
                    <input type="text"  name="txtmagiangvien" readonly value="<?php  echo $row['ma_giang_vien']?>">
                  
                </div>
                <label>Lịch Học</label>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtlichhoc" readonly value="<?php  echo $row['lich_hoc']?>">
                   
                </div>
                <label>Trạng thái lớp học</label>
                <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang mở" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang mở') echo 'selected'; ?>>Đang Mở</option>
                        <option value="Đã kết thúc" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đã kết thúc') echo 'selected'; ?>>Đóng</option>
                        </select>

</div>
<button type="submit" class="btn" name="btnLuu">Lưu</button>
<br>
                <div class="quaylai">
                <a href="http://localhost/QLHS/dslophoc">Quay lại</a>
                </div>
                
                </div>
                
     
                <?php
                    }
            }
            ?> 
            
        </div>
        </div>
    </form>
</body>
</html>