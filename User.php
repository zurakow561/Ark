<?php
require_once 'config/koneksi.php';

class User {
    private $conn;

    public /**
 * Fungsi __construct - Deskripsi fungsi ini.
 */
function __construct() {
        $database = new Koneksi();
        $this->conn = $database->getConnection();
    }

    // Cek apakah username atau email sudah ada
    public /**
 * Fungsi isExist - Deskripsi fungsi ini.
 */
function isExist($username, $email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Register user baru
    public /**
 * Fungsi register - Deskripsi fungsi ini.
 */
function register($username, $email, $password) {
        if ($this->isExist($username, $email)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hash);
        return $stmt->execute();
    }

    // Proses login user
    public /**
 * Fungsi login - Deskripsi fungsi ini.
 */
function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }

        return false;
    }
}
