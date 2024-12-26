<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/login.css?v=<?php echo time();?>">
    <base href="http://localhost/QLHS_L1/">
    <style>
        .content{
            margin-top: 70px;
        }
        .formDangnhap{
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
                }
    </style>
    
</head>
<body>
    <!-- Nút mở modal -->
    <!-- <button id="myBtn">Đăng nhập</button> -->

<!-- Modal -->
 <!-- <div id="myModal" class="modal"> -->
    <div class="formDangnhap">
        <!-- <span class="close">&times;</span> -->
        <form method="post" action="./Login/dangnhap">
        <div style="background-color:white;" class="content" >
        
        <div class="form-box login">
            <h2>Đăng nhập</h2>
            <?php
            
            if(isset($data['result'])){
                if($data['result']==true){

                }
                else{?>
                <h5>
                <?php
                echo'Đăng nhập thất bại';
                ?>
                </h5>
                
                <?php    
                }
            }
           
            ?>
            <form action="#">
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="email" required name="txtEmail">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="password" required name="txtMatkhau">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label ><input type="checkbox" >Remember me</label>
                    <a href="#">Quên mật khẩu</a>
                </div>
                <button type="submit" class="btn" name="btnDangnhap">Đăng nhập</button>
                <div class="login-register">
                    <p>Bạn chưa có tài khoản?&nbsp;<a href="http://localhost/QLHS_L1/Dangky" class="register-link"> Đăng ký</a></p>
                    
                </div>
            
        </div>
    </div>
        </form>
    </div>
<!-- </div> -->
<!-- <script src="./Public/JS/script.js"></script> -->
    
</body>
</html>
