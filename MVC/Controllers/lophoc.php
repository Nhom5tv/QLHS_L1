<!-- goi giao dien và function -->
<?php 
 class lophoc extends controller{
    private $lophoc;
    function __construct()
    {
        $this->lophoc=$this->model('qllophoc');
        // khởi tạo đối tượng model('lophoc_m') gán cho $lophoc
    }
    function Get_data(){
        $this->view('Masterlayout_admin',['page'=>'lophoc_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang lophoc view
    }
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            $ma_mon = $_POST['txtmanganh'];
            $hoc_ky = $_POST['txthocky'];
            $ma_giang_vien = $_POST['txtmagiangvien'];
            $lich_hoc = $_POST['txtlichhoc'];
            $trang_thai = $_POST['txttrangthai'];
    
            // Thêm mới lớp học
            $kq = $this->lophoc->lophoc_ins($ma_mon, $hoc_ky, $ma_giang_vien, $lich_hoc,$trang_thai);
    
            if ($kq) {
                $ma_lop = $this->lophoc->getLastInsertedId();
                

                // Gọi hàm cập nhật mã lớp vào bảng đăng ký môn học
                $this->lophoc->capNhatMaLopVaoDangKy($ma_lop, $ma_mon);

                $result = $this->lophoc->themDiemChiTiet($ma_lop, $ma_mon);

                if ($result) {
                    echo '<script>
                        alert("Thêm mới thành công, đã cập nhật mã lớp và chèn dữ liệu vào bảng điểm chi tiết!");
                        window.location.href = "http://localhost/qlhs/lophoc";
                        </script>';
                } else {
                    echo '<script>
                        alert("Thêm mới thành công, đã cập nhật mã lớp nhưng không có dữ liệu để chèn vào bảng điểm chi tiết!");
                        window.location.href = "http://localhost/qlhs/lophoc";
                        </script>';
                }
                exit(); // Thoát sau khi hiển thị thông báo
            } else {
                echo '<script>alert("Thêm mới thất bại!");</script>';
            }
        }
    }
    
 }
 ?>
