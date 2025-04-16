<?php
require_once 'models/list_model.php';

class ListController {
    public /**
 * Fungsi index - Deskripsi fungsi ini.
 */
function index() {
        $model = new ListModel();
        $produk = $model->getAll();

        // Cek jika ada edit_id di URL
        $editData = null;
        if (isset($_GET['edit_id'])) {
            $editData = $model->getById($_GET['edit_id']);
        }

        include 'views/produk/list.php';
    }

    public /**
 * Fungsi store - Deskripsi fungsi ini.
 */
function store() {
        $model = new ListModel();
        $model->create($_POST['nama'], $_POST['harga'], $_POST['stok']);
        header("Location: index.php?page=list");
        exit;
    }

    public /**
 * Fungsi update - Deskripsi fungsi ini.
 */
function update() {
        $model = new ListModel();
        $model->update($_POST['id'], $_POST['nama'], $_POST['harga'], $_POST['stok']);
        header("Location: index.php?page=list");
        exit;
    }

    public /**
 * Fungsi delete - Deskripsi fungsi ini.
 */
function delete() {
        $model = new ListModel();
        $model->delete($_GET['id']);
        header("Location: index.php?page=list");
        exit;
    }
}
?>