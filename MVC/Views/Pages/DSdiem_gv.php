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
        .flex-container {
    display: flex; /* Sử dụng flexbox */
    align-items: center; /* Căn giữa theo chiều dọc */
    gap: 10px; /* Khoảng cách giữa các phần tử */
}

.select-class {
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
}




    </style>
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
        <div class="Insert">
    <div class="flex-container">
        <!-- Select box -->
        <form action="http://localhost/qlhs/DSdiemtungmon_gv" method="post" class="form-container">
            <select name="class_id" class="select-class" onchange="this.form.submit()">
                <option value="" disabled selected>Chọn lớp</option>
                <?php
                    if (isset($data['classes']) && $data['classes'] instanceof mysqli_result && mysqli_num_rows($data['classes']) > 0) {
                        while ($class = mysqli_fetch_assoc($data['classes'])) {
                            $selected = (isset($_POST['class_id']) && $_POST['class_id'] == $class['ma_lop']) ? 'selected' : '';
                            echo '<option value="' . $class['ma_lop'] . '" ' . $selected . '>Lớp ' . $class['ma_lop'] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>Không có lớp nào</option>';
                    }
                ?>
            </select>
        </form>

        <!-- Button "Xuất Excel" -->
        <?php if (isset($_POST['class_id']) || isset($_GET['class_id'])): ?>
            <a href="http://localhost/qlhs/DSdiemtungmon_gv/exportExcel?class_id=<?= $_POST['class_id'] ?? $_GET['class_id'] ?>" class="button-85">Xuất Excel</a>
        <?php endif; ?>
    </div>
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
                    // Check if there are any student scores available
                    if (isset($data['dulieu']) && $data['dulieu'] instanceof mysqli_result && mysqli_num_rows($data['dulieu']) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {  
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['ma_sinh_vien']; ?></td>
                        <td><?php echo isset($row['ho_ten']) ? $row['ho_ten'] : 'Không có tên'; ?></td>
                        <td><?php echo $row['lan_hoc']; ?></td>
                        <td><?php echo $row['lan_thi']; ?></td>
                        <td><?php echo $row['diem_chuyen_can']; ?></td>
                        <td><?php echo $row['diem_giua_ky']; ?></td>
                        <td><?php echo $row['diem_cuoi_ky']; ?></td>
                        <td class="btn_cn">
                            <form action="http://localhost/qlhs/DSdiemtungmon_gv/sua/<?php echo $row['ma_dct']; ?>" method="post">
                                <input type="hidden" name="class_id" value="<?php echo isset($_POST['class_id']) ? $_POST['class_id'] : ''; ?>">
                                <button class="button-85" role="button">Sửa</button>
                            </form>
                        </td>

                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>
