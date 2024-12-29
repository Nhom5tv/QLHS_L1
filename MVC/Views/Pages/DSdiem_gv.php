<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .select-class {
            padding: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/qlhs/DSTaikhoan/timkiem"></form>
    <main class="table" id="customers_table">
        <section class="table__header">
            <div class="Insert">
                <form action="http://localhost/qlhs/Diemchitiet" method="post" class="form-container">
                    <!-- Select box for choosing a class -->
                    <select name="class_id" class="select-class">
                        <option value="" disabled selected>Chọn lớp</option>
                        <?php
                        // Assuming you have a list of classes stored in $classes
                        if (isset($data['classes']) && mysqli_num_rows($data['classes']) > 0) {
                            while ($row = mysqli_fetch_assoc($data['classes'])) {
                                echo '<option value="' . $row['class_id'] . '">' . $row['class_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button class="button-85" role="button">Thêm điểm sinh viên</button>
                </form>
            </div>
        </section>
        
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>STT <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Mã sinh viên <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Tên sinh viên <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Lần học <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Lần thi <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm chuyên cần <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm giữa kì <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm cuối kì <span class="icon-arrow">&UpArrow;</span></th>
                        <th style="padding-left:50px"> Chức năng <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {  
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['ma_sinh_vien']; ?></td>
                        <td><?php echo $row['lan_hoc']; ?></td>
                        <td><?php echo $row['lan_thi']; ?></td>
                        <td><?php echo $row['diem_chuyen_can']; ?></td>
                        <td><?php echo $row['diem_giua_ky']; ?></td>
                        <td><?php echo $row['diem_cuoi_ky']; ?></td>
                        <td class="btn_cn">
                            <form action="http://localhost/qlhs/DSdiemchitiet/sua/<?php echo $row['ma_dct']; ?>" method="post">
                                <button class="button-85" role="button">Sửa</button>
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
