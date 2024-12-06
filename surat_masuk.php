<?php
include 'db.php'; // Menggunakan koneksi database dari db.php
include './class/SuratMasuk.php';

// Ambil nilai filter tujuan jika ada
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$bulan_tahun = isset($_GET['bulan_tahun']) ? $_GET['bulan_tahun'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Membuat objek SuratMasuk
$suratMasuk = new SuratMasuk($conn, $tujuan, $keyword, $status, $bulan_tahun, $page);

// Mendapatkan surat masuk sesuai dengan filter
list($result, $total_pages) = $suratMasuk->getSurat();

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Tracking Letter Jamkrindo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style/style_surat_masuk.css">
    <style>
        /* CSS untuk pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 1.25rem; /* 20px */
            border-radius: 0.5rem; /* 8px */
            text-align: center;
        }

        .popup-content button {
            margin-top: 0.625rem; /* 10px */
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
        <!-- Pop-up Notifikasi -->
        <div class="popup-overlay" id="popup-overlay">
            <div class="popup-content">
                <p>Silakan pilih tujuan terlebih dahulu sebelum mengexport.</p>
                <button onclick="closePopup()">Tutup</button>
            </div>
        </div>

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
                        <a href="surat_masuk.php" class="active">
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
                            <span class="surat-keluar">Surat Keluar</span></a>
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
            <div class="content-section">
                <h1>Surat Masuk</h1>
                <!-- Form Pencarian -->
                <form action="surat_masuk.php" method="GET" class="search-form">
                    <input type="text" name="keyword" placeholder="Cari berdasarkan keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                    <select name="tujuan" id="tujuan-select">
                        <option value="">- Pilih Tujuan -</option>
                        <option value="Klaim dan Subrogasi" <?php if ($tujuan == 'Klaim dan Subrogasi') echo 'selected'; ?>>Klaim dan Subrogasi</option>
                        <option value="Operasional" <?php if ($tujuan == 'Operasional') echo 'selected'; ?>>Operasional</option>
                        <option value="Bisnis" <?php if ($tujuan == 'Bisnis') echo 'selected'; ?>>Bisnis</option>
                        <option value="Lainnya" <?php if ($tujuan == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                    </select>
                    <select name="status">
                        <option value="">- Pilih Status -</option>
                        <option value="Agendaris" <?php if ($status == 'Agendaris') echo 'selected'; ?>>Agendaris</option>
                        <option value="Manager" <?php if ($status == 'Manager') echo 'selected'; ?>>Manager</option>
                        <option value="Pinca" <?php if ($status == 'Pinca') echo 'selected'; ?>>Pinca</option>
                        <option value="Staff" <?php if ($status == 'Staff') echo 'selected'; ?>>Staff</option>
                    </select>
                    <input type="month" name="bulan_tahun" value="<?php echo htmlspecialchars($bulan_tahun); ?>">
                    <button type="submit">Cari</button>
                    <button type="button" onclick="exportData()">Export</button>
                </form>

                <!-- Tabel Hasil Pencarian -->
                <table>
                    <tr>
                        <th>No Disposisi</th>
                        <th>Tanggal Masuk</th>
                        <th>Perihal</th>
                        <th>Asal Surat</th>
                        <th>Tanggal Terakhir Disposisi</th>
                        <th>Status</th>
                        <th>Tujuan</th>
                        <th>Detail</th>
                    </tr>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['no_disposisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal_masuk']); ?></td>
                                <td><?php echo htmlspecialchars($row['perihal']); ?></td>
                                <td><?php echo htmlspecialchars($row['asal']); ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td><?php echo htmlspecialchars($row['tujuan']); ?></td>
                                <td>
                                    <a href="detail_surat_masuk.php?no_disposisi=<?php echo $row['no_disposisi']; ?>" class="detail-button">Detail Surat</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Tidak ada surat masuk</td>
                        </tr>
                    <?php endif; ?>
                </table>
                <div class="pagination">
                    <button onclick="goToPage(1)">Halaman Pertama</button>
                    <button onclick="goToPage(<?php echo max(1, $page - 1); ?>)">Sebelumnya</button>
                    <input type="number" id="pageNumber" class="no-arrows" value="<?php echo $page; ?>" min="1" max="<?php echo $total_pages; ?>" onchange="goToPage(this.value)" />
                    <span>of <?php echo $total_pages; ?></span>
                    <button onclick="goToPage(<?php echo min($total_pages, $page + 1); ?>)">Selanjutnya</button>
                    <button onclick="goToPage(<?php echo $total_pages; ?>)">Halaman Terakhir</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportData() {
            const tujuan = document.getElementById('tujuan-select').value;
            const bulanTahun = document.querySelector('input[name="bulan_tahun"]').value;

             if (tujuan === '') {
             // Export without tujuan
             window.location.href = `export_surat_masuk.php?bulan_tahun=${encodeURIComponent(bulanTahun)}`;
        } else {
            // Export with tujuan and optional bulan_tahun
            window.location.href = `export_surat_masuk.php?tujuan=${encodeURIComponent(tujuan)}&bulan_tahun=${encodeURIComponent(bulanTahun)}`;
         }
    }
        function exportAll() {
             window.location.href = 'export_surat_masuk.php?export_all=true';
        }


        function closePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
        }

        function goToPage(page) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', page);
            window.location.search = params.toString();
        }
    </script>
</body>
</html>

