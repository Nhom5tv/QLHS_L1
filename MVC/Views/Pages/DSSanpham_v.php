
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wmaspth=device-wmaspth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/CSS/styleDT.css?v=<?php echo time();?>">

    <style >

        .btn_cn {
            display: flex;
            margin: 0;
        }
        
    </style>
</head>

<body>
    <form method="post" action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/timkiem"></form>
    <main class="table" masp="customers_table">
        <section class="table__header">
            <h1>Quản lý sản phẩm</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/timkiem" method="post">         
                <input type="search" placeholder="Mã sản phẩm" name="txtTimkiemMasp" value="<?php if(isset($data['masp'])) echo $data['Masp']?>">
                                             
            </div>
            <div class="input-group"> 
            <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/timkiem" method="post">         
                <input type="search" placeholder="Tên sản phẩm" name="txtTimkiemTensp" value="<?php if(isset($data['tensp'])) echo $data['Tensp']?>">
                                             
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Sanpham" method="post">
                <button class="button-85" role="button">Thêm sản phẩm</button>
                </form>
            
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/timkiem" method="post">
                        <button style="width: 176px;" name="btnXuatExcel"><label for="export-file" id="toEXCEL">EXCEL <img src="./Public/Picture/imagesDT/excel.png" alt=""></label></button></form>
                </div>
            </div>
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Mã sản phẩm<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Tên sản phẩm <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Danh mục <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Giá <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Số lượng <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mô tả <span class="icon-arrow">&UpArrow;</span></th>
                       <th>Hình ảnh <span class="icon-arrow">&UpArrow;</span></th> 

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
                                        <td><?php echo $row['Masp'];?></td>
                                        <td><?php echo $row['Tensp'];?></td>
                                        <td>
                                            <?php echo $row['Madm'];?>
                                        </td>
                                        <td><?php echo $row['Gia'];?></td>
                                        <td><?php echo $row['Soluong'];?></td>
                                        <td><?php echo $row['Mota'];?></td>

                                     <td>
                                     <?php
                                        $hinhanhpath = "./upload/" . $row['Hinhanh'];
                                       
                                        if (is_file($hinhanhpath)) {
                                            $hinhanh = "<img src='" . $hinhanhpath . "' width='200px'>";
                                            echo $hinhanh;
                                        } else {
                                            $hinhanh = "no photo";
                                           
                                        }
                                                    ?>

                                        </td>  
                                        
                                           
                                           
                                            <td class="btn_cn">
                                            <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/sua/<?php echo $row['Masp']?>" method="post">
                                                <button class="button-85"  role="button">Sửa</button> &nbsp;
                                            </form>
                                               <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham/xoa/<?php echo $row['Masp']?>" method="post">
                                                <button class="button-85" onclick="return confirm('Bạn có chắc muốn xóa')" role="button" >Xóa</button>
                                               </form>
                                            </td>
                                        </tr>

                                <?php } } ?>
                                               
            </tbody>
            </table>
        </section>
    </main>
    <!-- <script src="./Public/JS/datatable.js"></script> -->

</body>

</html>
