<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Letter Jamkrindo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="./style/stel.edit.sumas.css">
    <style>
        .credit { 
            position: fixed;
            bottom: 0.625rem; 
            left: 0.625rem; 
            margin: 0;
            font-size: 0.625rem;
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
            <div class="content-section">
                <div class='text-container'>
                    <h1>Surat Masuk</h1>
                    <h2>Edit Data Surat Masuk</h2>
                </div>
                <?php
                include 'db.php';
                $no_disposisi = isset($_GET['no_disposisi']) ? intval($_GET['no_disposisi']) : 0;

                if ($no_disposisi <= 0) {
                    echo "<script>alert('No Disposisi tidak valid atau bernilai 0.');</script>";

                    exit;
                }
                $data = [
                    'no_disposisi' => '',
                    'no_surat' => '',
                    'jenis' => '',
                    'tanggal_masuk' => '',
                    'perihal' => '',
                    'asal' => '',
                    'tanggal_surat' => '',
                    'tujuan' => '',
                    'scan_surat' => '',
                    'disposisi' => '',
                    'audit_trail' => '',
                    'catatan' => '',
                    'tanggal_kembali' => '',
                    'status' => ''
                ];
                $sql = "SELECT * FROM disposisi WHERE no_disposisi = ?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo "Query error: " . $conn->error;
                    exit;
                }
                $stmt->bind_param('i', $no_disposisi);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $disposisi_data = $result->fetch_assoc();
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['delete'])) {
                        $sql_delete = "DELETE FROM surat_masuk WHERE no_disposisi = ?";
                        $stmt_delete = $conn->prepare($sql_delete);
                        if (!$stmt_delete) {
                            echo "Query error: " . $conn->error;
                            exit;
                        }
                        $stmt_delete->bind_param('i', $no_disposisi);
                        $stmt_delete->execute();
                        if ($stmt_delete->affected_rows > 0) {
                            echo "<script>alert('Surat berhasil dihapus.');</script>";

                            exit;
                        } else {
                            echo "<script>alert('Gagal menghapus surat!');</script>";

                        }
                    } else {
                    $no_disposisi = $_POST['no_disposisi'];
                    $no_surat = $_POST['no_surat'];
                    $jenis = $_POST['jenis'];
                    $tanggal_masuk = $_POST['tanggal_masuk'];
                    $perihal = $_POST['perihal'];
                    $asal = $_POST['asal'];
                    $tanggal_surat = $_POST['tanggal_surat'];
                    $tujuan = $_POST['tujuan'];
                    $disposisi = $_POST['disposisi'];
                    $audit_trail = $_POST['audit_trail'];
                    $catatan = $_POST['catatan'];
                    $tanggal_kembali = $_POST['tanggal_kembali'];
                    $status = $_POST['status'];

                    $sql = "UPDATE surat_masuk 
                            SET no_disposisi = ?, no_surat = ?, jenis = ?, tanggal_masuk = ?, perihal = ?, asal = ?, tanggal_surat = ?, tujuan = ? 
                            WHERE no_disposisi = ?";
                    $stmt = $conn->prepare($sql);

                    if (!$stmt) {
                        echo "Query error: " . $conn->error;
                        exit;
                    }

                    $stmt->bind_param('sssssssss', $no_disposisi, $no_surat, $jenis, $tanggal_masuk, $perihal, $asal, $tanggal_surat, $tujuan, $no_disposisi);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<script>alert('Data surat berhasil diperbarui!');</script>";
                    } else {
                        echo "<script>alert('Data surat tidak berubah!');</script>";
                    }

                    $sql_disposisi_lama = "SELECT disposisi, audit_trail, catatan FROM disposisi WHERE no_disposisi = ?";
                    $stmt_disposisi_lama = $conn->prepare($sql_disposisi_lama);
                    $stmt_disposisi_lama->bind_param('i', $no_disposisi);
                    $stmt_disposisi_lama->execute();
                    $result_disposisi_lama = $stmt_disposisi_lama->get_result();
                    $disposisi_lama = $result_disposisi_lama->fetch_assoc();

                    $disposisi_changed = (
                        $disposisi_lama['disposisi'] !== $disposisi ||
                        $disposisi_lama['audit_trail'] !== $audit_trail ||
                        $disposisi_lama['catatan'] !== $catatan
                    );

                    if ($disposisi_changed) {
                        $sql_disposisi = "INSERT INTO disposisi (no_disposisi, disposisi, audit_trail, catatan) VALUES (?, ?, ?, ?)
                                        ON DUPLICATE KEY UPDATE disposisi = VALUES(disposisi), audit_trail = VALUES(audit_trail), catatan = VALUES(catatan)";
                        $stmt_disposisi = $conn->prepare($sql_disposisi);

                        if (!$stmt_disposisi) {
                            echo "Query error: " . $conn->error;
                            exit;
                        }
                        $stmt_disposisi->bind_param('isss', $no_disposisi, $disposisi, $audit_trail, $catatan);
                        $stmt_disposisi->execute();

                        if ($stmt_disposisi->affected_rows > 0) {
                            echo "<script>alert('Data disposisi berhasil diperbarui!');</script>";
                        } else {
                            echo "Data disposisi tidak berubah.";
                        }
                    }
                    if(!empty($tanggal_kembali) && !empty($status)) {
                        $sql_status = "INSERT INTO status_riwayat (no_disposisi, tanggal, status) VALUES (?, ?, ?)";
                        $stmt_status = $conn->prepare($sql_status);

                        if (!$stmt_status) {
                            echo "Query error: " . $conn->error;
                            exit;
                        }

                        $stmt_status->bind_param('iss', $no_disposisi, $tanggal_kembali, $status);
                        $stmt_status->execute();

                        if ($stmt_status->affected_rows > 0) {
                            echo "<script>alert('Data status berhasil ditambahkan.');</script>";
                        } else {
                            echo "<script>alert('Data status tidak berubah.');</script>";
                        }

                        exit;
                    }
                    }
                }
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
                    $data = $result->fetch_assoc();
                } else {
                    echo "Data tidak ditemukan.";
                    exit;
                }
                ?>
                <form action="edit_sumas.php?no_disposisi=<?php echo htmlspecialchars($no_disposisi); ?>" method="post" enctype="multipart/form-data">
                    <div class="tables">
                    <div class="table-container">
                        <div class="keterangan">
                        <table>
                            <tr>
                                <th>No Disposisi</th>
                                <td><input type="text" name="no_disposisi" value="<?php echo htmlspecialchars($data['no_disposisi']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>No Surat</th>
                                <td><input type="text" name="no_surat" value="<?php echo htmlspecialchars($data['no_surat']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td><input type="text" name="jenis" value="<?php echo htmlspecialchars($data['jenis']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <td><input type="date" name="tanggal_masuk" value="<?php echo htmlspecialchars($data['tanggal_masuk']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Perihal</th>
                                <td><input type="text" name="perihal" value="<?php echo htmlspecialchars($data['perihal']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Asal</th>
                                <td><input type="text" name="asal" value="<?php echo htmlspecialchars($data['asal']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat</th>
                                <td><input type="date" name="tanggal_surat" value="<?php echo htmlspecialchars($data['tanggal_surat']); ?>" required></td>
                            </tr>
                            <tr>
                                <th>Tujuan</th>
                                <td>
                                    <select name="tujuan" required>
                                        <option value="Klaim dan Subrogasi" <?php echo $data['tujuan'] === 'Klaim dan Subrogasi' ? 'selected' : ''; ?>>Klaim dan Subrogasi</option>
                                        <option value="Operasional" <?php echo $data['tujuan'] === 'Operasional' ? 'selected' : ''; ?>>Operasional</option>
                                        <option value="Bisnis" <?php echo $data['tujuan'] === 'Bisnis' ? 'selected' : ''; ?>>Bisnis</option>
                                        <option value="Lainnya" <?php echo $data['tujuan'] === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Scan Surat</th>
                                <td>
                                    <a href="data:image/png;base64,<?php echo base64_encode($data['scan_surat']); ?>" target="_blank">Lihat Scan Surat</a><br>
                                    <input type="file" name="scan_surat">
                                    <input type="hidden" name="existing_scan_surat" value="<?php echo htmlspecialchars($data['scan_surat']); ?>">
                                </td>
                            </tr> -->
                        </table>
                        </div>
                        <div class="lembar">
                        <h2>Lembar Pengendalian Surat</h2>
                        <table>
                            <tr>
                                <th>Disposisi</th>
                                <td>
                                    <select name="disposisi">
                                    <option value="">Pilih Disposisi </option>
                                    <option value="SETUJU" <?php echo $disposisi_data['disposisi'] === 'SETUJU' ? 'selected' : ''; ?>>SETUJU</option>
                                    <option value="TOLAK" <?php echo $disposisi_data['disposisi'] === 'TOLAK' ? 'selected' : ''; ?>>TOLAK</option>
                                    <option value="TELITI & PENDAPAT" <?php echo $disposisi_data['disposisi'] === 'TELITI & PENDAPAT' ? 'selected' : ''; ?>>TELITI & PENDAPAT</option>
                                    <option value="BICARAKAN" <?php echo $disposisi_data['disposisi'] === 'BICARAKAN' ? 'selected' : ''; ?>>BICARAKAN</option>
                                    <option value="SELESAIKAN" <?php echo $disposisi_data['disposisi'] === 'SELESAIKAN' ? 'selected' : ''; ?>>SELESAIKAN</option>
                                    <option value="LAKSANAKAN" <?php echo $disposisi_data['disposisi'] === 'LAKSANAKAN' ? 'selected' : ''; ?>>LAKSANAKAN</option>
                                    <option value="UNTUK PERHATIAN" <?php echo $disposisi_data['disposisi'] === 'UNTUK PERHATIAN' ? 'selected' : ''; ?>>UNTUK PERHATIAN</option>
                                    <option value="JAWAB" <?php echo $disposisi_data['disposisi'] === 'JAWAB' ? 'selected' : ''; ?>>JAWAB</option>
                                    <option value="SESUAI CATATAN" <?php echo $disposisi_data['disposisi'] === 'SESUAI CATATAN' ? 'selected' : ''; ?>>SESUAI CATATAN</option>
                                    <option value="EDARKAN" <?php echo $disposisi_data['disposisi'] === 'EDARKAN' ? 'selected' : ''; ?>>EDARKAN</option>
                                    <option value="SIMPAN" <?php echo $disposisi_data['disposisi'] === 'SIMPAN' ? 'selected' : ''; ?>>SIMPAN</option>
                                    <option value="MONITOR" <?php echo $disposisi_data['disposisi'] === 'MONITOR' ? 'selected' : ''; ?>>MONITOR</option>
                                    <option value="HADIRI/WAKILI" <?php echo $disposisi_data['disposisi'] === 'HADIRI/WAKILI' ? 'selected' : ''; ?>>HADIRI/WAKILI</option>
                                    <option value="TERUSKAN" <?php echo $disposisi_data['disposisi'] === 'TERUSKAN' ? 'selected' : ''; ?>>TERUSKAN</option>
                                    <option value="PERBANYAK" <?php echo $disposisi_data['disposisi'] === 'PERBANYAK' ? 'selected' : ''; ?>>PERBANYAK</option>
                                    <option value="Untuk dihadiri" <?php echo $disposisi_data['disposisi'] === 'Untuk dihadiri' ? 'selected' : ''; ?>>Untuk dihadiri</option>
                                    <option value="Untuk diperhatikan" <?php echo $disposisi_data['disposisi'] === 'Untuk diperhatikan' ? 'selected' : ''; ?>>Untuk diperhatikan</option>
                                    <option value="Untuk dijadwalkan" <?php echo $disposisi_data['disposisi'] === 'Untuk dijadwalkan' ? 'selected' : ''; ?>>Untuk dijadwalkan</option>
                                    <option value="Setuju dilakukan dan proses selanjutnya" <?php echo $disposisi_data['disposisi'] === 'Setuju dilakukan dan proses selanjutnya' ? 'selected' : ''; ?>>Setuju dilakukan dan proses selanjutnya</option>
                                    <option value="Buatkan draft jawaban" <?php echo $disposisi_data['disposisi'] === 'Buatkan draft jawaban' ? 'selected' : ''; ?>>Buatkan draft jawaban</option>
                                    <option value="Untuk perhatian" <?php echo $disposisi_data['disposisi'] === 'Untuk perhatian' ? 'selected' : ''; ?>>Untuk perhatian</option>
                                    <option value="Proses sesuai dengan kewenangan Saudara" <?php echo $disposisi_data['disposisi'] === 'Proses sesuai dengan kewenangan Saudara' ? 'selected' : ''; ?>>Proses sesuai dengan kewenangan Saudara</option>
                                    <option value="Silahkan berdiskusi langsung dengan kami" <?php echo $disposisi_data['disposisi'] === 'Silahkan berdiskusi langsung dengan kami' ? 'selected' : ''; ?>>Silahkan berdiskusi langsung dengan kami</option>
                                    <option value="Silahkan laporkan hasilnya" <?php echo $disposisi_data['disposisi'] === 'Silahkan laporkan hasilnya' ? 'selected' : ''; ?>>Silahkan laporkan hasilnya</option>
                                    <option value="Ditinjau dan ditindaklanjuti" <?php echo $disposisi_data['disposisi'] === 'Ditinjau dan ditindaklanjuti' ? 'selected' : ''; ?>>Ditinjau dan ditindaklanjuti</option>
                                    <option value="Gunakan sebagai informasi" <?php echo $disposisi_data['disposisi'] === 'Gunakan sebagai informasi' ? 'selected' : ''; ?>>Gunakan sebagai informasi</option>
                                    <option value="Tanyakan saran tindak lanjut" <?php echo $disposisi_data['disposisi'] === 'Tanyakan saran tindak lanjut' ? 'selected' : ''; ?>>Tanyakan saran tindak lanjut</option>
                                    <option value="Teruskan kepada" <?php echo $disposisi_data['disposisi'] === 'Teruskan kepada' ? 'selected' : ''; ?>>Teruskan kepada</option>
                                    <option value="Silahkan memprioritaskan tugas ini" <?php echo $disposisi_data['disposisi'] === 'Silahkan memprioritaskan tugas ini' ? 'selected' : ''; ?>>Silahkan memprioritaskan tugas ini</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Audit Trail</th>
                                <td><textarea name="audit_trail" id="audit_trail"><?php echo htmlspecialchars($disposisi_data['audit_trail']); ?></textarea></td>
                                

                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td><textarea name="catatan" id="catatan"><?php echo htmlspecialchars($disposisi_data['catatan']); ?></textarea></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="table-container-2">
                        <div class="updatelog">
                        <table>
                            <tr>
                                <th>Tanggal Diperbarui:</th>
                                <td><input type="date" name="tanggal_kembali" required></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <select name="status">
                                    <option value= ""> Update Status</option>
                                    <option value="Pimpinan">Pimpinan</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Agendaris">Agendaris</option>
                                    <option value="Staff">Staff</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <button type="submit" class="btn-simpan">Simpan</button>
                    <a href="detail_surat_masuk.php?no_disposisi=<?php echo htmlspecialchars($no_disposisi); ?>" class="btn-kembali">Kembali</a>
                    <button type="submit" name="delete" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">Hapus</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <<script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("input[type=date]");
            const today = new Date().toISOString().split('T')[0];
            const tanggalMasukInput = document.querySelector('input[name="tanggal_masuk"]');
            if (tanggalMasukInput) {
                tanggalMasukInput.value = today;
            }

            const form = document.querySelector('form');
            const initialFormData = new FormData(form);

            form.addEventListener('submit', function(event) {
                const currentFormData = new FormData(form);
                let isChanged = false;

                for (const [key, value] of currentFormData.entries()) {
                    if (initialFormData.get(key) !== value) {
                        isChanged = true;
                        break;
                    }
                }

                if (isChanged) {
                    const isConfirmed = confirm('Anda telah melakukan perubahan. Apakah Anda yakin ingin menyimpan perubahan?');
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                }
            });
        });
    </script>
</body>
</html>
        
