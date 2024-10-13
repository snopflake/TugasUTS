<?php
session_start(); // Mulai sesi

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek data user di database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Jika login berhasil, simpan data user di sesi
            $_SESSION['username'] = $username; // Menyimpan username dalam sesi
            // Arahkan ke halaman homepage
            header("Location: homepage.html");
            exit(); // Berhenti di sini
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }

    $conn->close();
}
?>
