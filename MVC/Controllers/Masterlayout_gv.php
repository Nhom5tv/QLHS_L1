<?php 
class Masterlayout_gv extends controller{
    function __construct()
    {
       
    }
    function Get_data(){
        
        
        $this->view('Masterlayout_gv',['page'=>'DSTaikhoan_v']);
        
        // gọi giao diện chính và truyền dữ liệu page là trang dangky view
    }
}