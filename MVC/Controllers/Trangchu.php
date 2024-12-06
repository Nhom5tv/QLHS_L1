<?php 
class Trangchu extends controller{
    private $trangchu;
    function __construct()
    {
        $this->trangchu=$this->model('Trangchu_m');
        // khởi tạo đối tượng model('tintuc_m') gán cho $tintuc
    }
    function Get_data(){
        $doanhthu=$this->trangchu->doanhthungay();
       
        $this->view('Masterlayout',['page'=>'Trangchu_v', 'dulieu'=>$doanhthu]);
    }
    
}
?>