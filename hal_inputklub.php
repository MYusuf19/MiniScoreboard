<?php 
include "function.php"; // memasukkan halaman fungsi
if (isset($_POST["tombol1"])){ InputKlub($_POST);} // jika tombol submit ditekan data akan diinput
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Input Klub</title>
</head>
<body>
<div style="height: 100px; width: 200px; background-color: black;"></div>
<p>Catatan : Penggunaan Huruf kapital memiliki pengaruh dan membuat nama yang berbeda<br> Seperti persib dan Persib adalah nama yang berbeda</p>

<h3>Silahkan Isi Form Klub</h3>
<form action="" method="post">
    <p>Nama Klub</p>
    <input type="text" autocomplete="off" name="nama" required>
    <br>
    <p>Kota Klub</p>
    <input type="text" autocomplete="off" name="kota" required>
    <br>
    <input type="submit" name="tombol1" value="SAVE">
</form>
<a href="index.php"><button>Kembali</button></a>
</body>
</html>