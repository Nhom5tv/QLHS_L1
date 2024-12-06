<!-- goi giao dien và function -->
<?php 
 class Sanpham extends controller{
    private $Sanpham;
    function __construct()
    {
        $this->Sanpham=$this->model('Sanpham_m');
        // khởi tạo đối tượng model('Sanpham_m') gán cho $Sanpham
    }
    function Get_data(){
        $danhMucData =$this->Sanpham->getDanhMuc(); // Lấy dữ liệu từ model
        
        $this->view('Masterlayout',['page'=>'Sanpham_them', 'danhMucData'=>$danhMucData]);
        
        // gọi giao diện chính và truyền dữ liệu page là trang Sanpham view
    }
    function themmoi(){
        if(isset($_POST['btnLuu'])){
            $masp=$_POST['txtMasp'];
            $tensp=$_POST['txtTensp'];
            $madm=$_POST['ddlDanhmuc'];
            $gia=$_POST['txtGia'];
            $soluong=$_POST['txtSoluong'];
            $mota=$_POST['txtMota'];

            $hinhanh=$_FILES['txtHinhanh']['name'];
            echo $hinhanh;
            $target_dir = "upload/";

            $target_file = $target_dir . basename($_FILES["txtHinhanh"]["name"]);
            if (move_uploaded_file($_FILES["txtHinhanh"]["tmp_name"], $target_file)) {
                 echo "The file ". htmlspecialchars( basename( $_FILES["txtHinhanh"]["name"])). " has been uploaded.";
              } else {
                 echo "Sorry, there was an error uploading your file.";
              }

            // Kiem tra trung masp
            $kq1=$this->Sanpham->checktrungmasp($masp);
            
            if($kq1){
                echo'<script>alert("Trùng masp")</script>';
            }
            else{
                    // gọi hàm chèn dl Sanpham_ins trong model tacgia_m
            $kq=$this->Sanpham->Sanpham_ins($masp,$tensp,$madm,$gia,$soluong,$mota,$hinhanh);
            if($kq){
                echo '<script>
                alert("Thêm mới thành công");
                window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/Sanpham";
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
