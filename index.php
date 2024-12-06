<?php
session_start();

include 'db.php';
include './class/SuratMasuk.php';
include './class/SuratKeluar.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$nama = $_SESSION['nama'];
$selectedDate = isset($_GET['selectedDate']) ? $_GET['selectedDate'] : date('Y-m');

// Membuat objek SuratMasuk dan SuratKeluar
$suratMasuk = new SuratMasuk($conn, $selectedDate);
$suratKeluar = new SuratKeluar($conn, $selectedDate);

// Ambil data harian untuk surat masuk
$data_surat_masuk = $suratMasuk->getDataHarian();

// Ambil data harian untuk surat keluar
$data_surat_keluar = $suratKeluar->getDataHarian();

// Ambil total surat masuk bulan ini
$total_surat_masuk = $suratMasuk->getTotalSuratMasuk();

// Ambil total surat keluar bulan ini
$total_surat_keluar = $suratKeluar->getTotalSuratKeluar();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Letter Jamkrindo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style/indeex.css">
    <style>
        .content-container {
            position: relative;
            justify-content: space-between;
            padding: 2.5rem;
            margin-left: 16.875rem;
            margin-top: 3.75rem;
        }

        .form-box {
            font-family: 'Nunito';
            height: 5rem;
        }

        .form-box-2 {
            width: 13.125rem;
            padding: 1.25rem;
            position: absolute;
            border-radius: 0.5rem;
            background-color: #ffffff;
            top: 0rem;
            left: 3.75rem;
            height: 5rem;
            margin-top: 5.625rem;
            box-shadow: 0.125rem 0 0.3125rem rgba(0, 0, 0, 0.1);
            margin-left: 0rem;
        }

        .form-box-3 {
            width: 13.125rem;
            padding: 1.25rem;
            position: absolute;
            border-radius: 0.5rem;
            background-color: #ffffff;
            top: 0rem;
            left: 6.25rem;
            height: 5rem;
            margin-top: 5.625rem;
            box-shadow: 0.125rem 0 0.3125rem rgba(0, 0, 0, 0.1);
            margin-left: 11.25rem;
        }

        .form-group {
            margin-bottom: 0.9375rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.3125rem;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select,
        .form-group input[type="date"],
        .form-group input[type="radio"],
        .form-group input[type="checkbox"] {
            width: 100%;
            padding: 0.5rem;
            box-sizing: border-box;
            border: 0.0625rem solid #ccc;
            border-radius: 0.25rem;
        }

        .form-group input[type="radio"],
        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 0.625rem;
        }

        .form-group div {
            display: flex;
            align-items: center;
        }

        .form-group div label {
            margin-right: 0.9375rem;
        }

        .form-group div input[type="radio"],
        .form-group div input[type="checkbox"] {
            margin-right: 0.3125rem;
        }


        .form-actions {
            position: fixed;
            bottom: 1.25rem;
            right: 1.25rem;
            z-index: 1000;
            display: flex;
        }

        .form-actions button {
            padding: 0.625rem 1.25rem;
            margin-left: 0.625rem;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 0.3125rem;
        }

        .form-actions button.reset {
            background-color: #f44336;
        }

        .form-actions button:hover {
            opacity: 0.8;
        }

        .form-actions input {
            padding: 0.625rem 1.25rem;
            margin-left: 0.625rem;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 0.3125rem;
        }

        .form-actions input.reset {
            background-color: #f44336;
        }

        .form-actions input:hover {
            opacity: 0.8;
        }

        .form-group h2 {
            font-size: 1.0625rem;
            justify-content: center;
        }

        .form-group p {
            font-weight: 1000;
            font-size: 1.25rem;
            color: #012970;
        }


        .logout-btn {
            display: inline-block;
            position: absolute;
            margin-top: 0.4375rem; /* 7px */
            margin-left: 6.25rem; /* 100px */
            width: 0.625rem; /* 10px */
            cursor: pointer;
        }

        .logout-btn:hover {
            opacity: 0.8;
        }

        .small-image {
            width: 2.5rem; /* 40px */
            height: 2.5rem; /* 40px */
            position: absolute;
            left: 0.625rem; /* 10px */
            top: 0.125rem; /* 2px */
        }

        .small-image2 {
            width: 2.5rem; /* 40px */
            height: 2.5rem; /* 40px */
            position: absolute;
            left: 3.1875rem; /* 51px */
            top: 0rem;
        }

        .credit { /* TIDAK BOLEH DIHAPUS */
            position: fixed;
            bottom: 0.625rem; /* 10px */
            left: 0.625rem; /* 10px */
            margin: 0;
            font-size: 0.625rem; /* 10px */
            color: #012970;
            opacity: 0.5;
            font-family: Nunito, var(--default-font-family);
        }

        .credit h3 {
            margin: 0;
            padding: 0;
        }





    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-section">
        <div class="content">
            <a href="index.php" class="link">
                <span class="tre-jamin">TRE-JAMIN</span>
            </a>
            <img src="assets/images/2-LOGO-JAMKRINDO.png" class="small-image" alt="Small Image">
            <img src="assets/images/images-removebg-preview.png" class="small-image2" alt="Small Image">
        </div>

            <div class="form-section"><div class="unknown"></div></div>
            <div class="list">
            <a href="login.php" class="logout-btn" id="logoutButton">
                    <img src="assets/images/icons8-logout-16.png" alt="Logout Icon" title="Logout">
            </a>
                <div class="link-1">
                    <div class="profile-image"></div>
                    <div class="text">
                        <span class="name"><?php echo htmlspecialchars($nama); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-row">
            <div class="sidebar-section">
                <div class="sidebar-nav">
                    <span class="track">Track</span>
                    <div class="link-2">
                        <a href="surat_masuk.php">
                            <div class="file-spreadsheet">
                                <div class="group-3"></div>
                            </div>
                            <span class="surat-masuk">Surat Masuk</span>
                        </a>
                    </div>
                    <div class="link-4">
                        <a href="surat_keluar.php">
                            <div class="file-spreadsheet-5">
                                <div class="group-6"></div>
                            </div>
                            <span class="surat-keluar">Surat Keluar</span>
                        </a>
                    </div>
                </div>
                <span class="input">INPUT</span>
                <div class="link-7">
                    <a href="add_surat.php">
                        <span class="input-surat-masuk">Input Surat Masuk</span>
                    </a>
                    <div class="flex-column">
                        <div class="download-section">
                            <div class="icon"></div>
                        </div>
                    </div>
                </div>
                <div class="link-9">
                    <a href="add_surat_keluar.php">
                        <span class="input-surat-keluar">Input Surat Keluar</span>
                    </a>
                    <div class="flex-column-a">
                        <div class="download-section-b">
                            <div class="icon-c"></div>
                        </div>
                    </div>
                </div>
                <div class="credit">
                    <h3><span>&copy; 2024 - TEKNIK KOMPUTER UNDIP 2022</span></h3>
                </div>

                

            </div>
            <div class="content-container">
                <div class="text-container">
                    <h1>Dashboard</h1>
                </div>
                <div class="form-container">
                    <div class="form-box">
                            <div class="form-group">
                                <div class="form-box-2">
                                <h2>Jumlah Surat Masuk</h2>
                            <p id="suratMasuk"><?php echo ($total_surat_masuk); ?></p>
                        </div>
                        <div class="form-box-3">
                            <h2>Jumlah Surat Keluar</h2>
                            <p id="suratKeluar"><?php echo ($total_surat_keluar); ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="date-picker">
                    <input type="month" id="monthYearPicker" value="<?php echo htmlspecialchars($selectedDate); ?>">
                    <button id="updateChart">Update Chart</button>
                </div>
                <div class="section-diagram">
                <div class="diagram">
                    <canvas id="myChart"></canvas>
                </div>
                </div>
                
            </div>
        </div>
     </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [], // Placeholder for daily labels
                datasets: [
                    {
                        label: 'Jumlah Surat Masuk',
                        data: [], // Placeholder for daily data
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    },
                    {
                        label: 'Jumlah Surat Keluar',
                        data: [], // Placeholder for daily data
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Tanggal',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Surat',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        function generateDays(month, year) {
        const days = new Date(year, month, 0).getDate();
        return Array.from({ length: days }, (_, i) => i + 1);
    }

        document.getElementById('updateChart').addEventListener('click', function() {
            const selectedDate = document.getElementById('monthYearPicker').value;
            if (selectedDate) {
                const [year, month] = selectedDate.split('-').map(Number);

                // Redirect to the same page with the selected date as a query parameter
                window.location.href = `?selectedDate=${selectedDate}`;
            }
        });

        // Convert PHP arrays to JavaScript
        const dataSuratMasuk = <?php echo json_encode($data_surat_masuk); ?>;
        const dataSuratKeluar = <?php echo json_encode($data_surat_keluar); ?>;

        function updateChartData(month, year) {
            const days = generateDays(month, year);
            const dataIn = days.map(day => dataSuratMasuk[day] || 0);
            const dataOut = days.map(day => dataSuratKeluar[day] || 0);

            // Update chart labels and data
            myChart.data.labels = days.map(day => day.toString());
            myChart.data.datasets[0].data = dataIn;
            myChart.data.datasets[1].data = dataOut;
            myChart.update();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectedDate = document.getElementById('monthYearPicker').value;
            if (selectedDate) {
                const [year, month] = selectedDate.split('-').map(Number);
                updateChartData(month, year);
            }
        });
        // document.getElementById('updateChart').addEventListener('click', function() {
        //     const selectedDate = document.getElementById('monthYearPicker').value;
        //     if (selectedDate) {
        //         const [year, month] = selectedDate.split('-').map(Number);
        //         updateChartData(month, year);
        //     }
        // });

        // // Initialize chart with default data for the initial month/year
        // document.getElementById('updateChart').click();

        // Fitur notifikasi logout
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            if (!confirm('Apakah Anda yakin ingin logout?')) {
                event.preventDefault(); // Hentikan tindakan default (yaitu, logout)
            }
        });
    </script>

</body>
</html>
