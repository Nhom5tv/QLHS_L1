<?php
require 'C:\xampp\htdocs\vendor\autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
class DSNganh extends controller{
    private $dsnganh;
    
    function __construct()
    {
        $this->dsnganh = $this->model('Nganh_m');
    }

    // getdata de hien thi du lieu khi load trang
   // Trong controller
function Get_data() {
        $khoaList = $this->dsnganh->getKhoa();
        $this->view('Masterlayout_admin', [
        'page' => 'DSNganh_v',
        'dulieu' => $this->dsnganh->nganh_find('', ''),
        'khoaList' => $khoaList,
         // Truyền danh sách khoa vào view
    ]);
}
    function Timkiem(){
        if (isset($_POST['btnTimkiem'])) {
            $maNganh = $_POST['txtTimkiemMaNganh'];
            $tenNganh = $_POST['txtTimkiemTenNganh'];
            
            $dl = $this->dsnganh->nganh_find($maNganh, $tenNganh);
            $this->view('Masterlayout_admin', [
                'page' => 'DSNganh_v',
                'dulieu' => $dl,
                'ma_nganh' => $maNganh,
                'ten_nganh' => $tenNganh
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
                    $maNganh = isset($row[0]) ? trim($row[0]) : null;
                    $tenNganh = isset($row[1]) ? trim($row[1]) : null;
                    $maKhoa = isset($row[2]) ? trim($row[2]) : null;
                    $thoiGianDaoTao = isset($row[3]) ? trim($row[3]) : null;
                    $bacDaoTao= isset($row[4]) ? trim($row[4]) : null;
         
                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if (!$tenNganh || !$maKhoa || !$thoiGianDaoTao || !$bacDaoTao) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dsnganh->nganh_ins( $maNganh,$tenNganh, $maKhoa, $thoiGianDaoTao, $bacDaoTao);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSNganh';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSNganh';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSNganh';
                  </script>";
        }
    }

    function exportExcel() {
        try {
            $data = $this->dsnganh->nganh_find('', '');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Set tiêu đề cho các cột
            $sheet->setCellValue('A1', 'Mã ngành');
            $sheet->setCellValue('B1', 'Tên ngành');
            $sheet->setCellValue('C1', 'Mã khoa');
            $sheet->setCellValue('D1', 'Thời gian đào tạo');
            $sheet->setCellValue('E1', 'Bậc đào tạo');
    
            $rowNumber = 2;
            foreach ($data as $row) {
$sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_nganh'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_nganh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('C' . $rowNumber, $row['ma_khoa'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('D' . $rowNumber, $row['thoi_gian_dao_tao'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);

$sheet->setCellValueExplicit('E' . $rowNumber, $row['bac_dao_tao'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$rowNumber++;

            }
    
            // Tự động điều chỉnh chiều rộng cột
            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            // Xuất file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachNganh.xlsx"');
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
                    window.location.href = 'http://localhost/qlhs/DSNganh';
                  </script>";
        }
    }
    
    




    function xoa($maNganh){
        $kq = $this->dsnganh->nganh_del($maNganh);
        if ($kq) {
            echo '<script>
                alert("Xóa thành công");
                window.location.href = "http://localhost/qlhs/DSNganh";
            </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    function sua($maNganh) {
        // Lấy danh sách khoa từ cơ sở dữ liệu
        $khoaList = $this->dsnganh->getKhoa(); // Lấy dữ liệu từ model
        
        $nganhData = $this->dsnganh->nganh_find($maNganh, "");
    
        // Truyền dữ liệu vào View
        $this->view('Masterlayout_admin', [
            'page' => 'Nganh_sua', 
            'dulieu' => $nganhData, // Thông tin ngành
            'khoaList' => $khoaList // Danh sách khoa
        ]);
    }
    
    
    

    function suadl(){
        if (isset($_POST['btnLuu'])) {
            $maNganh = $_POST['txtMaNganh'];
            $tenNganh = $_POST['txtTenNganh'];
            $maKhoa = $_POST['txtMaKhoa']; // Mã khoa
            $thoiGianDaoTao = $_POST['txtThoiGianDaoTao']; // Mã ngành
            $bacDaoTao = $_POST['txtBacDaoTao'];
            $kq = $this->dsnganh->nganh_upd($maNganh,$tenNganh, $maKhoa,$thoiGianDaoTao, $bacDaoTao);

            if ($kq) {
                echo '<script>
                    alert("Sửa thành công");
                    window.location.href = "http://localhost/qlhs/DSNganh";
                </script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout_admin', [
                'page' => 'DSNganh_v',
                'dulieu' => $this->dsnganh->nganh_find('', '')
            ]);
        }
    }
}
?>
