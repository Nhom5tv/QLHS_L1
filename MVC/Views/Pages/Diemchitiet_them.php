<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Điểm Chi Tiết</title>
    <style>
        .quaylai {
            text-align: center;
            justify-content: center;
            padding-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/dulieu.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Form thêm mới điểm chi tiết -->
    <form id="myForm" method="post" action="http://localhost/qlhs/Diemchitiet/themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Điểm Chi Tiết</h2>

                <!-- Mã Lớp -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/class.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMaLop" value="<?php if(isset($data['ma_lop'])) echo $data['ma_lop']; ?>">
                    <label>Mã Lớp</label>
                </div>

                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/student.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMaSinhVien" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']; ?>">
                    <label>Mã Sinh Viên</label>
                </div>

                <!-- Lần Học -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/study.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtLanHoc" value="<?php if(isset($data['lan_hoc'])) echo $data['lan_hoc']; ?>">
                    <label>Lần Học</label>
                </div>

                <!-- Lần Thi -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/exam.png" alt="" width="15px">
                    </span>
                    <input type="number" required name="txtLanThi" value="<?php if(isset($data['lan_thi'])) echo $data['lan_thi']; ?>">
                    <label>Lần Thi</label>
                </div>

                <!-- Điểm Chuyên Cần -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/attendance.png" alt="" width="15px">
                    </span>
                    <input type="number" step="0.1" required name="txtDiemChuyenCan" value="<?php if(isset($data['diem_chuyen_can'])) echo $data['diem_chuyen_can']; ?>">
                    <label>Điểm Chuyên Cần</label>
                </div>

                <!-- Điểm Giữa Kỳ -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/midterm.png" alt="" width="15px">
                    </span>
                    <input type="number" step="0.1" required name="txtDiemGiuaKy" value="<?php if(isset($data['diem_giua_ky'])) echo $data['diem_giua_ky']; ?>">
                    <label>Điểm Giữa Kỳ</label>
                </div>

                <!-- Điểm Cuối Kỳ -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/final.png" alt="" width="15px">
                    </span>
                    <input type="number" step="0.1" required name="txtDiemCuoiKy" value="<?php if(isset($data['diem_cuoi_ky'])) echo $data['diem_cuoi_ky']; ?>">
                    <label>Điểm Cuối Kỳ</label>
                </div>

                <!-- Nút Lưu -->
                <div class="input-box">
                    <button type="submit" class="btn" name="btnLuu">Lưu</button>
                </div>

                <!-- Nút Quay Lại -->
                <div class="quaylai">
                    <a href="javascript:history.back()">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>