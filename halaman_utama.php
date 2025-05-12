<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
require 'function.php';

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';
$query = $keyword
    ? "SELECT * FROM data_tugas WHERE nama_tugas LIKE '%$keyword%'"
    : "SELECT * FROM data_tugas";
$tugas = query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <div class="halaman-utama-container" style="width: 80%; margin: 0 auto;">
        <header style="text-align: center; margin-bottom: 20px; display: flex; justify-content: center; align-items: center; gap: 20px;">
            <img src="Screenshot (377).png" alt="User Image" style="width: 70px; height: 70px; border-radius: 70%;">
            <h1>Selamat Datang <?= htmlspecialchars($username); ?>, <?= htmlspecialchars($password); ?></h1>
        </header>
        <h1 style="text-align: center;">Daftar Tugas</h1>
        <div class="search-container" style="margin-bottom: 20px; text-align: center;">
            <form action="" method="get" style="display: inline-block; width: 100%;">
                <input type="text" name="keyword" placeholder="Cari tugas..." 
                    style="padding: 10px; width: 60%; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px;">
                <button type="submit" 
                    style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Cari
                </button>
            </form>
        </div>
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="tambah.php" 
                style="padding: 10px 20px; background-color: #28A745; color: white; text-decoration: none; border-radius: 5px;">
                Tambah Tugas
            </a>
        </div>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Nama Tugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach( $tugas as $row) :?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin mau diubah?');">ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin mau dihapus?');">hapus</a> |
                        <?php if ($row["status"] === "Selesai"): ?>
                            <button disabled>Selesai</button>
                        <?php else: ?>
                            <a href="status.php?id=<?= $row["id"]; ?>" onclick="return confirm('Tandai selesai?');"><button>Selesai</button></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $row["nama_tugas"]; ?></td>
                    <td><?= $row["status"]; ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <a href="logout.php" 
                style="padding: 10px 20px; background-color: #DC3545; color: white; text-decoration: none; border-radius: 5px;">
                Logout
            </a>
        </div>
    </div>
</body>
</html>