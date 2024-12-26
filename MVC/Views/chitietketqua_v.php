
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kết quả học tập</title>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css?v=<?php echo time(); ?>">
    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <main class="table">
        <!-- <section class="table__header">
            <div class="input-group">
                <form action="http://localhost/qlhs/DSSinhvien/timkiem" method="post">
                    <input type="search" placeholder="Mã sinh viên" name="txtTimkiemMaSV" value="<?php echo $_POST['txtTimkiemMaSV'] ?? ''; ?>">
                </form>
            </div>
            <div class="input-group">
                <form action="http://localhost/qlhs/DSSinhvien/timkiem" method="post">
                    <input type="search" placeholder="Mã môn học" name="txtTimkiemMaMon" value="<?php echo $_POST['txtTimkiemMaMon'] ?? ''; ?>">
                </form>
            </div>
            <button style="border: none; background: transparent;" type="submit" name="btnTimkiem"><i class="fa fa-search"></i></button>
        </section> -->

        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>STT <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Lần học <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Lần thi <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm chuyên cần <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm cuối kì <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Điểm giữa kì <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Chức năng</th>
                        <!-- <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'giang_vien') { ?>
                            <th>Chức năng</th>
                        <?php } ?> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                            while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                                ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo $row['lan_hoc']; ?></td>
                                    <td><?php echo $row['lan_thi']; ?></td>
                                    <td><?php echo $row['diem_chuyen_can']; ?></td>
                                    <td><?php echo $row['diem_giua_ky']; ?></td>
                                    <td><?php echo $row['diem_cuoi_ky']; ?></td>
                                    <td class="btn_cn">
                                        <form action="http://localhost/qlhs/DSSinhvien/sua/<?php echo $row['ma_dct']; ?>" method="post">
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
