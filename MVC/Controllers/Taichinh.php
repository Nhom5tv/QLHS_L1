<?php 
class Taichinh extends controller{
    private $taichinh;
    function __construct()
    {
        $this->taichinh=$this->model('Taichinh_m');
        // khởi tạo đối tượng model('tintuc_m') gán cho $tintuc
    }
    function Get_data(){
        $dataHoaDon=$this->taichinh->getHoaDonBySinhVien('SV003');
        $dataDSphainop=$this->taichinh->getThongTinPhaiNopBySinhVien('SV003');
       
        $this->view('Masterlayout',['page'=>'Taichinh_v', 'dulieu'=>$dataHoaDon,'dsphainop'=>$dataDSphainop]);
    }
   
    
    
}
?>