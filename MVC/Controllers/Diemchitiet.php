<?php 
class Diemchitiet extends controller {
    private $diemchitiet;

    function __construct() {
        // Khởi tạo model Diemchitiet_m
        $this->diemchitiet = $this->model('Diemchitiet_m');
    }

    // Hiển thị giao diện thêm điểm chi tiết
    function Get_data() {
        // Gọi view thêm mới điểm chi tiết
        $this->view('Masterlayout', ['page' => 'Diemchitiet_them']);
    }

    // Thêm mới điểm chi tiết
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            // Lấy dữ liệu từ form
            $ma_lop = $_POST['txtMaLop'];
            $ma_sinh_vien = $_POST['txtMaSinhVien'];
            $lan_hoc = $_POST['txtLanHoc'];
            $lan_thi = $_POST['txtLanThi'];
            $diem_chuyen_can = $_POST['txtDiemChuyenCan'];
            $diem_giua_ky = $_POST['txtDiemGiuaKy'];
            $diem_cuoi_ky = $_POST['txtDiemCuoiKy'];

            // Kiểm tra dữ liệu đầu vào
            if (empty($ma_lop) || empty($ma_sinh_vien) || empty($lan_hoc) || empty($lan_thi)) {
                echo '<script>alert("Vui lòng điền đầy đủ thông tin!");</script>';
                return;
            }

            // // Kiểm tra trùng ID (giả sử bạn đã có phương thức kiểm tra trùng ID trong model)
            // $kq1 = $this->diemchitiet->kiemtra_trung_id($ma_sinh_vien, $lan_hoc, $lan_thi);
            // if ($kq1) {
            //     echo '<script>
            //         alert("Trùng dữ liệu điểm chi tiết (ID sinh viên, lần học, lần thi đã tồn tại)");
            //         window.location.href = "http://localhost/qlhs/Diemchitiet";
            //     </script>';
            //     exit();
            // }

            // Thêm mới điểm chi tiết
            $kq = $this->diemchitiet->diemchitiet_ins($ma_lop, $ma_sinh_vien, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky);

            if ($kq) {
                echo '<script>
                    alert("Thêm mới điểm chi tiết thành công");
                    window.location.href = "http://localhost/qlhs/DSdiemchitiet";
                </script>';
                exit();
            } else {
                $error = mysqli_error($this->diemchitiet->getDbConnection());
                echo '<script>alert("Thêm mới thất bại. Lỗi: ' . $error . '");</script>';
            }
        }
    }
}
?>
