<?php
class DSSinhvienController extends connectDB {
    private $model;

    public function __construct($db) {
        parent::__construct();
        $this->model = new DSSinhvienModel($db);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $data = $this->model->getAllSinhVien();
        include 'views/DSSinhvien/chitietketqua_v.php'; // Gọi view hiển thị danh sách
    }

    // Tìm kiếm sinh viên theo mã
    // public function timkiem() {
    //     $maSV = $_POST['txtTimkiemMaSV'] ?? null;
    //     $maMon = $_POST['txtTimkiemMaMon'] ?? null;

    //     if ($maSV) {
    //         $data = $this->model->searchByMaSV($maSV);
    //     } elseif ($maMon) {
    //         $data = $this->model->searchByMaMon($maMon);
    //     } else {
    //         $data = $this->model->getAllSinhVien(); // Hiển thị tất cả nếu không tìm kiếm
    //     }

    //     include 'views/DSSinhvien/index.php';
    // }

    // Hiển thị form sửa thông tin sinh viên
    public function sua($ma_dct) {
        $sinhvien = $this->model->getSinhVienById($ma_dct);
        include 'views/DSSinhvien/edit.php'; // Gọi view sửa
    }

    // Cập nhật thông tin sinh viên
    public function capnhat() {
        $ma_dct = $_POST['ma_dct'];
        $lanHoc = $_POST['lan_hoc'];
        $lanThi = $_POST['lan_thi'];
        $diemChuyenCan = $_POST['diem_chuyen_can'];
        $diemGiuaKy = $_POST['diem_giua_ky'];
        $diemCuoiKy = $_POST['diem_cuoi_ky'];

        $result = $this->model->updateSinhVien($ma_dct, $lanHoc, $lanThi, $diemChuyenCan, $diemGiuaKy, $diemCuoiKy);

        if ($result) {
            header('Location: http://localhost/qlhs/DSSinhvien/index');
        } else {
            echo "Cập nhật thất bại!";
        }
    }
}
?>
