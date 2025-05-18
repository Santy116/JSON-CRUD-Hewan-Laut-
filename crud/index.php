<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hewan Laut</title>
    <style>
        :root {
            --color-bg: #F0FAFB;
            --color-primary: #5BA4CF;
            --color-secondary: #A3DFF2;
            --color-accent: #D1F1F9;
            --color-text: #123E52;
            --color-muted: #6B90A0;
            --color-border: #C8E4EC;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: var(--color-primary);
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--color-secondary);
            padding-bottom: 10px;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: var(--color-primary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #4a8db8;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--color-border);
        }
        
        th {
            background-color: var(--color-secondary);
            color: var(--color-text);
        }
        
        tr:hover {
            background-color: var(--color-accent);
        }
        
        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
        }
        
        .edit-btn {
            background-color: var(--color-primary);
            color: white;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: var(--color-text);
            font-weight: 500;
        }
        
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--color-border);
            border-radius: 4px;
            font-size: 16px;
        }
        
        textarea {
            height: 100px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .submit-btn:hover {
            background-color: #4a8db8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>DATA HEWAN LAUT</h1>
        <a href="create.php" class="btn">Tambah Hewan Laut</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Habitat</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'hewan_laut.php';
                $hewan = new HewanLaut();
                $dataHewan = $hewan->getAll();
                $no = 1;
                
                foreach ($dataHewan as $data) {
                    echo "<tr>
                            <td>$no</td>
                            <td>{$data['nama']}</td>
                            <td>{$data['jenis']}</td>
                            <td>{$data['habitat']}</td>
                            <td>{$data['deskripsi']}</td>
                            <td>
                                <a href='edit.php?id={$data['id']}' class='action-btn edit-btn'>Edit</a>
                                <a href='delete.php?id={$data['id']}' class='action-btn delete-btn' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Hapus</a>
                            </td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>