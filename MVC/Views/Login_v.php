<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/login.css?v=<?php echo time();?>">
    <base href="http://localhost/QLHS/">
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
                    <input type="text" required name="txtTendangnhap">
                  
                    <label>  <i class="lni lni-graduation"></i> Tên đăng nhập</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="password" required name="txtMatkhau">
                    <label><i class="lni lni-lock"></i> Password</label>
                </div>
                <div class="remember-forgot">
                    <label ><input type="checkbox" >Remember me</label>
                </div>
                <button type="submit" class="btn" name="btnDangnhap">Đăng nhập</button>
              
            
        </div>
    </div>
        </form>
    </div>
<!-- </div> -->
<!-- <script src="./Public/JS/script.js"></script> -->
    
</body>
</html>
