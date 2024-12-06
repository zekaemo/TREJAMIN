<?php
require_once 'class/Surat.php';

class SuratMasuk extends Surat {
    private $tujuan;
    private $keyword;
    private $status;
    private $bulan_tahun;
    private $page;

    // Konstruktor
    public function __construct($conn, $tujuan = '', $keyword = '', $status = '', $bulan_tahun = '', $page = 1, $selectedDate = null) {
        parent::__construct($conn, $selectedDate);
        $this->tujuan = $tujuan;
        $this->keyword = $keyword;
        $this->status = $status;
        $this->bulan_tahun = $bulan_tahun;
        $this->page = $page;
    }

    // Menambahkan surat masuk
    public function addSurat($data) {
        $stmt = $this->conn->prepare("INSERT INTO surat_masuk (kategori, no_surat, tanggal_kirim, perihal, asal_surat, tujuan, no_pengiriman, no_resi, file_data, file_name, file_type, file_size) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind data dan eksekusi
        $stmt->bind_param("ssssssssbsss", $data['kategori'], $data['no_surat'], $data['tanggal_kirim'], $data['perihal'], 
                         $data['asal'], $data['tujuan'], $data['no_kirim'], $data['no_resi'], $data['fileData'], $data['fileName'], 
                         $data['fileType'], $data['fileSize']);

        return $stmt->execute();
    }

    // Mendapatkan surat masuk berdasarkan filter dan pagination
    public function getSurat($filters = []) {
        $offset = ($this->page - 1) * $this->limit;
        $sql = "SELECT sm.*, sr.status, sr.tanggal 
                FROM surat_masuk sm 
                LEFT JOIN (
                    SELECT no_disposisi, MAX(tanggal) AS tanggal
                    FROM status_riwayat
                    GROUP BY no_disposisi
                ) AS sr_filtered ON sm.no_disposisi = sr_filtered.no_disposisi
                LEFT JOIN status_riwayat sr ON sr.no_disposisi = sr_filtered.no_disposisi AND sr.tanggal = sr_filtered.tanggal
                WHERE 1=1";

        // Apply filters if provided
        if (!empty($filters['keyword'])) {
            $sql .= " AND (asal LIKE '%{$filters['keyword']}%' OR perihal LIKE '%{$filters['keyword']}%')";
        }
        if (!empty($filters['tujuan'])) {
            $sql .= " AND tujuan = '{$filters['tujuan']}'";
        }
        if (!empty($filters['status'])) {
            $sql .= " AND sr.status = '{$filters['status']}'";
        }
        if (!empty($filters['bulan_tahun'])) {
            $sql .= " AND DATE_FORMAT(tanggal_masuk, '%Y-%m') = '{$filters['bulan_tahun']}'";
        }

        // Query for total surat
        $result_count = $this->conn->query($sql);
        $total_surat = $result_count->num_rows;
        $total_pages = ceil($total_surat / $this->limit);

        // Limit & offset for pagination
        $sql .= " ORDER BY sm.no_disposisi LIMIT {$this->limit} OFFSET {$offset}";
        $result = $this->conn->query($sql);
        
        return [$result, $total_pages];
    }

    // Mengambil total surat masuk berdasarkan filter (fungsi yang diminta)
    public function getTotalSuratMasuk($filters = []) {
        $sql = "SELECT COUNT(*) AS total FROM surat_masuk sm 
                LEFT JOIN status_riwayat sr ON sm.no_disposisi = sr.no_disposisi
                WHERE 1=1";

        if (!empty($filters['keyword'])) {
            $sql .= " AND (asal LIKE '%{$filters['keyword']}%' OR perihal LIKE '%{$filters['keyword']}%')";
        }
        if (!empty($filters['tujuan'])) {
            $sql .= " AND tujuan = '{$filters['tujuan']}'";
        }
        if (!empty($filters['status'])) {
            $sql .= " AND sr.status = '{$filters['status']}'";
        }
        if (!empty($filters['bulan_tahun'])) {
            $sql .= " AND DATE_FORMAT(tanggal_masuk, '%Y-%m') = '{$filters['bulan_tahun']}'";
        }

        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Mengambil total halaman untuk pagination
    public function getTotalPages() {
        $sql = "SELECT COUNT(*) AS total FROM surat_masuk";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return ceil($row['total'] / $this->limit);
    }

    // Mengambil data surat harian
    public function getDataHarian() {
        $sql = "SELECT DAY(tanggal_masuk) as hari, COUNT(*) as jumlah 
                FROM surat_masuk 
                WHERE MONTH(tanggal_masuk) = MONTH('{$this->selectedDate}-01') 
                AND YEAR(tanggal_masuk) = YEAR('{$this->selectedDate}-01') 
                GROUP BY hari";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['hari']] = (int)$row['jumlah'];
        }
        return $data;
    }
}
?>
