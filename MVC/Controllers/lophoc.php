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
        $this->view('Masterlayout',['page'=>'lophoc_them']);
        // gọi giao diện chính và truyền dữ liệu page là trang lophoc view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $ma_nganh=$_POST['txtmanganh'];
            $hoc_ky=$_POST['txthocky'];
            $ma_giang_vien=$_POST['txtmagiangvien'];
            $lich_hoc=$_POST['txtlichhoc'];
            // Kiem tra trung id
            // $kq1=$this->lophoc->checktrungmalophoc($malophoc);
            
            // if($kq1){
            //     echo'<script>alert("Trùng Mã Nhân Viên")</script>';
            // }
            // else{
                    // gọi hàm chèn dl lophoc_ins trong model tacgia_m
            $kq=$this->lophoc->lophoc_ins($ma_nganh,$hoc_ky,$ma_giang_vien, $lich_hoc);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/qlhs/lophoc";
                </script>';
                // hiện thị alert trc khi chuyển trang
    exit();
                
            }
            else
                echo'<script>alert("Thêm mới thất bại")</script>';
           // }
           
            // gọi lại giao diện
            // $this->view('Masterlayout',[
            //     'page'=>'lophoc_them',
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
