<?php
include 'db.php'; // Menggunakan koneksi database dari db.php
require 'vendor/autoload.php'; // Pastikan path ini sesuai dengan lokasi file autoload.php dari PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Ambil nilai kategori, asal, dan tanggal dari URL
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$asal = isset($_GET['asal']) ? $_GET['asal'] : '';
$bulan_tahun = isset($_GET['bulan_tahun']) ? $_GET['bulan_tahun'] : '';
$date = date('d-m-Y');

// Query untuk mendapatkan data berdasarkan kategori, asal, dan bulan
$sql = "SELECT * FROM surat_keluar WHERE 1=1";

if (!empty($kategori)) {
    $kategori = $conn->real_escape_string($kategori);
    $sql .= " AND kategori LIKE '%{$kategori}%'";
}

if (!empty($asal)) {
    $asal = $conn->real_escape_string($asal);
    $sql .= " AND asal_surat LIKE '%{$asal}%'";
}

if (!empty($bulan_tahun)) {
    $bulan_tahun = $conn->real_escape_string($bulan_tahun);
    $sql .= " AND DATE_FORMAT(tanggal_kirim, '%Y-%m') = '{$bulan_tahun}'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Membuat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menentukan header tabel
    $sheet->setCellValue('A1', 'Kategori');
    $sheet->setCellValue('B1', 'No Surat');
    $sheet->setCellValue('C1', 'Tanggal Kirim');
    $sheet->setCellValue('D1', 'Perihal');
    $sheet->setCellValue('E1', 'Asal Surat');
    $sheet->setCellValue('F1', 'Tujuan');
    $sheet->setCellValue('G1', 'No Pengiriman');

    // Mengisi data
    $rowNum = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $row['kategori']);
        $sheet->setCellValue('B' . $rowNum, $row['no_sukel']);
        $sheet->setCellValue('C' . $rowNum, $row['tanggal_kirim']);
        $sheet->setCellValue('D' . $rowNum, $row['perihal']);
        $sheet->setCellValue('E' . $rowNum, $row['asal_surat']);
        $sheet->setCellValue('F' . $rowNum, $row['tujuan']);
        $sheet->setCellValue('G' . $rowNum, $row['no_pengiriman']);
        $rowNum++;
    }

    // Membuat nama file dengan format yang diinginkan
    if (!empty($bulan_tahun)) {
        $bulan = date('F', strtotime($bulan_tahun . '-01')); // Mendapatkan nama bulan dari format YYYY-MM
        $fileName = !empty($kategori) && !empty($asal) ? "Export_Surat_Keluar_{$kategori}_{$asal}_{$bulan}_{$date}.xlsx" :
                    (!empty($kategori) ? "Export_Surat_Keluar_{$kategori}_{$bulan}_{$date}.xlsx" :
                    (!empty($asal) ? "Export_Surat_Keluar_{$asal}_{$bulan}_{$date}.xlsx" :
                    "Export_Surat_Keluar_{$bulan}_{$date}.xlsx"));
    } else {
        $fileName = !empty($kategori) && !empty($asal) ? "Export_Surat_Keluar_{$kategori}_{$asal}_{$date}.xlsx" :
                    (!empty($kategori) ? "Export_Surat_Keluar_{$kategori}_{$date}.xlsx" :
                    (!empty($asal) ? "Export_Surat_Keluar_{$asal}_{$date}.xlsx" :
                    "Export_Surat_Keluar_{$date}.xlsx"));
    }

    // Menulis file ke output
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
} else {
    die('Tidak ada data yang ditemukan untuk kategori, asal, dan bulan ini.');
}
?>
