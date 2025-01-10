<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class DSKhoanthusv extends controller {
    private $dskt;

    function __construct() {
        $this->dskt = $this->model('Khoanthusv_m'); // Model dành cho khoản thu sinh viên
    }

    // Lấy dữ liệu để hiển thị khi load trang
    function Get_data() {
        $this->view('Masterlayout_admin', [
            'page' => 'DSKhoanthusv_v',
            'dulieu' => $this->dskt->hienthidl("","",""),
        ]);
    }

    // Thêm mới khoản thu sinh viên
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            $maKhoanThu= $_POST['txtId'];
            $maSinhVien = $_POST['txtMaSV'];
            $soTienBanDau = $_POST['txtSoTienBanDau'];
            $soTienMienGiam = $_POST['txtSoTienMienGiam'];
            $soTienPhaiNop = $_POST['txtSoTienPhaiNop'];
           
            $trangThaiThanhToan = $_POST['txtTrangThaiThanhToan'];

            $kq1 = $this->dskt->checktrungkhoanthu($maSinhVien);

            if ($kq1) {
                echo '<script>
                    alert("Khoản thu đã tồn tại");
                    window.location.href = "http://localhost/QLHS/DSKhoanthusv";
                    </script>';
                exit();
            } else {
                $kq = $this->dskt->khoanthu_ins($maKhoanThu,$maSinhVien, $soTienBanDau, $soTienMienGiam, $soTienPhaiNop, $trangThaiThanhToan);

                if ($kq) {
                    echo '<script>
                        alert("Thêm mới khoản thu thành công");
                        window.location.href = "http://localhost/QLHS/DSKhoanthusv";
                    </script>';
                    exit();
                } else {
                    echo '<script>alert("Thêm mới khoản thu thất bại")</script>';
                }
            }
        } else {
            $this->view('Masterlayout_admin', [
                'page' => 'Khoanthusv_them',
            ]);
        }
    }

    // Tìm kiếm
    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $maSinhVien = $_POST['txtTKMaSV'];
            $trangThaiThanhToan = $_POST['txtTKTrangThai'];
            $tenKhoanThu = $_POST['txtTKTenKhoanThu'];

            $dl = $this->dskt->hienthidl($maSinhVien,$tenKhoanThu, $trangThaiThanhToan);

            $this->view('Masterlayout_admin', [
                'page' => 'DSKhoanthusv_v',
                'dulieu' => $dl,
                'ma_sinh_vien' => $maSinhVien,
                'trang_thai_thanh_toan' => $trangThaiThanhToan,
                'ten_khoan_thu' => $tenKhoanThu,
            ]);
        }
    }

    // Upload Excel
    function uploadExcel() {
        if (isset($_FILES['txtFile']) && $_FILES['txtFile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['txtFile']['tmp_name'];

            try {
                $spreadsheet = IOFactory::load($fileTmpPath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

                array_shift($data);

                $successCount = 0;
                $failCount = 0;

                foreach ($data as $row) {
                    $maSinhVien = isset($row[0]) ? trim($row[0]) : null;
                    $soTienBanDau = isset($row[1]) ? trim($row[1]) : null;
                    $soTienMienGiam = isset($row[2]) ? trim($row[2]) : null;
                    $soTienPhaiNop = isset($row[3]) ? trim($row[3]) : null;
                    $trangThaiThanhToan = isset($row[4]) ? trim($row[4]) : null;

                    if (!$maSinhVien || !$soTienBanDau || !$soTienMienGiam || !$soTienPhaiNop ||  !$trangThaiThanhToan) {
                        $failCount++;
                        continue;
                    }

                    $result = $this->dskt->khoanthu_ins($maSinhVien, $soTienBanDau, $soTienMienGiam, $soTienPhaiNop, $trangThaiThanhToan);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/QLHS/DSKhoanthusv';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/QLHS/DSKhoanthusv';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/QLHS/DSKhoanthusv';
                  </script>";
        }
    }

    // Xuất Excel
    function exportExcel() {
        try {
            // Lấy dữ liệu từ POST (nếu có tìm kiếm trước đó)
            $maSinhVien = $_POST['txtTKMasinhvien'] ?? null;
            $tenKhoanThu = $_POST['txtTKTenKhoanThu'] ?? null;
            $trangThai = $_POST['txtTKTrangThai'] ?? null;
    
            // Lấy dữ liệu từ hàm hienthidl với các tham số tìm kiếm
            $data = $this->dskt->hienthidl($maSinhVien, $tenKhoanThu, $trangThai);
    
            // Tạo file Excel
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Thiết lập tiêu đề cột
            $sheet->setCellValue('A1', 'Mã khoản thu');
            $sheet->setCellValue('B1', 'Tên khoản thu');
            $sheet->setCellValue('C1', 'Mã sinh viên');
            $sheet->setCellValue('D1', 'Số tiền ban đầu');
            $sheet->setCellValue('E1', 'Số tiền miễn giảm');
            $sheet->setCellValue('F1', 'Số tiền phải nộp');
            $sheet->setCellValue('G1', 'Trạng thái thanh toán');
    
            // Ghi dữ liệu vào file
            $rowNumber = 2;
            while ($row = mysqli_fetch_assoc($data)) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_khoan_thu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_khoan_thu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['ma_sinh_vien'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['so_tien_ban_dau'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['so_tien_mien_giam'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('F' . $rowNumber, $row['so_tien_phai_nop'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('G' . $rowNumber, $row['trang_thai_thanh_toan'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $rowNumber++;
            }
    
            // Tự động điều chỉnh kích thước cột
            foreach (range('A', 'G') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            // Gửi file đến trình duyệt để tải về
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachKhoanThuSinhVien.xlsx"');
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
                    window.location.href = 'http://localhost/QLHS/DSKhoanthusv';
                  </script>";
        }
    }
    

    // Xóa khoản thu
    function xoa() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $maKhoanThu = $_POST['ma_khoan_thu'];
            $maSinhVien = $_POST['ma_sinh_vien'];
    
            // Gọi model để xóa bản ghi
            $kq = $this->dskt->khoanthu_del($maKhoanThu, $maSinhVien);
    
            if ($kq) {
                echo '<script>
                        alert("Xóa thành công");
                        window.location.href = "http://localhost/QLHS/DSKhoanthusv";
                      </script>';
                exit();
            } else {
                echo '<script>alert("Xóa thất bại")</script>';
            }
        } else {
            echo '<script>alert("Phương thức không hợp lệ!")</script>';
            header('Location: http://localhost/QLHS/DSKhoanthusv');
            exit();
        }
    }
    

    // Sửa khoản thu
    function sua() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $maKhoanThu = $_POST['ma_khoan_thu'];
            $maSinhVien = $_POST['ma_sinh_vien'];
    
            // Gọi view và truyền dữ liệu từ model
            $this->view('Masterlayout_admin', [
                'page' => 'Khoanthusv_sua',
                'dulieu' => $this->dskt->sua_id($maKhoanThu, $maSinhVien),
            ]);
        } else {
            echo '<script>alert("Phương thức không hợp lệ!");</script>';
            header('Location: http://localhost/QLHS/DSKhoanthusv');
            exit();
        }
    }
    

    // Lưu dữ liệu sau khi sửa
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            $id = $_POST['txtId'];
            $maSinhVien = $_POST['txtMaSV'];
            $soTienBanDau = $_POST['txtSoTienBanDau'];
            $soTienMienGiam = $_POST['txtSoTienMienGiam'];
            $soTienPhaiNop = $_POST['txtSoTienPhaiNop'];
            $trangThaiThanhToan = $_POST['txtTrangThaiThanhToan'];

            $kq = $this->dskt->khoanthu_upd($id, $maSinhVien, $soTienBanDau, $soTienMienGiam, $soTienPhaiNop, $trangThaiThanhToan);
            if ($kq) {
                echo '<script>alert("Sửa thành công")</script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout_admin', [
                'page' => 'DSKhoanthusv_v',
                'dulieu' => $this->dskt->khoanthu_find('', ''),
            ]);
        }
    }
}
?>
