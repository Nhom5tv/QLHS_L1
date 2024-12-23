<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <form id="myForm" method="post" action="./Taikhoan/themmoi">
    <div class="content">
    <div class="form-box login">
            <h2>Thêm tài khoản</h2>
            <form action="#">

            <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="text" required name="txtTendn" value="<?php if(isset($data['ten_dang_nhap'])) echo $data['ten_dang_nhap']?>">
                    <label>Tên đăng nhập</label>
                </div>


                <div class="input-box">
                    <span class="icon">
                    <img src="./Public/Picture/Pic_login/khoa.png" alt="" width="15px">
                    </span>
                    <input type="password" required name="txtMatkhau" value="<?php if(isset($data['mat_khau'])) echo $data['mat_khau']?>">
                    <label>Password</label>
                </div>


                <div class="input-box">
                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/user.png" alt="" width="15px">
                    </span>
                    <input type="text" id="txtQuyen" name="txtQuyen" value="" readonly required placeholder="Chọn quyền" style="text-align: center;">
    <select id="quyenDropdown" onchange="updateQuyen()" style="display: none;">
        <option value="giang_vien">Giảng viên</option>
        <option value="sinh_vien">Sinh viên</option>
    </select>
    <label>Quyền </label>
                </div>
                            
                <div class="input-box">

                    <span class="icon">
                        <img src="./Public/Picture/Pic_login/email.png" alt="" width="15px">
                    </span>
                    <input type="email" required name="txtEmail" value="<?php if(isset($data['email'])) echo $data['email']?>">
                    <label>Email</label>
                </div>
                
                <button type="submit" class="btn" name="btnLuu">Lưu</button>
                <br>
                <div class="quaylai">
                <a href="http://localhost/QLHS_L1/DSTaikhoan">Quay lại</a>
                </div>
                
                <script>
                // Khi nhấp vào ô input, hiển thị danh sách thả xuống
                document.getElementById("txtQuyen").addEventListener("click", function() {
                    document.getElementById("quyenDropdown").style.display = "block";
                });

                // Cập nhật giá trị input và ẩn danh sách thả xuống
                function updateQuyen() {
                    const dropdown = document.getElementById("quyenDropdown");
                    const input = document.getElementById("txtQuyen");
                    input.value = dropdown.value; // Gán giá trị được chọn vào ô input
                    dropdown.style.display = "none"; // Ẩn danh sách thả xuống
                    label.style.display = "none"; // Ẩn label sau khi chọn giá trị
                }

                // Ẩn danh sách thả xuống nếu click ra ngoài
                document.addEventListener("click", function(event) {
                    const input = document.getElementById("txtQuyen");
                    const dropdown = document.getElementById("quyenDropdown");
                    if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.style.display = "none";
                    }
                });
</script>
                
            
        </div>
        </div>
    </form>
    
</body>
</html>