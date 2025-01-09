<?php
 class dslichhoc extends controller{
    private $dslhoc;
    function __construct()
    {
        $this->dslhoc=$this->model('qllichhoc_m');
    }
    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout_admin',[
            'page'=>'qllichhoc_v',
            'dulieu'=>$this->dslhoc->lichhoc_find('','')
        ]);
    }
    function Timkiem(){
        if(isset($_POST['btnTimkiemlich'])){
           
            $ma_mon=$_POST['txtTimkiemmamon'];
            // lay du lieu nhap tu txt  
            $lich_hoc=$_POST['txtTimkiemlichhoc'];
            $dl=$this->dslhoc->lichhoc_find($ma_mon,$lich_hoc); // goi ham tim kiem
            // goi lai giao dien render lại trang va truyen $ dl ra 
            $this->view('Masterlayout_admin',[
                'page'=>'qllichhoc_v',
                'dulieu'=>$dl,
                'ma_mon'=>$ma_mon,
                'lich_hoc'=>$lich_hoc
            ]);
           

        
    }
}
   
    function xoa($id_lich_hoc){
        $kq=$this->dslhoc->lichhoc_del($id_lich_hoc);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/qlhs/dslichhoc";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
       
    

    }
    function sua($id_lich_hoc){
        $this->view('Masterlayout_admin',[
            'page'=>'lichhoc_sua',
            'dulieu'=>$this->dslhoc->lichhoc_findsua($id_lich_hoc,"")
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $id_lich_hoc=$_POST['txtidlichhoc'];
            $ma_mon_hoc=$_POST['txtmamon'];
            $so_luong=$_POST['txtsoluong'];
            $so_luong_toi_da=$_POST['txtmaxsoluong'];
            $lich_hoc=$_POST['txtlichhoc'];
            $trang_thai=$_POST['txttrangthai'];
        
                    // gọi hàm chèn dl tacgia_ins trong model tacgia_m
            $kq=$this->dslhoc->lichhoc_upd($id_lich_hoc,$ma_mon_hoc, $so_luong,$so_luong_toi_da,$lich_hoc,$trang_thai);
            if($kq){
                echo'<script>alert("Sửa thành công")
                window.location.href = "http://localhost/qlhs/dslichhoc";
                </script>';
            }
            else{
                echo'<script>alert("Sửa thất bại")</script>';
            }
            
            // gọi lại giao diện
            $this->view('Masterlayout_admin',[
                'page'=>'DSTaikhoan_v',
                'dulieu'=>$this->dslhoc->lichhoc_find('','')
            ]);
           
        }
    }
}
 
 
?>