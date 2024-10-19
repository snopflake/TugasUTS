<?php
session_start(); // Memulai sesi

if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: ../auth/login.html");
    exit();
}

// Menyertakan file koneksi
include '../db_connect.php';

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
    <link rel="stylesheet" href="detail.css"> <!-- Hubungkan ke file CSS -->
</head>
<body>
    <header>
        <h1><?php echo $data['name']; ?></h1>
    </header>
    <main>

        <br>
        <br>

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
