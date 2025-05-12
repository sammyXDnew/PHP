<?php

require 'function.php';

if(isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah');</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }
}

$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM data_tugas WHERE id = $id");
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Tugas</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <div class="tambah-container">
        <h1>Ubah Data Tugas</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
            <div style="margin-bottom: 15px;">
                <label for="nama_tugas" style="display: block; margin-bottom: 5px;">Nama Tugas:</label>
                <input type="text" name="nama_tugas" id="nama_tugas" required
                value="<?= $row["nama_tugas"]; ?>">
            </div>
            <button type="submit" name="submit">Ubah Data</button>
        </form>
        <a href="halaman_utama.php" class="back-link" style="display: block; margin-top: 20px;">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>