<?php
if(session_id()=='') session_start();
if(isset($_SESSION['ma_tai_khoan'])== false){
    echo'<script>alert("Chưa đăng ký tài khoản");
    window.location.href = "http://localhost/QLHS/Login";
    </script>';    
}
$id=$_SESSION['ma_tai_khoan'];
echo $id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý Điểm Học Tập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css?v=<?php echo time();?>">

    <style>
        .btn_cn {
            display: flex;
            margin: 0;
        }
    </style>
</head>

<body>
    <main class="table">
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <!-- <th>Mã học phần</th>
                        <th>Tên học phần</th>
                        <th>Số tín chỉ</th> -->
                        <th>Lần học</th>
                        <th>Lần thi</th>
                        <th>Điểm hệ 10</th>
                        <th>Điểm hệ 4</th>
                        <th>Điểm chữ</th>
                        <th>Đánh giá</th>
                        <th>Ghi chú</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        $i=1;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <!-- <td><?php echo $row['ma_mon']; ?></td>
                                <td><?php echo $row['ten_mon']; ?></td>
                                <td><?php echo $row['so_tin_chi']; ?></td> -->
                                <td><?php echo $row['lan_hoc']; ?></td>
                                <td><?php echo $row['lan_thi']; ?></td>
                                <td><?php echo $row['diem_he_10']; ?></td>
                                <td><?php echo $row['diem_he_4']; ?></td>
                                <td><?php echo $row['diem_chu']; ?></td>
                                <td><?php echo $row['danh_gia']; ?></td>
                                <td><?php echo $row['ghi_chu']; ?></td>
                                <td>
                                  <a href="#">Chi tiết</a>  
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