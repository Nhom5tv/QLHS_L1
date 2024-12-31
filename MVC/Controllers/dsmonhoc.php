<?php
require 'C:\xampp\htdocs\vendor\autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class DSmonhoc extends controller {
    private $dsmonhoc;

    function __construct() {
        $this->dsmonhoc = $this->model('monhoc_m');
    }

    // Hiển thị dữ liệu khi tải trang
    function Get_data() {
        $this->view('Masterlayout', [
            'page' => 'DSmonhoc_v',
            'dulieu' => $this->dsmonhoc->monhoc_find('', '')
        ]);
    }

    // Tìm kiếm môn học
    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $ma_mon = $_POST['txtTKMaMon'];
            $ten_mon = $_POST['txtTKTenMon'];
            
            $dl = $this->dsmonhoc->monhoc_find($ma_mon, $ten_mon); // Gọi hàm tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'DSmonhoc_v',
                'dulieu' => $dl,
                'ma_mon' => $ma_mon,
                'ten_mon' => $ten_mon
            ]);
        }
    }

    // Upload dữ liệu từ file Excel
    function uploadExcel() {
        if (isset($_FILES['txtFile']) && $_FILES['txtFile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['txtFile']['tmp_name'];

            try {
                $spreadsheet = IOFactory::load($fileTmpPath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

                array_shift($data); // Bỏ qua dòng tiêu đề

                $successCount = 0;
                $failCount = 0;

                foreach ($data as $row) {
                    // Cột: Mã môn học | Tên môn học | Số tín chỉ
                    $ma_mon = isset($row[0]) ? trim($row[0]) : null;
                    $ten_mon = isset($row[1]) ? trim($row[1]) : null;
                    $ma_nganh = isset($row[2]) ? trim($row[2]) : null;
                    $so_tin_chi = isset($row[3]) ? intval($row[3]) : null;
                    $so_tiet = isset($row[4]) ? trim($row[4]) : null;

                    if (!$ma_mon || !$ten_mon || !$ma_nganh || !$so_tin_chi || !$so_tiet ) {
                        $failCount++;
                        continue;
                    }

                    $result = $this->dsmonhoc->monhoc_ins($ma_mon, $ten_mon, $ma_nganh, $so_tin_chi, $so_tiet);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSmonhoc';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSmonhoc';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSmonhoc';
                  </script>";
        }
    }

    // Xuất dữ liệu ra file Excel
    function exportExcel() {
        try {
            $data = $this->dsmonhoc->monhoc_find('', '');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            $sheet->setCellValue('A1', 'Mã môn ');
            $sheet->setCellValue('B1', 'Tên môn ');
            $sheet->setCellValue('C1', 'Mã Ngành');
            $sheet->setCellValue('D1', 'Số tín chỉ');
            $sheet->setCellValue('E1', 'Số tiết');
    
            $rowNumber = 2;
            foreach ($data as $row) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_mon'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_mon'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['ma_nganh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['so_tin_chi'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['so_tiet'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $rowNumber++;
            }
    
            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachMonHoc.xlsx"');
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');
    
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            ob_clean();
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            echo "<script>
                    alert('Có lỗi xảy ra khi xuất file Excel: {$e->getMessage()}');
                    window.location.href = 'http://localhost/qlhs/DSmonhoc';
                  </script>";
        }
    }

    // Xóa môn học
    function xoa($ma_mon) {
        $kq = $this->dsmonhoc->monhoc_del($ma_mon);
        if ($kq) {
            echo '<script>
                    alert("Xóa thành công");
                    window.location.href = "http://localhost/qlhs/DSmonhoc";
                  </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    // Hiển thị giao diện sửa môn học
    function sua($ma_mon){
        $this->view('Masterlayout',[
            'page'=>'monhoc_sua',
            'dulieu'=>$this->dsmonhoc->monhoc_find($ma_mon,"")
        ]);
    }

    // Lưu thông tin sửa môn học
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            $ma_mon = $_POST['txtMaMon'];
            $ten_mon = $_POST['txtTenMon'];
            $ma_nganh= $_POST['txtMaNganh'];
            $so_tin_chi = $_POST['txtSoTinChi'];
            $so_tiet = $_POST['txtSoTiet'];
            $kq = $this->dsmonhoc->monhoc_upd($ma_mon,$ten_mon, $ma_nganh, $so_tin_chi, $so_tiet);
            if ($kq) {
                echo '<script>alert("Sửa thành công")</script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout', [
                'page' => 'DSmonhoc_v',
                'dulieu' => $this->dsmonhoc->monhoc_find('', '')
            ]);
        }
    }
}
?>
