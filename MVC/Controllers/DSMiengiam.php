<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class DSMiengiam extends controller {
    private $dsmg;

    function __construct() {
        $this->dsmg = $this->model('Miengiam_m');
    }

    // Lấy dữ liệu để hiển thị khi load trang
    function Get_data() {
        
        
        $this->view('Masterlayout', [
            'page' => 'DSMiengiam_v',
            'dulieu' => $this->dsmg->miengiam_find('', ''),
            
        ]);
    }

    // Thêm mới miễn giảm
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            // Lấy dữ liệu từ form
            $maSinhVien = $_POST['txtMasinhvien'];
            $mucTien = $_POST['txtMuctien'];
            $loaiMienGiam = $_POST['txtLoaimiengiam'];
            $ghiChu = $_POST['txtGhichu'];
           
            

            // Kiểm tra trùng mã sinh viên và loại miễn giảm
            $kq1 = $this->dsmg->checktrungmiengiam($maSinhVien, $loaiMienGiam);

            if ($kq1) {
                // Nếu trùng, thông báo lỗi
                echo '<script>
                    alert("Mã sinh viên và loại miễn giảm đã tồn tại");
                    window.location.href = "http://localhost/QLHS_L1/DSMiengiam";
                    </script>';
                exit();  // Dừng lại ngay sau khi thông báo lỗi
            } else {
                // Thực hiện thêm mới miễn giảm vào cơ sở dữ liệu
                $kq = $this->dsmg->miengiam_ins($maSinhVien, $mucTien, $loaiMienGiam,$ghiChu);

                if ($kq) {
                    // Nếu thành công, thông báo và chuyển hướng
                    echo '<script>
                        alert("Thêm mới miễn giảm thành công");
                        window.location.href = "http://localhost/QLHS_L1/DSMiengiam";
                    </script>';
                    exit();  // Dừng lại sau khi redirect
                } else {
                    // Nếu thất bại, thông báo lỗi
                    echo '<script>alert("Thêm mới miễn giảm thất bại")</script>';
                }
            }
        } else {
            $dsloaikhoanthu=$this->dsmg->getAllLoaiKhoanThu();
            // Nếu chưa submit form, chỉ hiển thị form thêm mới
            $this->view('Masterlayout', [
                'page' => 'Miengiam_them',
                'dsloaikhoanthu' => $dsloaikhoanthu,  // Gọi view thêm mới miễn giảm
            ]);
        }
    }

    // Tìm kiếm miễn giảm
    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $maSinhVien = $_POST['txtTKMasinhvien'];
            $loaiMienGiam = $_POST['txtTKLoaimiengiam']; // lấy dữ liệu từ form

            $dl = $this->dsmg->miengiam_find($maSinhVien, $loaiMienGiam); // gọi hàm tìm kiếm
            // gọi lại giao diện render lại trang và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'DSMiengiam_v',
                'dulieu' => $dl,
                'ma_sinh_vien' => $maSinhVien,
                'loai_mien_giam' => $loaiMienGiam,
            ]);
        }
    }

    // Hàm upload Excel
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
                    // Giả sử thứ tự cột: Mã sinh viên | Loại miễn giảm | Mức tiền | Ngày tạo | Hạn nộp
                    $maSinhVien = isset($row[0]) ? trim($row[0]) : null;
                    $loaiMienGiam = isset($row[1]) ? trim($row[1]) : null;
                    $mucTien = isset($row[2]) ? trim($row[2]) : null;
                    $ghiChu = isset($row[3]) ? trim($row[3]) : null;
                    
                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if (!$maSinhVien || !$loaiMienGiam || !$mucTien || !$ghiChu ) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dsmg->miengiam_ins($maSinhVien, $loaiMienGiam, $mucTien,$ghiChu);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/QLHS_L1/DSMiengiam';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/QLHS_L1/DSMiengiam';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/QLHS_L1/DSMiengiam';
                  </script>";
        }
    }

    // Hàm xuất Excel
    function exportExcel() {
        try {
            $data = $this->dsmg->miengiam_find('', '');

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Mã miễn giảm');
            $sheet->setCellValue('B1', 'Mã sinh viên');
            $sheet->setCellValue('C1', 'Mức tiền');
            $sheet->setCellValue('D1', 'Loại miễn giảm');
            $sheet->setCellValue('E1', 'Ghi chú');
          
         

            $rowNumber = 2;
            foreach ($data as $row) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_mien_giam'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ma_sinh_vien'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['muc_tien'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['loai_mien_giam'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['ghi_chu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
              
                $rowNumber++;
            }

            foreach (range('A', 'E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachMienGiam.xlsx"');
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
                    window.location.href = 'http://localhost/QLHS_L1/DSMiengiam';
                  </script>";
        }
    }

    // Hàm xóa
    function xoa($id) {
        $kq = $this->dsmg->miengiam_del($id);
        if ($kq) {
            echo '<script>
                    alert("Xóa thành công");
                    window.location.href = "http://localhost/QLHS_L1/DSMiengiam";
                  </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    // Hàm sửa
    function sua($id) {
        $dsloaikhoanthu=$this->dsmg->getAllLoaiKhoanThu();
        $this->view('Masterlayout', [
            'page' => 'Miengiam_sua',
            'dulieu' => $this->dsmg->idmiengiam($id),
            'dsloaikhoanthu' => $dsloaikhoanthu,
        ]);
    }

    // Lưu dữ liệu sau khi sửa
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            $id = $_POST['txtId'];
            $maSinhVien = $_POST['txtMasinhvien'];
            $loaiMienGiam = $_POST['txtLoaimiengiam'];
            $mucTien = $_POST['txtMuctien'];
            $ghiChu = $_POST['txtGhichu'];
          
            $kq = $this->dsmg->miengiam_upd($id, $maSinhVien, $mucTien,$loaiMienGiam,$ghiChu);
            if ($kq) {
                echo '<script>alert("Sửa thành công")</script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            // Gọi lại giao diện
            $this->view('Masterlayout', [
                'page' => 'DSMiengiam_v',
                'dulieu' => $this->dsmg->miengiam_find('', ''),
            ]);
        }
    }
}
?>
