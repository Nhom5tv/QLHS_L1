<!-- goi giao dien và function -->
<?php 
 class qldkmonhoc extends controller{
    private $monhoc;
    function __construct()
    {
        $this->monhoc=$this->model('qlmonhoc');
        // khởi tạo đối tượng model('monhoc_m') gán cho $monhoc
    }
    function Get_data(){
        $this->view('Masterlayout',['page'=>'monhoc_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang monhoc view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_mon=$_POST['txtmamon'];
            $ma_sinh_vien=$_POST['txtmasinhvien'];
            $lich_hoc_du_kien=$_POST['txtlichhocdukien'];
            $trang_thai=$_POST['txttrangthai'];
            // Kiem tra trung id
            // $kq1=$this->monhoc->checktrungmamonhoc($mamonhoc);
            
            // if($kq1){
            //     echo'<script>alert("Trùng Mã Nhân Viên")</script>';
            // }
            // else{
                    // gọi hàm chèn dl monhoc_ins trong model tacgia_m
            $kq=$this->monhoc->monhoc_ins($ma_mon,$ma_sinh_vien,$lich_hoc_du_kien, $trang_thai);
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
           // }
           
            // gọi lại giao diện
            // $this->view('Masterlayout',[
            //     'page'=>'monhoc_them',
            //     'id'=> $id,
            //     'email'=>$email,
            //     'quyen'=> $tdn,
            //     'matkhau'=> $mk,
            //     'ngaytao'=> $nt,
                
            // ]);
        }
    }
    
 }
 ?>