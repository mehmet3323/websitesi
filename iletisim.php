<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="https://kit.fontawesome.com/601562f8f9.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="app.css">
</head>
<body>
<section id="iletisim">
	<div class="container"></div>
<h3 id=	h3iletisim>İletişim</h3>
<form action="iletisim.php" method="post">
	<div id="iletisimopak">
	<div id="formgroup">
		<div id="solform">
			<input type="text" name="isim" placeholder="Ad-Soyad" required class="form-control">
			<input type="text" name="tel" placeholder="Telefon Numarası" required class="form-control">
		</div>
		<div id="sagform">
			
			<input type="email" name="mail" placeholder="Email Adresiniz" required class="form-control">
			<input type="text" name="konu" placeholder="Konu Başlığı" required class="form-control">
		</div>
		<textarea name="mesaj" placeholder="Mesaj Giriniz" required class="form-control" id="text"=></textarea>
		<input type="submit" value="Gönder" name="">
	</div>
	<div id="adres">
		<h4 id="adresbaslig">Adres : </h4>
		<p class="adresp">Kale mah.</p>
		<p class="adresp">şahin bey caddesi</p>
		<p class="adresp">Mehmet Bey sokak No:12</p>
		<p class="adresp">0123 456 78 99</p>
		<p class="adresp">mjdc360@gmail.com</p>


	</div>
</div>
</form>


<footer>
	
<div id="copyriht"> 2024 - Tüm Hakları Saklıdır</div>
<div id="socialfooter">
	
		<a href="https://www.instagram.com/codeslayer.fu/" ><i class="fa-brands fa-facebook social"></i></a>
	<a href="https://www.instagram.com/codeslayer.fu/"><i class="fa-brands fa-instagram social"></i></a>
	<a href="https://www.instagram.com/codeslayer.fu/"><i class="fa-brands fa-twitter social"></i></a>

</div>


</footer>

</section>
</body>
</html>
<?php
include("baglanti.php");

if(isset($_POST["isim"], $_POST["tel"], $_POST["mail"], $_POST["konu"], $_POST["mesaj"])) {
    $adsoyad = mysqli_real_escape_string($baglan, $_POST["isim"]);
    $telefon = mysqli_real_escape_string($baglan, $_POST["tel"]);
    $email = mysqli_real_escape_string($baglan, $_POST["mail"]);
    $konu = mysqli_real_escape_string($baglan, $_POST["konu"]);
    $mesaj = mysqli_real_escape_string($baglan, $_POST["mesaj"]);

    $ekle = "INSERT INTO iletisim (adsoyad, telefon, email, konu, mesaj) VALUES ('$adsoyad', '$telefon', '$email', '$konu', '$mesaj')";

   if($baglan->query($ekle) === TRUE) {
        echo "<script>alert('Mesajınız başarıyla gönderildi.')</script>";
    } else {
        echo "<script>alert('Mesaj gönderilirken bir hata oluştu.')</script>";
    }
}
?>

