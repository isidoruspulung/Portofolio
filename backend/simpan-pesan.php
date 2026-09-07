<?php
// Masukkan file koneksi (naik satu folder ke root)
include '../koneksi.php';

// Cek apakah request yang masuk berasal dari form POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form dan mengamankannya dari SQL Injection
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    // Query untuk menyimpan data
    $query = "INSERT INTO messages (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    // Eksekusi query dan lempar kembali ke halaman utama dengan parameter status
    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?status=success#contact");
        exit();
    } else {
        header("Location: ../index.php?status=error#contact");
        exit();
    }
} else {
    // Jika diakses langsung tanpa lewat form
    header("Location: ../index.php");
    exit();
}
?>