<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/dsmonhoc/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Thông Tin Môn Học</h2>
            <form action="#">
            <input type="hidden" name="txtmadangky" value="<?php echo $row['ma_dang_ky'] ?>">  
            <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon"  value="<?php  echo $row['ma_mon']?>">
                    <label>Mã Môn Học</label>
                </div>            
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmasinhvien"  value="<?php  echo $row['ma_sinh_vien']?>">
                    <label>Mã Sinh Viên</label>
                </div>
                <div class="input-box">
                    
                    <input type="text"  name="txtmalop"  value="<?php  echo $row['ma_lop']?>">
                    <label>Mã Lớp</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtlichhocdukien"  value="<?php  echo $row['lich_hoc_du_kien']?>">
                    <label>Lịch Học Dự Kiến</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <!-- <input type="text" required name="txttrangthai"  value=""> -->
                    <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Còn Chỗ Trống" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Còn Chỗ Trống') echo 'selected'; ?>>Còn Chỗ Trống</option>
                        <option value="Đã Đủ Sinh Viên" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đã Đủ Sinh Viên') echo 'selected'; ?>>Đã Đủ Sinh Viên</option>
                        <option value="Đã Đóng Đăng Ký" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đã Đóng Đăng Ký') echo 'selected'; ?>>Đã Đóng Đăng Ký</option>
                        </select>
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