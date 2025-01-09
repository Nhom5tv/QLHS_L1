<!-- truy van sql -->
<?php 
class svdktinchi_m extends connectDB{
    function tinchi_ins($ma_sinh_vien){
        $sql="SELECT 
    mh.ma_mon AS ma_mon_hoc, 
    mh.ten_mon AS ten_mon_hoc, 
    mh.so_tin_chi, 
    dk.ma_dang_ky, 
    dk.trang_thai AS trang_thai_dang_ky, 
    lh.so_luong_toi_da, 
    (lh.so_luong_toi_da - COUNT(dk2.ma_sinh_vien)) AS con_lai, 
    lh.lich_hoc AS lich_hoc_du_kien
FROM 
    mon_hoc AS mh
LEFT JOIN 
    dang_ky_mon_hoc AS dk
ON 
    mh.ma_mon = dk.ma_mon AND dk.ma_sinh_vien = '$ma_sinh_vien'
LEFT JOIN 
    lich_hoc AS lh
ON 
    mh.ma_mon = lh.ma_mon_hoc
LEFT JOIN 
    dang_ky_mon_hoc AS dk2
ON 
    mh.ma_mon = dk2.ma_mon
    WHERE lh.trang_thai = N'Đang Mở'
GROUP BY 
    mh.ma_mon, 
    mh.ten_mon, 
    mh.so_tin_chi, 
    dk.ma_dang_ky, 
    dk.trang_thai, 
    lh.so_luong_toi_da, 
    lh.lich_hoc;

 ";
         return mysqli_query($this->con,$sql);
        
    }
    function dk_ins($ma_mon,$ma_sinh_vien,$lich_hoc_du_kien){
        $sql="INSERT INTO dang_ky_mon_hoc(ma_mon,ma_sinh_vien,ma_lop,lich_hoc_du_kien,trang_thai) VALUES ('$ma_mon','$ma_sinh_vien',NULL,'$lich_hoc_du_kien',N'Đang Chờ Duyệt')";
         return mysqli_query($this->con,$sql);
        
    }
    function capNhatSoLuong($maMonHoc) {
        // Tạo biến @so_luong_da_dang_ky để lưu số lượng sinh viên đã đăng ký
        $sqlSetVariable = "
            SET @so_luong_da_dang_ky = (
                SELECT COUNT(*) 
                FROM dang_ky_mon_hoc 
                WHERE ma_mon = '$maMonHoc' AND trang_thai = 'Đang Chờ Duyệt'
            );
        ";
    
        // Câu lệnh UPDATE để cập nhật số lượng trong bảng lich_hoc
        $sqlUpdate = "
            UPDATE lich_hoc 
            SET so_luong = so_luong_toi_da - @so_luong_da_dang_ky
            WHERE ma_mon_hoc = '$maMonHoc';
        ";
    
        // Thực thi cả hai câu lệnh SQL
        $resultSetVariable = mysqli_query($this->con, $sqlSetVariable);
        $resultUpdate = mysqli_query($this->con, $sqlUpdate);
    
        // Kiểm tra nếu cả hai câu lệnh đều thực thi thành công
        return $resultSetVariable && $resultUpdate;
    }
    
    
    function ddk_ins($ma_sinh_vien){
        $sql="SELECT 
    dk.ma_dang_ky,
    mh.ma_mon AS ma_mon_hoc,
    mh.ten_mon AS ten_mon_hoc,
    mh.so_tin_chi,
    lh.so_luong_toi_da,
    lh.so_luong_toi_da - (
        SELECT COUNT(*) 
        FROM dang_ky_mon_hoc dk2 
        WHERE dk2.ma_mon = mh.ma_mon AND dk2.trang_thai = N'Đang Chờ Duyệt'
    ) AS con_lai,
    dk.lich_hoc_du_kien
FROM 
    mon_hoc mh
JOIN 
    lich_hoc lh ON mh.ma_mon = lh.ma_mon_hoc
LEFT JOIN 
    dang_ky_mon_hoc dk ON mh.ma_mon = dk.ma_mon
WHERE 
    dk.ma_sinh_vien = '$ma_sinh_vien' AND dk.trang_thai = N'Đang Chờ Duyệt' and lh.trang_thai = N'Đang Mở'
GROUP BY 
    mh.ma_mon, mh.ten_mon, mh.so_tin_chi, lh.so_luong_toi_da, dk.lich_hoc_du_kien, dk.ma_dang_ky;
";
    return mysqli_query($this->con,$sql);
    }
    // function checktrungmamon($manhanvien){
    //     $sql="SELECT * FROM qlnhanvien WHERE Manhanvien='$manhanvien'";
    //     $dl=mysqli_query($this->con,$sql);
    //     $kq=false;
    //     if(mysqli_num_rows($dl)>0){
    //         $kq=true;
    //     }
    //     return $kq;
    // }
    function tinchi_find($ten_mon_hoc,$lich_hoc_du_kien){
        // trường hợp loaddata
       
        // trường hợp tìm kiếm
        
        $sql = "SELECT 
    mh.ma_mon AS ma_mon_hoc,
    mh.ten_mon AS ten_mon_hoc,
    mh.so_tin_chi,
    lh.so_luong_toi_da,
    lh.so_luong_toi_da - COUNT(dk.ma_sinh_vien) AS con_lai,
    dk.lich_hoc_du_kien
FROM 
    mon_hoc mh
JOIN 
    lich_hoc lh ON mh.ma_mon = lh.ma_mon_hoc
LEFT JOIN 
    dang_ky_mon_hoc dk ON mh.ma_mon = dk.ma_mon
     WHERE mh.ten_mon LIKE '%$ten_mon_hoc%' 
            AND dk.lich_hoc_du_kien LIKE '%$lich_hoc_du_kien%'
GROUP BY 
    mh.ma_mon, mh.ten_mon, mh.so_tin_chi, lh.so_luong_toi_da, dk.lich_hoc_du_kien";
       
       
        return mysqli_query($this->con,$sql);
    }
    
    function ddk_del($ma_dang_ky){
        $sql="DELETE FROM dang_ky_mon_hoc WHERE ma_dang_ky ='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    function monhoc_upd($ma_dang_ky,$ma_mon,$ma_sinh_vien,$ma_lop,$lich_hoc_du_kien,$trang_thai){
        $sql="UPDATE dang_ky_mon_hoc SET ma_mon= '$ma_mon' , ma_sinh_vien= '$ma_sinh_vien' , ma_lop= '$ma_lop' , lich_hoc_du_kien= '$lich_hoc_du_kien' , trang_thai= N'$trang_thai'  
        WHERE ma_dang_ky='$ma_dang_ky'";
        return mysqli_query($this->con,$sql);
    }
    
}
?>