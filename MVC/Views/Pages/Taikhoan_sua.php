<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form method="post" action="http://localhost/QLHS/DSTaikhoan/suadl">
    <div class="content">
    <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        ?>
                        
    <div class="form-box login">
            <h2>Sửa tài khoản</h2>
            <form action="#">
                        <!-- thẻ ẩn lưu tt id  -->
                 <input type="hidden" name="txtId" value="<?php echo $row['ma_tai_khoan'] ?>">     
                 <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtTendn" value="<?php  echo $row['ten_dang_nhap']?>">
                    <label>Tên đăng nhập</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="email" required name="txtEmail" value="<?php  echo $row['email']?>">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input readonly style="padding: 0 5px 0 90px;" type="text" name="txtQuyen" value="<?php  echo $row['phan_quyen']?>">
                    <label>Quyền</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="password" required name="txtMatkhau" value="<?php  echo $row['mat_khau']?>">
                    <label>Password</label>
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