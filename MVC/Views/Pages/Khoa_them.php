<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ThêmKhoa</title>
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
        <h1 style="text-align: center; color: #333;">Thêm Khoa</h1>
        <form action="http://localhost/qlhs/Khoa/themmoi" method="post">
            <div class="form-container">
                <div class="input-group">
                    <label for="ma_khoa">Mã Khoa</label>
                    <input type="text" name="txtMaKhoa" id="ma_khoa" placeholder="Nhập mã Khoa" required>
                </div>

                <div class="input-group">
                    <label for="ten_khoa">Tên Khoa</label>
                    <input type="text" name="txtTenKhoa" id="ten_khoa" placeholder="Tên Khoa" required>
                </div>

                <div class="input-group">
                    <label for="ma_khoa">Liên hệ </label>
                    <input type="text" name="txtLienHe" id="lien_he" placeholder="Nhập liên hệ" required>
                </div>


                <div class="input-group">
                    <label for="ngay_thanh_lap">Ngày thành lập </label>
                    <input type="date" name="txtNgayThanhLap" id="ngay_thanh_lap" placeholder="Ngày thành lâp" required>
                </div>

                <div class="input-group">
                    <label for="tien_moi_tin_chi">Tiền mỗi tín chỉ</label>
                    <input type="text" name="txtTienMoiTinChi" id="tien_moi_tin_chi" placeholder="Nhập tiền mỗi tín chỉ " required>
                </div>
            </div>

            <button type="submit" class="btn" name="btnLuu">Lưu</button>
            <br>
                <div class="quaylai">
                <a href="http://localhost/qlhs/DSKhoa">Quay lại</a>
                </div>


        </form>
    </main>
</body>

</html>