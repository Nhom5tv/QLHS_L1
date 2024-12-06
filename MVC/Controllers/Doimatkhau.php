<?php 
class Doimatkhau extends controller{
    private $doimk,$Login;
    function __construct()
    {
        $this->doimk=$this->model('Doimatkhau_m');
        $this->Login=$this->model('Login_m');
        
        // khởi tạo đối tượng model('dangky_m') gán cho $dangky
    }
    function Get_data(){
        
        
        $this->view('Doimatkhau_v');
        
        // gọi giao diện chính và truyền dữ liệu page là trang dangky view
    }
    function doimatkhau(){
        
        if(isset($_POST['btnluu'])){
            
            
            $email=$_POST['txtEmaildky'];
            $mkcu=$_POST['txtMatkhaucu'];
            $mk1=$_POST['txtMatkhaulan1'];
            $mk2=$_POST['txtMatkhaulan2'];
            $kq=$this->Login->login($email);
            if(mysqli_num_rows($kq)){
                while($row = mysqli_fetch_array($kq)){
                    $mkcheck=$row['Matkhau'];
                   
                }}
            if($mkcheck==$mkcu){
                // kiểm tra mk 2 lần
                if($mk1==$mk2){
                    $kq=$this->doimk->doimatkhau($email,$mk1);
                    if($kq){
                        echo'<script>alert("Đổi mật khẩu thành công");
                        window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Login";
                        </script>';
                    }
                   
                }
                else{
                    // mật khẩu ko trùng nhau
                    echo'<script>alert("Mật khẩu không khớp");
                        </script>';
                     // goi lai giao dien render lại trang va truyen $ dl ra 
                    $this->view('Doimatkhau_v',[
                        
                        'email'=>$email,
                        
                    ]);    
                }
            }
            // mật khẩu cũ không khớp
            else{
                echo'<script>alert("Mật khẩu cũ không khớp");</script>';
                        $this->view('Doimatkhau_v',[
                        
                            'email'=>$email,
                            
                        ]);  
            }
        }
    }
}