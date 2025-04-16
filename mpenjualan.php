<?php
require_once 'config/koneksi.php';

class Mpenjualan {
    private $conn;

    public /**
 * Fungsi __construct - Deskripsi fungsi ini.
 */
function __construct() {
        $this->conn = (new Koneksi())->getConnection();
    }

    public /**
 * Fungsi getAll - Deskripsi fungsi ini.
 */
function getAll() {
        $sql = "SELECT penjualan.*, pelanggan.Nama, produk.NamaProduk 
                FROM penjualan
                JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID
                JOIN produk ON penjualan.ProdukID = produk.ProdukID";
        return $this->conn->query($sql);
    }

    public /**
 * Fungsi insert - Deskripsi fungsi ini.
 */
function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO penjualan (TanggalPenjualan, PelangganID, ProdukID, TotalBarang, TotalPembayaran)
                                      VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiid", $data['TanggalPenjualan'], $data['PelangganID'], $data['ProdukID'], $data['TotalBarang'], $data['TotalPembayaran']);
        return $stmt->execute();
    }
}
?>