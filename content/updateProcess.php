<?php
// Menghubungkan ke database
include '../db_connect.php'; // Menggunakan file dbconnect.php

// Proses ketika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $mbti = $_POST['mbti'];

    // Cek jika ada gambar baru yang diupload
    if ($_FILES['gambar']['name']) {
        // Proses upload file gambar
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/"; // direktori untuk menyimpan gambar
        $target_file = $target_dir . basename($gambar);

        // Pastikan direktori 'uploads' ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Membuat direktori jika belum ada
        }

        // Pindahkan file gambar ke direktori yang ditentukan
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Update data ke database dengan gambar baru
            $sql = "UPDATE mbti_uploads SET nama = ?, mbti = ?, gambar = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nama, $mbti, $target_file, $id);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        // Update data tanpa mengubah gambar
        $sql = "UPDATE mbti_uploads SET nama = ?, mbti = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nama, $mbti, $id);
    }

    if ($stmt->execute()) {
        // Redirect ke halaman hasil
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
