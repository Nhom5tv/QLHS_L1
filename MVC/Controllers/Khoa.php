<?php 
class Khoa extends controller{
    private $Khoa;

    function __construct()
    {
        $this->Khoa = $this->model('Khoa_m');
    }

    function Get_data(){
        $this->view('Masterlayout_admin', ['page' => 'Khoa_them']);
    }

    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $maKhoa = $_POST['txtMaKhoa'];
            $tenKhoa = $_POST['txtTenKhoa'];
            $lienHe = $_POST['txtLienHe'];  // Thêm Mã Khoa
            
            $ngayThanhLap = $_POST['txtNgayThanhLap'];
            $tienMoiTinChi = $_POST['txtTienMoiTinChi'];

            // Kiểm tra trùng mã sinh viên
            $kq1 = $this->Khoa->checktrungmaKhoa($maKhoa);

            if($kq1){
                echo '<script>alert("Trùng mã ngành")</script>';
            } else {
                // Thêm Mã Khoa, Mã Ngành, và Khoá Học vào hàm Khoa_ins
                $kq = $this->Khoa->Khoa_ins($maKhoa, $tenKhoa, $lienHe, $ngayThanhLap, $tienMoiTinChi);

                if ($kq) {
                    echo '<script>
                        alert("Thêm mới thành công");
                        window.location.href = "http://localhost/qlhs/DSKhoa";
                    </script>';
                } else {
                    echo '<script>alert("Thêm mới thất bại")</script>';
                }
            }
        }
    }
}
?>
