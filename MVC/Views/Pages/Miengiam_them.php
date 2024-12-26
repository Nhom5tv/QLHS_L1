<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Miễn Giảm</title>
    <style>
        .quaylai {
            text-align: center;
            justify-content: center;
            padding-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://localhost/QLHS_L1/Public/CSS/dulieu.css?v=<?php echo time();?>">
</head>
<body>
    <form id="myForm" method="post" action="./themmoi">
        <div class="content">
            <div class="form-box login">
                <h2>Thêm Miễn Giảm</h2>

                <!-- Mã Sinh Viên -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtMasinhvien" style="text-align: center" value="<?php if(isset($data['ma_sinh_vien'])) echo $data['ma_sinh_vien']; ?>">
                    <label>Mã Sinh Viên</label>
                </div>
               
                <!-- Mức Tiền -->
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/soTien.png" alt="" width="15px">
                    </span>
                    <input type="number" max="100"  style="text-align: center" required name="txtMuctien" value="<?php if(isset($data['muc_tien'])) echo $data['muc_tien']; ?>">
                    <label>Mức Tiền(0-100%)</label>
                </div>

                <!-- Loại Miễn Giảm -->
                <label>Loại Miễn Giảm</label>
                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <select name="txtLoaimiengiam" required style="text-align: center;">
                        <option value="">Chọn loại miễn giảm</option>
                        <?php
                        if (isset($data['dsloaikhoanthu']) && mysqli_num_rows($data['dsloaikhoanthu']) > 0) {
                            while ($row = mysqli_fetch_assoc($data['dsloaikhoanthu'])) {
                                // Hiển thị loại đã chọn nếu có
                                $selected = (isset($data['loai_mien_giam']) && $data['loai_mien_giam'] === $row['loai_khoan_thu']) ? 'selected' : '';
                                echo "<option value='{$row['loai_khoan_thu']}' $selected>{$row['loai_khoan_thu']}</option>";
                            }
                        } else {
                            echo "<option value=''>Không có loại miễn giảm</option>";
                        }
                        ?>
                    </select>
                    </div>


                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/category.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtGhichu" style="text-align: center" value="<?php if(isset($data['ghi_chu'])) echo $data['ghi_chu']; ?>">
                    <label>Ghi chú</label>
                </div>

                

                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                    <a href="http://localhost/QLHS_L1/DSMiengiam">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
