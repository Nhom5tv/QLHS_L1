<?php 
class Hoadon_m extends connectDB {
     // hàm lấy tên khoản thu
     function getKhoanThuList() {
        $sql = "SELECT ma_khoan_thu, ten_khoan_thu FROM khoan_thu";
        return mysqli_query($this->con, $sql);
    }

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

    // // Hàm tìm kiếm hóa đơn theo mã sinh viên hoặc loại khoản thu
    // function hoadon_find($maSinhVien, $ngayThanhToan) {
    //     // Trường hợp tìm tất cả
    //     if (empty($maSinhVien) && empty($ngayThanhToan)) {
    //         $sql = "SELECT * FROM hoa_don";
    //     }
    //     // Trường hợp tìm theo mã sinh viên
    //     elseif (empty($ngayThanhToan)) {
    //         $sql = "SELECT * FROM hoa_don WHERE ma_sinh_vien LIKE '$maSinhVien%'";
    //     }
    //     // Trường hợp tìm theo ngày thanh toán
    //     elseif (empty($maSinhVien)) {
    //         $sql = "SELECT * FROM hoa_don WHERE ngay_thanh_toan LIKE '$ngayThanhToan%'";
    //     }
    //     // Trường hợp tìm theo cả mã sinh viên và ngày thanh toán
    //     else {
    //         $sql = "SELECT * FROM hoa_don WHERE ma_sinh_vien LIKE '$maSinhVien%' AND ngay_thanh_toan LIKE '$ngayThanhToan%'";
    //     }
    
    //     return mysqli_query($this->con, $sql);
    // }
    // function getHoaDonWithTenKhoanThu() {
    //     $sql = "SELECT 
    //                 hd.ma_hoa_don,
    //                 hd.ma_sinh_vien,
    //                 hd.ma_khoan_thu,
    //                 kt.ten_khoan_thu,
    //                 hd.so_tien_da_nop,
    //                 hd.ngay_thanh_toan,
    //                 hd.hinh_thuc_thanh_toan,
    //                 hd.noi_dung
    //             FROM hoa_don AS hd
    //             JOIN khoan_thu AS kt ON hd.ma_khoan_thu = kt.ma_khoan_thu";
    //     return mysqli_query($this->con, $sql); // Trả về kết quả truy vấn
    // }
    function searchHoaDon($maSinhVien = null, $ngayThanhToan = null) {
        // Bắt đầu câu truy vấn cơ bản
        $sql = "SELECT 
                    hd.ma_hoa_don,
                    hd.ma_sinh_vien,
                    hd.ma_khoan_thu,
                    kt.ten_khoan_thu,
                    hd.so_tien_da_nop,
                    hd.ngay_thanh_toan,
                    hd.hinh_thuc_thanh_toan,
                    hd.noi_dung
                FROM hoa_don AS hd
                JOIN khoan_thu AS kt ON hd.ma_khoan_thu = kt.ma_khoan_thu";
    
        // Thêm điều kiện WHERE nếu cần thiết
        $conditions = [];
        if (!empty($maSinhVien)) {
            $conditions[] = "hd.ma_sinh_vien LIKE '$maSinhVien%'";
        }
        if (!empty($ngayThanhToan)) {
            $conditions[] = "hd.ngay_thanh_toan LIKE '$ngayThanhToan%'";
        }
    
        // Gắn các điều kiện vào câu truy vấn
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        // Thực hiện truy vấn
        return mysqli_query($this->con, $sql);
    }
    
    
    

    // Hàm lấy thông tin hóa đơn theo ID
    function idhoadon($id) {
        $sql = "SELECT * FROM hoa_don WHERE ma_hoa_don = '$id'";
        return mysqli_query($this->con, $sql);
    }
    function getHoaDonById($maHoaDon) {
        $sql = "SELECT * FROM hoa_don WHERE ma_hoa_don = '$maHoaDon'";
        $result = mysqli_query($this->con, $sql);
    
        // Chuyển đổi kết quả truy vấn thành mảng
        return mysqli_fetch_assoc($result); // Trả về dòng kết quả đầu tiên dưới dạng mảng liên kết
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
        if ($tongTienDaDong == 0) {
            $trangThai = 'Chưa thanh toán';
        } elseif ($tongTienDaDong >= $soTienPhaiNop) {
            $trangThai = 'Đã thanh toán';
        } else {
            $trangThai = 'Thanh toán 1 phần';
        }
    
        // Cập nhật trạng thái trong bảng khoan_thu_sinh_vien
        $sqlUpdate = "UPDATE khoan_thu_sinh_vien 
                      SET trang_thai_thanh_toan = N'$trangThai' 
                      WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
        return mysqli_query($this->con, $sqlUpdate);
    }
    
   
    
    
}
?>
