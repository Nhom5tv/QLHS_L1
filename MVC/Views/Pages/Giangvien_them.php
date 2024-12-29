<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/button.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/qlhs/Public/CSS/styleDT.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }
        .input-group {
            width: 45%; /* Điều chỉnh chiều rộng để form vừa vặn */
            margin-bottom: 15px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .input-group label {
            font-weight: bold;
            color: #333;
            display: block;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .input-group input:focus,
        .input-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            padding: 12px 20px;
            background-color: #6c757d;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <main>
        <h1 style="text-align: center; color: #333;">Thêm Giảng Viên</h1>
        <form action="http://localhost/qlhs/Giangvien/themmoi" method="post">
            <div class="form-container">
                <div class="input-group">
                    <label for="ma_giang_vien">Mã Giảng Viên</label>
                    <input type="text" name="txtMaGV" id="ma_giang_vien" placeholder="Nhập mã giảng viên" required>
                </div>

                <div class="input-group">
    <label for="ma_khoa">Chọn Khoa</label>
    <select name="txtMaKhoa" id="ma_khoa" required>
        <<option value="">Chọn khoa</option>
                                    <?php 
                            if(isset($data['khoaList']) && mysqli_num_rows($data['khoaList'])>0){
                                
                                    while($r1=mysqli_fetch_array($data['khoaList'])){
                                        echo'<option value="'.$r1['ma_khoa'].'">'.$r1['ten_khoa'].'</option>';
                                        
                                    }
                            }
                            ?>
    </select>
</div>

                <div class="input-group">
                    <label for="ho_ten">Họ Tên</label>
                    <input type="text" name="txtHoTen" id="ho_ten" placeholder="Nhập họ tên" required>
                </div>


                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="txtEmail" id="email" placeholder="Nhập email" required>
                </div>

                <div class="input-group">
                    <label for="so_dien_thoai">Số Điện Thoại</label>
                    <input type="text" name="txtSoDienThoai" id="so_dien_thoai" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="input-group">
                    <label for="chuyen_nganh">Chuyên ngành</label>
                    <input type="text" name="txtChuyenNganh" id="chuyen_nganh" placeholder="Nhập chuyên ngành" required>
                </div>

            <button type="submit" class="btn" name="btnLuu">Lưu</button>
            <br>
                <div class="quaylai">
                <a href="http://localhost/qlhs/DSGiangvien">Quay lại</a>
                </div>


        </form>
    </main>
</body>

</html>
