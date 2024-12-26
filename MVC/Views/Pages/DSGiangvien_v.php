<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <main class="table" id="students_table">
        <section class="table__header">
            <h1>Quản lý Giảng viên</h1>

            <div class="input-group"> 
            <form action="http://localhost/qlhs/DSGiangvien/timkiem" method="post">         
                <input type="search" placeholder="Mã GV" name="txtTimkiemMaGV" value="<?php if(isset($data['ma_giang_vien'])) echo $data['ma_giang_vien']?>">
                                              
            </div>
            <div class="input-group">
                <input type="search" placeholder="Họ tên" name="txtTimkiemHoTen" value="<?php if(isset($data['ho_ten'])) echo $data['ho_ten']?>">
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>
            <div class="Insert">
                <form action="http://localhost/qlhs/Giangvien" method="post">
                    <button class="button-85" role="button">Thêm giảng viên</button>
                </form>
            </div>
            <div class="Upload">
                <form action="http://localhost/qlhs/DSGiangvien/uploadExcel" method="post" enctype="multipart/form-data">
                    <input type="file" name="txtFile">
                    <button class="button-85" role="button">Upload</button>
                </form>
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <form action="http://localhost/qlhs/DSGiangvien/exportExcel" method="post">
                        <button style="width: 176px;" name="btnXuatExcel">
                            <label for="export-file" id="toEXCEL">EXCEL <img src="./Public/Picture/imagesDT/excel.png" alt=""></label>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Mã GV <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Mã khoa <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Họ tên <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Số điện thoại <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Chuyên ngành <span class="icon-arrow">&UpArrow;</span></th>
                        <th> ID tài khoản <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Chức năng <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0 ){
                            while($row=mysqli_fetch_assoc($data['dulieu'])){
                                ?>
                                <tr>
                                    <td><?php echo $row['ma_giang_vien']?></td>
                                    <td>
                        <?php
                        // Hiển thị tên khoa từ mã khoa
                        if (isset($data['khoaList']) && !empty($data['khoaList'])) {
                            foreach ($data['khoaList'] as $khoa) {
                                if ($khoa['ma_khoa'] == $row['ma_khoa']) {
                                    echo $khoa['ten_khoa'];
                                    break;
                                }
                            }
                        } else {
                            echo 'Không có khoa';
                        }
                        ?>
                    </td>                                
                                    <td><?php echo $row['ho_ten']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><?php echo $row['so_dien_thoai']?></td>
                                    <td><?php echo $row['chuyen_nganh']?></td>
                                    <td><?php echo $row['ma_tai_khoan']?></td>
                                    <td class="btn_cn">
                                        <form action="http://localhost/qlhs/DSGiangvien/sua/<?php echo $row['ma_giang_vien'] ?>" method="post">
                                            <button class="button-85" role="button">Sửa</button>
                                        </form>
                                        <form action="http://localhost/qlhs/DSGiangvien/xoa/<?php echo $row['ma_giang_vien'] ?>" method="post">
                                            <button class="button-85" onclick="return confirm('Bạn có chắc muốn xóa')" role="button">Xóa</button>
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
</body>

</html>
