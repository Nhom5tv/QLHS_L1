<!-- goi giao dien và function -->
<?php 
 class lichhoc extends controller{
    private $lichhoc;
    function __construct()
    {
        $this->lichhoc=$this->model('qllichhoc_m');
        // khởi tạo đối tượng model('lichhoc_m') gán cho $lichhoc
    }
    function Get_data(){
        $this->view('Masterlayout',['page'=>'lichhoc_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang lichhoc view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_mon_hoc=$_POST['txtmamon'];
            $so_luong=$_POST['txtsoluong'];
            $so_luong_toi_da=$_POST['txtmaxsoluong'];
            $lich_hoc=$_POST['txtlichhoc'];
            $trang_thai=$_POST['txttrangthai'];
            // Kiem tra trung id
            // $kq1=$this->lichhoc->checktrungmalichhoc($malichhoc);
            
            // if($kq1){
            //     echo'<script>alert("Trùng Mã Nhân Viên")</script>';
            // }
            // else{
                    // gọi hàm chèn dl lichhoc_ins trong model tacgia_m
            $kq=$this->lichhoc->lichhoc_ins($ma_mon_hoc,$so_luong_toi_da,$so_luong_toi_da, $lich_hoc,$trang_thai);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/qlhs/lichhoc";
                </script>';
                // hiện thị alert trc khi chuyển trang
    exit();
                
            }
            else
                echo'<script>alert("Thêm mới thất bại")</script>';
           // }
           
            // gọi lại giao diện
            // $this->view('Masterlayout',[
            //     'page'=>'lichhoc_them',
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
