<?php include_once './MVC/Core/connectDB.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê doanh thu và nhập hàng</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
<?php
// Kết nối cơ sở dữ liệu
$con = mysqli_connect('localhost', 'root', '', 'qlbanhang');

// Khởi tạo biến dữ liệu ban đầu
$data = [];
$xaxis = [];
$dataNhapHang = [];
$xaxisNhapHang = [];
$initialDataNhapHang = [];
$initialXaxisNhapHang = [];

// Truy vấn dữ liệu doanh thu ban đầu
$sql = "SELECT Ngaydathang, SUM(amount_paid) AS TongTienTrongNgay
    FROM orders
    WHERE Trangthaidonhang = 'Thành công'
    GROUP BY Ngaydathang";
$res = mysqli_query($con, $sql);

if ($res) {
    while ($row = mysqli_fetch_array($res)) {
        $data[] = $row['TongTienTrongNgay'];
        $xaxis[] = $row['Ngaydathang'];
    }
}

// Truy vấn dữ liệu nhập hàng ban đầu
$sqlNhapHang = "SELECT Thoigiannhap, SUM(TongTien) AS TongTienNhapTrongNgay
    FROM qlynhaphang
    GROUP BY Thoigiannhap";
$resNhapHang = mysqli_query($con, $sqlNhapHang);

if ($resNhapHang) {
    while ($rowNhapHang = mysqli_fetch_array($resNhapHang)) {
        $dataNhapHang[] = $rowNhapHang['TongTienNhapTrongNgay'];
        $xaxisNhapHang[] = $rowNhapHang['Thoigiannhap'];
    }

    // Lưu trữ dữ liệu nhập hàng ban đầu
    $initialDataNhapHang = $dataNhapHang;
    $initialXaxisNhapHang = $xaxisNhapHang;
}

// Kiểm tra và xử lý form khi được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['formType']) && $_POST['formType'] == 'doanhthu') {
        $startDateDT = $_POST['startDateDT'];
        $endDateDT = $_POST['endDateDT'];

        // Truy vấn dữ liệu doanh thu theo khoảng thời gian
        $sql = "SELECT Ngaydathang, SUM(amount_paid) AS TongTienTrongNgay
            FROM orders
            WHERE Trangthaidonhang = 'Thành công' AND Ngaydathang BETWEEN '$startDateDT' AND '$endDateDT'
            GROUP BY Ngaydathang";
        $res = mysqli_query($con, $sql);

        if ($res) {
            $data = [];
            $xaxis = [];
            while ($row = mysqli_fetch_array($res)) {
                $data[] = $row['TongTienTrongNgay'];
                $xaxis[] = $row['Ngaydathang'];
            }
        }

        // Nếu không có dữ liệu mới từ form, sử dụng dữ liệu ban đầu
        if (empty($data)) {
            $data = $initialDataDoanhThu;
            $xaxis = $initialXaxisDoanhThu;
        }
    }

    if (isset($_POST['formType']) && $_POST['formType'] == 'nhaphang') {
        $startDateNH = $_POST['startDateNH'];
        $endDateNH = $_POST['endDateNH'];

        // Truy vấn dữ liệu nhập hàng theo khoảng thời gian
        $sqlNhapHang = "SELECT Thoigiannhap, SUM(TongTien) AS TongTienNhapTrongNgay
            FROM qlynhaphang
            WHERE Thoigiannhap BETWEEN '$startDateNH' AND '$endDateNH'
            GROUP BY Thoigiannhap";
        $resNhapHang = mysqli_query($con, $sqlNhapHang);

        if ($resNhapHang) {
            $dataNhapHang = [];
            $xaxisNhapHang = [];
            while ($rowNhapHang = mysqli_fetch_array($resNhapHang)) {
                $dataNhapHang[] = $rowNhapHang['TongTienNhapTrongNgay'];
                $xaxisNhapHang[] = $rowNhapHang['Thoigiannhap'];
            }
        }

        // Nếu không có dữ liệu mới từ form, sử dụng dữ liệu ban đầu
        if (empty($dataNhapHang)) {
            $dataNhapHang = $initialDataNhapHang;
            $xaxisNhapHang = $initialXaxisNhapHang;
        }
    }
}
?>
    <div class="shell" style="display:flex; margin-top:100px;">
    <div class="bgDoanhthu" style="width:600px; background: white; margin-right:50px;">
        <div><h3>Thống kê doanh thu</h3></div>
        <form method="post" action="">
            <input type="hidden" name="formType" value="doanhthu">
            <label for="startDateDT">Từ ngày:</label>
            <input type="date" id="startDateDT" name="startDateDT"  required>
            
            <label for="endDateDT">Đến ngày:</label>
            <input type="date" id="endDateDT" name="endDateDT"  required>
            <button type="submit">Tìm kiếm</button>
        </form>
        <div class="Doanhthu">
            <div style="width: 600px; " id="chart"></div>
            <script>
                let options = {
                    chart: {
                        type: 'line'
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 6,
                    },
                    series: [{
                        name: 'Tổng tiền',
                        data: <?php echo json_encode($data); ?> // Chuyển mảng data thành JSON
                    }],
                    xaxis: {
                        categories: <?php echo json_encode($xaxis); ?> // Chuyển mảng xaxis thành JSON
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>
        </div>
    </div>

    <div class="bgNhaphang" style="width:600px; background: white;">
        <div><h3>Thống kê nhập hàng</h3></div>
        <form method="post" action="">
            <input type="hidden" name="formType" value="nhaphang">
            <label for="startDateNH">Từ ngày:</label>
            <input type="date" id="startDateNH" name="startDateNH" required>
            <label for="endDateNH">Đến ngày:</label>
            <input type="date" id="endDateNH" name="endDateNH" required>
            <button type="submit">Tìm kiếm</button>
        </form>
        <div class="NhapHang">
            <div style="width: 600px; " id="chartNhapHang"></div>
            <script>
                let optionsNhapHang = {
                    chart: {
                        type: 'line'
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 6,
                    },
                    series: [{
                        name: 'Tổng tiền nhập hàng',
                        data: <?php echo json_encode($dataNhapHang); ?> // Chuyển mảng dataNhapHang thành JSON
                    }],
                    xaxis: {
                        categories: <?php echo json_encode($xaxisNhapHang); ?> // Chuyển mảng xaxisNhapHang thành JSON
                    }
                };

                var chartNhapHang = new ApexCharts(document.querySelector("#chartNhapHang"), optionsNhapHang);
                chartNhapHang.render();
            </script>
        </div>
    </div>
    </div>
</body>
</html>
