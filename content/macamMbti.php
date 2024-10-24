<?php

session_start(); // Memulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak login, redirect ke halaman login
    header('Location: auth/login.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>16 Tipe Kepribadian MBTI</title>
    <link rel="stylesheet" href="homepage.css"> <!-- Link ke CSS untuk styling -->
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

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.7); /* Lebih redup */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Menjadi 2 kolom */
            gap: 20px;
        }

        .grid-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .grid-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .grid-item span {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        footer {
            margin-top: 20px;
        }

        footer p {
            color: #777;
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

    <div class="container">
        <main>
            <section class="personality-types">
                <div class="grid-container">
                    <div class="grid-item">
                        <a href="detail.php?type=INTJ">
                            <img src="../images/INTJ.png" alt="INTJ - Arsitek">
                            <span>INTJ - Arsitek</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=INTP">
                            <img src="../images/INTP.png" alt="INTP - Logician">
                            <span>INTP - Logician</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ENTJ">
                            <img src="../images/ENTJ.png" alt="ENTJ - Commander">
                            <span>ENTJ - Commander</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ENTP">
                            <img src="../images/ENTP.png" alt="ENTP - Debater">
                            <span>ENTP - Debater</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=INFJ">
                            <img src="../images/INFJ.png" alt="INFJ - Advocate">
                            <span>INFJ - Advocate</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=INFP">
                            <img src="../images/INFP.png" alt="INFP - Mediator">
                            <span>INFP - Mediator</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ENFJ">
                            <img src="../images/ENFJ.png" alt="ENFJ - Protagonist">
                            <span>ENFJ - Protagonist</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ENFP">
                            <img src="../images/ENFP.png" alt="ENFP - Campaigner">
                            <span>ENFP - Campaigner</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ESTJ">
                            <img src="../images/ESTJ.png" alt="ESTJ - Executive">
                            <span>ESTJ - Executive</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ESFJ">
                            <img src="../images/ESFJ.png" alt="ESFJ - Consul">
                            <span>ESFJ - Consul</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ISFJ">
                            <img src="../images/ISFJ.png" alt="ISFJ - Defender">
                            <span>ISFJ - Defender</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ISTJ">
                            <img src="../images/ISTJ.png" alt="ISTJ - Logistician">
                            <span>ISTJ - Logistician</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ISFP">
                            <img src="../images/ISFP.png" alt="ISFP - Adventurer">
                            <span>ISFP - Adventurer</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ESFP">
                            <img src="../images/ESFP.png" alt="ESFP - Entertainer">
                            <span>ESFP - Entertainer</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ISTP">
                            <img src="../images/ISTP.png" alt="ISTP - Virtuoso">
                            <span>ISTP - Virtuoso</span>
                        </a>
                    </div>
                    <div class="grid-item">
                        <a href="detail.php?type=ESTP">
                            <img src="../images/ESTP.png" alt="ESTP - Entrepreneur">
                            <span>ESTP - Entrepreneur</span>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <p>&copy; 2024 MBTI Personality Types</p>
            <p>Images by twitter/@7Hrang & Website by Nofa Anak Filkom~</p>
        </footer>
    </div>

</body>
</html>
