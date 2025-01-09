<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Sinh Viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .avatar {
            width: 120px;
            height: 120px;
            background-color: #eaeaea;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            color: #999;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        table {
            width: 100%;
            margin: 0 auto 20px;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            text-align: left;
        }

        table td:first-child {
            font-weight: 500;
            color: #555;
            text-align: right;
            width: 40%;
        }

        table td:last-child {
            text-align: left;
            width: 60%;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button.cancel {
            background-color: #dc3545;
        }

        .button.cancel:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="avatar">Avatar</div>
    <h1>Sửa Thông Tin Sinh Viên</h1>
    <form action="<?php echo $data['dulieu']['ma_sinh_vien']; ?>" method="POST">
        <table>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?php echo $data['dulieu']['email']; ?>" required></td>
            </tr>
            <tr>
                <td>Số Điện Thoại:</td>
                <td><input type="text" name="soDienThoai" value="<?php echo $data['dulieu']['so_dien_thoai']; ?>" required></td>
            </tr>
        </table>
        <div class="buttons">
            <a href="http://localhost/QLHS/ThongTinSinhVien" class="button cancel">Hủy</a>
            <button type="submit"  name= "btnluu" class="button">Lưu Thay Đổi</button>
        </div>
    </form>
</div>
</body>
</html>
