<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
class DSSinhvien extends controller{
    private $dssv;
    
    function __construct()
    {
        $this->dssv = $this->model('Sinhvien_m');
    }

    // getdata de hien thi du lieu khi load trang
    function Get_data(){
        $khoaList = $this->dssv->getKhoa(); 
        $nganhList = $this->dssv->getNganh();
        $this->view('Masterlayout_admin', [
            'page' => 'DSSinhvien_v',
            'dulieu' => $this->dssv->sinhvien_find('', ''),
            'khoaList'=> $khoaList,
            'nganhList'=> $nganhList,
            
        ]);
    }


    
    

    function Timkiem(){
        if (isset($_POST['btnTimkiem'])) {
            $maSV = $_POST['txtTimkiemMaSV'];
            $hoTen = $_POST['txtTimkiemHoTen'];
            
            $dl = $this->dssv->sinhvien_find($maSV, $hoTen);
            $this->view('Masterlayout_admin', [
                'page' => 'DSSinhvien_v',
                'dulieu' => $dl,
                'ma_sinh_vien' => $maSV,
                'ho_ten' => $hoTen
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
                    $maSV = isset($row[0]) ? trim($row[0]) : null;
                    $maKhoa = isset($row[1]) ? trim($row[1]) : null;
                    $maNganh = isset($row[2]) ? trim($row[2]) : null;
                    $hoTen = isset($row[3]) ? trim($row[3]) : null;
                    $ngaySinh = isset($row[4]) ? trim($row[4]) : null;
                    $gioiTinh= isset($row[5]) ? trim($row[5]) : null;
                    $queQuan= isset($row[6]) ? trim($row[6]) : null;
                    $email = isset($row[7]) ? trim($row[7]) : null;
                    $soDienThoai = isset($row[8]) ? trim($row[8]) : null;
                    $khoaHoc = isset($row[9]) ? trim($row[9]) : null;
                 


                    // Kiểm tra và định dạng ngày sinh
$formattedDate = DateTime::createFromFormat('Y-m-d', $ngaySinh);
if ($formattedDate && $formattedDate->format('Y-m-d') === $ngaySinh) {
    $ngaySinh = $formattedDate->format('Y-m-d');
} else {
    // Nếu ngày không hợp lệ, thiết lập ngày sinh mặc định hoặc bỏ qua
    $ngaySinh = '0000-00-00'; // Hoặc có thể bỏ qua
    $failCount++;
    continue;
}
         
                    


                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if ( !$maKhoa || !$maNganh || !$hoTen || !$ngaySinh || !$gioiTinh || !$queQuan || !$email || !$soDienThoai || !$khoaHoc ) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dssv->sinhvien_ins( $maSV,$maKhoa, $maNganh, $hoTen, $ngaySinh,$gioiTinh,$queQuan,$email,$soDienThoai,$khoaHoc);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSSinhvien';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSSinhvien';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSSinhvien';
                  </script>";
        }
    }

    function exportExcel() {
        try {
            $data = $this->dssv->sinhvien_find('', '');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Set tiêu đề cho các cột
            $sheet->setCellValue('A1', 'Mã sinh viên');
            $sheet->setCellValue('B1', 'Tên đăng nhập');
            $sheet->setCellValue('C1', 'Mật khẩu');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Ngày sinh');
            $sheet->setCellValue('F1', 'Giới tính');
            $sheet->setCellValue('G1', 'Quê quán');
            $sheet->setCellValue('H1', 'Email');
            $sheet->setCellValue('I1', 'Số điện thoại');
            $sheet->setCellValue('J1', 'Khóa học');
    
            $rowNumber = 2;
            foreach ($data as $row) {
               // Kiểm tra và định dạng ngày sinh
$ngaySinh = $row['ngay_sinh'] ?? '';
if (!empty($ngaySinh)) {
    try {
        // Đảm bảo ngày sinh ở dạng 'YYYY-MM-DD' hoặc một định dạng hợp lệ
        $date = new DateTime($ngaySinh); // Chuyển sang đối tượng DateTime
        // Chuyển đổi ngày sinh sang giá trị số của Excel
        $excelDate = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($date);
        $sheet->setCellValueExplicit('E' . $rowNumber, $excelDate, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);

        // Định dạng ngày theo kiểu 'DD/MM/YYYY' (hoặc định dạng bạn muốn)
        $sheet->getStyle('E' . $rowNumber)->getNumberFormat()->setFormatCode('DD/MM/YYYY');
    } catch (Exception $e) {
        // Nếu ngày sinh không hợp lệ, để trống ô
        $sheet->setCellValueExplicit('E' . $rowNumber, '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    }
} else {
    // Nếu không có ngày sinh, để trống
    $sheet->setCellValueExplicit('E' . $rowNumber, '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
}

// Điền các giá trị khác
$sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_sinh_vien'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('B' . $rowNumber, $row['ma_khoa'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('C' . $rowNumber, $row['ma_nganh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$sheet->setCellValueExplicit('D' . $rowNumber, $row['ho_ten'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

// Không cần đặt lại ngày sinh ở đây nữa
// $sheet->setCellValueExplicit('E' . $rowNumber, $row['ngay_sinh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

$sheet->setCellValueExplicit('F' . $rowNumber, $row['gioi_tinh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('G' . $rowNumber, $row['que_quan'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('H' . $rowNumber, $row['email'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('I' . $rowNumber, $row['so_dien_thoai'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
$sheet->setCellValueExplicit('J' . $rowNumber, $row['khoa_hoc'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
$rowNumber++;

            }
    
            // Tự động điều chỉnh chiều rộng cột
            foreach (range('A', 'K') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            // Xuất file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachsinhvien.xlsx"');
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
                    window.location.href = 'http://localhost/qlhs/DSSinhvien';
                  </script>";
        }
    }
    
    




    function xoa($maSV){
        $kq = $this->dssv->sinhvien_del($maSV);
        if ($kq) {
            echo '<script>
                alert("Xóa thành công");
                window.location.href = "http://localhost/qlhs/DSSinhvien";
            </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    function sua($maSV){
        $khoaList = $this->dssv->getKhoa(); 
        $nganhList = $this->dssv->getNganh(); 
    
        // Lấy thông tin ngành dựa trên mã ngành
        $svData = $this->dssv->sinhvien_find($maSV, "");

        $this->view('Masterlayout_admin', [
            'page' => 'Sinhvien_sua',
            'dulieu' =>$svData,
            'khoaList'=> $khoaList,
            'nganhList'=> $nganhList,

        ]);
    }

    function suadl(){
        if (isset($_POST['btnLuu'])) {
            $maSV = $_POST['txtMaSV'];
            $maKhoa = $_POST['txtMaKhoa']; // Mã khoa
            $maNganh = $_POST['txtMaNganh']; // Mã ngành
            $hoTen = $_POST['txtHoTen'];
            $ngaySinh = $_POST['txtNgaySinh'];
            $gioiTinh = $_POST['ddlGioiTinh'];
            $queQuan = $_POST['txtQueQuan'];
            $email = $_POST['txtEmail'];
            $soDienThoai = $_POST['txtSoDienThoai'];
            $khoaHoc = $_POST['txtKhoaHoc'];

            $kq = $this->dssv->sinhvien_upd($maSV,$maKhoa, $maNganh,$hoTen, $ngaySinh, $gioiTinh, $queQuan, $email, $soDienThoai, $khoaHoc);

            if ($kq) {
                echo '<script>
                    alert("Sửa thành công");
                    window.location.href = "http://localhost/qlhs/DSSinhvien";
                </script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout_admin', [
                'page' => 'DSSinhvien_v',
                'dulieu' => $this->dssv->sinhvien_find('', '')
            ]);
        }
    }
}
?>
