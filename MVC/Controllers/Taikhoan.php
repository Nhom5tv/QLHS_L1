<!-- goi giao dien và function -->
 <?php 
 class Taikhoan extends controller{
    private $taikhoan;

    function __construct()
    {
        $this->taikhoan=$this->model('Taikhoan_m');
    
        // khởi tạo đối tượng model('Taikhoan_m') gán cho $taikhoan
    }
    function Get_data(){
        $this->view('Masterlayout',['page'=>'Taikhoan_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang taikhoan view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_tai_khoan=$_POST['txtmaTK'];
            $tendn=$_POST['txtTendn'];
            $mk=$_POST['txtMatkhau'];
            $email=$_POST['txtEmail'];
            $quyen=$_POST['txtQuyen'];
           
            
            // Kiem tra trung id
            $kq1=$this->taikhoan->checktrungemail($email);
            
            if($kq1){
                echo'<script>alert("Trùng ID");
                window.location.href = "http://localhost/QLHS/Taikhoan";
                </script>';
                
            }
            else{
            $kq=$this->taikhoan->taikhoan_ins($ma_tai_khoan,$tendn,$mk,$email,$quyen);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/QLHS/Taikhoan";
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
