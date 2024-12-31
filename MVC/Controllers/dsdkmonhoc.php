<?php
 class dsdkmonhoc extends controller{
    private $dsmh;
    function __construct()
    {
        $this->dsmh=$this->model('qlmonhoc');
    }
    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout_admin',[
            'page'=>'qldkmonhoc_v',
            'dulieu'=>$this->dsmh->qldkmonhoc_find('','')
        ]);
    }
    function Timkiem(){
        if(isset($_POST['btnTimkiem'])){
           
            $ma_mon=$_POST['txtTimkiemmamon'];
            // lay du lieu nhap tu txt  
            $ma_sinh_vien=$_POST['txtTimkiemmasinhvien'];
            $dl=$this->dsmh->qldkmonhoc_find($ma_mon,$ma_sinh_vien); // goi ham tim kiem
            // goi lai giao dien render lại trang va truyen $ dl ra 
            $this->view('Masterlayout_admin',[
                'page'=>'qldkmonhoc_v',
                'dulieu'=>$dl,
                'ma_mon'=>$ma_mon,
                'ma_sinh_vien'=>$ma_sinh_vien
            ]);
           

        
    }
}
   
    function xoa($ma_dang_ky){
        $kq=$this->dsmh->qldkmonhoc_del($ma_dang_ky);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/qlhs/dsdkmonhoc";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
       
    

    }
    function sua($ma_dang_ky){

        $this->view('Masterlayout_admin',[
            'page'=>'qldkmonhoc_sua',
            'dulieu'=>$this->dsmh->qldkmonhoc_findsua($ma_dang_ky)
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $ma_dang_ky=$_POST['txtmadangky'];
            $ma_mon=$_POST['txtmamon'];
            $ma_sinh_vien=$_POST['txtmasinhvien'];
            $ma_lop=$_POST['txtmalop'];
            $lich_hoc_du_kien=$_POST['txtlichhocdukien'];
            $trang_thai=$_POST['txttrangthai'];
                    // gọi hàm chèn dl tacgia_ins trong model tacgia_m
            $kq=$this->dsmh->qldkmonhoc_upd($ma_dang_ky,$ma_mon,$ma_sinh_vien,$ma_lop,$lich_hoc_du_kien,$trang_thai);
            if($kq){
                echo'<script>alert("Sửa thành công")
                window.location.href = "http://localhost/qlhs/dsdkmonhoc";
                </script>';
            }
            else{
                echo'<script>alert("Sửa thất bại")</script>';
            }
            
            // gọi lại giao diện
            $this->view('Masterlayout_admin',[
                'page'=>'DSTaikhoan_v',
                'dulieu'=>$this->dsmh->qldkmonhoc_find('','')
            ]);
           
        }
    }
}
 
 
?>