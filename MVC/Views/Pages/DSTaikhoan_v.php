
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/QLHS/Public/CSS/styleDT.css">
    <style >
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/QLHS/DSTaikhoan/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Quản lý tài khoản</h1>
           
            <div class="input-group"> 
            <form action="http://localhost/QLHS/DSTaikhoan/timkiem" method="post">         
                <input type="search" placeholder="ID" name="txtTKID" value="<?php if(isset($data['ma_tai_khoan'])) echo $data['ma_tai_khoan']?>">
                                             
            </div>
            <div class="input-group">
            <div style="position: relative;">
            <input type="text" id="txtTKQuyen" name="txtTKQuyen" placeholder="Quyền" readonly
                   value="<?php if(isset($data['phan_quyen'])) echo $data['phan_quyen'] ?>" required>
            <select id="quyenDropdown" onchange="updateQuyen()" style="display: none; position: absolute; top: 100%; left: 0; width: 100%;"value="<?php if(isset($data['phan_quyen'])) echo $data['phan_quyen']?>">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="giang_vien">Giảng viên</option>
                <option value="sinh_vien">Sinh viên</option>
            </select>
        </div>

        <script>
    // Hiển thị danh sách thả xuống khi nhấp vào ô quyền
    document.getElementById("txtTKQuyen").addEventListener("click", function() {
        document.getElementById("quyenDropdown").style.display = "block";
    });

    // Cập nhật giá trị quyền vào ô input và ẩn danh sách
    function updateQuyen() {
        const dropdown = document.getElementById("quyenDropdown");
        const input = document.getElementById("txtTKQuyen");
        input.value = dropdown.value; // Gán giá trị được chọn vào ô input
        dropdown.style.display = "none"; // Ẩn danh sách thả xuống
    }

    // Ẩn danh sách nếu click ra ngoài
    document.addEventListener("click", function(event) {
        const input = document.getElementById("txtTKQuyen");
        const dropdown = document.getElementById("quyenDropdown");
        if (!input.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
</script>
 
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/QLHS/Taikhoan" method="post">
                <button class="button-85" role="button">Thêm tài khoản</button>
                </form>
            
            </div>
            <div class="Upload">
                <form action="http://localhost/QLHS/DSTaikhoan/uploadExcel" method="post" enctype="multipart/form-data">
                <input type="file" name="txtFile">
                <button class="button-85" role="button">Upload</button>
                </form>
            
            </div>

            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File" ><img src="./Public/Picture/export.png" alt="" width="20"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <form action="http://localhost/QLHS/DSTaikhoan/exportExcel" method="post">
                    <button style="width: 176px;" name="btnXuatExcel"><label for="export-file" id="toEXCEL">EXCEL</label></button></form>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Mã <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Tên đăng nhập <span class="icon-arrow">&uparrow;</span></th>
                        <th> Mật khẩu <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Quyền <span class="icon-arrow">&UpArrow;</span></th>
                        
                        
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
                                            <td><?php echo $row['ma_tai_khoan']?></td>
                                            <td><?php echo $row['ten_dang_nhap']?></td>
                                            <td> <?php echo $row['mat_khau']?> </td>
                                            <td> <?php echo $row['email']?> </td>
                                            <td> <?php echo $row['phan_quyen']?> </td>
                                            <?php
if ($row['phan_quyen'] == 'giang_vien' || $row['phan_quyen'] == 'sinh_vien' ) {
    // Hiển thị nút Sửa
    echo '<td class="btn_cn">';
    echo '<form action="http://localhost/QLHS/DSTaikhoan/sua/' . $row['ma_tai_khoan'] . '" method="post">';
    echo '<button class="button-85" role="button">Sửa</button> ';
    echo '</form>';

    // Hiển thị nút Xóa
    echo '<form action="http://localhost/QLHS/DSTaikhoan/xoa/' . $row['ma_tai_khoan'] . '" method="post">';
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
