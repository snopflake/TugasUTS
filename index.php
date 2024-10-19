<?php
// result.php
include 'db_connect.php'; // Menggunakan file dbconnect.php

// Ambil semua data dari tabel mbti_uploads
$sql = "SELECT * FROM mbti_uploads";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Simpan data ke dalam array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Tambahkan setiap baris ke array
    }
} else {
    $data = []; // Tidak ada data
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar MBTI</title>
    <style>
        /* CSS untuk tampilan */
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
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .result-card {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .result-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .result-card h3, .result-card p {
            margin: 10px 0;
        }

        .btn {
            margin-top: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .button-group {
            display: flex; /* Gunakan Flexbox */
            justify-content: center; /* Rata tengah secara horizontal */
            margin-top: 10px; /* Jarak atas */
        }

        .button-group form {
            margin-right: 10px; /* Jarak antar tombol */
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
            <li><a href="content/uploadMBTI.php">Upload MBTI</a></li>
            <li><a href="content/macamMbti.php">Macam MBTI</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Data MBTI</h2>

        <div class="grid-container">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                    <div class="result-card">
                        <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar MBTI">
                        <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                        <p>MBTI: <?php echo htmlspecialchars($row['mbti']); ?></p>
                        <div class="button-group"> <!-- Tambahkan div ini -->
                            <form action="content/update.php" method="get">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn">Update</button>
                            </form>
                            <form action="content/delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada data MBTI yang tersimpan.</p>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>
