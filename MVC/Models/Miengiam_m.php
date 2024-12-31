<?php 
class Miengiam_m extends connectDB {
    // Hàm thêm mới miễn giảm
    function miengiam_ins($maSinhVien, $mucTien, $loaiMienGiam,$ghiChu) {
        $sql = "INSERT INTO mien_giam_sinh_vien (ma_sinh_vien, muc_tien, loai_mien_giam,ghi_chu) 
                VALUES ('$maSinhVien', '$mucTien', N'$loaiMienGiam',N'$ghiChu')";
        return mysqli_query($this->con, $sql);
    }

   // Hàm kiểm tra trùng mã sinh viên và loại miễn giảm
function checktrungmiengiam($maSinhVien, $loaiMienGiam) {
    $sql = "SELECT * FROM mien_giam_sinh_vien WHERE ma_sinh_vien = '$maSinhVien' AND loai_mien_giam = N'$loaiMienGiam'";
    $dl = mysqli_query($this->con, $sql);
    $kq = false;
    if (mysqli_num_rows($dl) > 0) {
        $kq = true;  // Nếu có kết quả trả về, có nghĩa là đã trùng mã sinh viên và loại miễn giảm
    }
    return $kq;
}

   

    // Hàm tìm kiếm miễn giảm theo mã sinh viên hoặc loại miễn giảm
    function miengiam_find($maSinhVien, $loaiMienGiam) {
        // Trường hợp tìm tất cả
        if (empty($maSinhVien) && empty($loaiMienGiam)) {
            $sql = "SELECT * FROM mien_giam_sinh_vien";
        }
        // Trường hợp tìm theo mã sinh viên
        elseif (empty($loaiMienGiam)) {
            $sql = "SELECT * FROM mien_giam_sinh_vien WHERE ma_sinh_vien LIKE '$maSinhVien%'";
        }
        // Trường hợp tìm theo loại miễn giảm
        elseif (empty($maSinhVien)) {
            $sql = "SELECT * FROM mien_giam_sinh_vien WHERE loai_mien_giam LIKE N'%$loaiMienGiam%'";
        }
        // Trường hợp tìm theo cả mã sinh viên và loại miễn giảm
        else {
            $sql = "SELECT * FROM mien_giam_sinh_vien WHERE ma_sinh_vien LIKE '$maSinhVien%' AND loai_mien_giam LIKE N'%$loaiMienGiam%'";
        }

        return mysqli_query($this->con, $sql);
    }
    // hàm lấy id miễn giảm 
    function idmiengiam($id){
        $sql = "SELECT * FROM mien_giam_sinh_vien WHERE ma_mien_giam='$id'";
        return mysqli_query($this->con, $sql);
    }
    // hàm lấy tất cả các loại khoản thu
    function getAllLoaiKhoanThu() {
        $sql = "SELECT DISTINCT loai_khoan_thu FROM khoan_thu"; // Lấy danh sách các loại khoản thu duy nhất
        return mysqli_query($this->con, $sql);
           
    }
    

    // Hàm xóa miễn giảm
    function miengiam_del($id) {
        $sql = "DELETE FROM mien_giam_sinh_vien WHERE ma_mien_giam = '$id'";
        return mysqli_query($this->con, $sql);
    }

    // Hàm cập nhật thông tin miễn giảm
    function miengiam_upd($id, $maSinhVien, $mucTien, $loaiMienGiam,$ghiChu) {
        $sql = "UPDATE mien_giam_sinh_vien SET ma_sinh_vien = '$maSinhVien', muc_tien = '$mucTien', 
                loai_mien_giam = N'$loaiMienGiam',ghi_chu = N'$ghiChu'
                WHERE ma_mien_giam = '$id'";
        return mysqli_query($this->con, $sql);
    }
    function capnhatMienGiamKhiTaoKhoanThu($maKhoanThu) {
        // Tìm tất cả sinh viên có khoản thu mới tạo
        $sqlSinhVien = "SELECT ktsv.ma_sinh_vien, ktsv.so_tien_ban_dau, ktsv.trang_thai_thanh_toan, kt.loai_khoan_thu 
                        FROM khoan_thu_sinh_vien AS ktsv
                        JOIN khoan_thu AS kt ON ktsv.ma_khoan_thu = kt.ma_khoan_thu
                        WHERE ktsv.ma_khoan_thu = '$maKhoanThu'";
        $resultSinhVien = mysqli_query($this->con, $sqlSinhVien);
    
        while ($row = mysqli_fetch_assoc($resultSinhVien)) {
            $maSinhVien = $row['ma_sinh_vien'];
            $soTienBanDau = $row['so_tien_ban_dau'];
            $trangThaiThanhToan = $row['trang_thai_thanh_toan'];
            $loaiKhoanThu = $row['loai_khoan_thu'];
    
            // Bỏ qua nếu trạng thái là "Đã thanh toán"
            if ($trangThaiThanhToan === 'Đã thanh toán') {
                continue;
            }
    
            // Tìm trong bảng mien_giam
            $sqlMienGiam = "SELECT muc_tien FROM mien_giam_sinh_vien 
                            WHERE ma_sinh_vien = '$maSinhVien' AND loai_mien_giam = '$loaiKhoanThu'";
            $resultMienGiam = mysqli_query($this->con, $sqlMienGiam);
            $mienGiam = mysqli_fetch_assoc($resultMienGiam);
    
            if ($mienGiam) {
                $giaTriMienGiam = $mienGiam['muc_tien'];
    
                // Tính số tiền miễn giảm
                $soTienMienGiam = $soTienBanDau * $giaTriMienGiam / 100;
    
                // Tính số tiền phải nộp
                $soTienPhaiNop = max(0, $soTienBanDau - $soTienMienGiam);
    
                // Cập nhật vào bảng khoan_thu_sinh_vien
                $sqlUpdate = "UPDATE khoan_thu_sinh_vien 
                              SET so_tien_mien_giam = '$soTienMienGiam', 
                                  so_tien_phai_nop = '$soTienPhaiNop' 
                              WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
                mysqli_query($this->con, $sqlUpdate);
                if ($soTienPhaiNop == 0) {
                    $sqlUpdateTrangThai = "UPDATE khoan_thu_sinh_vien 
                                           SET trang_thai_thanh_toan = N'Đã thanh toán' 
                                           WHERE ma_khoan_thu = '$maKhoanThu' AND ma_sinh_vien = '$maSinhVien'";
                    mysqli_query($this->con, $sqlUpdateTrangThai);
                }
            }
        }
    
        return true;
    }
    
}
?>
