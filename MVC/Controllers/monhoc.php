<!-- goi giao dien và function -->
<?php 
 class Monhoc extends controller{
    private $monhoc;

    function __construct()
    {
        $this->monhoc=$this->model('monhoc_m');
    
        // khởi tạo đối tượng model('monhoc_m') gán cho $monhoc
    }
    function Get_data(){
        $this->view('Masterlayout',['page'=>'monhoc_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang monhoc view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_mon=$_POST['txtMaMon'];
            $ten_mon=$_POST['txtTenMon'];
            $ma_nganh=$_POST['txtMaNganh'];
            $so_tin_chi=$_POST['txtSoTinChi'];
            $so_tiet=$_POST['txtSoTiet'];
           
            
            // Kiem tra trung id
            $kq1=$this->monhoc->checktrungmamon($ma_mon);
            
            if($kq1){
                echo'<script>alert("Trùng ID");
                window.location.href = "http://localhost/qlhs/monhoc";
                </script>';
                
            }
            else{
            $kq=$this->monhoc->monhoc_ins($ma_mon, $ten_mon, $ma_nganh, $so_tin_chi, $so_tiet);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/qlhs/monhoc";
                </script>';
                // hiện thị alert trc khi chuyển trang
    exit();
                
            }
            else
                echo'<script>alert("Thêm mới thất bại")</script>';
            }
           
           
        }
    }
    
 }
 ?>
