<?php
 class DSSanpham extends controller{
    private $dssp;
    function __construct()
    {
        $this->dssp=$this->model('Sanpham_m');
    }
    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout',[
            'page'=>'DSSanpham_v',
            'dulieu'=>$this->dssp->sanpham_find('','')
        ]);
    }
    function Timkiem(){
        if(isset($_POST['btnTimkiem'])){
           
            $masp=$_POST['txtTimkiemMasp'];
            $tensp=$_POST['txtTimkiemTensp']; // lay du lieu nhap tu txt  
            
            $dl=$this->dssp->sanpham_find($masp,$tensp); // goi ham tim kiem
            // goi lai giao dien render lại trang va truyen $ dl ra 
            $this->view('Masterlayout',[
                'page'=>'DSSanpham_v',
                'dulieu'=>$dl,
                'Masp'=>$masp,
                'Tensp'=>$tensp
            ]);
    }
    if(isset($_POST['btnXuatExcel'])){
        //code xuất excel
        $objExcel=new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $sheet=$objExcel->getActiveSheet()->setTitle('DSsp');
        $rowCount=1;
        //Tạo tiêu đề cho cột trong excel
        $sheet->setCellValue('A'.$rowCount,'Masp');
        $sheet->setCellValue('B'.$rowCount,'Tensp');
        $sheet->setCellValue('C'.$rowCount,'Madm');
        $sheet->setCellValue('D'.$rowCount,'Gia');
        $sheet->setCellValue('E'.$rowCount,'Soluong');
        $sheet->setCellValue('F'.$rowCount,'Mota');
        $sheet->setCellValue('G'.$rowCount,'Hinhanh');
        


        //định dạng cột tiêu đề
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
      

        //gán màu nền
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
        //căn giữa
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
        $masp=$_POST['txtTimkiemMasp'];
            $tensp=$_POST['txtTimkiemTensp']; // lay du lieu nhap tu txt  
            
            $data=$this->dssp->sanpham_find($masp,$tensp); // goi ham tim kiem
        while($row=mysqli_fetch_array($data)){
            $rowCount++;
            $sheet->setCellValue('A'.$rowCount,$row['Masp']);
            $sheet->setCellValue('B'.$rowCount,$row['Tensp']);
            $sheet->setCellValue('C'.$rowCount,$row['Madm']);
            $sheet->setCellValue('D'.$rowCount,$row['Gia']);
            $sheet->setCellValue('E'.$rowCount,$row['Soluong']);
            $sheet->setCellValue('F'.$rowCount,$row['Mota']);
            $sheet->setCellValue('G'.$rowCount,$row['Hinhanh']);

            
           
           
        
        }
        //Kẻ bảng 
        $styleAray=array(
            'borders'=>array(
                'allborders'=>array(
                    'style'=>PHPExcel_Style_Border::BORDER_THIN
                )
            )
            );
        $sheet->getStyle('A1:'.'G'.($rowCount))->applyFromArray($styleAray);
        $objWriter=new PHPExcel_Writer_Excel2007($objExcel);
        $fileName='ExportExcel.xlsx';
        $objWriter->save($fileName);
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Content-Type: application/vnd.openxlmformatsofficedocument.speadsheetml.sheet');
        header('Content-Length: '.filesize($fileName));
        header('Content-Transfer-Encoding:binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($fileName);
        }
    }
    
    function xoa($masp){
        $kq=$this->dssp->sanpham_del($masp);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
       
    

    }
    function sua($masp){
        $danhMucData =$this->dssp->getDanhMuc(); // Lấy dữ liệu từ model
        $this->view('Masterlayout',[
            'page'=>'sanpham_sua',
            'dulieu'=>$this->dssp->sanpham_find($masp,""),'danhMucData'=>$danhMucData
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $masp=$_POST['txtMasp'];
            $tensp=$_POST['txtTensp'];
            $madm=$_POST['ddlDanhmuc']; // Sử dụng tên biến khác
            $gia=$_POST['txtGia'];
            $soluong=$_POST['txtSoluong'];
            $mota=$_POST['txtMota'];
           
            $hinhanh=$_FILES['txtHinhanh']['name'];
            $target_dir = "upload/";
    
            $target_file = $target_dir . basename($_FILES["txtHinhanh"]["name"]);
            if (move_uploaded_file($_FILES["txtHinhanh"]["tmp_name"], $target_file)) {
                 echo "The file ". htmlspecialchars( basename( $_FILES["txtHinhanh"]["name"])). " has been uploaded.";
              } else {
                 echo "Sorry, there was an error uploading your file.";
              }
        }
    
    
                    // gọi hàm chèn dl tacgia_ins trong model tacgia_m
            $kq=$this->dssp->sanpham_upd($masp,$tensp,$madm,$gia,$soluong,$mota,$hinhanh);
           
            if($kq){
              
                echo '<script>
                alert("Sửathành công");
                window.location.href = "http://localhost/Web%20qu%E1%BA%A3n%20l%C3%BD/DSSanpham";
                </script>';


                
            }
            else{
                echo'<script>alert("Sửa thất bại")</script>';
            }
            
            // gọi lại giao diện
            $this->view('Masterlayout',[
                'page'=>'DSSanpham_v',
                'dulieu'=>$this->dssp->sanpham_find('','')
            ]);
           
        }
    }

?>