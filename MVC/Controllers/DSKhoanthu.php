<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class DSKhoanthu extends controller {
    private $dskt,$dsmg;

    function __construct() {
        $this->dskt = $this->model('Khoanthu_m');
        $this->dsmg = $this->model('Miengiam_m');
    }

    // Lấy dữ liệu để hiển thị khi load trang
    function Get_data() {
        $this->view('Masterlayout', [
            'page' => 'DSKhoanthu_v',
            'dulieu' => $this->dskt->khoanthu_find('', ''),
        ]);
    }
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            // Lấy dữ liệu từ form
            $tenKhoanThu = $_POST['txtTenkhoanthu'];
            $loaiKhoanThu = $_POST['txtLoaikhoanthu'];
            $soTien = $_POST['txtSoTien'];
            $ngayTao = $_POST['txtNgaytao'];
            $hanNop = $_POST['txtHannop'];
    
            // Kiểm tra trùng tên khoản thu
            $kq1 = $this->dskt->checktrungkhoanthu($tenKhoanThu);
    
            if ($kq1) {
                echo '<script>
                    alert("Tên khoản thu đã tồn tại");
                    window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                </script>';
                exit(); // Dừng lại nếu tên khoản thu đã tồn tại
            } else {
                // BƯỚC 1: Tạo khoản thu chung
                $kq = $this->dskt->khoanthu_ins($tenKhoanThu, $loaiKhoanThu, $soTien, $ngayTao, $hanNop);
    
                if ($kq) {
                    // Lấy mã khoản thu vừa tạo
                    $maKhoanThu = mysqli_insert_id($this->dskt->con);
    
                    // BƯỚC 2: Xử lý theo loại khoản thu
                    if ($loaiKhoanThu === 'Học phí') {
                        // Nếu là học phí, tính học phí cho từng sinh viên
                        $resultHocPhi = $this->dskt->capNhatHocPhiChoSinhVien($maKhoanThu);
    
                        if (!$resultHocPhi) {
                            echo '<script>
                                alert("Thêm khoản thu thành công nhưng tính học phí thất bại!");
                                window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                            </script>';
                            exit();
                        }
                    } else {
                        // Nếu là khoản thu khác, gán mặc định cho từng sinh viên
                        $resultSinhVien = $this->dskt->khoanthu_sinhvien_ins($maKhoanThu, $soTien);
    
                        if (!$resultSinhVien) {
                            echo '<script>
                                alert("Thêm khoản thu thành công nhưng không có sinh viên nào để gán!");
                                window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                            </script>';
                            exit();
                        }
                    }
    
                    // BƯỚC 3: Cập nhật miễn giảm
                    $capnhatMienGiam = $this->dsmg->capnhatMienGiamKhiTaoKhoanThu($maKhoanThu);
    
                    if ($capnhatMienGiam) {
                        echo '<script>
                            alert("Thêm khoản thu, gán sinh viên và cập nhật miễn giảm thành công!");
                            window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                        </script>';
                    } else {
                        echo '<script>
                            alert("Thêm khoản thu thành công nhưng cập nhật miễn giảm thất bại!");
                            window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                        </script>';
                    }
                } else {
                    echo '<script>alert("Thêm mới khoản thu thất bại!")</script>';
                }
            }
        } else {
            // Hiển thị form thêm khoản thu
            $this->view('Masterlayout', [
                'page' => 'Khoanthu_them', // Gọi view thêm khoản thu
            ]);
        }
    }
    
    
    
    
    

    // Tìm kiếm
    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $tenKhoanThu = $_POST['txtTKTenkhoanthu'];
            $hanNop = $_POST['txtTKHannop']; // lấy dữ liệu từ form

            $dl = $this->dskt->khoanthu_find($tenKhoanThu, $hanNop); // gọi hàm tìm kiếm
            // gọi lại giao diện render lại trang và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'DSKhoanthu_v',
                'dulieu' => $dl,
                'ten_khoan_thu' => $tenKhoanThu,
                'han_nop' => $hanNop,
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
                    // Giả sử thứ tự cột: Tên khoản thu | Loại khoản thu | Số tiền | Ngày tạo | Hạn nộp
                    $tenKhoanThu = isset($row[0]) ? trim($row[0]) : null;
                    $loaiKhoanThu = isset($row[1]) ? trim($row[1]) : null;
                    $soTien = isset($row[2]) ? trim($row[2]) : null;
                    $ngayTao = isset($row[3]) ? trim($row[3]) : null;
                    $hanNop = isset($row[4]) ? trim($row[4]) : null;

                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if (!$tenKhoanThu || !$loaiKhoanThu || !$soTien || !$ngayTao || !$hanNop) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dskt->khoanthu_ins($tenKhoanThu, $loaiKhoanThu, $soTien, $ngayTao, $hanNop);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/QLHS_L1/DSKhoanthu';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/QLHS_L1/DSKhoanthu';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/QLHS_L1/DSKhoanthu';
                  </script>";
        }
    }

    // Hàm xuất Excel
    function exportExcel() {
        try {
            $data = $this->dskt->khoanthu_find('', '');

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Mã khoản thu');
            $sheet->setCellValue('B1', 'Tên khoản thu');
            $sheet->setCellValue('C1', 'Loại khoản thu');
            $sheet->setCellValue('D1', 'Số tiền');
            $sheet->setCellValue('E1', 'Ngày tạo');
            $sheet->setCellValue('F1', 'Hạn nộp');

            $rowNumber = 2;
            foreach ($data as $row) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_khoan_thu'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ten_khoan_thu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['loai_khoan_thu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['so_tien'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['ngay_tao'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('F' . $rowNumber, $row['han_nop'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $rowNumber++;
            }

            foreach (range('A', 'F') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachKhoanThu.xlsx"');
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
                    window.location.href = 'http://localhost/QLHS_L1/DSKhoanthu';
                  </script>";
        }
    }

    // Hàm xóa
    function xoa($id) {
        $kq = $this->dskt->khoanthu_del($id);
        if ($kq) {
            echo '<script>
                    alert("Xóa thành công");
                    window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                  </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    // Hàm sửa
    function sua($id) {
        $this->view('Masterlayout', [
            'page' => 'Khoanthu_sua',
            'dulieu' => $this->dskt->sua_id($id),
        ]);
    }

    // Lưu dữ liệu sau khi sửa
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            $id = $_POST['txtId'];
            $tenKhoanThu = $_POST['txtTenkhoanthu'];
            $loaiKhoanThu = $_POST['txtLoaikhoanthu'];
            $soTien = $_POST['txtSoTien'];
            $ngayTao = $_POST['txtNgaytao'];
            $hanNop = $_POST['txtHannop'];
    
            // Cập nhật khoản thu
            $kq = $this->dskt->khoanthu_upd($id, $tenKhoanThu, $loaiKhoanThu, $soTien, $ngayTao, $hanNop);
    
            if ($kq) {
                // Gọi hàm cập nhật miễn giảm cho sinh viên
                $capnhatMienGiam = $this->dsmg->capnhatMienGiamKhiTaoKhoanThu($id);
    
                if ($capnhatMienGiam) {
                    echo '<script>
                            alert("Sửa khoản thu và cập nhật miễn giảm thành công!");
                            window.location.href = "http://localhost/QLHS_L1/DSKhoanthu";
                          </script>';
                    exit();
                } else {
                    echo '<script>alert("Sửa khoản thu thành công nhưng cập nhật miễn giảm thất bại!")</script>';
                }
            } else {
                echo '<script>alert("Sửa khoản thu thất bại!")</script>';
            }
    
            // Gọi lại giao diện
            $this->view('Masterlayout', [
                'page' => 'DSKhoanthu_v',
                'dulieu' => $this->dskt->khoanthu_find('', ''),
            ]);
        }
    }
    
}
?>
