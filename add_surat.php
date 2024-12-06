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
    <link rel="stylesheet" href="style/style_add_surat.css">
    <style>
    .content-container {
    position: relative;
    justify-content: space-between;
    padding: 2.5rem; /* 40px */
    top: 3.75rem; /* 60px */
    left: 17.8125rem; /* 285px */
    }


    .form-box {
        width: calc(60% - 1.25rem);
        margin-right: 1.25rem;
        padding: 1.25rem;
        box-shadow: 0.125rem 0 0.3125rem rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        background-color: #ffffff;
        margin-top: 5rem;
        margin-left: 0.9375rem;
        font-family: 'Nunito';
    }

    .form-box-2 {
        width: 25rem;
        padding: 1.25rem;
        box-shadow: 0.125rem 0 0.3125rem rgba(0, 0, 0, 0.1);
        position: absolute;
        border-radius: 0.5rem;
        background-color: #ffffff;
        top: 0.625rem;
        left: calc(60% + 0.625rem);
        height: 6.25rem;
        margin-top: 6.875rem;
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


    .reset {
        display: inline-block;
        padding: 0.625rem 1.25rem;
        bottom: 1.25rem;
        right: 8.75rem;
        font-size: 1rem;
        background-color: #f30505;
        color: #ffffff;
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        border-radius: 0.25rem;
        border: 0.0625rem solid transparent;
        transition: background-color 0.3s, color 0.3s;
        position: fixed;
    }

    .reset:hover {
        background-color: #bb1616;
    }

    .submit {
        display: inline-block;
        padding: 0.625rem 1.25rem;
        bottom: 1.25rem;
        right: 1.875rem;
        font-size: 1rem;
        background-color: #012970;
        color: #ffffff;
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        border-radius: 0.25rem;
        border: 0.0625rem solid transparent;
        transition: background-color 0.3s, color 0.3s;
        position: fixed;
    }

    .submit:hover {
        background-color: #0056b3;
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
                    <h1>Input Surat Masuk</h1>
                    <h2>Isi data Surat Masuk</h2>
                </div>
                <div class="form-container">
                    <div class="form-box">
                        <form action="add_surat.php" method="POST" enctype="multipart/form-data">
                            <form>
                            <div id="error-message" style="display: none; color: red; margin-top: 20px;"></div>
                            <div>
                            <div class="form-group">
                                <label for="nomor_agenda">Nomor Agenda:</label>
                                <input type="text" id="nomor_agenda" name="nomor_agenda" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat:</label>
                                <input type="text" id="nomor_surat" name="nomor_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal:</label>
                                <input type="text" id="perihal" name="perihal" required>
                            </div>
                            <div class="form-group">
                                <label for="asal_surat">Asal Surat:</label>
                                <input type="text" id="asal_surat" name="asal_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan Bagian:</label>
                                <select id="tujuan" name="tujuan" required>
                                    <option value="pilih">Pilih Tujuan Bagian</option>
                                    <option value="Klaim dan Subrogasi">Klaim dan Subrogasi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat:</label>
                                <input type="date" id="tanggal_surat" placeholder="yyyy/mm/dd" name="tanggal_surat" required>
                            </div>
                           <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk:</label>
                                <input type="date" id="tanggal_masuk" placeholder="yyyy/mm/dd" name="tanggal_masuk" required>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
                                // FLATPICK BUAT KALENDER
                                flatpickr('#tanggal_masuk', {
                                    dateFormat: 'Y/m/d', // Format tanggal dd/mm/yyyy
                                });
                                flatpickr('#tanggal_surat', {
                                    dateFormat: 'Y/m/d', // Format tanggal dd/mm/yyyy
                                });
                            </script>
                            <div class="form-group">
                                <label>Jenis:</label>
                                <div>
                                    <label>
                                        <input type="radio" name="jenis" value="asli" required> Asli
                                    </label>
                                    <label>
                                        <input type="radio" name="jenis" value="tembusan" required> Tembusan
                                    </label>
                                    <div class="form-box-2">
                                        <label for="file">Upload File:</label>
                                        <div class="file-input">
                                            <input type="file" id="file" name="file" class="input-file" value="">
                                        </div>
                                    </div>
                    <div class="form-actions">
                        <button type="reset" class="reset">Reset</button>
                        <button class="submit" type="submit" name="upload">Submit</button>
                        
                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Peringatan saat menekan tombol reset
        document.querySelector('button[type="reset"]').addEventListener('click', function(event) {
            if (!confirm("Apakah Anda yakin ingin mereset formulir ini? Semua data yang telah dimasukkan akan hilang.")) {
                event.preventDefault();
            }
        });
    </script>
    </body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';
    include './class/SuratMasuk.php';

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
    
    $no_surat = $_POST['nomor_surat'];
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $perihal = $_POST['perihal'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $no_kirim = $_POST['no_kirim'];
    $no_resi = $_POST['no_resi'];
    $kategori = $_POST['kategori'];

    $fileData = null;
    $fileName = null;
    $fileType = null;
    $fileSize = null;

    // Handle file upload jika file diunggah
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileData = addslashes(file_get_contents($fileTmpName));

        // Determine file extension from MIME type
        $fileExtension = getExtensionFromMimeType($fileType);
        // Create the new file name based on the nomor_agenda
        $newFileName = $no_kirim . '.' . $fileExtension;
        $folder = "./surat_masuk/bukti_pengiriman/" . $newFileName;

        // Upload file ke server
        if (!move_uploaded_file($fileTmpName, $folder)) {
            echo "<h3>&nbsp; Failed to upload file!</h3>";
        }
    }

    // Membuat objek SuratMasuk dan menambahkan surat masuk
    $suratMasuk = new SuratMasuk($conn);
    $success = $suratMasuk->addSurat($kategori, $no_surat, $tanggal_kirim, $perihal, $asal, $tujuan, $no_kirim, $no_resi, $fileData, $fileName, $fileType, $fileSize);

    if ($success) {
        echo "<script>alert('Surat masuk berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan surat masuk!');</script>";
    }

    $conn->close();
}
?>
</body>
</html>

