<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Miễn Giảm</title>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/QLHS_L1/DSMiengiam/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                
                    while($row = mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Miễn Giảm</h2>
            <form action="#">
                        <!-- Thẻ ẩn lưu ID của miễn giảm -->
                 <input type="hidden" name="txtId" value="<?php echo $row['ma_mien_giam'] ?>">     
                 
                 <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMasinhvien" value="<?php echo $row['ma_sinh_vien'] ?>">
                    <label>Mã Sinh Viên</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" step="0.01" required name="txtMuctien" value="<?php echo $row['muc_tien'] ?>">
                    <label>Mức Tiền</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtLoaimiengiam" value="<?php echo $row['loai_mien_giam'] ?>">
                    <label>Loại Miễn Giảm</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtGhichu" value="<?php echo $row['ghi_chu'] ?>">
                    <label>Ghi chú</label>
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
