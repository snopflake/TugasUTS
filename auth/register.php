<?php
session_start(); // Mulai sesi

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Setelah registrasi berhasil, simpan username di sesi (opsional)
        $_SESSION['username'] = $username;

        // Arahkan ke index.html
        header("Location: login.html");
        exit(); // Pastikan script berhenti di sini
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
