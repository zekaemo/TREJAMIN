<?php
require 'vendor/autoload.php';
include 'db.php'; // Include database connection

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Get parameters from query string
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : '';
$bulan_tahun = isset($_GET['bulan_tahun']) ? $_GET['bulan_tahun'] : '';
$export_all = isset($_GET['export_all']) ? $_GET['export_all'] : '';

// Build SQL query based on parameters
$sql = "SELECT sm.*, sr.status, sr.tanggal 
        FROM surat_masuk sm 
        LEFT JOIN (
            SELECT no_disposisi, MAX(tanggal) AS tanggal
            FROM status_riwayat
            GROUP BY no_disposisi
        ) AS sr_filtered ON sm.no_disposisi = sr_filtered.no_disposisi
        LEFT JOIN status_riwayat sr ON sr.no_disposisi = sr_filtered.no_disposisi AND sr.tanggal = sr_filtered.tanggal
        WHERE 1=1";

// Apply filters based on parameters
if (!empty($tujuan)) {
    $tujuan = $conn->real_escape_string($tujuan);
    $sql .= " AND sm.tujuan = '{$tujuan}'";
}

if (!empty($bulan_tahun)) {
    $bulan_tahun = $conn->real_escape_string($bulan_tahun);
    $sql .= " AND DATE_FORMAT(sm.tanggal_masuk, '%Y-%m') = '{$bulan_tahun}'";
}

$sql .= " ORDER BY sm.no_disposisi";

// Execute query
$result = $conn->query($sql);

// Determine the month name if bulan_tahun is provided
$month_name = '';
if (!empty($bulan_tahun)) {
    $month_number = (int)date('m', strtotime($bulan_tahun . '-01'));
    $month_name = date('F', mktime(0, 0, 0, $month_number, 1));
}

// Generate filename based on the parameters
$date = date('d-m-Y');
if ($export_all) {
    $filename = "Export_Surat Masuk_Semua_{$date}.xlsx";
} elseif (!empty($tujuan) && !empty($bulan_tahun)) {
    $filename = "Export_Surat Masuk_{$tujuan}_{$month_name}_{$date}.xlsx";
} elseif (!empty($tujuan)) {
    $filename = "Export_Surat Masuk_{$tujuan}_{$date}.xlsx";
} elseif (!empty($bulan_tahun)) {
    $filename = "Export_Surat Masuk_{$month_name}_{$date}.xlsx";
} else {
    $filename = "Export_Surat Masuk_{$date}.xlsx";
}

if ($result->num_rows > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers for the columns
    $sheet->setCellValue('A1', 'No Disposisi');
    $sheet->setCellValue('B1', 'Tanggal Masuk');
    $sheet->setCellValue('C1', 'Perihal');
    $sheet->setCellValue('D1', 'Asal Surat');
    $sheet->setCellValue('E1', 'Tanggal Terakhir Disposisi');
    $sheet->setCellValue('F1', 'Status');
    $sheet->setCellValue('G1', 'Tujuan');

    // Fill the data
    $rowIndex = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowIndex, $row['no_disposisi']);
        $sheet->setCellValue('B' . $rowIndex, $row['tanggal_masuk']);
        $sheet->setCellValue('C' . $rowIndex, $row['perihal']);
        $sheet->setCellValue('D' . $rowIndex, $row['asal']);
        $sheet->setCellValue('E' . $rowIndex, $row['tanggal']);
        $sheet->setCellValue('F' . $rowIndex, $row['status']);
        $sheet->setCellValue('G' . $rowIndex, $row['tujuan']);
        $rowIndex++;
    }

    // Set headers to force download the file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
} else {
    echo "No data found for the specified criteria.";
}
exit();
?>
