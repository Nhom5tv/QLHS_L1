<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style >
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/qlhs/dslophoc/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Quản lý Đăng Ký Lớp Học</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/qlhs/dslophoc/timkiem" method="post">         
                <input type="search" placeholder="Mã Môn Học" name="txtTimkiemmamon" value="<?php if(isset($data['ma_mon'])) echo $data['ma_mon']?>">
                                             
            </div>
            <div class="input-group"> 
                  
                <input type="search" placeholder="Mã Giảng Viên" name="txtTimkiemmagiangvien" value="<?php if(isset($data['ma_giang_vien'])) echo $data['ma_giang_vien']?>">
                                             
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiemlop"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/qlhs/lophoc" method="post">
                <button class="button-85" role="button">Thêm Lớp Học</button>
                </form>
            
            </div>
            <div >
                <!-- <form action="http://localhost/qlhs/dslophoc/timkiem" method="post">
                    <button type="submit" class="button-85" name="btnXuatExcel2">Xuất Excel</button>
                </form> -->
            
            </div>
           
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Mã Lớp <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mã Môn <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Học Kỳ <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mã Giảng Viên <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Lịch Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Trạng thái <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> Chức Năng <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0 ){
                            $i=0;
                            while($row=mysqli_fetch_assoc($data['dulieu'])){
                                
                                ?>
                                        <tr>
                                            
                                            <td>
                                                <?php echo $row['ma_lop']?>
                                            </td>
                                            <td> <?php echo $row['ma_mon']?> </td>
                                            <td> <?php echo $row['hoc_ky']?> </td>
                                            <td> <?php echo $row['ma_giang_vien']?> </td>
                                            <td> <?php echo $row['lich_hoc']?> </td>
                                            <td> <?php echo $row['trang_thai']?> </td>
                                                                                      
                                           
                                           
                                            <td class="btn_cn">
                                            <form action="http://localhost/qlhs/dslophoc/sua/<?php echo $row['ma_lop']?>" method="post">
                                                <button class="button-85"  role="button">Sửa</button> &nbsp;
                                                                                </td>
                                        </tr>

                                <?php

                            }
                        }
                    ?>
            </tbody>
            </table>
        </section>
    </main>
    <!-- <script src="./Public/JS/datatable.js"></script> -->

</body>

</html>
