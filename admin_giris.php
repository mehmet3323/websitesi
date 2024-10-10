<?php
session_start();

// Kendi belirlediğiniz admin bilgileri
$admin_kullanici_adi = "mehmet"; // Kullanıcı adı
$admin_sifre = "123"; // Şifre

// Giriş işlemi
if (isset($_POST['giris'])) {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Kullanıcı adı ve şifre kontrolü
    if ($kullanici_adi === $admin_kullanici_adi && $sifre === $admin_sifre) {
        $_SESSION['admin'] = $kullanici_adi;
        header("Location: admin_panel.php"); // Giriş başarılı, admin paneline yönlendir
        exit();
    } else {
        echo "<div class='error'>Giriş işlemi başarısız!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Giriş</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group input:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Giriş</h2>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="kullanici_adi" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="input-group">
                <input type="password" name="sifre" placeholder="Şifre" required>
            </div>
            <button type="submit" name="giris">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
