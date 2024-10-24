<?php
// Menyertakan file koneksi
include '../db_connect.php';

session_start(); // Memulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak login, redirect ke halaman login
    header('Location: auth/login.html');
    exit;
}

// Mendapatkan tipe kepribadian dari URL
$type = $_GET['type'];

// Query untuk mengambil data dari tabel mbti_types
$sql = "SELECT * FROM mbti_types WHERE type = '$type'";
$result = $conn->query($sql);

// Cek apakah data ditemukan
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc(); // Mengambil data sebagai array asosiatif
} else {
    echo "Tipe kepribadian tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../images/background2.png');
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

        header {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #333;
        }

        main {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .mbti-title {
            font-size: 1.5rem; /* Ukuran font tidak terlalu besar */
            color: black; 
            margin-bottom: 10px; /* Memberikan sedikit jarak ke gambar */
        }

        img {
            width: 50%;
            height: auto;
            border-radius: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .famous-characters {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .famous-character {
            font-style: italic;
            font-size: 1.1rem;
            color: #2c3e50;
            width: 30%;
            text-align: center;
        }

        footer {
            margin-top: 20px;
        }

        footer a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        footer a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><img src="../images/logo.png" alt="Logo"></a>
        </div>
        <ul class="navbar-menu">
            <li><a href="../index.php">Beranda</a></li>
            <li><a href="../uploadMBTI.php">Upload MBTI</a></li>
            <li><a href="macamMbti.php">Macam MBTI</a></li>
        </ul>
    </nav>

    <main>
        <h1 class="mbti-title"><?php echo $data['name']; ?></h1> <!-- Judul di atas gambar -->
        <img src="<?php echo $data['image']; ?>" alt="<?php echo $data['name']; ?>">
        <p><?php echo $data['description']; ?></p>

        <h3>Karakter Terkenal</h3>
        <div class="famous-characters">
            <?php 
            // Pisahkan karakter terkenal berdasarkan koma
            $famous_characters = explode(',', $data['famous_characters']);
            foreach ($famous_characters as $character) {
                echo "<div class='famous-character'>" . trim($character) . "</div>";
            }
            ?>
        </div>

        <footer>
            <a href="../index.php">Kembali ke Homepage</a>
        </footer>
    </main>

</body>
</html>
