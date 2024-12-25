<?php 
class Hoadon_m extends connectDB {

    // Hàm thêm mới hóa đơn
    function hoadon_ins($maSinhVien, $maKhoanThu, $ngayThanhToan, $soTien, $hinhThucThanhToan, $noiDung) {
        $sql = "INSERT INTO hoa_don (ma_sinh_vien, ma_khoan_thu, ngay_thanh_toan, so_tien_da_nop, hinh_thuc_thanh_toan, noi_dung) 
                VALUES ('$maSinhVien', '$maKhoanThu', '$ngayThanhToan', '$soTien', N'$hinhThucThanhToan', N'$noiDung')";
        return mysqli_query($this->con, $sql);
    }

    // Hàm kiểm tra trùng mã sinh viên và mã khoản thu
    function checktrunghoadon($maSinhVien, $maKhoanThu) {
        $sql = "SELECT * FROM hoa_don WHERE ma_sinh_vien = '$maSinhVien' AND ma_khoan_thu = '$maKhoanThu'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  // Nếu có kết quả trả về, có nghĩa là đã trùng mã sinh viên và mã khoản thu
        }
        return $kq;
    }

    // Hàm tìm kiếm hóa đơn theo mã sinh viên hoặc loại khoản thu
    function hoadon_find($maSinhVien, $ngayThanhToan) {
        // Trường hợp tìm tất cả
        if (empty($maSinhVien) && empty($ngayThanhToan)) {
            $sql = "SELECT * FROM hoa_don";
        }
        // Trường hợp tìm theo mã sinh viên
        elseif (empty($ngayThanhToan)) {
            $sql = "SELECT * FROM hoa_don WHERE ma_sinh_vien LIKE '$maSinhVien%'";
        }
        // Trường hợp tìm theo ngày thanh toán
        elseif (empty($maSinhVien)) {
            $sql = "SELECT * FROM hoa_don WHERE ngay_thanh_toan LIKE '$ngayThanhToan%'";
        }
        // Trường hợp tìm theo cả mã sinh viên và ngày thanh toán
        else {
            $sql = "SELECT * FROM hoa_don WHERE ma_sinh_vien LIKE '$maSinhVien%' AND ngay_thanh_toan LIKE '$ngayThanhToan%'";
        }
    
        return mysqli_query($this->con, $sql);
    }
    

    // Hàm lấy thông tin hóa đơn theo ID
    function idhoadon($id) {
        $sql = "SELECT * FROM hoa_don WHERE ma_hoa_don = '$id'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa hóa đơn
    function hoadon_del($id) {
        $sql = "DELETE FROM hoa_don WHERE ma_hoa_don = '$id'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin hóa đơn
    function hoadon_upd($id, $maSinhVien, $maKhoanThu, $ngayThanhToan, $soTien, $hinhThucThanhToan, $noiDung) {
        $sql = "UPDATE hoa_don SET ma_sinh_vien = '$maSinhVien', ma_khoan_thu = '$maKhoanThu', 
                ngay_thanh_toan = '$ngayThanhToan', so_tien_da_nop = '$soTien', hinh_thuc_thanh_toan = N'$hinhThucThanhToan', 
                noi_dung = N'$noiDung' WHERE ma_hoa_don = '$id'";
        return mysqli_query($this->con, $sql);
    }
    function capnhatTrangThaiThanhToan($maKhoanThu, $maSinhVien) {
        // Lấy thông tin từ bảng hoa_don
        $sqlHoaDon = "SELECT SUM(so_tien_da_nop) AS tongTienDaDong 
                      FROM hoa_don 
                      WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        $resultHoaDon = mysqli_query($this->con, $sqlHoaDon);
        $rowHoaDon = mysqli_fetch_assoc($resultHoaDon);
        $tongTienDaDong = $rowHoaDon['tongTienDaDong'] ?? 0;
    
        // Lấy thông tin từ bảng khoan_thu_sinh_vien
        $sqlKhoanThuSV = "SELECT so_tien_phai_nop FROM khoan_thu_sinh_vien 
                          WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        $resultKhoanThuSV = mysqli_query($this->con, $sqlKhoanThuSV);
        $rowKhoanThuSV = mysqli_fetch_assoc($resultKhoanThuSV);
        $soTienPhaiNop = $rowKhoanThuSV['so_tien_phai_nop'] ?? 0;
    
        // Xác định trạng thái thanh toán
        $trangThai = ($tongTienDaDong >= $soTienPhaiNop) ? 'Đã thanh toán' : 'Thanh toán 1 phần';
    
        // Cập nhật trạng thái trong bảng khoan_thu_sinh_vien
        $sqlUpdate = "UPDATE khoan_thu_sinh_vien 
                      SET trang_thai_thanh_toan = N'$trangThai' 
                      WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sqlUpdate);
    }
    
}
?>
