
<?php
class ThongTinSinhVien extends controller {
    private $dssv1;
    
    public function __construct() {
        // Gọi model ThongTinSinhVien_m để làm việc với dữ liệu sinh viên
        $this->dssv1 = $this->model('ThongTinSinhVien_m');
    }

    // getdata để hiển thị dữ liệu khi load trang
    public function Get_data() {
        $maSV = 'msv3';
    
        // Lấy dữ liệu từ Model
        $result = $this->dssv1->get_sinhvien_by_msv($maSV);
    
        // Kiểm tra nếu có dữ liệu
        $dulieu = mysqli_fetch_assoc($result);
    
        // Truyền dữ liệu vào view
        $this->view('Masterlayout', [
            'page' => 'ThongTinSinhVien_v',
            'dulieu' => $dulieu
        ]);
    }

    // Phương thức để xử lý cập nhật thông tin sinh viên
    public function Update_data($maSV) {
        $result = $this->dssv1->get_sinhvien_by_msv($maSV);
    
        // Kiểm tra nếu có dữ liệu
        $dulieu = mysqli_fetch_assoc($result);
        $this->view('Masterlayout', [
            'page' => 'ThongTinSinhVien_sua',
            'dulieu' => $dulieu
        ]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $email = $_POST['email'];
            $soDienThoai = $_POST['soDienThoai'];

            // Gọi phương thức cập nhật trong model
            $updated = $this->dssv1->update_sinhvien($maSV, $email, $soDienThoai);

            if ($updated) {
                echo '<script>
            alert("Sửa thành công");
            window.location.href = "http://localhost/qlhs/ThongTinSinhVien";
                </script>';
            } else {
                // Xử lý nếu có lỗi
                echo "Cập nhật thất bại!";
            }
        }
    }
}
?>
