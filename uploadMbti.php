<?php

session_start(); // Memulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak login, redirect ke halaman login
    header('Location: auth/login.html');
    exit;
}

// Menghubungkan ke database
include 'db_connect.php'; // Menggunakan file dbconnect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $mbti = $_POST['mbti'];
    $motto = $_POST['motto'];  // Ambil nilai motto

    // Proses upload file gambar (seperti sebelumnya)
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($gambar);
    
    // Pastikan direktori 'uploads' ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); 
    }
    
    // Validasi file gambar
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        exit();
    }
    if ($_FILES['gambar']['size'] > 5000000) {
        echo "Maaf, ukuran file terlalu besar.";
        exit();
    }
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        exit();
    }

    // Pindahkan file dan simpan data ke database
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        // Simpan ke database termasuk motto
        $sql = "INSERT INTO mbti_uploads (nama, mbti, gambar, motto) VALUES ('$nama', '$mbti', '$target_file', '$motto')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php?id=" . $conn->insert_id);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white; /* Warna latar navbar */
            padding: 10px;
            border-bottom: 5px solid transparent; /* Untuk border gradasi di bawah */
            border-image: linear-gradient(to right, #ff7f50, #ffb74d, #ffd54f, #aed581, #64b5f6, #ba68c8, #ef5350) 1; /* Gradasi pelangi lembut */
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
            color: black; /* Tulisan hitam */
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .navbar-menu li a:hover {
            background-color: #f0f0f0; /* Warna latar saat hover */
        }

        .beranda {
            flex: 1;
            position: relative;
            text-align: center;
            color: white; /* Warna tulisan di konten */
            overflow: hidden;
        }

        .beranda img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.8; /* Mengatur opasitas gambar */
            z-index: 1;
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 35px; /* Menambah padding untuk kontainer lebih panjang */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 100px auto 0; /* Center horizontally */
            position: relative;
            top: 40%; /* Bawa kontainer lebih ke bawah */
            z-index: 3; /* Pastikan di atas gambar */
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black; /* Judul hitam */
        }

        .form-container textarea {
            width: 100%; /* Lebar textarea sama dengan input lain */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical; /* Mengizinkan pengguna memperbesar ukuran vertikal */
        }


        .form-group {
            margin-bottom: 15px; /* Jarak antara grup input */
        }

        .form-group label {
            display: block; /* Membuat label menjadi block untuk memudahkan penataan */
            margin-bottom: 5px; /* Jarak antara label dan input */
            color: black; /* Warna label hitam */
            text-align: left; /* Rata kiri */
        }

        .form-container input[type="text"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container input[type="submit"] {
            background-color: #66bb6a; /* Warna hijau soft */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .form-container input[type="submit"]:hover {
            background-color: #57a95b; /* Warna hijau lebih gelap saat hover */
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
            <li><a href="#">Upload MBTI</a></li>
            <li><a href="content/macammbti.php">Macam MBTI</a></li>
        </ul>
    </nav>

    <section class="beranda">
        <img src="images/background2.png" alt="Background Image"> <!-- Ganti dengan path gambar yang sesuai -->

        <div class="form-container">
            <h2>Upload Data MBTI</h2> <!-- Judul di atas kolom -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="mbti">Tipe MBTI</label>
                    <input type="text" id="mbti" name="mbti" placeholder="Masukkan Tipe MBTI" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Unggah Gambar</label>
                    <input type="file" id="gambar" name="gambar" required>
                </div>
                <div class="form-group">
                    <label for="motto">Motto Hidup</label>
                    <textarea id="motto" name="motto" placeholder="Masukkan Motto Hidup" rows="4" required></textarea>
                </div>


                <input type="submit" value="Simpan">
            </form>
        </div>
    </section>

</body>
</html>
