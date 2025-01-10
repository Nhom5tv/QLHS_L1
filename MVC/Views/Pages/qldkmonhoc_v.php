<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>
<body>
    <form method="post" action="http://localhost/qlhs/dsdkmonhoc/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Danh sách đăng ký môn học</h1>
            <div class="input-group">
                <form action="http://localhost/qlhs/dsdkmonhoc/timkiem" method="post">        
                    <input type="search" placeholder="Mã Sinh Viên" name="txttkmasv" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien'] ?>">
            </div>
            <div class="input-group">
                <form action="http://localhost/qlhs/dsdkmonhoc/timkiem" method="post">        
                    <input type="search" placeholder="Mã môn" name="txttkmamon" value="<?php if(isset($data['ma_mon'])) echo $data['ma_mon'] ?>">
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search" ></i></button>
            </form>  
            <div>
            <form action="http://localhost/qlhs/qldkmonhoc/cancel" method="post">
                                                <button class="button-85" onclick="return confirm('Bạn có chắc muốn huỷ')" role="button" >Huỷ Tất Cả</button>
                                               </form>
            
                                               </div>

           
            

           
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>Mã Đăng Ký <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Mã Môn <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Mã Sinh Viên <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Mã Lớp <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Lịch Học Dự Kiến <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Trạng Thái <span class="icon-arrow">&UpArrow;</span></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0) {
                            while($row = mysqli_fetch_assoc($data['dulieu'])) {
                                ?>
                                <tr>
                                    <td><?php echo $row['ma_dang_ky'] ?></td>
                                    <td><?php echo $row['ma_mon'] ?></td>
                                    <td><?php echo $row['ma_sinh_vien'] ?></td>
                                    <td><?php echo $row['ma_lop'] ?></td>
                                    
                                    <td><?php echo $row['lich_hoc_du_kien'] ?></td>
                                    <td><?php echo $row['trang_thai'] ?></td>
                                    <!-- <td class="btn_cn">
                                        <form action="http://localhost/qlhs/dsdkmonhoc/sua/<?php echo $row['ma_dang_ky'] ?>" method="post">
                                            <button class="button-85" role="button">Sửa</button>
                                        </form>

                                        <form action="http://localhost/qlhs/dsdkmonhoc/xoa/<?php echo $row['ma_dang_ky'] ?>" method="post">
                                            <button class="button-85" onclick="return confirm('Bạn có chắc muốn xóa')" role="button">Xóa</button>
                                        </form>
                                    </td> -->
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