<!-- goi giao dien và function -->
<?php 
 class dktinchi extends controller{
    private $tinchi;

    function __construct()
    {
        $this->tinchi=$this->model('tinchi_m');
    
        // khởi tạo đối tượng model('tinchi_m') gán cho $tinchi
    }
    function Get_data(){
        $this->view('Masterlayout',['page'=>'tinchi_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang tinchi view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_mon=$_POST['txtMaMon'];
            $ten_mon=$_POST['txtTenMon'];
            $ma_nganh=$_POST['txtMaNganh'];
            $so_tin_chi=$_POST['txtSoTinChi'];
            $so_tiet=$_POST['txtSoTiet'];
           
            
            // Kiem tra trung id
            $kq1=$this->tinchi->checktrungmamon($ma_mon);
            
            if($kq1){
                echo'<script>alert("Trùng ID");
                window.location.href = "http://localhost/qlhs/tinchi";
                </script>';
                
            }
            else{
            $kq=$this->tinchi->tinchi_ins($ma_mon, $ten_mon, $ma_nganh, $so_tin_chi, $so_tiet);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/qlhs/tinchi";
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