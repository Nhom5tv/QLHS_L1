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
            <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmanganh"  value="<?php  echo $row['ma_nganh']?>">
                    <label>Mã Ngành Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txthocky"  value="<?php  echo $row['hoc_ky']?>">
                    <label>Học Kỳ</label>
                </div>
                <div class="input-box">
                    
                    <input type="text"  name="txtmagiangvien"  value="<?php  echo $row['ma_giang_vien']?>">
                    <label>Mã Giảng Viên</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtlichhoc"  value="<?php  echo $row['lich_hoc']?>">
                    <label>Lịch Học</label>
                </div>
                
                   
                </div>
               
                </div>
                
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <?php
                    }
            }
            ?> 
            
        </div>
        </div>
    </form>
</body>
</html>