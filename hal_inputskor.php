<?php 
include "function.php"; // memasukkan halaman fungsi

//Bila tombol save ditekan akan dilakukan validasi berlapis dan dimasukkan bila data diisi sesuai dengan kriteria
if(isset($_GET['tombol1'])){
    //variabel n adalah jumlah pertandingan yang dimasukkan
    $n=$_GET['form']; 
    //melakukan pengecekan apakah data klub yang dimasukkan terdapat didalam data base
    for($i=1;$i<=$n;$i++){
        $A1="klubA$i";    
        $klub1=$_GET[$A1];
        if(CariIndeksKlub($klub1)=="tidak ditemukan") {DataSalah(); break;}
        $B1="klubB$i";    $klub2=$_GET[$B1];
        if(CariIndeksKlub($klub2)=="tidak ditemukan") {DataSalah(); break;}
    }
    
//Buat Validasi Pertandingan tidak boleh sama
    $n=$_GET['form']; 
    for($i=1;$i<=$n;$i++){
    $AI="klubA$i";    
    $klubAI=$_GET[$AI];
    $BI="klubB$i";    
    $klubBI=$_GET[$BI];
    for($j=$i+1;$j<=$n;$j++){
        $AJ="klubA$j";    
        $klubAJ=$_GET[$AJ];
        $BJ="klubB$j";    
        $klubBJ=$_GET[$BJ];
        if($klubAI==$klubAJ && $klubBI==$klubBJ) DataPertandinganSama();
        if($klubAI==$klubBJ && $klubBI==$klubAJ) DataPertandinganSama();
}}   



//Manipulasi Concatenation untuk mengambil skor melalui perulangan pada setiap pertandingan
    for($i=1;$i<=$n;$i++){
        $A1="klubA$i";    $klub1=$_GET[$A1];
        $A2="skorA$i";    $skor1=$_GET[$A2];
        $B1="klubB$i";    $klub2=$_GET[$B1];
        $B2="skorB$i";    $skor2=$_GET[$B2];
        InputSkorKlub1($klub1,$skor1,$skor2);
        InputSkorKlub2($klub2,$skor1,$skor2);
    }
    echo '<script>alert("Data Yang Anda Masukkan Berhasil")</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Input Klub</title>
</head>
<body>
<h3>Silahkan Isi Form Klub</h3>
<p style="border: 1px black solid; width:fit-content; padding:5px; ;">
Halaman ini memiliki fungsi validasi dan menolak input bila nama klub tidak ada didalam database temporary<br> 
dan bila pertandingan yang melibatkan 2 klub yang sama meskipun skornya berbeda akan tetap ditolak<br>
jumlah input tidak terbatas dengan menekan tombol "Add"
</p>
<a href="hal_inputskor.php<?php if(!isset($_GET['form'])) {$form=1; echo"?form=2"; $_GET['form']=1;} else {$form=$_GET['form']+1; echo"?form=$form";} ?>"><button>Add</button></a>
<br><br>
<form action="" method="GET">
    <?php $n=$_GET['form']; for($i=1;$i<=$n;$i++) : ?>
    Nama Klub :<input style="width: 75px;" type="text" autocomplete="off" name="klubA<?php echo $i;?>" required>
    Skor :<input style="width: 40px;" type="number" autocomplete="off" name="skorA<?php echo $i;?>" required>
    VS
    Nama Klub :<input style="width: 75px;" type="text" autocomplete="off" name="klubB<?php echo $i;?>" required>
    Skor :<input style="width: 40px;" type="number" autocomplete="off" name="skorB<?php echo $i;?>" required>
    <br><br>
    <?php endfor; ?>
<input type="number" name="form" value="<?php echo $_GET['form']; ?>" hidden>
    <input type="submit" name="tombol1" value="SAVE">
</form>

<a href="index.php"><button>Kembali</button></a>
</body>
</html>