<?php

abstract class Surat {
    protected $conn;
    protected $selectedDate;
    protected $limit = 10;

    // Konstruktor untuk inisialisasi variabel
    public function __construct($conn, $selectedDate = null) {
        $this->conn = $conn;
        $this->selectedDate = $selectedDate ? $selectedDate : date('Y-m');
    }

    // Metode abstrak untuk diturunkan pada class turunannya
    abstract public function addSurat($data);
    abstract public function getSurat($filters = []);
    abstract public function getTotalPages();
    abstract public function getDataHarian();

    // Metode untuk mendapatkan file extension dari MIME type
    protected function getExtensionFromMimeType($mimeType) {
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
}
?>
