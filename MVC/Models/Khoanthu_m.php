<?php 
class Khoanthu_m extends connectDB{
    // Hàm thêm mới khoản thu
    function khoanthu_ins($tenKhoanThu, $loaiKhoanThu, $soTien, $ngayTao, $hanNop){
        $sql = "INSERT INTO khoan_thu (ten_khoan_thu, loai_khoan_thu, so_tien, ngay_tao, han_nop) 
                VALUES (N'$tenKhoanThu', N'$loaiKhoanThu', '$soTien', '$ngayTao', '$hanNop')";
        return mysqli_query($this->con, $sql);
    }

    // Hàm kiểm tra trùng tên khoản thu (nếu cần)
    function checktrungkhoanthu($tenKhoanThu){
        $sql = "SELECT * FROM khoan_thu WHERE ten_khoan_thu = N'$tenKhoanThu'";
        $dl = mysqli_query($this->con, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;
        }
        return $kq;
    }
   

    // Hàm tìm kiếm theo tên và hạn nộp
    function khoanthu_find($tenKhoanThu, $hanNop ){
        // Trường hợp tìm tất cả
        if (empty($tenKhoanThu) && empty($hanNop)) {
            $sql = "SELECT * FROM khoan_thu";
        }
        // Trường hợp tìm theo tên khoản thu
        elseif (empty($hanNop)) {
            $sql = "SELECT * FROM khoan_thu WHERE ten_khoan_thu LIKE N'%$tenKhoanThu%'";
        }
        // Trường hợp tìm theo hạn nộp
        elseif (empty($tenKhoanThu)) {
            $sql = "SELECT * FROM khoan_thu WHERE han_nop LIKE '%$hanNop%'";
        }
        // Trường hợp tìm theo cả tên và hạn nộp
        else {
            $sql = "SELECT * FROM khoan_thu WHERE ten_khoan_thu LIKE N'%$tenKhoanThu%' AND han_nop LIKE '%$hanNop%'";
        }

        return mysqli_query($this->con, $sql);
    }

    // Hàm xóa khoản thu
    function khoanthu_del($id) {
        // Xóa bản ghi liên quan trong khoan_thu_sinh_vien
        $sqlDeleteKhoanThuSV = "DELETE FROM khoan_thu_sinh_vien WHERE ma_khoan_thu = '$id'";
        $resultKhoanThuSV = mysqli_query($this->con, $sqlDeleteKhoanThuSV);
    
        // Nếu xóa trong khoan_thu_sinh_vien thành công, tiếp tục xóa trong khoan_thu
        if ($resultKhoanThuSV) {
            $sqlDeleteKhoanThu = "DELETE FROM khoan_thu WHERE ma_khoan_thu = '$id'";
            $resultKhoanThu = mysqli_query($this->con, $sqlDeleteKhoanThu);
    
            // Trả về kết quả của việc xóa trong khoan_thu
            return $resultKhoanThu;
        }
    
        // Nếu xóa trong khoan_thu_sinh_vien thất bại, trả về false
        return false;
    }
    
    function sua_id($maKhoanThu){
        $sql = "SELECT * FROM khoan_thu WHERE ma_khoan_thu='$maKhoanThu' ";
        return mysqli_query($this->con, $sql);
    }
    // Hàm cập nhật thông tin khoản thu
    function khoanthu_upd($id, $tenKhoanThu, $loaiKhoanThu, $soTien, $ngayTao, $hanNop) {
        // Cập nhật bảng khoan_thu
        $sql = "UPDATE khoan_thu 
                SET ten_khoan_thu = N'$tenKhoanThu', 
                    loai_khoan_thu = N'$loaiKhoanThu', 
                    so_tien = '$soTien', 
                    ngay_tao = '$ngayTao', 
                    han_nop = '$hanNop' 
                WHERE ma_khoan_thu = '$id'";
        $resultKhoanThu = mysqli_query($this->con, $sql);
    
        if ($resultKhoanThu) {
            // Đồng bộ bảng khoan_thu_sinh_vien
            $sqlUpdateKhoanThuSV = "UPDATE khoan_thu_sinh_vien 
                                    SET so_tien_ban_dau = '$soTien', so_tien_phai_nop= '$soTien' 
                                    WHERE ma_khoan_thu = '$id'";
            $resultKhoanThuSV = mysqli_query($this->con, $sqlUpdateKhoanThuSV);
    
            // Kiểm tra kết quả đồng bộ
            if ($resultKhoanThuSV) {
                return true; // Thành công cả hai
            } else {
                return false; // Lỗi khi đồng bộ bảng khoan_thu_sinh_vien
            }
        }
    
        return false; // Lỗi khi cập nhật bảng khoan_thu
    }
    function khoanthu_capnhathannop($id,$hanNop)
    {
        $sql = "UPDATE khoan_thu SET han_nop = '$hanNop' WHERE ma_khoan_thu = '$id'";
        return mysqli_query($this->con, $sql);
    }
    
