<?php
require_once 'hewan_laut.php';

$hewan = new HewanLaut();
$id = $_GET['id'];
$data = $hewan->getById($id)[0];
$errors = []; // Inisialisasi array untuk menyimpan error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'habitat' => $_POST['habitat'],
        'deskripsi' => $_POST['deskripsi']
    ];
    
    // VALIDASI INPUT
    if (empty($_POST['nama']) || strlen($_POST['nama']) > 100) {
        $errors[] = "Nama hewan harus diisi dan maksimal 100 karakter";
    }
    
    if (empty($_POST['jenis'])) {
        $errors[] = "Jenis hewan harus dipilih";
    }
    
    if (empty($_POST['habitat'])) {
        $errors[] = "Habitat hewan harus diisi";
    }
    
    // Jika tidak ada error, proses update
    if (empty($errors)) {
        if ($hewan->update($id, $updatedData)) {
            header("Location: index.php?status=success&action=update");
            exit();
        } else {
            $errors[] = "Gagal mengupdate data";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bagian head tetap sama -->
</head>
<body>
    <div class="container">
        <h1>EDIT HEWAN LAUT</h1>
        <a href="index.php" class="btn">Kembali</a>
        
        <!-- Tampilkan error jika ada -->
        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="form-container">
            <form method="POST">
                <!-- Bagian form tetap sama -->
            </form>
        </div>
    </div>
</body>
</html>