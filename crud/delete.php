<?php
require_once 'hewan_laut.php';

$hewan = new HewanLaut();
$id = $_GET['id'];

if ($hewan->delete($id)) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data";
}
?>