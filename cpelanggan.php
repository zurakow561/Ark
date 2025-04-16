<?php
require_once 'models/mpelanggan.php';

class CPelanggan {
    public /**
 * Fungsi index - Deskripsi fungsi ini.
 */
function index() {
        $model = new MPelanggan();
        $data = $model->getAll();

        if (isset($_GET['edit_id'])) {
            $editData = $model->getById($_GET['edit_id']);
        }

        include 'views/pelanggan/pelanggan.php';
    }

    public /**
 * Fungsi store - Deskripsi fungsi ini.
 */
function store() {
        $model = new MPelanggan();
        $model->create($_POST['nama'], $_POST['alamat'], $_POST['telepon']);
        header("Location: index.php?page=pelanggan");
        exit;
    }

    public /**
 * Fungsi update - Deskripsi fungsi ini.
 */
function update() {
        $model = new MPelanggan();
        $model->update($_POST['id'], $_POST['nama'], $_POST['alamat'], $_POST['telepon']);
        header("Location: index.php?page=pelanggan");
        exit;
    }

    public /**
 * Fungsi delete - Deskripsi fungsi ini.
 */
function delete() {
        $model = new MPelanggan();
        $model->delete($_GET['id']);
        header("Location: index.php?page=pelanggan");
        exit;
    }
}
