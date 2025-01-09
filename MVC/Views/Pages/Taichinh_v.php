<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/QLHS/Public/CSS/styleDT.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style >
        .btn_cn {
            display: flex;
            margin: 0;
        }
        .main.table{
            width: 950px;
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css">
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/select2.css?v=<?php echo time();?>">

    <style>
        .quaylai {
    text-align: center;
    justify-content: center;
    padding-top: 5px;
          }
    .main-content{
      width: 100%;
      display: flex;
    }
    </style>
    <link rel="stylesheet" href="http://localhost/QLHS/Public/CSS/dulieu.css?v=<?php echo time();?>">
    <style>
      .content{
        width: 550px;
        margin:10px;
        height: 600px;
        
      }
      .input-box input{
        width : 100%;
      }
      .status-label {
        display: inline-block !important;
    color: #fff !important;
    background-color: #28a745 ;
   
    padding: 5px 10px;
    
    font-weight: bold;
    border-radius: 4px;
    
    margin: 10px 0;
}

.status-complete {
    background-color: #28a745 !important; /* Màu xanh */
}

.status-incomplete {
    background-color: #dc3545 !important; /* Màu đỏ */
}


      
    </style>
</head>

<body>
    <form method="post" action="http://localhost/QLHS/DSDonhang/timkiem"></form>
    <main class="table" id="customers_table" style="margin-top: 30px;">
            <?php
        $tong_trang_thai = 'Đã hoàn thành';
        if (isset($data['dsphainop']) && mysqli_num_rows($data['dsphainop']) > 0) {
            while ($row = mysqli_fetch_assoc($data['dsphainop'])) {
                if ($row['trang_thai_thanh_toan'] != 'Đã thanh toán') {
                    $tong_trang_thai = 'Chưa hoàn thành';
                    break; // Dừng vòng lặp ngay khi tìm thấy trạng thái chưa thanh toán
                }
            }
            // Reset lại con trỏ kết quả để dùng tiếp bên dưới
            mysqli_data_seek($data['dsphainop'], 0);
        }
        ?>
        <?php
$thong_bao_popup = '';
if (isset($data['dsphainop']) && mysqli_num_rows($data['dsphainop']) > 0) {
    while ($row = mysqli_fetch_assoc($data['dsphainop'])) {
        $today = date('Y-m-d');
        if (strtotime($row['han_nop']) <= strtotime($today . ' +7 days') && $row['trang_thai_thanh_toan'] != 'Đã thanh toán') {
            $thong_bao_popup .= 'Khoản thu "' . $row['ten_khoan_thu'] . '" sắp đến hạn nộp vào ngày ' . $row['han_nop'] . '\\n';
        }
    }
    mysqli_data_seek($data['dsphainop'], 0);
}
?>
<script>
    const message = '<?php echo $thong_bao_popup; ?>';
    // console.log("Thông báo kiểm tra:", message); // Kiểm tra nội dung của biến message
    if (message) {
        Swal.fire({
            title: 'Thông Báo Quan Trọng!',
            text: message,
            icon: 'warning',
            confirmButtonText: 'Đã hiểu'
        });
    }
</script>


        <section class="table__header">
            <h1>Các khoản phải nộp</h1>
            <div style="text-align: center; margin: 10px 0;">
    <?php
    if ($tong_trang_thai == 'Đã hoàn thành') {
        echo '<span class="status-label status-complete">Đã hoàn thành</span>';
    } else {
        echo '<span class="status-label status-incomplete">Chưa hoàn thành</span>';
    }
    ?>
</div>


        </section>

        <section class="table__body">
            <table>
                <thead>
                    <tr>
                    <th>Tên khoản thu</th>
                    <th>Ngày tạo</th>
                    <th>Hạn nộp</th>
                    <th>Số tiền ban đầu</th>
                    <th>Số tiền miễn giảm</th>
                    <th>Số tiền phải nộp</th>
                    <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($data['dsphainop']) && mysqli_num_rows($data['dsphainop'])>0 ){
                            $i=0;
                            while($row=mysqli_fetch_assoc($data['dsphainop'])){
                                
                                ?>
                                        <tr>
                                           
                                            <td> <?php echo $row['ten_khoan_thu']?> </td>
                                            
                                            <td> <?php echo $row['ngay_tao']?> </td>
                                            <td> <?php echo $row['han_nop']?> </td>
                                            <td> <?php echo $row['so_tien_ban_dau']?> </td>
                                            <td> <?php echo $row['so_tien_mien_giam']?> </td>
                                            <td> <?php echo $row['so_tien_phai_nop']?> </td>
                                            <td> <?php echo $row['trang_thai_thanh_toan']?> </td>
                                           
                                            
                                            
                                           
                                           
                                            
                                        </tr>

                                <?php

                            }
                        }
                    ?>
            </tbody>
            </table>
        </section>
    </main>
    <div class="content-2">
    
    <form id="myForm" method="post" action="./Taichinh">
    
   
    
          
    <main class="table" id="customers_table" style="width: 750px; margin: 30px;">
        <section class="table__header">
            <h1>Thông tin hóa đơn</h1>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Tên khoản thu</th>
                        <th>Số tiền đã nộp</th>
                        <th>Ngày thanh toán</th>
                        <th>Hình thức thanh toán</th>
                        <th>Nội dung</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                            ?>
                            <tr>
                                <td><?php echo $row['ma_hoa_don']; ?></td>
                                <td><?php echo $row['ten_khoan_thu']; ?></td>
                                <td><?php echo $row['so_tien_da_nop']; ?></td>
                                <td><?php echo $row['ngay_thanh_toan']; ?></td>
                                <td><?php echo $row['hinh_thuc_thanh_toan']; ?></td>
                                <td><?php echo $row['noi_dung']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align: center;">Không có hóa đơn nào</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
                
        
                
                
                
                
                
                
            
        
        </div>
        </form>
        
    </div>
    
    

</body>

</html>