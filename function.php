<?php
$conn = mysqli_connect("localhost", "root", "", "data_tugas");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    $nama_tugas = htmlspecialchars($data["nama_tugas"]);

    $query = "INSERT INTO data_tugas VALUES ('', '$nama_tugas' , 'Belum Selesai')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM data_tugas WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    $id = $data["id"];
    $nama_tugas = htmlspecialchars($data["nama_tugas"]);

    $result = mysqli_query($conn, "SELECT status FROM data_tugas WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $status = $row["status"];

    if ($status === "Selesai") {
        $status = "Belum Selesai";
    }

    $query = "UPDATE data_tugas SET
                nama_tugas = '$nama_tugas',
                status = '$status'
            WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function status($id) {
    global $conn;

    $query = "UPDATE data_tugas SET status = 'Selesai' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function getStatus($id) {
    global $conn;
    $query = "SELECT status FROM data_tugas WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['status'];
}

function register($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'"))) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>