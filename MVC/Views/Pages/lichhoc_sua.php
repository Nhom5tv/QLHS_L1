<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css">
</head>
<body>
    <form method="post" action="http://localhost/qlhs/dslichhoc/suadl">
    <v class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Thông Tin Lịch Học</h2>
            <form action="#">
            <input type="hidden" name="txtidlichhoc" value="<?php echo $row['id_lich_hoc'] ?>">  
            <label>Mã Môn Học</label>
            <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon" readonly  value="<?php  echo $row['ma_mon_hoc']?>">
                    
                </div> 
                <label>Số Lượng Tối Đa</label>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmaxsoluong" readonly  value="<?php  echo $row['so_luong_toi_da']?>">
                  
                </div>                    
                <label>Lịch Học</label>      
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtlichhoc" readonly  value="<?php  echo $row['lich_hoc']?>">
                  
                </div>
                <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang Mở" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang Mở') echo 'selected'; ?>>Đang Mở</option>
                        <option value="Đóng" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đóng') echo 'selected'; ?>>Đóng</option>
                        </select>
</div>
                
<button type="submit" class="btn" name="btnLuu">Lưu</button>
<br>
<div class="quaylai">
                <a href="http://localhost/QLHS/dslichhoc">Quay lại</a>
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