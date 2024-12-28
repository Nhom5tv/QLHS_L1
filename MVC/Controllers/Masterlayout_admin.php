<?php 
class Masterlayout_admin extends controller{
    function __construct()
    {
       
    }
    function Get_data(){
        
        
        $this->view('Masterlayout_admin',['page'=>'DSTaikhoan_v']);
        
        // gọi giao diện chính và truyền dữ liệu page là trang dangky view
    }
}