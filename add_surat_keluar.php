<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Surat Keluar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style/style_add_surat.css">
    <link rel="stylesheet" href="style/style_input_sukel.css">
    <style>
        .content-container {
            position: relative;
            justify-content: space-between;
            padding: 2.5rem;
            margin-left: 17.1875rem;
            margin-top: 3.125rem;
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
                    <a href="add_surat.php" class="active">
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
                    <h1>Input Surat Keluar</h1>
                    <h2>Isi data Surat Keluar</h2>
                </div>
                <div class="form-container">
                    <div class="form-box">
                        <form action="add_surat_keluar.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select id="kategori" name="kategori" required>
                                    <option value="">Kategori</option>
                                    <option value="Barang">Barang</option>
                                    <option value="Surat">Dokumen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat:</label>
                                <input type="text" id="nomor_surat" name="nomor_surat">
                            </div>                            
                            <div class="form-group">
                                <label for="tanggal_kirim">Tanggal Kirim:</label>
                                <input type="date" id="tanggal_kirim" placeholder="dd/mm/yyyy" name="tanggal_kirim" required>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
                                flatpickr("#tanggal_kirim", {
                                    dateFormat: "Y/m/d",
                                });
                            </script>
                            <div class="form-group">
                                <label for="perihal">Perihal:</label>
                                <input type="text" id="perihal" name="perihal" required>
                            </div>
                            <div class="form-group">
                            <label for="asal">Asal Bagian:</label>
                                <select id="asal" name="asal" required>
                                    <option value="pilih">Pilih Asal Bagian</option>
                                    <option value="Klaim dan Subrogasi">Klaim dan Subrogasi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan:</label>
                                <input type="text" id="tujuan" name="tujuan" required>
                            </div>                            
                            <div class="form-group">
                                <label for="no_kirim">No Surat Pengiriman:</label>
                                <input type="text" id="no_kirim" name="no_kirim" required>
                            </div>
                            <div class="form-group">
                                <label for="no_resi">No Resi:</label>
                                <input type="text" id="no_resi" name="no_resi">
                            </div>                              
                            <div class="form-group">
                                <div class="form-box-2">
                                    <label for="file">Upload File:</label>
                                    <div class="file-input">
                                        <input type="file" id="file" name="file" class="input-file">
                                    </div>
                                </div>
                                <div class="form-actions">
                                <button type="reset" class="reset">Reset</button>
                                <button class="submit" type="submit" name="upload">Submit</button>
                        
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
include 'db.php';
include './class/SuratKeluar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inisialisasi objek SuratKeluar
    $suratKeluar = new SuratKeluar($conn);

    // Ambil data dari form
    $suratKeluar->setKategori($_POST['kategori']);
    $suratKeluar->setNoSurat($_POST['nomor_surat']);
    $suratKeluar->setTanggalKirim($_POST['tanggal_kirim']);
    $suratKeluar->setPerihal($_POST['perihal']);
    $suratKeluar->setAsal($_POST['asal']);
    $suratKeluar->setTujuan($_POST['tujuan']);
    $suratKeluar->setNoKirim($_POST['no_kirim']);
    $suratKeluar->setNoResi($_POST['no_resi']);

    // Menangani upload file
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $suratKeluar->setFileData(file_get_contents($_FILES['file']['tmp_name']));
        $suratKeluar->setFileName($_FILES['file']['name']);
        $suratKeluar->setFileType($_FILES['file']['type']);
        $suratKeluar->setFileSize($_FILES['file']['size']);
    }

    // Insert surat keluar ke database
    $suratKeluar->addSurat();
}
?>
</body>
</html>
