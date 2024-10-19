<?php
include 'db_connect.php'; // Menggunakan file dbconnect.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Hapus data dari tabel mbti_uploads
    $sql = "DELETE FROM mbti_uploads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: result.php"); // Kembali ke halaman result setelah operasi
exit();
?>
