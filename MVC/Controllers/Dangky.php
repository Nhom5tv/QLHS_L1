<?php 
class Dangky extends controller{
    private $dangky;
    function __construct()
    {
        $this->dangky=$this->model('Dangky_m');
        
        // khởi tạo đối tượng model('dangky_m') gán cho $dangky
    }
    function Get_data(){
        
        
        $this->view('Dangky_v');
        
        // gọi giao diện chính và truyền dữ liệu page là trang dangky view
    }
    function dangky(){
        if(isset($_POST['btnDangky'])){
            $email=$_POST['txtEmaildky'];
            $mk=$_POST['txtMatkhaudky'];
            $check=$this->dangky->checktrungemail($email);
            if($check){
                echo'<script>alert("Email đã đăng ký");
                window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Login";
                </script>';
            }
            else{
                $kq=$this->dangky->dangky_ins($email,$mk);// gọi hàm ins
                if($kq){
                    echo '<script>
                    alert("Đăng ký thành công");
                    </script>';
                    $id=$this->dangky->getId($email);
                    
                    $this->view('Dangkykhmoi_v',['getId'=> $id]);
                    // hiện thị alert trc khi chuyển trang gọi lại link thêm khách hàng
                     exit();
                }
                else{
                    echo '<script>
                    alert("Đăng ký thất bại");
                
                    window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Dangky";
                    </script>';
                    // hiện thị alert trc khi chuyển trang gọi lại link dang ky
                     exit();
                }
            }
        }
    }
    
}


?>