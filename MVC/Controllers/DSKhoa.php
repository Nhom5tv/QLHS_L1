<?php
require 'C:\xampp\htdocs\vendor\autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
class DSKhoa extends controller{
    private $dskhoa;
    
    function __construct()
    {
        $this->dskhoa = $this->model('Khoa_m');
    }

    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $this->view('Masterlayout', [
            'page' => 'DSKhoa_v',
            'dulieu' => $this->dskhoa->khoa_find('', '')
        ]);
    }


    
    

    function Timkiem(){
        if (isset($_POST['btnTimkiem'])) {
            $maKhoa = $_POST['txtTimkiemMaKhoa'];
            $tenKhoa = $_POST['txtTimkiemTenKhoa'];
            
            $dl = $this->dskhoa->khoa_find($maKhoa, $tenKhoa);
            $this->view('Masterlayout', [
                'page' => 'DSKhoa_v',
                'dulieu' => $dl,
                'ma_Khoa' => $maKhoa,
                'ten_Khoa' => $tenKhoa
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
                    $maKhoa = isset($row[0]) ? trim($row[0]) : null;
                    $tenKhoa = isset($row[1]) ? trim($row[1]) : null;
                    $lienHe = isset($row[2]) ? trim($row[2]) : null;
                    $ngayThanhLap = isset($row[3]) ? trim($row[3]) : null;
                    $tienMoiTinChi= isset($row[4]) ? trim($row[4]) : null;
         
//                     $formattedDate = DateTime::createFromFormat('Y-m-d', $ngaySinh);
// if ($formattedDate && $formattedDate->format('Y-m-d') === $ngaySinh) {
//     $ngaySinh = $formattedDate->format('Y-m-d');
// } else {
//     // Nếu ngày không hợp lệ, thiết lập ngày sinh mặc định hoặc bỏ qua
//     $ngaySinh = '0000-00-00'; // Hoặc có thể bỏ qua
//     $failCount++;
//     continue;
// }
                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if (!$tenKhoa || !$lienHe|| !$ngayThanhLap || !$tienMoiTinChi) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dskhoa->khoa_ins( $maKhoa,$tenKhoa, $lienHe, $ngayThanhLap, $tienMoiTinChi);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSKhoa';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSKhoa';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSKhoa';
                  </script>";
        }
    }

    function exportExcel() {
        try {
            $data = $this->dskhoa->khoa_find('', '');
    
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
$sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_khoa'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_khoa'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('C' . $rowNumber, $row['lien_he'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('D' . $rowNumber, $row['ngay_thanh_lap'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);

$sheet->setCellValueExplicit('E' . $rowNumber, $row['tien_moi_tin_chi'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$rowNumber++;

            }
    
            // Tự động điều chỉnh chiều rộng cột
            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            // Xuất file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachKhoa.xlsx"');
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
                    window.location.href = 'http://localhost/qlhs/DSKhoa';
                  </script>";
        }
    }
    
    




    function xoa($maKhoa){
        $kq = $this->dskhoa->khoa_del($maKhoa);
        if ($kq) {
            echo '<script>
                alert("Xóa thành công");
                window.location.href = "http://localhost/qlhs/DSKhoa";
            </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    function sua($maKhoa){
        $this->view('Masterlayout', [
            'page' => 'Khoa_sua',
            'dulieu' => $this->dskhoa->khoa_find($maKhoa, "")
        ]);
    }

    function suadl(){
        if (isset($_POST['btnLuu'])) {
            $maKhoa = $_POST['txtMaKhoa'];
            $tenKhoa = $_POST['txtTenKhoa'];
            $lienHe = $_POST['txtLienHe']; // Mã khoa
            $ngayThanhLap = $_POST['txtNgayThanhLap']; // Mã ngành
            $tienMoiTinChi = $_POST['txtTienMoiTinChi'];
            $kq = $this->dskhoa->khoa_upd($maKhoa,$tenKhoa, $lienHe,$ngayThanhLap, $tienMoiTinChi);

            if ($kq) {
                echo '<script>
                    alert("Sửa thành công");
                    window.location.href = "http://localhost/qlhs/DSKhoa";
                </script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout', [
                'page' => 'DSKhoa_v',
                'dulieu' => $this->dskhoa->khoa_find('', '')
            ]);
        }
    }
}
?>