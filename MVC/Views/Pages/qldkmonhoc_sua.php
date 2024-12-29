<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/dsdkmonhoc/suadl">
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
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon" readonly  value="<?php echo $row['ma_mon'] ?>"/>
                    <label>Mã Môn Học</label>
                </div>  
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmasinhvien" readonly  value="<?php echo $row['ma_sinh_vien'] ?>"/>
                    <label>Mã Sinh Viên</label>
                </div>
                <div class="input-box">
                    
                    <input type="text"  name="txtmalop" readonly  value="<?php  echo $row['ma_lop'] ?>"/>
                    <label>Mã Lớp</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtlichhocdukien"  value="<?php  echo $row['lich_hoc_du_kien'] ?>"/>
                    <label>Lịch Học Dự Kiến</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <!-- <input type="text" required name="txttrangthai"  value=""> -->
                    <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang Chờ Duyệt" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang Chờ Duyệt') echo 'selected'; ?>>Đang Chờ Duyệt</option>
                        <option value="Đã Duyệt" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đã Duyệt') echo 'selected'; ?>>Đã Duyệt</option>
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