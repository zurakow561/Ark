<?php
require_once 'models/mpenjualan.php';
require_once 'models/mpelanggan.php';
require_once 'models/list_model.php'; // pastikan nama class di sini adalah ListModel

class Cpenjualan {
    private $model;
    private $pelanggan;
    private $produk;

    public /**
 * Fungsi __construct - Deskripsi fungsi ini.
 */
function __construct() {
        $this->model = new Mpenjualan();
        $this->pelanggan = new Mpelanggan();
        $this->produk = new ListModel(); // sesuai dengan nama class-nya
    }

    public /**
 * Fungsi index - Deskripsi fungsi ini.
 */
function index() {
        $data['penjualan'] = $this->model->getAll();
        $data['pelanggan'] = $this->pelanggan->getAll();
        $data['produk'] = $this->produk->getAll();
        include 'views/penjualan/penjualan.php';
    }

    public /**
 * Fungsi store - Deskripsi fungsi ini.
 */
function store() {
        $produkID = $_POST['ProdukID'];
        $jumlah = $_POST['TotalBarang'];
        $produk = $this->produk->find($produkID);

        if ($jumlah > $produk['Stok']) {
            echo "<script>alert('Jumlah melebihi stok!'); window.location='index.php?page=penjualan';</script>";
            return;
        }

        $totalBayar = $jumlah * $produk['Harga'];

        $data = [
            'TanggalPenjualan' => date('Y-m-d'),
            'PelangganID' => $_POST['PelangganID'],
            'ProdukID' => $produkID,
            'TotalBarang' => $jumlah,
            'TotalPembayaran' => $totalBayar
        ];

        $this->model->insert($data);
        $this->produk->kurangiStok($produkID, $jumlah);

        header("Location: index.php?page=penjualan");
        exit();
    }
}
?>