<?php
session_start();

// Eğer oturum değişkeni 'admin' tanımlı değilse, giriş sayfasına yönlendir.
if (!isset($_SESSION['admin'])) {
    header("Location: admin_giris.php");
    exit();
}

// Çıkış işlemi
if (isset($_GET['cikis'])) {
    session_destroy(); // Oturumu sonlandır
    header("Location: admin_giris.php"); // Giriş sayfasına yönlendir
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Paneli</title>
    <link rel="stylesheet" type="text/css" href="app.css">
    <style>
        /* Genel stil ayarları */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        /* Başlık stili */
        h1 {
            text-align: center;
            color: #04AA6D;
            margin-bottom: 20px;
            font-size: 36px;
        }

        /* Çıkış butonu stili */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff4c4c; /* Buton rengi (kırmızı) */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #e04343; /* Üzerine gelindiğinde renk değişimi */
        }

        /* Butonlar için stil ayarları */
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container h2 {
            margin: 10px 0;
        }

        /* Tablo stil ayarları */
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) { background-color: #f2f2f2; }
        #customers tr:hover { background-color: #ddd; }
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        /* Form stil ayarları */
        .form-style {
            background-color: #f9f9f9; /* Arka plan rengi */
            border-radius: 8px; /* Kenar yuvarlama */
            padding: 20px; /* İç boşluk */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Gölge efekti */
            max-width: 600px; /* Maksimum genişlik */
            margin: 20px auto; /* Merkeze alma */
        }

        .form-style input, .form-style textarea, .form-style button {
            width: 100%; /* Tüm genişliği kapla */
            padding: 10px; /* İç boşluk */
            margin: 10px 0; /* Dış boşluk */
            border: 1px solid #ccc; /* Kenar rengi */
            border-radius: 4px; /* Kenar yuvarlama */
            box-sizing: border-box; /* Kenar ve dolgu hesaplama */
        }

        .form-style input:focus, .form-style textarea:focus {
            border-color: #04AA6D; /* Odaklandığında kenar rengi */
            outline: none; /* Kenar çizgisini kaldır */
        }

        .form-style button {
            background-color: #04AA6D; /* Buton rengi */
            color: white; /* Yazı rengi */
            font-weight: bold; /* Yazı kalınlığı */
            cursor: pointer; /* İmleci el şeklinde yap */
            transition: background-color 0.3s; /* Geçiş efekti */
        }

        .form-style button:hover {
            background-color: #038d55; /* Üzerine gelindiğinde renk değişimi */
        }
    </style>
</head>
<body>
    <h1>Admin Paneli</h1>
    <a href="?cikis=true" class="logout-button">Çıkış Yap</a>

    <div class="button-container">
        <h2>Kullanıcı EKLE-SİL</h2>
        <form method="post" action="" class="form-style">
            <input type="text" name="adsoyad" placeholder="Ad Soyad" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="sifre" placeholder="Şifre" required>
            <button type="submit" name="ekle_kullanici">Ekle</button>
        </form>

        <h2>Kullanıcılar</h2>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Şifre</th>
                <th>Kayıt Tarihi</th>
                <th>İşlem</th>
            </tr>
            <?php
            include 'baglanti.php'; // Veritabanı bağlantısını dahil et
            

            // Kullanıcı ekleme
            if (isset($_POST['ekle_kullanici'])) {
                $adsoyad = $_POST['adsoyad'];
                $email = $_POST['email'];
                $sifre = $_POST['sifre'];

                // E-posta kontrolü
                $email_check = "SELECT * FROM kullanicilar WHERE email='$email'";
                $check_result = mysqli_query($baglan, $email_check);
                if (mysqli_num_rows($check_result) > 0) {
                    echo "<script>alert('Bu e-posta ile zaten bir kullanıcı mevcut. Lütfen başka bir e-posta deneyin.');</script>";
                } else {
                    $sql = "INSERT INTO kullanicilar (adsoyad, email, sifre, kayit_tarihi) VALUES ('$adsoyad', '$email', '$sifre', NOW())";
                    mysqli_query($baglan, $sql);
                }
            }

            // Kullanıcı silme
            if (isset($_GET['sil_kullanici'])) {
                $id = $_GET['sil_kullanici'];
                $sql = "DELETE FROM kullanicilar WHERE id='$id'";
                mysqli_query($baglan, $sql);
            }

            // Kullanıcıları göster
            $sec = "SELECT * FROM kullanicilar";
            $sonuc = $baglan->query($sec);

            if ($sonuc->num_rows > 0) {
                while ($cek = $sonuc->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$cek['id']."</td>
                            <td>".$cek['adsoyad']."</td>
                            <td>".$cek['email']."</td>
                            <td>".$cek['sifre']."</td>
                            <td>".$cek['kayit_tarihi']."</td>
                            <td><a href='?sil_kullanici=".$cek['id']."'>Sil</a></td>
                        </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='6'>Veri tabanında kayıtlı kullanıcı bulunmamaktadır.</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="button-container">
        <h2>Mesaj EKLE-SİL</h2>
        <form method="post" action="" class="form-style">
            <input type="text" name="adsoyad" placeholder="Ad Soyad" required>
            <input type="text" name="telefon" placeholder="Telefon" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="konu" placeholder="Konu" required>
            <textarea name="mesaj" placeholder="Mesaj" required></textarea>
            <button type="submit" name="ekle_mesaj">Ekle</button>
        </form>

        <h2>Mesajlar</h2>
        <table id="customers">
            <tr>
                <th>Ad Soyad</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Konu</th>
                <th>Mesaj</th>
                <th>İşlem</th>
            </tr>
            <?php
            // Mesaj ekleme
            if (isset($_POST['ekle_mesaj'])) {
                $adsoyad = $_POST['adsoyad'];
                $telefon = $_POST['telefon'];
                $email = $_POST['email'];
                $konu = $_POST['konu'];
                $mesaj = $_POST['mesaj'];

                $sql = "INSERT INTO iletisim (adsoyad, telefon, email, konu, mesaj) VALUES ('$adsoyad', '$telefon', '$email', '$konu', '$mesaj')";
mysqli_query($baglan, $sql);
}
        // Mesaj silme
        if (isset($_GET['sil_mesaj'])) {
            $email = $_GET['sil_mesaj'];
            $sql = "DELETE FROM iletisim WHERE email='$email'";
            mysqli_query($baglan, $sql);
        }

        // Mesajları göster
        $sec = "SELECT * FROM iletisim";
        $sonuc = $baglan->query($sec);

        if ($sonuc->num_rows > 0) {
            while ($cek = $sonuc->fetch_assoc()) {
                echo "
                    <tr>
                        <td>".$cek['adsoyad']."</td>
                        <td>".$cek['telefon']."</td>
                        <td>".$cek['email']."</td>
                        <td>".$cek['konu']."</td>
                        <td>".$cek['mesaj']."</td>
                        <td><a href='?sil_mesaj=".$cek['email']."'>Sil</a></td>
                    </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='6'>Veri tabanında kayıtlı veri bulunmamaktadır.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>