<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class DSHoadon extends controller {
    private $dshd;

    function __construct() {
        $this->dshd = $this->model('Hoadon_m'); // Sử dụng model Hoadon_m thay vì Miengiam_m
    }

    // Lấy dữ liệu để hiển thị khi load trang
    function Get_data() {
        $dulieu = $this->dshd->getHoaDonWithTenKhoanThu();
        $this->view('Masterlayout_admin', [
            'page' => 'DSHoadon_v',
            'dulieu' => $dulieu, // Lấy danh sách hóa đơn
        ]);
    }

    // Thêm mới hóa đơn
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            // Lấy dữ liệu từ form
            $maSinhVien = $_POST['txtMasinhvien'];
            $maKhoanThu = $_POST['txtMakhoanthu'];
            $soTien = $_POST['txtSotien'];
            $ngayThanhToan = $_POST['txtNgaythanhtoan'];
            $noiDung = $_POST['txtNoidung'];  // Thêm nội dung vào đây
            $hinhThucThanhToan = $_POST['txtHinhthucthanhtoan']; // Thêm hình thức thanh toán
            
            // Thực hiện thêm mới hóa đơn vào cơ sở dữ liệu
            $kq = $this->dshd->hoadon_ins($maSinhVien, $maKhoanThu, $ngayThanhToan, $soTien, $hinhThucThanhToan, $noiDung);
    
            if ($kq) {
                // Cập nhật trạng thái thanh toán trong khoan_thu_sinh_vien
                $capnhatTrangThai = $this->dshd->capnhatTrangThaiThanhToan($maKhoanThu, $maSinhVien);
    
                if ($capnhatTrangThai) {
                    // Nếu thành công, thông báo và chuyển hướng
                    echo '<script>
                        alert("Thêm mới hóa đơn và cập nhật trạng thái thành công");
                        window.location.href = "http://localhost/QLHS/DSHoadon";
                    </script>';
                    exit();  // Dừng lại sau khi redirect
                } else {
                    echo '<script>alert("Thêm hóa đơn thành công nhưng cập nhật trạng thái thất bại")</script>';
                }
            } else {
                // Nếu thất bại, thông báo lỗi
                echo '<script>alert("Thêm mới hóa đơn thất bại")</script>';
            }
        } else {
            $tenkhoanthu=$this->dshd->getKhoanThuList();
            // Nếu chưa submit form, chỉ hiển thị form thêm mới
            $this->view('Masterlayout_admin', [
                'page' => 'Hoadon_them',  // Gọi view thêm mới hóa đơn
                'tenkhoanthu' => $tenkhoanthu,
            ]);
        }
    }
    

    // Tìm kiếm hóa đơn
    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $maSinhVien = $_POST['txtTKMasinhvien'];
            $ngayThanhToan = $_POST['txtTKNgaythanhtoan']; // lấy dữ liệu từ form
            
            $dl = $this->dshd->hoadon_find($maSinhVien, $ngayThanhToan); // gọi hàm tìm kiếm
            // gọi lại giao diện render lại trang và truyền $dl ra
            $this->view('Masterlayout_admin', [
                'page' => 'DSHoadon_v',
                'dulieu' => $dl,
                'ma_sinh_vien' => $maSinhVien,
                'ngay_thanh_toan' => $ngayThanhToan,
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
                    // Giả sử thứ tự cột: Mã sinh viên | Mã khoản thu | Số tiền | Ngày thanh toán | Nội dung | Hình thức thanh toán
                    $maSinhVien = isset($row[0]) ? trim($row[0]) : null;
                    $maKhoanThu = isset($row[1]) ? trim($row[1]) : null;
                    $soTien = isset($row[2]) ? trim($row[2]) : null;
                    $ngayThanhToan = isset($row[3]) ? trim($row[3]) : null;
                    $hinhThucThanhToan = isset($row[4]) ? trim($row[4]) : null; // Thêm hình thức thanh toán
                    $noiDung = isset($row[5]) ? trim($row[5]) : null;

                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if (!$maSinhVien || !$maKhoanThu || !$soTien || !$ngayThanhToan || !$noiDung || !$hinhThucThanhToan) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dshd->hoadon_ins($maSinhVien, $maKhoanThu, $ngayThanhToan, $soTien,  $hinhThucThanhToan, $noiDung);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/QLHS/DSHoadon';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/QLHS/DSHoadon';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/QLHS/DSHoadon';
                  </script>";
        }
    }

    // Hàm xuất Excel
    function exportExcel() {
        try {
            $data = $this->dshd->hoadon_find('', '');

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Mã hóa đơn');
            $sheet->setCellValue('B1', 'Mã sinh viên');
            $sheet->setCellValue('C1', 'Mã khoản thu');
            $sheet->setCellValue('D1', 'Số tiền');
            $sheet->setCellValue('E1', 'Ngày thanh toán');
            $sheet->setCellValue('F1', 'Hình thức thanh toán');  // Thêm cột "Hình thức thanh toán"
            $sheet->setCellValue('G1', 'Nội dung');  // Thêm cột "Nội dung"

            $rowNumber = 2;
            foreach ($data as $row) {
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_hoa_don'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('B' . $rowNumber, $row['ma_sinh_vien'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['ma_khoan_thu'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['so_tien_da_nop'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('E' . $rowNumber, $row['ngay_thanh_toan'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('F' . $rowNumber, $row['hinh_thuc_thanh_toan'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('G' . $rowNumber, $row['noi_dung'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

                $rowNumber++;
            }

            foreach (range('A', 'G') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachHoaDon.xlsx"');
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
                    window.location.href = 'http://localhost/QLHS/DSHoadon';
                  </script>";
        }
    }

    // Hàm xóa
    function xoa($id) {
        // Lấy thông tin hóa đơn trước khi xóa
        $hoaDon = $this->dshd->getHoaDonById($id);
    
        if (!$hoaDon) {
            echo '<script>
                    alert("Hóa đơn không tồn tại!");
                    window.history.back();
                  </script>';
            exit;
        }
    
        $maKhoanThu = $hoaDon['ma_khoan_thu'];
        $maSinhVien = $hoaDon['ma_sinh_vien'];
    
        // Thực hiện xóa hóa đơn
        $kq = $this->dshd->hoadon_del($id);
    
        if ($kq) {
            // Cập nhật trạng thái thanh toán
            $this->dshd->capnhatTrangThaiThanhToan($maKhoanThu, $maSinhVien);
    
            echo '<script>
                    alert("Xóa thành công và trạng thái đã được cập nhật");
                    window.location.href = "http://localhost/QLHS/DSHoadon";
                  </script>';
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }
    
    function sua($id) {
        $tenkhoanthu=$this->dshd->getKhoanThuList();
        $this->view('Masterlayout_admin', [
            'page' => 'Hoadon_sua',
            'dulieu' => $this->dshd->idhoadon($id),
            'tenkhoanthu' => $tenkhoanthu,
        ]);
    }

    // Lưu dữ liệu sau khi sửa
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            $id = $_POST['txtId'];
            $maSinhVien = $_POST['txtMasinhvien'];
            $maKhoanThu = $_POST['txtMakhoanthu'];
            $soTien = $_POST['txtSotien'];
            $ngayThanhToan = $_POST['txtNgaythanhtoan'];
            $noiDung = $_POST['txtNoidung'];  // Thêm nội dung vào đây
            $hinhThucThanhToan = $_POST['txtHinhthucthanhtoan']; // Thêm hình thức thanh toán

            // Thực hiện thêm mới hóa đơn vào cơ sở dữ liệu
            $kq = $this->dshd->hoadon_upd($id,$maSinhVien, $maKhoanThu, $ngayThanhToan, $soTien ,$hinhThucThanhToan, $noiDung);
            if ($kq) {
                echo '<script>alert("Sửa thành công")</script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }
            $dulieu = $this->dshd->getHoaDonWithTenKhoanThu();
            // Gọi lại giao diện
            $this->view('Masterlayout_admin', [
                'page' => 'DSHoadon_v',
                'dulieu' => $dulieu,
            ]);
        }
    }
}
