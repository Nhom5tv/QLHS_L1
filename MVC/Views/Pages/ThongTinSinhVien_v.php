<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Sinh Viên</title>
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
            border-bottom: 1px solid #ddd;
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
    </style>
</head>
<body>
<div class="container">
    <div class="avatar">Avatar</div>
    <h1>Thông Tin Sinh Viên</h1>
    <table>
        <?php if (!empty($data['dulieu'])): ?>
            <tr>
                <td>Mã Sinh Viên:</td>
                <td><?php echo $data['dulieu']['ma_sinh_vien']; ?></td>
            </tr>
            <tr>
                <td>Họ và Tên:</td>
                <td><?php echo $data['dulieu']['ho_ten']; ?></td>
            </tr>
            <tr>
                <td>Ngày Sinh:</td>
                <td><?php echo $data['dulieu']['ngay_sinh']; ?></td>
            </tr>
            <tr>
                <td>Ngành Học:</td>
                <td><?php echo $data['dulieu']['ten_nganh']; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $data['dulieu']['email']; ?></td>
            </tr>
            <tr>
                <td>Số Điện Thoại:</td>
                <td><?php echo $data['dulieu']['so_dien_thoai']; ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="2">Không tìm thấy thông tin sinh viên.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="buttons">
        <a href="./ThongTinSinhVien/Update_data/<?php echo $data['dulieu']['ma_sinh_vien']; ?>" class="button">Chỉnh sửa</a>
        <a href="./ThongTinSinhVien/List" class="button">Quay lại</a>
    </div>
</div>
</body>
</html>
