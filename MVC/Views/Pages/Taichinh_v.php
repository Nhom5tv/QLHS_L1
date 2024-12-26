<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/button.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/QLHS_L1/Public/CSS/styleDT.css">
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
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/select2.css?v=<?php echo time();?>">

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
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time();?>">
    <style>
      .content{
        width: 550px;
        margin:10px;
        height: 600px;
        
      }
      .input-box input{
        width : 100%;
      }
      
    </style>
</head>

<body>
    <form method="post" action="http://localhost/QLHS_L1/DSDonhang/timkiem"></form>
    <main class="table" id="customers_table" style="margin-top: 30px;">
        <section class="table__header">
            <h1>Các khoản phải nộp</h1>
           
            
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