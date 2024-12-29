<?php
require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PHPSpreadsheet qua Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
class DSGiangvien extends controller{
    private $dsgv;
    
    function __construct()
    {
        $this->dsgv = $this->model('Giangvien_m');
    }

    // getdata de hien thi du lieu khi load trang
    function Get_data() {
        $khoaList = $this->dsgv->getKhoa();  // Lấy dữ liệu khoa
        $this->view('Masterlayout_admin', [
            'page' => 'DSGiangvien_v',
            'dulieu' => $this->dsgv->giangvien_find('', ''),
            'khoaList' => $khoaList   // Truyền dữ liệu khoa vào view
        ]);
    }


    
    

    function Timkiem() {
        if (isset($_POST['btnTimkiem'])) {
            $maGV = $_POST['txtTimkiemMaGV'];
            $hoTen = $_POST['txtTimkiemHoTen'];
    
            $dl = $this->dsgv->giangvien_find($maGV, $hoTen);
            $khoaList = $this->dsgv->getKhoa();  // Lấy danh sách khoa
            $this->view('Masterlayout_admin', [
                'page' => 'DSGiangvien_v',
                'dulieu' => $dl,
                'ma_giang_vien' => $maGV,
                'ho_ten' => $hoTen,
                'khoaList' => $khoaList // Truyền danh sách khoa vào view
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
                    $maGV = isset($row[0]) ? trim($row[0]) : null;
                    $maKhoa = isset($row[1]) ? trim($row[1]) : null;
                    $hoTen = isset($row[2]) ? trim($row[2]) : null;
                    $email = isset($row[3]) ? trim($row[3]) : null;
                    $soDienThoai = isset($row[4]) ? trim($row[4]) : null;
                    $chuyenNganh = isset($row[5]) ? trim($row[5]) : null;
                    $maTaiKhoan = isset($row[6]) ? trim($row[6]) : null;
         
                    


                    // Bỏ qua các hàng thiếu dữ liệu cần thiết
                    if ( !$maKhoa || !$hoTen || !$email || !$soDienThoai || !$chuyenNganh || !$maTaiKhoan) {
                        $failCount++;
                        continue;
                    }

                    // Lưu vào cơ sở dữ liệu
                    $result = $this->dsgv->giangvien_ins( $maGV,$maKhoa, $hoTen,$email,$soDienThoai,$chuyenNganh,$maTaiKhoan);
                    if ($result) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                echo "<script>
                        alert('Upload thành công: {$successCount} hàng, thất bại: {$failCount} hàng.');
                        window.location.href = 'http://localhost/qlhs/DSGiangvien';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Có lỗi xảy ra khi xử lý file Excel: {$e->getMessage()}');
                        window.location.href = 'http://localhost/qlhs/DSGiangvien';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Không có file nào được chọn hoặc có lỗi trong quá trình tải lên.');
                    window.location.href = 'http://localhost/qlhs/DSGiangvien';
                  </script>";
        }
    }

    function exportExcel() {
        try {
            $data = $this->dsgv->giangvien_find('', '');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Set tiêu đề cho các cột
            $sheet->setCellValue('A1', 'Mã giảng viên');
            $sheet->setCellValue('B1', 'Mã khoa');
            $sheet->setCellValue('C1', 'Tên giảng viên');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Số điện thoại');
            $sheet->setCellValue('F1', 'Chuyên ngành');
            $sheet->setCellValue('G1', 'Mã tài khoản');
    
            $rowNumber = 2;
            foreach ($data as $row) {
    
               
                $sheet->setCellValueExplicit('A' . $rowNumber, $row['ma_giang_vien'] ?? 0, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                 $sheet->setCellValueExplicit('B' . $rowNumber, $row['ma_khoa'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('C' . $rowNumber, $row['ho_ten'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $rowNumber, $row['email'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                 $sheet->setCellValueExplicit('E' . $rowNumber, $row['so_dien_thoai'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                 $sheet->setCellValueExplicit('F' . $rowNumber, $row['chuyen_nganh'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                 $sheet->setCellValueExplicit('G' . $rowNumber, $row['ma_tai_khoan'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $rowNumber++;
            }
    
            // Tự động điều chỉnh chiều rộng cột
            foreach (range('A', 'G') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
    
            // Xuất file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="DanhSachGiangvien.xlsx"');
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
                    window.location.href = 'http://localhost/qlhs/DSGiangvien';
                  </script>";
        }
    }
    
    




    function xoa($maGV){
        $kq = $this->dsgv->giangvien_del($maGV);
        if ($kq) {
            echo '<script>
                alert("Xóa thành công");
                window.location.href = "http://localhost/qlhs/DSGiangvien";
            </script>';
            exit();
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
    }

    function sua($maGV) {

        $khoaList = $this->dsgv->getKhoa(); // Lấy dữ liệu từ model
        
        // Kiểm tra xem có dữ liệu khoa hay không
        if (!$khoaList) {
            echo "Không có dữ liệu khoa!";
        } else {
            echo "Có dữ liệu khoa!";
        }
    
        // Lấy thông tin ngành dựa trên mã ngành
        $gvData = $this->dsgv->giangvien_find($maGV, "");
    
        $this->view('Masterlayout_admin', [
            'page' => 'Giangvien_sua',
            'dulieu' => $gvData,
            'khoaList' => $khoaList   // Truyền dữ liệu khoa vào view
        ]);
    }

    function suadl(){
        if (isset($_POST['btnLuu'])) {
            $maGV = $_POST['txtMaGV'];
            $maKhoa = $_POST['txtMaKhoa']; // Mã kho
            $hoTen = $_POST['txtHoTen'];
            $email = $_POST['txtEmail'];
            $soDienThoai = $_POST['txtSoDienThoai'];
            $chuyenNganh = $_POST['txtChuyenNganh'];
            $maTaiKhoan = $_POST['txtIdTaiKhoan'];

            $kq = $this->dsgv->giangvien_upd($maGV,$maKhoa,$hoTen, $email, $soDienThoai, $chuyenNganh , $maTaiKhoan);

            if ($kq) {
                echo '<script>
                    alert("Sửa thành công");
                    window.location.href = "http://localhost/qlhs/DSGiangvien";
                </script>';
            } else {
                echo '<script>alert("Sửa thất bại")</script>';
            }

            $this->view('Masterlayout_admin', [
                'page' => 'DSGiangvien_v',
                'dulieu' => $this->dsgv->giangvien_find('', '')
            ]);
        }
    }
}
?>
