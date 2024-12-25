<?php 
class Svdktinchi extends controller{
    private $svdktinchi;
    function __construct()
    {
        $this->svdktinchi=$this->model('svdktinchi_m');
        // khởi tạo đối tượng model('tintuc_m') gán cho $tintuc
    }
    function Get_data(){
        $svdktin=$this->svdktinchi->tinchi_ins();
        $ma_sinh_vien ='SV001';
       $svddk=$this->svdktinchi->ddk_ins($ma_sinh_vien);
        $this->view('Masterlayout',['page'=>'SVdktinchi_v', 'dulieu'=>$svdktin,'dulieu2'=>$svddk]);
        
    }
    function Timkiem() {
        if (isset($_POST['btnTimkiemtin'])) {
            $ma_mon_hoc = $_POST['txtTimkiemmonhoc'];
            $lich_hoc_du_kien = $_POST['txtTimkiemlichhoc'];
            
            $dl = $this->svdktinchi->tinchi_find($ma_mon_hoc, $lich_hoc_du_kien); // Gọi hàm tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'SVdktinchi_v',
                'dulieu' => $dl,
                'ma_mon_hoc' => $ma_mon_hoc,
                'lich_hoc_du_kien' => $lich_hoc_du_kien
            ]);
        }
    }
    function dk() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $ma_mon_hoc = $_POST['ma_mon_hoc'];
            $lich_hoc_du_kien = $_POST['lich_hoc_du_kien'];
            $ma_sinh_vien = 'SV001';
            // Gọi model để xóa bản ghi
            $kq = $this->svdktinchi->dk_ins($ma_mon_hoc, $ma_sinh_vien,$lich_hoc_du_kien,);
    
            if ($kq) {
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