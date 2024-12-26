<?php 
class Sinhvien extends controller{
    private $Sinhvien;

    function __construct()
    {
        $this->Sinhvien = $this->model('Sinhvien_m');
    }

    function Get_data(){
        $nganhList=$this->Sinhvien->getNganh();
        $khoaList = $this->Sinhvien->getKhoa();
        $this->view('Masterlayout', ['page' => 'Sinhvien_them','khoaList' => $khoaList, 'nganhList' => $nganhList]);

    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $maSV = $_POST['txtMaSV'];
            $maKhoa = $_POST['txtMaKhoa'];  // Thêm Mã Khoa
            $maNganh = $_POST['txtMaNganh']; // Thêm Mã Ngành
            $hoTen = $_POST['txtHoTen'];
            $ngaySinh = $_POST['txtNgaySinh'];
            $gioiTinh = $_POST['ddlGioiTinh'];
            $queQuan = $_POST['txtQueQuan'];
            $email = $_POST['txtEmail'];
            $soDienThoai = $_POST['txtSoDienThoai'];
            $khoaHoc = $_POST['txtKhoaHoc']; // Thêm Khoá Học
            $maTaiKhoan = $_POST['txtIdTaiKhoan'];

            // Kiểm tra trùng mã sinh viên
            $kq1 = $this->Sinhvien->checktrungmasv($maSV);

            if($kq1){
                echo '<script>alert("Trùng mã sinh viên")</script>';
            } else {
                // Thêm Mã Khoa, Mã Ngành, và Khoá Học vào hàm sinhvien_ins
                $kq = $this->Sinhvien->sinhvien_ins($maSV, $maKhoa, $maNganh, $hoTen, $ngaySinh, $gioiTinh, $queQuan, $email, $soDienThoai, $khoaHoc, $maTaiKhoan);

                if ($kq) {
                    echo '<script>
                        alert("Thêm mới thành công");
                        window.location.href = "http://localhost/qlhs/DSSinhvien";
                    </script>';
                } else {
                    echo '<script>alert("Thêm mới thất bại")</script>';
                }
            }
        }
    }
}
?>
