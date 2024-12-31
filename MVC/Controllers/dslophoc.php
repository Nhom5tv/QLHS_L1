<?php
 class dslophoc extends controller{
    private $dslh;
    function __construct()
    {
        $this->dslh=$this->model('qllophoc');
    }
    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout_admin',[
            'page'=>'dslophoc_v',
            'dulieu'=>$this->dslh->lophoc_find('','')
        ]);
    }
    function Timkiem(){
        if(isset($_POST['btnTimkiemlop'])){
           
            $ma_nganh=$_POST['txtTimkiemmanganh'];
            // lay du lieu nhap tu txt  
            $ma_giang_vien=$_POST['txtTimkiemmagiangvien'];
            $dl=$this->dslh->lophoc_find($ma_nganh,$ma_giang_vien); // goi ham tim kiem
            // goi lai giao dien render lại trang va truyen $ dl ra 
            $this->view('Masterlayout_admin',[
                'page'=>'dslophoc_v',
                'dulieu'=>$dl,
                'ma_nganh'=>$ma_nganh,
                'ma_giang_vien'=>$ma_giang_vien
            ]);
           

        
    }
}
   
    function xoa($ma_lop){
        $kq=$this->dslh->lophoc_del($ma_lop);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/qlhs/dslophoc";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
       
    

    }
    function sua($ma_lop){
        $this->view('Masterlayout_admin',[
            'page'=>'lophoc_sua',
            'dulieu'=>$this->dslh->lophoc_findsua($ma_lop,"")
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $ma_lop=$_POST['txtmalop'];
            $ma_nganh=$_POST['txtmanganh'];
            $hoc_ky=$_POST['txthocky'];
            $ma_giang_vien=$_POST['txtmagiangvien'];
            $lich_hoc=$_POST['txtlichhoc'];
        
                    // gọi hàm chèn dl tacgia_ins trong model tacgia_m
            $kq=$this->dslh->lophoc_upd($ma_lop,$ma_nganh,$hoc_ky,$ma_giang_vien,$lich_hoc);
            if($kq){
                echo'<script>alert("Sửa thành công")
                window.location.href = "http://localhost/qlhs/dslophoc";
                </script>';
            }
            else{
                echo'<script>alert("Sửa thất bại")</script>';
            }
            
            // gọi lại giao diện
            $this->view('Masterlayout_admin',[
                'page'=>'dslophoc_v',
                'dulieu'=>$this->dslh->lophoc_find('','')
            ]);
           
        }
    }
}
 
 
?>