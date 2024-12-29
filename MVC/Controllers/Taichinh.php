<?php 
class Taichinh extends controller{
    private $taichinh;
    function __construct()
    {
        $this->taichinh=$this->model('Taichinh_m');
        // khởi tạo đối tượng model('tintuc_m') gán cho $tintuc
    }
    function Get_data(){
        $id=$_SESSION['ma_tai_khoan'];
        $dataHoaDon=$this->taichinh->getHoaDonBySinhVien($id);
        $dataDSphainop=$this->taichinh->getThongTinPhaiNopBySinhVien($id);
       
        $this->view('Masterlayout',['page'=>'Taichinh_v', 'dulieu'=>$dataHoaDon,'dsphainop'=>$dataDSphainop]);
    }
   
    
    
}
?>