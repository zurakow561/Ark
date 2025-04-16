<?php
require_once 'models/User.php';

class AuthController {
    public /**
 * Fungsi register - Deskripsi fungsi ini.
 */
function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $success = $user->register(
                $_POST['username'],
                $_POST['email'],
                $_POST['password']
            );

            if ($success) {
                $_SESSION['success_message'] = "Data berhasil ditambahkan";
                header("Location: index.php?page=login");
                exit;
            } else {
                $error = "Username atau Email sudah digunakan.";
            }
        }

        include 'views/auth/register.php';
    }

    public /**
 * Fungsi login - Deskripsi fungsi ini.
 */
function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $result = $user->login(
                $_POST['username'],
                $_POST['password']
            );

            if ($result) {
                $_SESSION['user'] = $result;
                header("Location: index.php?page=list");

                exit;
            } else {
                $error = "Username atau Password salah.";
            }
        }

        include 'views/auth/login.php';
    }

    public /**
 * Fungsi logout - Deskripsi fungsi ini.
 */
function logout() {
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
