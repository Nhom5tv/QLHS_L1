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

<body style="display: block;">
    <form method="post" action="http://localhost/qlhs/dslophoc/timkiem"></form>
   
    <!-- <script src="./Public/JS/datatable.js"></script> -->
    <div class="table-wrapper">
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Đăng Ký Tín Chỉ</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/QLHS/Svdktinchi/timkiem" method="post">         
                <input type="search" placeholder="Tên Môn Học" name="txtTimkiemmonhoc" value="<?php if(isset($data['ten_mon_hoc'])) echo $data['ten_mon_hoc']?>">
                                             
            </div>
            <div class="input-group"> 
                  
                <input type="search" placeholder="Lịch Học" name="txtTimkiemlichhoc" value="<?php if(isset($data['lich_hoc_du_kien'])) echo $data['lich_hoc_du_kien']?>">
                                             
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiemtin"><i class="fa fa-search" ></i></button>
            </form>
           
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
                        <th> Mã Môn Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Tên Môn Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số Tín Chỉ <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số Lượng <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Còn Lại <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Lịch Học Dự Kiến <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> Chọn <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php
if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($data['dulieu'])) {
        ?>
        <tr>
            <td>
                <?php echo $row['ma_mon_hoc']; ?>
            </td>
            <td>
                <?php echo $row['ten_mon_hoc']; ?>
            </td>
            <td>
                <?php echo $row['so_tin_chi']; ?>
            </td>
            <td>
                <?php echo $row['so_luong_toi_da']; ?>
            </td>
            <td>
                <?php echo $row['con_lai']; ?>
            </td>
            <td>
                <?php echo $row['lich_hoc_du_kien']; ?>
            </td>
            <td class="btn_cn">
                <?php if (isset($row['trang_thai_dang_ky']) && trim($row['trang_thai_dang_ky']) == 'Đang Chờ Duyệt') : ?>
                    <!-- Nếu đã đăng ký hoặc đang chờ duyệt -->
                    <button class="button-85" disabled style="background-color: gray; cursor: not-allowed;">Đã đăng ký</button>
                <?php elseif (isset($row['con_lai']) && trim($row['con_lai']) == 0) :  ?>
                    <!-- Nếu chưa đăng ký -->
                    <form action="http://localhost/QLHS/svdktinchi/dk" method="post">
                        <button class="button-85" disabled style="background-color: gray; cursor: not-allowed;">Đã Hết Chỗ</button>
                    </form>
                    <?php else : ?>
                    <!-- Nếu chưa đăng ký -->
                    <form action="http://localhost/QLHS/svdktinchi/dk" method="post">
                        <input type="hidden" name="id_lich_hoc" value="<?php echo $row['id_lich_hoc']; ?>">
                        <input type="hidden" name="ma_mon_hoc" value="<?php echo $row['ma_mon_hoc']; ?>">
                        <input type="hidden" name="lich_hoc_du_kien" value="<?php echo $row['lich_hoc_du_kien']; ?>">
                        <button class="button-85" onclick="return confirm('Bạn có chắc muốn Đăng Ký không ?')" role="button">Đăng Ký</button>
                    </form>
                <?php endif; ?>
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
    </div>
   
    <div class="table-wrapper">
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Danh Sách Đã Đăng Ký</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/qlhs/dslophoc/timkiem" method="post">         
                <input type="search" placeholder="Tên Môn Học" name="txtTimkiemmanganh" value="<?php if(isset($data['ma_nganh'])) echo $data['ma_nganh']?>">
                                             
            </div>
            <div class="input-group"> 
                  
                <input type="search" placeholder="Số Tín Chỉ" name="txtTimkiemmagiangvien" value="<?php if(isset($data['ma_giang_vien'])) echo $data['ma_giang_vien']?>">
                                             
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiemlop"><i class="fa fa-search" ></i></button>
            </form>
           
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
                        <th> Mã Môn Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Tên Môn Học <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số Tín Chỉ <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số Lượng <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Còn Lại <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Lịch Học Dự Kiến <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> Chọn <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dulieu2']) && mysqli_num_rows($data['dulieu2'])>0 ){
                            $i=0;
                            while($row=mysqli_fetch_assoc($data['dulieu2'])){
                                
                                ?>
                                        <tr>
                                        <td>
                                                <?php echo $row['ma_mon_hoc']?>
                                            </td>
                                            <td> <?php echo $row['ten_mon_hoc']?> </td>
                                            <td> <?php echo $row['so_tin_chi']?> </td>
                                            <td> <?php echo $row['so_luong_toi_da']?> </td>
                                            <td> <?php echo $row['con_lai']?> </td>
                                            <td> <?php echo $row['lich_hoc_du_kien']?> </td>
                                           
                                           
                                            <td class="btn_cn">
                                               <form action="http://localhost/qlhs/SVdktinchi/xoa/<?php echo $row['ma_dang_ky']?>" method="post">
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
    </div>
    <!-- <script src="./Public/JS/datatable.js"></script> -->
</body>

</html>
