<?php
class DSdiem extends controller {
    private $diemModel;

    public function __construct() {
        // Khởi tạo model DiemModel
        $this->diemModel = $this->model('Diemtonghop_m');
    }

    // Tính toán và cập nhật dữ liệu từ diem_chi_tiet sang diem_tong_hop
    public function capNhatDiemTongHop() {
        // Xóa dữ liệu cũ trong bảng diem_tong_hop
        $this->diemModel->clearDiemTongHop();

        // Lấy tất cả dữ liệu từ bảng diem_chi_tiet
        $diemChiTiet = $this->diemModel->getAllDetailedScores();

        if ($diemChiTiet) {
            // Duyệt qua từng bản ghi
            while ($row = $diemChiTiet->fetch_assoc()) {
                $ma_dct = $row['ma_dct'];
                $diem_chuyen_can = $row['diem_chuyen_can'];
                $diem_giua_ky = $row['diem_giua_ky'];
                $diem_cuoi_ky = $row['diem_cuoi_ky'];
                $lan_thi = $row['lan_thi']; 

                 // Kiểm tra xem các điểm có đầy đủ không
                if (is_null($diem_chuyen_can) || is_null($diem_giua_ky) || is_null($diem_cuoi_ky)) {
                    continue; // Nếu thiếu dữ liệu, bỏ qua bản ghi này
                }

                // Tính điểm hệ 10
                $diem_he_10 = $diem_chuyen_can * 0.1 + $diem_giua_ky * 0.3 + $diem_cuoi_ky * 0.6;

                // Quy đổi điểm hệ 4 và điểm chữ
                if ($diem_he_10 >= 8.5) {
                    $diem_he_4 = 4.0;
                    $diem_chu = 'A';
                } elseif ($diem_he_10 >= 8.0) {
                    $diem_he_4 = 3.5;
                    $diem_chu = 'B+';
                } elseif ($diem_he_10 >= 7.0) {
                    $diem_he_4 = 3.0;
                    $diem_chu = 'B';
                } elseif ($diem_he_10 >= 6.0) {
                    $diem_he_4 = 2.5;
                    $diem_chu = 'C+';
                } elseif ($diem_he_10 >= 5.5) {
                    $diem_he_4 = 2.0;
                    $diem_chu = 'C';
                } elseif ($diem_he_10 >= 5.0) {
                    $diem_he_4 = 1.5;
                    $diem_chu = 'D+';
                } elseif ($diem_he_10 >= 4.0) {
                    $diem_he_4 = 1.0;
                    $diem_chu = 'D';
                } else {
                    $diem_he_4 = 0.0;
                    $diem_chu = 'F';
                }

                // Đánh giá
                if ($diem_he_10 >= 4.0) {
                    $danh_gia = "DAT";
                } elseif ($lan_thi == 2) {
                    $danh_gia = "HOCLAI";
                } else {
                    $danh_gia = "THILAI";
                }

                // Chèn dữ liệu vào bảng diem_tong_hop
                $this->diemModel->insertDiemTongHop($ma_dct, $diem_he_10, $diem_he_4, $diem_chu, $danh_gia);
            }
        }
        // Chuyển hướng tới trang danh sách điểm tổng hợp
        header("Location: /qlhs/Diemsinhvien/dulieu");
        exit();
    }

    // Hiển thị danh sách điểm tổng hợp
    public function Get_data() {
        $id=$_SESSION['ma_tai_khoan'];
        $diemTongHop = $this->diemModel->getAllSummaryScores($id);
        $this->view('MasterLayout', [
            'page' => 'Diemsinhvien',
            'dulieu' => $diemTongHop
        ]);
    }
}
?>
