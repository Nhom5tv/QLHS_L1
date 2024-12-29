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
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Thông Tin Lịch Học</h2>
            <form action="#">
            <input type="hidden" name="txtidlichhoc" value="<?php echo $row['id_lich_hoc'] ?>">  
            <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmamon"  value="<?php  echo $row['ma_mon_hoc']?>">
                    <label>Mã Môn Học</label>
                </div> 
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/id-card_9424609.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtmaxsoluong"  value="<?php  echo $row['so_luong_toi_da']?>">
                    <label>Số Lượng Tối Đa</label>
                </div>                    
                               
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtlichhoc"  value="<?php  echo $row['lich_hoc']?>">
                    <label>Lịch Học</label>
                </div>
                <div class="input-box">
                        <select name="txttrangthai">
                        <option value="Đang Mở" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đang Mở') echo 'selected'; ?>>Đang Mở</option>
                        <option value="Đóng" <?php if(isset($row['trang_thai']) && $row['trang_thai'] === 'Đóng') echo 'selected'; ?>>Đóng</option>
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