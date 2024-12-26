<?php 
class Masterlayout extends controller{
    private $show;
    function __construct()
    {
       
    }
    function Get_data(){
        
        
        $this->view('Masterlayout',['page'=>'DSTaikhoan']);
        
        // gọi giao diện chính và truyền dữ liệu page là trang dangky view
    }
}