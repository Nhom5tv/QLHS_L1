<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý hóa đơn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/QLHS_L1/Public/CSS/styleDT.css">
    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/QLHS_L1/DSHoadon/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Quản lý hóa đơn</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/QLHS_L1/DSHoadon/timkiem" method="post">         
                <input type="search" placeholder="Mã sinh viên" name="txtTKMasinhvien" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']?>">
            </div>
            <div class="input-group"> 
            <form action="http://localhost/QLHS_L1/DSHoadon/timkiem" method="post">         
                <input type="date" placeholder="Ngày thanh toán" name="txtTKNgaythanhtoan" value="<?php if(isset($data['ngay_thanh_toan'])) echo $data['ngay_thanh_toan']?>">
            </div>
            
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/QLHS_L1/DSHoadon/themmoi" method="post">
                <button class="button-85" role="button">Thêm hóa đơn</button>
                </form>
            </div>

            <div class="Upload">
                <form action="http://localhost/QLHS_L1/DSHoadon/uploadExcel" method="post" enctype="multipart/form-data">
                <input type="file" name="txtFile">
                <button class="button-85" role="button">Upload</button>
                </form>
            </div>

            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File" ><img src="./Public/Picture/export.png" alt="" width="20"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <form action="http://localhost/QLHS_L1/DSHoadon/exportExcel" method="post">
                    <button style="width: 176px;" name="btnXuatExcel"><label for="export-file" id="toEXCEL">EXCEL</label></button></form>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Mã hóa đơn<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mã sinh viên <span class="icon-arrow">&uparrow;</span></th>
                        <th> Mã Khoản thu <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số tiền đã nộp <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Ngày thanh toán <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Hình thức thanh toán <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Nội dung <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> Chức năng <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0 ){
                            $i=0;
                            while($row=mysqli_fetch_assoc($data['dulieu'])){
                                ?>
                                    <tr>
                                        <td><?php echo $row['ma_hoa_don']?></td>
                                        <td><?php echo $row['ma_sinh_vien']?></td>
                                        <td> <?php echo $row['ma_khoan_thu']?> </td>
                                        <td> <?php echo $row['so_tien_da_nop']?> </td>
                                        <td> <?php echo $row['ngay_thanh_toan']?> </td>
                                        <td> <?php echo $row['hinh_thuc_thanh_toan']?> </td>
                                        <td> <?php echo $row['noi_dung']?> </td>
                                        <?php

                                        // Hiển thị nút Sửa
                                        echo '<td class="btn_cn">';
                                        echo '<form action="http://localhost/QLHS_L1/DSHoadon/sua/' . $row['ma_hoa_don'] . '" method="post">';
                                        echo '<button class="button-85" role="button">Sửa</button>  ';
                                        echo '</form>';

                                        // Hiển thị nút Xóa
                                        echo '<form action="http://localhost/QLHS_L1/DSHoadon/xoa/' . $row['ma_hoa_don'] . '" method="post">';
                                        echo '<button class="button-85" onclick="return confirm(\'Bạn có chắc muốn xóa\')" role="button">Xóa</button>';
                                        echo '</form>';
                                        echo '</td>';
                                    ?>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>
