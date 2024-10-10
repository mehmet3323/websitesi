
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı İşlemleri</title>
    <style>
        body {
            background-image: url('wep_resim/kutuphane.jpg'); 
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container input[type="text"], .container input[type="password"], .container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #218838;
        }
        .container .back-button, .container .login-button {
            background-color: #6c757d;
        }
        .container .back-button:hover, .container .login-button:hover {
            background-color: #5a6268;
        }
        .container .forgot-password, .container .account-exist {
            text-align: center;
            margin-top: 10px;
        }
        .container .forgot-password a, .container .account-exist a {
            color: #007bff;
            text-decoration: none;
            cursor: pointer;
        }
        .container .forgot-password a:hover, .container .account-exist a:hover {
            text-decoration: underline;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .hidden {
            display: none;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Gerekli kütüphaneler
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

    session_start();
    $error_message = ""; // Hata mesajı için değişken

    // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";  // Veritabanı kullanıcı adınız
    $password = "";      // Veritabanı şifreniz
    $dbname = "paylastikca";   // Veritabanı adınız

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Kayıt olma işlemi
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO kayitol (kullanici_adi, sifre, eposta) VALUES ('$username', '$password', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Kayıt başarılı!');</script>";
        } else {
            $error_message = "Hata: " . $conn->error;
        }
    }



// Giriş yapma işlemi
if (isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    // kayitol tablosunu kontrol et
    $sql = "SELECT * FROM kayitol WHERE kullanici_adi = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['sifre'])) {
            // Giriş başarılı, kullanıcı adını oturumda sakla
            $_SESSION['kullanici_adi'] = $username;
            header("Location: kitaplar.php");
            exit();
        } else {
            $error_message = "Şifre yanlış!";
        }
    } else {
        // kullanicilar tablosunu kontrol et
        $sql = "SELECT * FROM kullanicilar WHERE adsoyad = '$username' AND sifre = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Giriş başarılı, kullanıcı adını oturumda sakla
            $_SESSION['kullanici_adi'] = $username;
            header("Location: kitaplar.php");
            exit();
        } else {
            $error_message = "Kullanıcı adı veya şifre yanlış!";
        }
    }
}

    



    // Şifre sıfırlama (kod gönderme) işlemi
if (isset($_POST['send_code'])) {
    $email = $_POST['email'];

    // E-posta doğrulaması
    $sql = "SELECT * FROM kayitol WHERE eposta = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 6 haneli rastgele bir kod oluştur
        $reset_code = rand(100000, 999999);

        // PHPMailer ile e-posta gönderme
        if (sendResetCode($email, $reset_code)) {
           
            $_SESSION['reset_code'] = $reset_code;
            $_SESSION['email'] = $email;
            echo "<script>alert('Kod gönderildi!');</script>";
        } else {
            echo "<script>alert('Kod gönderilemedi!');</script>";
        }
    } else {
        echo "<script>alert('Bu e-posta adresi kayıtlı değil!');</script>";
    }
}


    // Şifre sıfırlama (doğrulama ve güncelleme) işlemi
   
if (isset($_POST['validate_code'])) {
  
    $entered_code = $_POST['code'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    if ($entered_code == $_SESSION['reset_code']) {
        $email = $_SESSION['email'];

        $sql = "UPDATE kayitol SET sifre = '$new_password' WHERE eposta = '$email'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Şifre başarıyla güncellendi!');</script>";
            session_unset();
            session_destroy();
        } else {
            echo "<script>alert('Hata: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Doğrulama kodu yanlış!');</script>";
    }
}

    $conn->close();

   function sendResetCode($to, $reset_code) {
    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPKeepAlive=true;
        $mail->SMTPSecure='tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'cagataysavun@gmail.com'; 
        $mail->Password = 'uspr aeii kcwq wgzv'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Alıcı bilgileri
        $mail->setFrom('cagataysavun@gmail.com', 'Çağatay Savun');
        $mail->addAddress($to);

        // İçerik
        $mail->isHTML(true);
        $mail->Subject = 'Şifre Sıfırlama Kodu';
        $mail->Body    = 'Şifre sıfırlama kodunuz: ' . $reset_code;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

    ?>

    <!-- Kayıt Ol Formu -->
    <div class="container" id="registerForm">
        <h2>Kayıt Ol</h2>
        <?php if ($error_message): ?>
            <div class="error"><?= $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="Şifre" id="password" required>
            <div class="checkbox-container">
                <label><input type="checkbox" onclick="togglePassword()"> Şifreyi Göster</label>
            </div>
            <button type="submit" name="register">Kayıt Ol</button>
        </form>
        <div class="account-exist">
            <a onclick="showLogin()">Hesabım Var</a>
        </div>
        <div class="forgot-password">
            <a onclick="showForgotPassword()">Şifremi Unuttum</a>
        </div>
    </div>

    <!-- Giriş Yap Formu -->
    <div class="container hidden" id="loginForm">
        <h2>Giriş Yap</h2>
        <?php if ($error_message): ?>
            <div class="error"><?= $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="login_username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="login_password" placeholder="Şifre" required>
            <button type="submit" name="login">Giriş Yap</button>
        </form>
        <div class="account-exist">
            <a onclick="showRegister()">Hesap Oluştur</a>
        </div>
        <div class="forgot-password">
            <a onclick="showForgotPassword()">Şifremi Unuttum</a>
        </div>
    </div>

   <!-- Şifremi Unuttum Formu -->
    <div class="container hidden" id="forgotPasswordForm">
        <h2>Şifremi Unuttum</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="E-posta" required>
            <button type="submit" name="send_code">Kod Gönder</button>
        </form>
        <form method="POST">
            <input type="text" name="code" placeholder="Doğrulama Kodu" required>
            <input type="password" name="new_password" placeholder="Yeni Şifre" required>
            <button type="submit" name="validate_code">Doğrula ve Şifreyi Yenile</button>
        </form>
        <button class="back-button" onclick="showRegister()">Geri Dön</button>
    </div>


    <script>
        function showLogin() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('forgotPasswordForm').classList.add('hidden');
        }

        function showRegister() {
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('forgotPasswordForm').classList.add('hidden');
        }

        function showForgotPassword() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('forgotPasswordForm').classList.remove('hidden');
        }

        function togglePassword() {
            const passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
