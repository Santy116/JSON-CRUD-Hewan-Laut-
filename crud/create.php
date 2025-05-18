<?php
require_once 'hewan_laut.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hewan = new HewanLaut();
    $data = [
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'habitat' => $_POST['habitat'],
        'deskripsi' => $_POST['deskripsi']
    ];
    
    if ($hewan->create($data)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambahkan data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hewan Laut</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>TAMBAH HEWAN LAUT</h1>
        <a href="index.php" class="btn">Kembali</a>
        
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama Hewan</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">Pilih Jenis</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Moluska">Moluska</option>
                        <option value="Reptil">Reptil</option>
                        <option value="Mamalia">Mamalia</option>
                        <option value="Krustasea">Krustasea</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="habitat">Habitat</label>
                    <input type="text" id="habitat" name="habitat" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>