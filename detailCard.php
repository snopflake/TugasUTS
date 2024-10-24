<?php
// detailCard.php
include 'db_connect.php'; // Menggunakan file dbconnect.php

session_start(); // Memulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak login, redirect ke halaman login
    header('Location: auth/login.html');
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data dari database berdasarkan ID
$sql = "SELECT * FROM mbti_uploads WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail MBTI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/background2.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-bottom: 5px solid transparent;
            border-image: linear-gradient(to right, #ff7f50, #ffb74d, #ffd54f, #aed581, #64b5f6, #ba68c8, #ef5350) 1;
        }

        .navbar-logo img {
            width: 50px;
            height: auto;
        }

        .navbar-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-menu li {
            margin-left: 20px;
        }

        .navbar-menu li a {
            color: black;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .navbar-menu li a:hover {
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .back-button:hover {
            background-color: #f0f0f0;
        }

        .result-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .result-card h3, .result-card p {
            margin: 10px 0;
        }

        .motto {
            font-style: italic;
            margin-top: 15px;
        }

        .motto::before, .motto::after {
            content: '"';
        }

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="uploadMBTI.php">Upload MBTI</a></li>
            <li><a href="content/macamMbti.php">Macam MBTI</a></li>
        </ul>
    </nav>

    <div class="container">
        <button class="back-button" onclick="window.location.href='index.php';">&#8592;</button>

        <h2>Detail MBTI</h2>
        <div class="result-card">
            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar MBTI">
            <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
            <p>MBTI: <?php echo htmlspecialchars($row['mbti']); ?></p>
            <p class="motto"><?php echo htmlspecialchars($row['motto']); ?></p>
        </div>
    </div>

</body>
</html>
