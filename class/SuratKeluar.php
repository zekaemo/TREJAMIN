<?php
require_once 'class/Surat.php';

class SuratKeluar extends Surat {
    private $kategori;
    private $no_surat;
    private $tanggal_kirim;
    private $perihal;
    private $asal;
    private $tujuan;
    private $no_kirim;
    private $no_resi;
    private $fileData;
    private $fileName;
    private $fileType;
    private $fileSize;
    private $page;


    public function __construct($conn, $selectedDate = null) {
        parent::__construct($conn, $selectedDate);
    }

    public function addSurat($data) {
        $stmt = $this->conn->prepare("INSERT INTO surat_keluar (kategori, no_sukel, tanggal_kirim, perihal, asal_surat, tujuan, no_pengiriman, no_resi, file_data, file_name, file_type, file_size) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssbsss", $data['kategori'], $data['no_surat'], $data['tanggal_kirim'], $data['perihal'], 
                         $data['asal'], $data['tujuan'], $data['no_kirim'], $data['no_resi'], $data['fileData'], 
                         $data['fileName'], $data['fileType'], $data['fileSize']);
        
        return $stmt->execute();
    }

    public function getSurat($filters = []) {
        $offset = ($this->page - 1) * $this->limit;
        $sql = "SELECT * FROM surat_keluar WHERE 1=1";

        // Apply filters
        if (!empty($filters['keyword'])) {
            $sql .= " AND (no_sukel LIKE '%{$filters['keyword']}%' OR perihal LIKE '%{$filters['keyword']}%')";
        }
        if (!empty($filters['kategori'])) {
            $sql .= " AND kategori = '{$filters['kategori']}'";
        }
        if (!empty($filters['bulan_tahun'])) {
            $sql .= " AND DATE_FORMAT(tanggal_kirim, '%Y-%m') = '{$filters['bulan_tahun']}'";
        }

        // Pagination logic
        $sql .= " LIMIT {$this->limit} OFFSET {$offset}";

        $result = $this->conn->query($sql);
        return $result;
    }

    public function getTotalPages() {
        $sql = "SELECT COUNT(*) AS total FROM surat_keluar";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return ceil($row['total'] / $this->limit);
    }

    public function getDataHarian() {
        $sql = "SELECT DAY(tanggal_kirim) as hari, COUNT(*) as jumlah 
                FROM surat_keluar 
                WHERE MONTH(tanggal_kirim) = MONTH('{$this->selectedDate}-01') 
                AND YEAR(tanggal_kirim) = YEAR('{$this->selectedDate}-01') 
                GROUP BY hari";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['hari']] = (int)$row['jumlah'];
        }
        return $data;
    }
    public function getTotalSuratKeluar($filters = []) {
        $sql = "SELECT COUNT(*) AS total FROM surat_keluar WHERE 1=1";

        // Apply filters
        if (!empty($filters['keyword'])) {
            $sql .= " AND (no_sukel LIKE '%{$filters['keyword']}%' OR perihal LIKE '%{$filters['keyword']}%')";
        }
        if (!empty($filters['kategori'])) {
            $sql .= " AND kategori = '{$filters['kategori']}'";
        }
        if (!empty($filters['bulan_tahun'])) {
            $sql .= " AND DATE_FORMAT(tanggal_kirim, '%Y-%m') = '{$filters['bulan_tahun']}'";
        }

        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

}
?>
