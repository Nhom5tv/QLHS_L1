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
    <form method="post" action="http://localhost/qlhs/dslichhoc/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Quản lý lịch học</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/qlhs/dslichhoc/timkiem" method="post">         
                <input type="search" placeholder="Mã Môn Học" name="txtTimkiemmamon" value="<?php if(isset($data['ma_mon_hoc'])) echo $data['ma_mon_hoc']?>">
                                             
            </div>
            <div class="input-group"> 
                  
                <input type="search" placeholder="Lịch Học" name="txtTimkiemlichhoc" value="<?php if(isset($data['lich_hoc'])) echo $data['lich_hoc']?>">
                                             
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiemlich"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/qlhs/lichhoc" method="post">
                <button class="button-85" role="button">Thêm Lịch Học</button>
                </form>
            
            </div>
            <div>
            <form action="http://localhost/qlhs/lichhoc/dongall" method="post">
                                                <button class="button-85" onclick="return confirm('Bạn có chắc muốn đóng')" role="button" >Đóng Tất Cả</button>
                                               </form>
            
                                               </div>
            <div >
                <!-- <form action="http://localhost/qlhs/dslichhoc/timkiem" method="post">
                    <button type="submit" class="button-85" name="btnXuatExcel2">Xuất Excel</button>
                </form> -->
            
            </div>
           
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mã Môn Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Còn Lại <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số Lượng Tối Đa <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Lịch Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Trạng Thái <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> TOOL <span class="icon-arrow">&UpArrow;</span></th>
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
                                                <?php echo $row['id_lich_hoc']?>
                                            </td>
                                            <td> <?php echo $row['ma_mon_hoc']?> </td>
                                            <td> <?php echo $row['so_luong']?> </td>
                                            <td> <?php echo $row['so_luong_toi_da']?> </td>
                                            <td> <?php echo $row['lich_hoc']?> </td>
                                            <td> <?php echo $row['trang_thai']?> </td>
                                                                                      
                                           
                                           
                                            <td class="btn_cn">
                                            <form action="http://localhost/qlhs/dslichhoc/sua/<?php echo $row['id_lich_hoc']?>" method="post">
                                                <button class="button-85"  role="button">Sửa</button> &nbsp;
                                            </form>
                                               <form action="http://localhost/qlhs/dslichhoc/xoa/<?php echo $row['id_lich_hoc']?>" method="post">
                                                <button class="button-85" onclick="return confirm('Bạn có chắc muốn xóa')" role="button" >Xóa</button>
                                               </form>
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
