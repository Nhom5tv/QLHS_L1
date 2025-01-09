<?php
class DSdiemchitiet extends controller {
    private $dstk;

    function __construct() {
        // Khởi tạo model Diemchitiet_m
        $this->dstk = $this->model('Diemchitiet_m');
    }

    // Hiển thị danh sách điểm chi tiết
    function Get_data() {
        $id = $_SESSION['ma_tai_khoan']; // Lấy mã tài khoản (hoặc mã sinh viên)

        // Kiểm tra nếu mã lớp tồn tại
        if (isset($_GET['ma_lop'])) {
            $ma_lop = $_GET['ma_lop'];
            // Xử lý với $ma_mon
        }
        // Trả về view với dữ liệu từ model
        $this->view('Masterlayout', [
            'page' => 'DSdiemchitiet_v',
            'dulieu' => $this->dstk->getAllDiemChiTiet($id,$ma_lop)
        ]);
    }

    // // Hiển thị form sửa điểm chi tiết
    // function sua($id) {
    //     // Lấy dữ liệu theo ID để hiển thị trong form sửa
    //     $dulieu = $this->dstk->diemchitiet_find($id);
        
    //     // Kiểm tra nếu không tìm thấy dữ liệu
    //     if (empty($dulieu)) {
    //         echo '<script>alert("Dữ liệu không tồn tại"); window.location.href = "/qlhs/DSdiemchitiet/Get_data";</script>';
    //         exit;
    //     }

    //     // Trả về view sửa điểm chi tiết với dữ liệu
    //     $this->view('Masterlayout', [
    //         'page' => 'DSdiemchitiet_sua',
    //         'dulieu' => $dulieu
    //     ]);
    // }

    // // Xử lý cập nhật điểm chi tiết
    // function suadl() {
    //     // Kiểm tra khi người dùng nhấn nút "Lưu"
    //     if (isset($_POST['btnLuu'])) {
    //         // Lấy dữ liệu từ form
    //         $id = $_POST['txtId'];
    //         // $ma_lop = $_POST['txtMaLop'];
    //         // $ma_sinh_vien = $_POST['txtMaSinhVien'];
    //         $lan_hoc = $_POST['txtLanHoc'];
    //         $lan_thi = $_POST['txtLanThi'];
    //         $diem_chuyen_can = $_POST['txtDiemChuyenCan'];
    //         $diem_giua_ky = $_POST['txtDiemGiuaKy'];
    //         $diem_cuoi_ky = $_POST['txtDiemCuoiKy'];

    //         // Kiểm tra dữ liệu đầu vào
    //         // if (empty($ma_sinh_vien) || empty($ma_lop)) {
    //         //     echo '<script>alert("Vui lòng điền đầy đủ thông tin");</script>';
    //         //     return;
    //         // }

    //         // Cập nhật điểm chi tiết trong cơ sở dữ liệu
    //         $kq = $this->dstk->diemchitiet_upd($id, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky);

    //         // Kiểm tra kết quả cập nhật
    //         if ($kq) {
    //             // $dsdiem = new DSdiem();
    //             // $dsdiem->capNhatDiemTongHop();
    //             echo '<script>alert("Sửa điểm chi tiết thành công");</script>';
    //             // Sau khi sửa, quay lại trang danh sách điểm chi tiết
    //             echo '<script>window.location.href = "/qlhs/DSdiemchitiet/Get_data";</script>';
    //             exit;
    //         } else {
    //             echo '<script>alert("Sửa điểm chi tiết thất bại");</script>';
    //         }
            

    //     }
    // }
}
?>
