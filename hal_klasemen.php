<?php 
include "function.php"; // memasukkan halaman fungsi
//Funsgi Bila Tombol Reset Data Klub dan Skor
if(isset($_POST['reset'])) $_SESSION['klub']=null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasemen</title>
</head>
<body>

<h3>Klasemen Dalam Bentuk Tabel</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>No</td>
        <td>Nama Klub</td>
        <td>Main</td>
        <td>Menang</td>
        <td>Seri</td>
        <td>Kalah</td>
        <td>Gol Menang</td>
        <td>Gol Kalah</td>
        <td>Poin</td>
    </tr>
    <?php if(isset($_SESSION['klub'])) :?>
        <?php $n=count($_SESSION['klub']); $i=0; while($i<$n) :?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $_SESSION['klub'][$i][1]?></td>
                <td><?php echo $_SESSION['klub'][$i][2]?></td>
                <td><?php $menang=$_SESSION['klub'][$i][3]; echo $menang; $menang=$menang*3;?></td>
                <td><?php $seri=$_SESSION['klub'][$i][4];   echo $seri;?></td>
                <td><?php echo $_SESSION['klub'][$i][5]?></td>
                <td><?php echo $_SESSION['klub'][$i][6]?></td>
                <td><?php echo $_SESSION['klub'][$i][7]?></td>
                <td><?php $poin=$menang+$seri; echo $poin;?></td>
            </tr>
        <?php $i=$i+1; endwhile; ?>
    <?php endif;?>
</table>

<br><br><br><br>
<form action="" method="post"><input type="submit" value="Reset Data Klub dan Score" name="reset"></form>
<br>
<a href="index.php"><button>Kembali</button></a>
</body>
</html>