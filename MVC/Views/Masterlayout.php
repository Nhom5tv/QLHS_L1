<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <title>Web quản lý bán hàng</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"  href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/CSS/layout.css?v=<?php echo time();?>">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">LUXURY</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Trangchu" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
              
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#QLHT" aria-expanded="false" aria-controls="QLHT">
                        <i class="lni lni-protection"></i>
                        <span>Quản lý hệ thống</span>
                    </a>
                    <ul id="QLHT" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan" class="sidebar-link">Quản lý tài khoản</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSNhanvien" class="sidebar-link">Quản lý nhân viên</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSkhachhang" class="sidebar-link">Quản lý khách hàng</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#QLSP-DV" aria-expanded="false" aria-controls="QLSP-DV">
                        <i class="lni lni-diamond-alt"></i>
                        <span>Quản lý sản phẩm và dịch vụ</span>
                    </a>
                    <ul id="QLSP-DV" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSDanhmuc" class="sidebar-link">Quản lý danh mục</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham" class="sidebar-link">Quản lý sản phẩm</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DStintuc" class="sidebar-link">Quản lý tin tức</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSkhuyenmai" class="sidebar-link">Quản lý khuyến mãi</a>
                        </li>
                    </ul>
                </li>

                 <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#QLGD-DH" aria-expanded="false" aria-controls="QLGD-DH">
                        <i class="lni lni-cart-full"></i>
                        <span>Quản lý giao dịch và đơn hàng</span>
                    </a>
                    <ul id="QLGD-DH" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                        <!-- <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSDathang" class="sidebar-link">Đặt hàng</a>
                        </li> -->

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSDonhang" class="sidebar-link">Đơn hàng</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSGiaohang" class="sidebar-link">Giao hàng</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSNhacungcap" class="sidebar-link">Nhà cung cấp</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSNhaphang" class="sidebar-link">Nhập hàng</a>
                        </li>
                    </ul>
                </li>
                    

                
                
            </ul>
            <img src="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/Picture/nhandoi.png" alt="">
            <div class="sidebar-footer">
                <a href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Login/logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
        <div class="title">
            
            </div>
            <!-- content -->
            <div class="main-content">
            <?php 
                   include_once './MVC/Views/Pages/'.$data['page'].'.php';
                //    nối chuỗi tên tệp là ./MVC/Views/Pages/ + giá trị của phần tử page trong mảng data + .php
               ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
            const hamBurger = document.querySelector(".toggle-btn");
            hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");});
    </script>
</body>

</html>