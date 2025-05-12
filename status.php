<?php
require 'function.php';

$id = $_GET['id'];

if (status($id) > 0) {
    echo "
        <script>
            alert('Status berhasil diubah!');
            document.location.href = 'halaman_utama.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Status gagal diubah!');
            document.location.href = 'halaman_utama.php';
        </script>
    ";
}
?>