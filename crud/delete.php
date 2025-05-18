<?php
require_once '../hewan_laut.php';

$hewan = new HewanLaut();
$id = $_GET['id'];

if ($hewan->delete($id)) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data";
}

// Di create.php dan edit.php tambahkan:
if (empty($_POST['nama']) || strlen($_POST['nama']) > 100) {
    $errors[] = "Nama hewan harus diisi dan maksimal 100 karakter";
}
?>