    // Hàm thêm khoản thu sinh viên tự động
    function khoanthu_sinhvien_ins($maKhoanThu, $soTienBanDau) {
        // Lấy danh sách tất cả sinh viên
        $sqlSinhVien = "SELECT ma_sinh_vien FROM sinh_vien";
        $resultSinhVien = mysqli_query($this->con, $sqlSinhVien);
    
        if (mysqli_num_rows($resultSinhVien) > 0) {
            while ($row = mysqli_fetch_assoc($resultSinhVien)) {
                $maSinhVien = $row['ma_sinh_vien'];
    
                // Mặc định giá trị khi thêm khoản thu sinh viên
                $soTienMienGiam = 0; // Miễn giảm ban đầu = 0
                $soTienPhaiNop = $soTienBanDau; // Số tiền phải nộp = Số tiền ban đầu
    
                // Thêm khoản thu cho sinh viên
                $sqlInsert = "INSERT INTO khoan_thu_sinh_vien (ma_khoan_thu, ma_sinh_vien, so_tien_ban_dau, so_tien_mien_giam, so_tien_phai_nop, trang_thai_thanh_toan)
                              VALUES ('$maKhoanThu', '$maSinhVien', '$soTienBanDau', '$soTienMienGiam', '$soTienPhaiNop', 'Chưa thanh toán')";
                mysqli_query($this->con, $sqlInsert);
            }
            return true;
        } else {
            return false; // Không có sinh viên nào trong hệ thống
        }
    }
    function capNhatHocPhiChoSinhVien($maKhoanThu) {
        // Tính học phí cho từng sinh viên dựa trên tổng tín chỉ
        $sqlTinhHocPhi = "
            SELECT 
                sv.ma_sinh_vien, 
                SUM(mh.so_tin_chi) AS tong_tin_chi, 
                (SUM(mh.so_tin_chi) * k.tien_moi_tin_chi) AS tong_hoc_phi
            FROM dang_ky_mon_hoc AS dkmh
            JOIN lop AS lh ON dkmh.ma_lop = lh.ma_lop
            JOIN mon_hoc AS mh ON dkmh.ma_mon = mh.ma_mon
            JOIN sinh_vien AS sv ON dkmh.ma_sinh_vien = sv.ma_sinh_vien
            JOIN khoa AS k ON sv.ma_khoa = k.ma_khoa
            WHERE dkmh.trang_thai = N'Đã duyệt' AND lh.trang_thai = N'Đang mở'
            GROUP BY sv.ma_sinh_vien;
        ";
    
        $resultHocPhi = mysqli_query($this->con, $sqlTinhHocPhi);
    
        if ($resultHocPhi) {
            // Duyệt qua danh sách sinh viên để lưu học phí vào bảng khoan_thu_sinh_vien
            while ($row = mysqli_fetch_assoc($resultHocPhi)) {
                $maSinhVien = $row['ma_sinh_vien'];
                $tongHocPhi = $row['tong_hoc_phi'];
    
                // Lưu vào bảng khoan_thu_sinh_vien
                $sqlInsertKhoanThuSV = "
                    INSERT INTO khoan_thu_sinh_vien (ma_khoan_thu, ma_sinh_vien, so_tien_ban_dau, so_tien_mien_giam, so_tien_phai_nop, trang_thai_thanh_toan)
                    VALUES ('$maKhoanThu', '$maSinhVien', '$tongHocPhi', 0, '$tongHocPhi', 'Chưa thanh toán')
                    ON DUPLICATE KEY UPDATE 
                    so_tien_ban_dau = '$tongHocPhi', 
                    so_tien_phai_nop = '$tongHocPhi',
                    trang_thai_thanh_toan = 'Chưa thanh toán';
                ";
    
                mysqli_query($this->con, $sqlInsertKhoanThuSV);
            }
            return true;
        }
        return false;
    }
    
    

}
?>
