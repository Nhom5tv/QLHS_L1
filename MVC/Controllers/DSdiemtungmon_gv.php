<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
class DSdiemtungmon_gv extends controller {
    private $diemtungmon;

    function __construct() {
        $this->diemtungmon = $this->model('DSdiemtheomon_m');
    }

    // Hiển thị danh sách lớp và điểm chi tiết
    function Get_data() {
        // Lấy mã giảng viên từ session
        $ma_giang_vien = $_SESSION['ma_tai_khoan'];

        // Lấy mã lớp được chọn từ POST hoặc GET
        $selected_class_id = isset($_POST['class_id']) ? $_POST['class_id'] : (isset($_GET['class_id']) ? $_GET['class_id'] : null);

        // Truyền trực tiếp kết quả của các phương thức vào view
        $this->view('Masterlayout_gv', [
            'page' => 'DSdiem_gv',
            'classes' => $this->diemtungmon->getClassesByLecturer($ma_giang_vien), // Truyền danh sách lớp vào view
            'dulieu' => $selected_class_id ? $this->diemtungmon->getStudentScoresByClass($selected_class_id) : null // Truyền danh sách điểm nếu đã chọn lớp
        ]);
    }

    
    

    // Hiển thị form sửa điểm chi tiết
    function sua($id) {
        // Lấy dữ liệu theo ID để hiển thị trong form sửa
        $dulieu = $this->diemtungmon->diemtungmon_find($id);

        // Kiểm tra nếu không tìm thấy dữ liệu
        if (!$dulieu || mysqli_num_rows($dulieu) == 0) {
            echo '<script>alert("Dữ liệu không tồn tại"); window.location.href = "/qlhs/DSdiemtungmon_gv/Get_data";</script>';
            exit;
        }

        $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

        // Trả về view sửa điểm chi tiết với dữ liệu
        $this->view('Masterlayout_gv', [
            'page' => 'DSdiemchitiet_sua',
            'dulieu' => $dulieu,
            'class_id' => $class_id
        ]);
    }

    // Xử lý cập nhật điểm chi tiết
    function suadl() {
        if (isset($_POST['btnLuu'])) {
            // Lấy dữ liệu từ form
            $id = $_POST['txtId'];
            $lan_hoc = $_POST['txtLanHoc'];
            $lan_thi = $_POST['txtLanThi'];
            $diem_chuyen_can = $_POST['txtDiemChuyenCan'];
            $diem_giua_ky = $_POST['txtDiemGiuaKy'];
            $diem_cuoi_ky = $_POST['txtDiemCuoiKy'];
            $class_id = $_POST['class_id']; 

            // Cập nhật điểm chi tiết trong cơ sở dữ liệu
            $kq = $this->diemtungmon->diemtungmon_upd($id, $lan_hoc, $lan_thi, $diem_chuyen_can, $diem_giua_ky, $diem_cuoi_ky);

            // Kiểm tra kết quả cập nhật
            if ($kq) {
                echo '<script>alert("Sửa điểm chi tiết thành công");</script>';
                $ma_giang_vien = $_SESSION['ma_tai_khoan']; // Lấy mã giảng viên từ session
                $this->view('Masterlayout_gv', [
                    'page' => 'DSdiem_gv',
                    'classes' => $this->diemtungmon->getClassesByLecturer($ma_giang_vien), // Lấy danh sách lớp
                    'dulieu' => $this->diemtungmon->getStudentScoresByClass($class_id) // Lấy danh sách điểm theo class_id
                ]);
                exit;
            } else {
                echo '<script>alert("Sửa điểm chi tiết thất bại");</script>';
            }
        }
    }

    function exportExcel() {
        if (isset($_GET['class_id'])) { // Lấy mã lớp từ GET
            $class_id = $_GET['class_id'];
    
            try {
                // Lấy dữ liệu danh sách điểm của lớp
                $data = $this->diemtungmon->getStudentScoresByClass($class_id);
    
                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
    
                // Đặt tiêu đề các cột
                $sheet->setCellValue('A1', 'STT');
                $sheet->setCellValue('B1', 'Mã sinh viên');
                $sheet->setCellValue('C1', 'Họ tên');
                $sheet->setCellValue('D1', 'Lần học');
                $sheet->setCellValue('E1', 'Lần thi');
                $sheet->setCellValue('F1', 'Điểm chuyên cần');
                $sheet->setCellValue('G1', 'Điểm giữa kỳ');
                $sheet->setCellValue('H1', 'Điểm cuối kỳ');
    
                // Duyệt qua dữ liệu và điền vào file Excel
                $rowNumber = 2; // Bắt đầu từ dòng 2 (dòng 1 là tiêu đề)
                $index = 1; // Số thứ tự
                while ($row = mysqli_fetch_assoc($data)) {
                    $sheet->setCellValue('A' . $rowNumber, $index++);
                    $sheet->setCellValueExplicit('B' . $rowNumber, $row['ma_sinh_vien'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('C' . $rowNumber, $row['ho_ten']);
                    $sheet->setCellValue('D' . $rowNumber, $row['lan_hoc']);
                    $sheet->setCellValue('E' . $rowNumber, $row['lan_thi']);
                    $sheet->setCellValue('F' . $rowNumber, $row['diem_chuyen_can']);
                    $sheet->setCellValue('G' . $rowNumber, $row['diem_giua_ky']);
                    $sheet->setCellValue('H' . $rowNumber, $row['diem_cuoi_ky']);
                    $rowNumber++;
                }
    
                // Tự động điều chỉnh kích thước cột
                foreach (range('A', 'H') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
    
                // Thiết lập header để xuất file
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="DanhSachDiemLop_' . $class_id . '.xlsx"');
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Pragma: no-cache');
                header('Expires: 0');
    
                // Xuất file Excel
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                ob_clean(); // Xóa các dữ liệu đầu ra trước đó để tránh lỗi
                $writer->save('php://output');
                exit;
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xuất file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSdiemtungmon_gv';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không tìm thấy mã lớp để xuất dữ liệu.');
                    window.location.href = 'http://localhost/qlhs/DSdiemtungmon_gv';
                  </script>";
        }
    }
    
}

?>
