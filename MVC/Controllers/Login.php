<?php
class Login extends controller{
    private $Login;
    function __construct()
    {
        $this->Login=$this->model('Login_m');
        
        
        // khởi tạo đối tượng model('Login_m') gán cho $Login
    }
    function Get_data(){
        
        
        $this->view('Login_v');
        
        // gọi giao diện chính và truyền dữ liệu page là trang Login view
    }
    function dangnhap(){
        $result_mess = false;
        if(isset($_POST['btnDangnhap'])){           
            $email=$_POST['txtEmail'];
            $mk_input=$_POST['txtMatkhau'];            
            $kq=$this->Login->login($email);
            
            if(mysqli_num_rows($kq)){
               while($row = mysqli_fetch_array($kq)){
                $id=$row['ma_tai_khoan'];
                $mk=$row['mat_khau'];
                $email=$row['email'];
                $quyen=$row['phan_quyen'];                
                
                
               
               }
               if ($mk==$mk_input)
               {
                    // tạo phiên đăng nhập
                    $_SESSION['ma_tai_khoan']=$id;
                    $_SESSION['email']=$email;
                    if ($quyen == 'admin') {
                        // Gọi đến trang bán hàng
                        echo '<script>
                        alert("Đăng nhập thành công");
                        window.location.href = "http://localhost/QLHS/Masterlayout_admin";
                        </script>';
                        
                        
                        $result_mess=true;                 
                        exit();
                    } 
                    elseif ($quyen == 'giang_vien') {
                       
                        echo '<script>
                        alert("Đăng nhập thành công");
                        window.location.href = "http://localhost/QLHS/Masterlayout_gv";
                        </script>';
                    }
                    elseif ($quyen == 'sinh_vien') {
                       
                        echo '<script>
                        alert("Đăng nhập thành công");
                        window.location.href = "http://localhost/QLHS/Masterlayout";
                        </script>';
                    }
                    else{
                        echo 'Không xác định đc quyền';
                    }

                   
               }
               // sai mật khẩu
               else{
                echo '<script>
                alert("Sai mật khẩu");
                window.location.href = "http://localhost/QLHS/Login";
                </script>';   
               }
               
            }
            // email chưa đăng ký
            else
               {
                echo '<script>
                alert("Email chưa đăng ký");
                window.location.href = "http://localhost/QLHS/Login";
                </script>';           
               }
}
}
function logout(){
    unset($_SESSION['Id']);
    session_destroy();
    $this->view('Login_v');
}


}
?>