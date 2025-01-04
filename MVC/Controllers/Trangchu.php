<?php 
class Trangchu extends controller {
    private $trangchu;

    function __construct() {
        $this->trangchu = $this->model('Trangchu_m');
    }

    function Get_data() {
        // Lấy dữ liệu thống kê loại học viên
        $thongkeloaihocvien = $this->trangchu->thongkeloaihocvien();

        // Lấy tổng số giảng viên
        $tonggiangvien = $this->trangchu->thongkegiangvien();

        // Chuyển dữ liệu sang View
        $this->view('Masterlayout_admin', [
            'page' => 'Trangchu_v',
            'dulieuHocVien' => $thongkeloaihocvien,
            'tongGiangVien' => $tonggiangvien
        ]);
    }
}
?>
