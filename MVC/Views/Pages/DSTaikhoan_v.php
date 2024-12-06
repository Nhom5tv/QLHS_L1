
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Public/CSS/styleDT.css">
    <style >
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Quản lý tài khoản</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan/timkiem" method="post">         
                <input type="search" placeholder="ID" name="txtTKID" value="<?php if(isset($data['id'])) echo $data['id']?>">
                                             
            </div>
            <div class="input-group">
            <input type="search" placeholder="quyền" name="txtTKQuyen" value="<?php if(isset($data['quyen'])) echo $data['quyen']?>">
 
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Taikhoan" method="post">
                <button class="button-85" role="button">Thêm tài khoản</button>
                </form>
            
            </div>
            <div class="Upload">
                <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Taikhoan/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="txtFile">
                <button class="button-85" role="button">Upload</button>
                </form>
            
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan/timkiem" method="post">
                    <button style="width: 176px;" name="btnXuatExcel"><label for="export-file" id="toEXCEL">EXCEL <img src="./Public/Picture/imagesDT/excel.png" alt=""></label></button></form>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Quyền <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mật khẩu <span class="icon-arrow">&UpArrow;</span></th>
                        
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
                                            
                                            <td>
                                                <?php echo $row['Id']?>
                                            </td>
                                            <td> <?php echo $row['Email']?> </td>
                                            <td> <?php echo $row['Quyen']?> </td>
                                            <td> <?php echo $row['Matkhau']?> </td>
                                           
                                           
                                            <?php
if ($row['Quyen'] == 'Nhân viên') {
    // Hiển thị nút Sửa
    echo '<td class="btn_cn">';
    echo '<form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan/sua/' . $row['Id'] . '" method="post">';
    echo '<button class="button-85" role="button">Sửa</button>  ';
    echo '</form>';

    // Hiển thị nút Xóa
    echo '<form action="http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSTaikhoan/xoa/' . $row['Id'] . '" method="post">';
    echo '<button class="button-85" onclick="return confirm(\'Bạn có chắc muốn xóa\')" role="button">Xóa</button>';
    echo '</form>';
    echo '</td>';
}
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
