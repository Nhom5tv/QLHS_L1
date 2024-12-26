<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Khoản Thu</title>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/QLHS_L1/DSKhoanthu/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                
                    while($row = mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa Khoản Thu</h2>
            <form action="#">
                        <!-- Thẻ ẩn lưu ID của khoản thu -->
                 <input type="hidden" name="txtId" value="<?php echo $row['ma_khoan_thu'] ?>">     
                 
                 <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtTenkhoanthu" value="<?php echo $row['ten_khoan_thu'] ?>">
                    <label>Tên Khoản Thu</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <!-- Input kết hợp datalist -->
                    <input 
                        type="text" 
                        required 
                        name="txtLoaikhoanthu" 
                        list="loaikhoanthuOptions" 
                        value="<?php if(isset($row['loai_khoan_thu'])) echo $row['loai_khoan_thu']; ?>">
                    <label>Loại Khoản Thu</label>

                    <!-- Datalist chứa các loại khoản thu có sẵn -->
                    <datalist id="loaikhoanthuOptions">
                        <option value="Học phí">
                        <option value="BHYT">
                        <option value="Khám sức khỏe">
                        <option value="Bảo hiểm thân thể">
                        <option value="Khác">
                    </datalist>
                </div>


                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/so_tien.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtSoTien" value="<?php echo $row['so_tien'] ?>">
                    <label>Số Tiền</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/ngay_tao.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtNgaytao" value="<?php echo $row['ngay_tao'] ?>">
                    <label>Ngày Tạo</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/han_nop.png" alt="" width="15px">
                    </span>
                    <input type="date" required name="txtHannop" value="<?php echo $row['han_nop'] ?>">
                    <label>Hạn Nộp</label>
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
