<?php 
class Nganh extends controller{
    private $Nganh;

    function __construct()
    {
        $this->Nganh = $this->model('Nganh_m');
    }

    function Get_data(){
        $khoaList = $this->Nganh->getKhoa();
       

        $this->view('Masterlayout', ['page' => 'Nganh_them','khoaList' => $khoaList ]);
    }

    function themmoi(){

        if(isset($_POST['btnLuu'])){
            $maNganh = $_POST['txtMaNganh'];
            $tenNganh = $_POST['txtTenNganh'];
            $maKhoa = $_POST['txtMaKhoa'];  // Thêm Mã Khoa
            
            $thoiGianDaoTao = $_POST['txtThoiGianDaoTao'];
            $bacDaoTao = $_POST['txtBacDaoTao'];

            // Kiểm tra trùng mã sinh viên
            $kq1 = $this->Nganh->checktrungmanganh($maNganh);

            if($kq1){
                echo '<script>alert("Trùng mã ngành")</script>';
            } else {
                // Thêm Mã Khoa, Mã Ngành, và Khoá Học vào hàm Nganh_ins
                $kq = $this->Nganh->nganh_ins($maNganh, $tenNganh, $maKhoa, $thoiGianDaoTao, $bacDaoTao);

                if ($kq) {
                    echo '<script>
                        alert("Thêm mới thành công");
                        window.location.href = "http://localhost/qlhs/DSNganh";
                    </script>';
                } else {
                    echo '<script>alert("Thêm mới thất bại")</script>';
                }
            }
        }
    }
}
?>
