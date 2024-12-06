<?php
include 'db.php'; // Pastikan path ini benar

// Ambil no_pengiriman dari query string
$no_pengiriman = isset($_GET['no_pengiriman']) ? intval($_GET['no_pengiriman']) : 0;
$data = ['no_resi' => ''];
$no_resi = $_POST['no_resi'];


if ($no_pengiriman <= 0) {
    echo "No Pengiriman tidak valid.";
    
    exit;
}

// Query untuk mendapatkan detail surat berdasarkan no_pengiriman
$sql = "SELECT * FROM surat_keluar WHERE no_pengiriman = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Query error: " . $conn->error;
    exit;
}

$stmt->bind_param('i', $no_pengiriman);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['no_resi'] = $row['no_resi'];
} else {
    echo "Data tidak ditemukan.";
    exit;
}

$file_extension = pathinfo($row['file_name'],PATHINFO_EXTENSION);

function getExtensionFromMimeType($mimeType) {
    $mimeMap = [
            'application/pdf' => 'pdf',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/zip' => 'zip',
        ];

        return isset($mimeMap[$mimeType]) ? $mimeMap[$mimeType] : 'bin';
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Skrip untuk menghapus surat
        $sql_delete = "DELETE FROM surat_keluar WHERE no_pengiriman = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        if (!$stmt_delete) {
            echo "Query error: " . $conn->error;
            exit;
        }
        $stmt_delete->bind_param('i', $no_pengiriman);
        $stmt_delete->execute();
        if ($stmt_delete->affected_rows > 0) {
            echo "<script>alert('Surat berhasil dihapus!');</script>";
            header("Location: surat_keluar.php");
            exit;
        } else {
            echo "<script>alert('Gagal menghapus surat!');</script>";

        }
    }   else if (isset($_FILES['file_resi']) && $_FILES['file_resi']['error'] == 0){
        $fileName = $_FILES['file_resi']['name'];
        $fileTmpName = $_FILES['file_resi']['tmp_name'];
        $fileSize = $_FILES['file_resi']['size'];
        $fileType = $_FILES['file_resi']['type'];
        $fileData = addslashes(file_get_contents($fileTmpName));
        
        // Determine file extension from MIME type
        $fileExtension = getExtensionFromMimeType($fileType);
        // Create the new file name based on the nomor_agenda
        $newFileName = $no_resi . '.' . $fileExtension;
        $folder = "./surat_keluar/no_resi/" . $newFileName;

        $stmt_post = $conn->prepare("UPDATE surat_keluar SET resi_data = ?, resi_name = ?, resi_type = ?, resi_size = ? WHERE no_pengiriman = ?");
        $stmt_post->bind_param("ssssi", $fileData, $fileName, $fileType, $fileSize, $no_pengiriman);
        


        if ($stmt_post->execute()) {
            echo "<script>alert('Surat keluar berhasil ditambahkan!');</script>";
        
            if (move_uploaded_file($fileTmpName, $folder)) {
                echo "<h3>&nbsp; File uploaded successfully!</h3>";
            } else {
                echo "<h3>&nbsp; Failed to upload file!</h3>";
            }
        }   else {
            echo "<script>alert('Error: " . $stmt_post->error . "');</script>";
        }
        $stmt_post->close();


    }   else  {

        $sql = "UPDATE surat_keluar SET no_resi = ? WHERE no_pengiriman = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "Query error: " . $conn->error;
            exit;
        }

        $stmt->bind_param('si', $no_resi, $no_pengiriman);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('No Resi berhasil diperbarui!');</script>";
            $data['no_resi'] = $no_resi; // Update the $data array with the new no_resi
        } else {
            echo "<script>alert('Gagal memperbarui No Resi!');</script>";

        }
    }
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
    <link rel="stylesheet" href="style/style_detail_sukeel.css">
    <style>
        .content-container {
            position: relative;
            width: auto;
            height: auto;
            top: -2.375rem; /* -38px */
            left: 18.75rem; /* 300px */
            padding: 1.875rem; /* 30px */
            background: #f6f9ff;
            z-index: 178;
            overflow: auto;
            min-height: 100%;
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

            <div class="form-section"><div class="unknown"></div></div>
            <div class="list">
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
                <h1>Surat Keluar</h1>
                <h2>Detail Surat Keluar</h2>
                <div class="horizontal">
                <div class='tablee'>
                    <table>
                        <tr>
                            <th>Kategori</th>
                            <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                        </tr>
                        <tr>
                            <th>No Surat</th>
                            <td><?php echo htmlspecialchars($row['no_sukel']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kirim</th>
                            <td><?php echo htmlspecialchars($row['tanggal_kirim']); ?></td>
                        </tr>
                        <tr>
                            <th>Perihal</th>
                            <td><?php echo htmlspecialchars($row['perihal']); ?></td>
                        </tr>
                        <tr>
                            <th>Asal Surat</th>
                            <td><?php echo htmlspecialchars($row['asal_surat']); ?></td>
                        </tr>
                        <tr>
                            <th>Tujuan</th>
                            <td><?php echo htmlspecialchars($row['tujuan']); ?></td>
                        </tr>
                        <tr>
                            <th>No Pengiriman</th>
                            <td><?php echo htmlspecialchars($row['no_pengiriman']); ?></td>
                        </tr>
                        <tr>
                            <th>Bukti Pengiriman</th>
                            <td>
                            <a href="./surat_keluar/bukti_pengiriman/<?php echo htmlspecialchars($no_pengiriman); ?>.<?php echo htmlspecialchars($file_extension); ?>" download>Unduh Bukti Pengiriman</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen Resi</th>
                            <td>
                            <a href="./surat_keluar/no_resi/<?php echo htmlspecialchars($no_pengiriman); ?>.<?php echo htmlspecialchars($file_extension); ?>" download>Unduh No Resi</a>
                            </td>
                        </tr>
                    </table>
                    <a href="surat_keluar.php" class="btn-kembali">Kembali</a>
                </div>
                <div class="resi-container">
                    <h2>Input No Resi</h2>
                    <div class="resi">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="no_resi">No Resi</label>
                                <td><input type="text" name="no_resi" value="<?php echo htmlspecialchars($data['no_resi']); ?>" required></td>
                            </div>
                            <div class="form-group">
                                <div class="form-box-2">
                                    <label for="file_resi">Upload file resi:</label>
                                    <div class="file_resi-input">
                                        <input type="file" id="file_resi" name="file_resi" class="input-file_resi">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn-simpan">Simpan</button>
                            <button type="submit" name="delete" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">Hapus</button>
    
                        </form>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
