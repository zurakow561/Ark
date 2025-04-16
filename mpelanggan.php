<?php
require_once 'config/koneksi.php';

class MPelanggan {
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
        return $this->conn->query("SELECT * FROM pelanggan");
    }

    public /**
 * Fungsi getById - Deskripsi fungsi ini.
 */
function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pelanggan WHERE PelangganID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public /**
 * Fungsi create - Deskripsi fungsi ini.
 */
function create($nama, $alamat, $telepon) {
        $stmt = $this->conn->prepare("INSERT INTO pelanggan (Nama, Alamat, Telepon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $alamat, $telepon);
        return $stmt->execute();
    }

    public /**
 * Fungsi update - Deskripsi fungsi ini.
 */
function update($id, $nama, $alamat, $telepon) {
        $stmt = $this->conn->prepare("UPDATE pelanggan SET Nama=?, Alamat=?, Telepon=? WHERE PelangganID=?");
        $stmt->bind_param("sssi", $nama, $alamat, $telepon, $id);
        return $stmt->execute();
    }

    public /**
 * Fungsi delete - Deskripsi fungsi ini.
 */
function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM pelanggan WHERE PelangganID=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
