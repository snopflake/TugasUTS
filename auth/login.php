<?php
session_start(); // Mulai sesi

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan hindari SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Gunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Jika login berhasil, simpan data user di sesi
            $_SESSION['loggedin'] = true;  // Menandakan user sudah login
            $_SESSION['username'] = $username; // Menyimpan username dalam sesi
            
            // Arahkan ke halaman homepage
            header("Location: ../index.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>
