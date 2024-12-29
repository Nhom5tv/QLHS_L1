<?php 
class Giangvien extends controller{
    private $Giangvien;

    function __construct()
    {
        $this->Giangvien = $this->model('Giangvien_m');
    }

    function Get_data(){
        $khoaList = $this->Giangvien->getKhoa();
        $this->view('Masterlayout', ['page' => 'Giangvien_them','khoaList' => $khoaList ]);
    }


    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $maGV = $_POST['txtMaGV'];
            $maKhoa = $_POST['txtMaKhoa'];  // Thêm Mã Khoa
            $hoTen = $_POST['txtHoTen'];
            $email = $_POST['txtEmail'];
            $soDienThoai = $_POST['txtSoDienThoai'];
            $chuyenNganh = $_POST['txtChuyenNganh']; // Thêm Khoá Học
           

            // Kiểm tra trùng mã sinh viên
            $kq1 = $this->Giangvien->checktrungmagv($maGV);

            if($kq1){
                echo '<script>alert("Trùng mã giảng viên")</script>';
            } else {
                // Thêm Mã Khoa, Mã Ngành, và Khoá Học vào hàm Giangvien_ins
                $kq = $this->Giangvien->giangvien_ins($maGV, $maKhoa, $hoTen, $email, $soDienThoai, $chuyenNganh);

                if ($kq) {
                    echo '<script>
                        alert("Thêm mới thành công");
                        window.location.href = "http://localhost/qlhs/DSGiangvien";
                    </script>';
                } else {
                    echo '<script>alert("Thêm mới thất bại")</script>';
                }
            }
        }
    }
}
?>
