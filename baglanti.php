<?php

$baglan = mysqli_connect("localhost", "root", "", "paylastikca");
if(!$baglan)
{
	die("Veri tabanı bağlantısı başarısız.".mysqli_connect_error());
}
?>