<?php
require_once '../hewan_laut.php'; // Pastikan path ini benar sesuai struktur folder kamu

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hewan = new HewanLaut();
    $data = [
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

    // Jika tidak ada error, proses penyimpanan
    if (empty($errors)) {
        if ($hewan->create($data)) {
            header("Location: ../index.php?status=success&action=create");
            exit();
        } else {
            $errors[] = "Gagal menambahkan data";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hewan Laut</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #F0FAFB; color: #123E52; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); padding: 30px; }
        h1 { color: #5BA4CF; text-align: center; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 8px 15px; background: #5BA4CF; color: #fff; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .btn:hover { background: #4a8db8; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-container { margin-top: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], textarea, select { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #C8E4EC; border-radius: 4px; }
        textarea { resize: vertical; }
        input[type="submit"] { background: #5BA4CF; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        input[type="submit"]:hover { background: #4a8db8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>TAMBAH HEWAN LAUT</h1>
        <a href="../index.php" class="btn">Kembali</a>

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
                <label for="nama">Nama Hewan Laut</label>
                <input type="text" name="nama" id="nama" maxlength="100" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>" required>

                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Ikan" <?= (isset($_POST['jenis']) && $_POST['jenis'] == 'Ikan') ? 'selected' : '' ?>>Ikan</option>
                    <option value="Mamalia" <?= (isset($_POST['jenis']) && $_POST['jenis'] == 'Mamalia') ? 'selected' : '' ?>>Mamalia</option>
                    <option value="Moluska" <?= (isset($_POST['jenis']) && $_POST['jenis'] == 'Moluska') ? 'selected' : '' ?>>Moluska</option>
                    <option value="Krusta" <?= (isset($_POST['jenis']) && $_POST['jenis'] == 'Krusta') ? 'selected' : '' ?>>Krusta</option>
                    <option value="Lainnya" <?= (isset($_POST['jenis']) && $_POST['jenis'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                </select>

                <label for="habitat">Habitat</label>
                <input type="text" name="habitat" id="habitat" value="<?= isset($_POST['habitat']) ? htmlspecialchars($_POST['habitat']) : '' ?>" required>

                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"><?= isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : '' ?></textarea>

                <input type="submit" value="Simpan">
            </form>
        </div>
    </div>
</body>
</html>