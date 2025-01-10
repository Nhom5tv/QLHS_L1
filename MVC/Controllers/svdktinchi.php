<?php 
class Svdktinchi extends controller{
    private $svdktinchi;
    function __construct()
    {
        $this->svdktinchi=$this->model('svdktinchi_m');
        // khởi tạo đối tượng model('tintuc_m') gán cho $tintuc
    }
    function Get_data(){
        $id=$_SESSION['ma_tai_khoan'];
        $svdktin=$this->svdktinchi->tinchi_ins($id);
       $svddk=$this->svdktinchi->ddk_ins($id);
        $this->view('Masterlayout',['page'=>'SVdktinchi_v', 'dulieu'=>$svdktin,'dulieu2'=>$svddk]);
        
    }
    function Timkiem() {
        if (isset($_POST['btnTimkiemtin'])) {
            $ten_mon_hoc = $_POST['txtTimkiemmonhoc'];
            $lich_hoc_du_kien = $_POST['txtTimkiemlichhoc'];
            
            $dl = $this->svdktinchi->tinchi_find($ten_mon_hoc, $lich_hoc_du_kien); // Gọi hàm tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'SVdktinchi_v',
                'dulieu' => $dl,
                'ten_mon_hoc' => $ten_mon_hoc,
                'lich_hoc_du_kien' => $lich_hoc_du_kien
            ]);
        }
    }
    function dk() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $ma_mon_hoc = $_POST['ma_mon_hoc'];
            $lich_hoc_du_kien = $_POST['lich_hoc_du_kien'];
            $id = $_SESSION['ma_tai_khoan'];
            $id_lich_hoc = $_POST['id_lich_hoc'];
        
    
            // Gọi model để thêm bản ghi đăng ký môn học
            $kq = $this->svdktinchi->dk_ins($ma_mon_hoc, $id, $lich_hoc_du_kien);
    
            if ($kq) {
                // Gọi hàm cập nhật số lượng trong bảng lich_hoc
                $this->svdktinchi->capNhatSoLuong($ma_mon_hoc,$lich_hoc_du_kien,$id_lich_hoc);
    
                echo '<script>
                        alert("Đăng Ký thành công");
                        window.location.href = "http://localhost/QLHS/SVdktinchi";
                      </script>';
                exit();
            } else {
                echo '<script>alert("Đăng Ký thất bại")</script>';
            }
        } else {
            echo '<script>alert("Phương thức không hợp lệ!")</script>';
            header('Location: http://localhost/QLHS/SVdktinchi');
            exit();
        }
    }
    
    function xoa($ma_dang_ky){
        $kq=$this->svdktinchi->ddk_del($ma_dang_ky);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/qlhs/SVdktinchi";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
    }

    
}
?>