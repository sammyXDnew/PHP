<?php

require 'function.php';
$conn = mysqli_connect("localhost", "root", "", "data_tugas");

if(isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tugas</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <div class="tambah-container">
        <h1>Tambah Data Tugas</h1>
        <form action="" method="post">
            <div style="margin-bottom: 15px;">
                <label for="nama_tugas" style="display: block; margin-bottom: 5px;">Nama Tugas:</label>
                <input type="text" name="nama_tugas" id="nama_tugas" required>
            </div>
            <button type="submit" name="submit">Tambah Data</button>
        </form>
        <a href="halaman_utama.php" class="back-link" style="display: block; margin-top: 20px;">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>