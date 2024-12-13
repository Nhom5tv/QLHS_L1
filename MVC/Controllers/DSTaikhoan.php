<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
 class DSTaikhoan extends controller{
    private $dstk;
    function __construct()
    {
        $this->dstk=$this->model('Taikhoan_m');
    }
    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout',[
            'page'=>'DSTaikhoan_v',
            'dulieu'=>$this->dstk->taikhoan_find('','')
        ]);
    }
    function Timkiem(){
        if(isset($_POST['btnTimkiem'])){
           
            $id=$_POST['txtTKID'];
            $quyen=$_POST['txtTKQuyen']; // lay du lieu nhap tu txt  
            
            $dl=$this->dstk->taikhoan_find($id,$quyen); // goi ham tim kiem
            // goi lai giao dien render lại trang va truyen $ dl ra 
            $this->view('Masterlayout',[
                'page'=>'DSTaikhoan_v',
                'dulieu'=>$dl,
                'ma_tai_khoan'=>$id,
                'phan_quyen'=>$quyen
            ]);
        
    }

    }

    function uploadExcel() {
        if (isset($_FILES['txtFile']) && $_FILES['txtFile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['txtFile']['tmp_name'];

            try {
                // Đọc file Excel
                $spreadsheet = IOFactory::load($fileTmpPath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

                // Bỏ qua dòng tiêu đề (giả sử tiêu đề nằm ở dòng đầu tiên)
                array_shift($data);

                $successCount = 0;
                $failCount = 0;

                foreach ($data as $row) {
                    // Giả sử thứ tự cột: ID | Tên đăng nhập | Mật khẩu | Email | Quyền
                    $tendn = isset($row[0]) ? trim($row[0]) : null;
                    $mk = isset($row[1]) ? trim($row[1]) : null;
                    $email = isset($row[2]) ? trim($row[2]) : null;
                    $quyen = isset($row[3]) ? trim($row[3]) : null;

                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if ( !$tendn || !$mk || !$email || !$quyen) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dstk->taikhoan_ins( $tendn, $mk, $email, $quyen);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSTaikhoan';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSTaikhoan';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSTaikhoan';
                  </script>";
        }
    }

    function exportExcel() {
        try {
            $data = $this->dstk->taikhoan_find('', '');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Tên đăng nhập');
            $sheet->setCellValue('C1', 'Mật khẩu');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Quyền');
    
            $rowNumber = 2;
            foreach ($data as $row) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_tai_khoan'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_dang_nhap'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['mat_khau'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['email'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['phan_quyen'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $rowNumber++;
            }
    
            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachTaiKhoan.xlsx"');
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');
    
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            ob_clean(); // Xóa các dữ liệu đầu ra trước đó
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            echo "<script>
                    alert('Có lỗi xảy ra khi xuất file Excel: {$e->getMessage()}');
                    window.location.href = 'http://localhost/qlhs/DSTaikhoan';
                  </script>";
        }
    }

    function xoa($id){
        $kq=$this->dstk->taikhoan_del($id);
        if($kq){
            echo '<script>
            alert("Xóa thành công");
            window.location.href = "http://localhost/qlhs/DSTaikhoan";
                </script>';
    exit();
        }
        else{
            echo'<script>alert("Xóa thất bại")</script>';
        }
       
    

    }
    function sua($id){
        $this->view('Masterlayout',[
            'page'=>'Taikhoan_sua',
            'dulieu'=>$this->dstk->taikhoan_find($id,"")
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $id=$_POST['txtId'];
            $tendn=$_POST['txtTendn'];
            $mk=$_POST['txtMatkhau'];
            $email=$_POST['txtEmail'];
            $quyen=$_POST['txtQuyen'];
           
            
                    // gọi hàm chèn dl tacgia_ins trong model tacgia_m
            $kq=$this->dstk->taikhoan_upd($id, $tendn, $mk, $email, $quyen);
            if($kq){
                echo'<script>alert("Sửa thành công")</script>';
            }
            else{
                echo'<script>alert("Sửa thất bại")</script>';
            }
            
            // gọi lại giao diện
            $this->view('Masterlayout',[
                'page'=>'DSTaikhoan_v',
                'dulieu'=>$this->dstk->taikhoan_find('','')
            ]);
           
        }
    }
}
?>