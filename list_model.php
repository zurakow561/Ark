<?php
require_once 'config/koneksi.php';

class ListModel {
    private $conn;

    public /**
 * Fungsi __construct - Deskripsi fungsi ini.
 */
function __construct() {
        $db = new Koneksi();
        $this->conn = $db->getConnection();
    }

    public /**
 * Fungsi getAll - Deskripsi fungsi ini.
 */
function getAll() {
        return $this->conn->query("SELECT * FROM produk");
    }

    public /**
 * Fungsi getById - Deskripsi fungsi ini.
 */
function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE ProdukID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public /**
 * Fungsi create - Deskripsi fungsi ini.
 */
function create($nama, $harga, $stok) {
        $stmt = $this->conn->prepare("INSERT INTO produk (NamaProduk, Harga, Stok) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $nama, $harga, $stok);
        return $stmt->execute();
    }

    public /**
 * Fungsi update - Deskripsi fungsi ini.
 */
function update($id, $nama, $harga, $stok) {
        $stmt = $this->conn->prepare("UPDATE produk SET NamaProduk = ?, Harga = ?, Stok = ? WHERE ProdukID = ?");
        $stmt->bind_param("sdii", $nama, $harga, $stok, $id);
        return $stmt->execute();
    }

    public /**
 * Fungsi delete - Deskripsi fungsi ini.
 */
function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM produk WHERE ProdukID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public /**
 * Fungsi find - Deskripsi fungsi ini.
 */
function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE ProdukID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public /**
 * Fungsi updateStok - Deskripsi fungsi ini.
 */
function updateStok($id, $stokBaru) {
        $stmt = $this->conn->prepare("UPDATE produk SET Stok = ? WHERE ProdukID = ?");
        $stmt->bind_param("ii", $stokBaru, $id);
        $stmt->execute();
    }

    public /**
 * Fungsi kurangiStok - Deskripsi fungsi ini.
 */
function kurangiStok($id, $jumlah) {
        $stmt = $this->conn->prepare("UPDATE produk SET Stok = Stok - ? WHERE ProdukID = ?");
        $stmt->bind_param("ii", $jumlah, $id);
        $stmt->execute();
    }
}
?>