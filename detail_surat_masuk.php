<?php
include 'db.php'; // Ensure the correct path

// Get no_disposisi from query string
$no_disposisi = isset($_GET['no_disposisi']) ? intval($_GET['no_disposisi']) : 0;

if ($no_disposisi <= 0) {
    echo "No Disposisi tidak valid.";
    exit;
}

// Query to get surat details based on no_disposisi
$sql = "SELECT * FROM surat_masuk WHERE no_disposisi = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Query error: " . $conn->error;
    exit;
}


$stmt->bind_param('i', $no_disposisi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}

$file_extension = pathinfo($row['file_name'],PATHINFO_EXTENSION);


// Query to get status details based on no_disposisi
$status_sql = "SELECT status, tanggal FROM status_riwayat WHERE no_disposisi = ? ORDER BY tanggal";
$status_stmt = $conn->prepare($status_sql);

if (!$status_stmt) {
    echo "Query error: " . $conn->error;
    exit;
}

$status_stmt->bind_param('i', $no_disposisi);
$status_stmt->execute();
$status_result = $status_stmt->get_result();

// Query to get lembar pengendalian
$disposisi_sql = "SELECT * FROM disposisi WHERE no_disposisi = ?";
$disposisi_stmt = $conn->prepare($disposisi_sql);

if (!$disposisi_stmt) {
    echo "Query error: " . $conn->error;
    exit;
}

$disposisi_stmt->bind_param('i', $no_disposisi);
$disposisi_stmt->execute();
$disposisi_result = $disposisi_stmt->get_result();

if ($disposisi_result->num_rows > 0) {
    $row_disposisi = $disposisi_result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}



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
    <link rel="stylesheet" href="style/style_detail_sumas.css">
    <style>
        .content-container {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 1.875rem; /* 30px */
            background: #f6f9ff;
            z-index: 178;
            transform: translateX(18.75rem); /* 300px */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 2.1875rem; /* 35px */
        }

        .horizontally {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1.25rem; /* 20px */
            flex-wrap: wrap;
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
                <div class="form-section">
                    <div class="unknown"></div>
                </div>
                <div class="list">
                    <div class="group">
                    </div>
                    <div class="link-1">
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
                <h1>Surat Masuk</h1>
                <h2>Detail Surat Masuk</h2>
                <div class="horizontally"> 
                    <div class="tablee">
                        <table>
                            <tr>
                                <th>No Disposisi</th>
                                <td><?php echo htmlspecialchars($row['no_disposisi']); ?></td>
                            </tr>
                            <tr>
                                <th>No Surat</th>
                                <td><?php echo htmlspecialchars($row['no_surat']); ?></td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td><?php echo htmlspecialchars($row['jenis']); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <td><?php echo htmlspecialchars($row['tanggal_masuk']); ?></td>
                            </tr>
                            <tr>
                                <th>Perihal</th>
                                <td><?php echo htmlspecialchars($row['perihal']); ?></td>
                            </tr>
                            <tr>
                                <th>Asal</th>
                                <td><?php echo htmlspecialchars($row['asal']); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat</th>
                                <td><?php echo htmlspecialchars($row['tanggal_surat']); ?></td>
                            </tr>
                            <tr>
                                <th>Tujuan</th>
                                <td><?php echo htmlspecialchars($row['tujuan']); ?></td>
                            </tr>
                            <tr>
                                <th>Scan Surat</th>
                                <td>
                                    <a href="./surat_masuk/<?php echo htmlspecialchars($no_disposisi); ?>.<?php echo htmlspecialchars($file_extension); ?>" download>Unduh File Surat</a>
                                </td>                        
                            </tr>  
                        </table>
                    </div>
                    <div class="lembar">
                <h1>Info Lembar Pengendalian Surat</h1>
                    <table>
                        <tr>
                            <th>Disposisi</th>
                            <td><?php echo htmlspecialchars($row_disposisi['disposisi']); ?></td>
                        </tr>
                        <tr>
                            <th>Audit Trail</th>
                            <td><?php echo htmlspecialchars($row_disposisi['audit_trail']); ?></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td><?php echo htmlspecialchars($row_disposisi['catatan']); ?></td>
                        </tr>
                    </table>
                </div>
                    
                </div>
                <div class="lembar-container">
                <div class="status-container">
                        <h2>Detail Status</h2>
                        <div class="timeline">
                            <?php while ($status_row = $status_result->fetch_assoc()) { ?>
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        <span><?php echo date('l', strtotime($status_row['tanggal'])); ?></span>
                                        <span><?php echo date('d/m/Y', strtotime($status_row['tanggal'])); ?></span>
                                    </div>
                                    <div class="timeline-content">
                                        <span><?php echo htmlspecialchars($status_row['status']); ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        
            <a href="surat_masuk.php" class="btn-kembali">Kembali</a>
            <a href="edit_sumas.php?no_disposisi=<?php echo htmlspecialchars($row['no_disposisi']); ?>" class="btn-edit">Edit</a>
            
            
        </div>        
    </div>
</body>
</html>

                    