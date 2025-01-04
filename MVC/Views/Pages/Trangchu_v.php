<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <title>Quản lý hồ sơ sinh viên</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="http://localhost/qlhs/Public/Picture/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/qlhs/Public/CSS/layout.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
         .chart-container {
        display: flex;
        gap: 20px; /* Khoảng cách giữa các biểu đồ */
        justify-content: space-around; /* Canh đều các biểu đồ */
        background-color: transparent;
    }

    .chart-box {
        flex: 1; /* Chia đều không gian giữa các biểu đồ */
        text-align: center;
    }
</style>
</head>

<body>
    <div class="wrapper">
        
        <div class="main p-3" >
            <!-- Nội dung chính -->
            <div class="main-content p-4" >
                <h2 class="mb-4">Thống kê sinh viên và giảng viên</h2>
                <div class="chart-container d-flex justify-content-between" style="background-color: transparent;">
                    <!-- Biểu đồ loại học viên -->
                    <div class="chart-box">
                        <h3>Biểu đồ loại học viên</h3>
                        <canvas id="studentChart"></canvas>
                    </div>

                    <!-- Biểu đồ tổng số giảng viên -->
                    <div class="chart-box">
                        <h3>Tổng số giảng viên</h3>
                        <canvas id="teacherChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Dữ liệu từ backend
        const studentData = <?php echo json_encode($data['dulieuHocVien']); ?>;
        const studentLabels = studentData.map(item => item.PhanLoai);
        const studentCounts = studentData.map(item => item.SoLuong);

        // Biểu đồ loại học viên
        const ctx1 = document.getElementById('studentChart').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: studentLabels,
                datasets: [{
                    label: 'Số lượng học viên',
                    data: studentCounts,
                    backgroundColor: ['#4caf50', '#ff9800', '#f44336', '#9c27b0'],
                    borderWidth: 1
                }]
            }
        });

        // Biểu đồ tổng số giảng viên
        const teacherCount = <?php echo $data['tongGiangVien']; ?>;
        const ctx2 = document.getElementById('teacherChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Giảng viên'],
                datasets: [{
                    data: [teacherCount],
                    backgroundColor: ['#2196f3'],
                    borderWidth: 1
                }]
            }
        });

        // Sidebar toggle
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>
