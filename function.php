<?php
session_start(); // memulai session untuk penyimpanan temporary pada memori

//melakukan validasi apakah ada klub dengan nama dan kota yang sama sudah ada atau belum
function ValidasiKlub($data){
    $kota=$data['kota']; 
    $nama=$data['nama']; 
    if(!isset($_SESSION['klub'])) return true;
    $jumlah=count($_SESSION['klub']);
    $i=0;
    // bila sudah ada maka akan di return false bila tidak ada akan di return true
    while($i<$jumlah){if($kota==$_SESSION['klub'][$i][0] && $nama==$_SESSION['klub'][$i][1]) 
        return false; $i=$i+1;}
        return true;}
        

//Fungsi melakukan input data klub
function InputKlub($data){
    //melakukan pengecekan apakah klub sudah pernah dimasukkan belum
    if (ValidasiKlub($data)==false) return false; // bila validasi salah fungsi akan berhenti
    $kota=$data['kota']; //array 0 berisi kota
    $nama=$data['nama']; //array 1 berisi nama
    $main=0;             //array 2 berisi jumlah pertandingan
    $menang=0;           //array 3 berisi jumlah menang
    $seri=0;             //array 4 berisi jumlah seri
    $kalah=0;            //array 5 berisi jumlah kalah
    $golMenang=0;        //array 6 berisi jumlah gol menang
    $golKalah=0;         //array 7 berisi jumlah gol kalah
    //semuanya disimpan kedalam suatu array agar dapat dipanggil kembali
    $_SESSION['klub'][]=array($kota,$nama,$main,$menang,$seri,$kalah,$golMenang,$golKalah);    
    //Menampilkan notifikasi bila data berhasil diinput
    echo '<script>
    alert("Data Klub Berhasil Di Isi")
    window.location.href = "hal_inputklub.php";
    </script>';
}

//fungsi untuk mendapatkan nilai indeks klub mengeluarkan fungsi eror bila tidak ditemukan
function CariIndeksKlub($namaklub){
//mengeluarkan nilai eror bila tidak memiliki data
if(!isset($_SESSION['klub'])) return "tidak ditemukan";
//lanjut mencari bila nilai array memiliki data
$jumlah=count($_SESSION['klub']);
$i=0;
while($i<$jumlah){if($namaklub==$_SESSION['klub'][$i][1]) return $i; $i=$i+1;} 
return "tidak ditemukan";}

//fungsi memasukkan nilai klub 1
function InputSkorKlub1($klub1,$skor1,$skor2){
//cari indeks array klub tersebut
$indeks=CariIndeksKlub($klub1);
if($indeks=="tidak ditemukan") return false; //bila nilai indeks bernilai false maka fungsi dihentikan
$_SESSION['klub'][$indeks][2]=$_SESSION['klub'][$indeks][2]+1; // menambah jumlah pertandingan

//nilai menang kalah dan seri diisi berdasarkan skor dan melakukan update nilai pada array
$status = $skor1-$skor2;

//jika menang menambah jumlah pertandingan menang dan mengisi gol menang
if ($status>0){ $_SESSION['klub'][$indeks][3]=$_SESSION['klub'][$indeks][3]+1; 
                $_SESSION['klub'][$indeks][6]=$_SESSION['klub'][$indeks][6]+$skor1;   }
// jika seri menambah jumlah pertandingan seri
if ($status==0) $_SESSION['klub'][$indeks][4]=$_SESSION['klub'][$indeks][4]+1; 
// jika kalah menambah jumlah pertandingan kalah dan menambah skor kalah
if ($status<0){ $_SESSION['klub'][$indeks][5]=$_SESSION['klub'][$indeks][5]+1; 
                $_SESSION['klub'][$indeks][7]=$_SESSION['klub'][$indeks][7]+$skor2;}


}

//memasukkan skor klub 2
function InputSkorKlub2($klub2,$skor1,$skor2){
    //cari indeks array klub tersebut
    $indeks=CariIndeksKlub($klub2);
    if($indeks=="tidak ditemukan") return false; //bila nilai indeks bernilai false maka fungsi dihentikan
    // menambah jumlah pertandingan
    $_SESSION['klub'][$indeks][2]=$_SESSION['klub'][$indeks][2]+1; 
    //nilai menang kalah dan seri diisi berdasarkan skor status dan melakukan update nilai pada array
    $status = $skor2-$skor1;
    
    //jika menang menambah jumlah pertandingan menang dan mengisi gol menang
    if ($status>0){ $_SESSION['klub'][$indeks][3]=$_SESSION['klub'][$indeks][3]+1; 
                    $_SESSION['klub'][$indeks][6]=$_SESSION['klub'][$indeks][6]+$skor2;   }
    // jika seri menambah jumlah pertandingan seri
    if ($status==0){ $_SESSION['klub'][$indeks][4]=$_SESSION['klub'][$indeks][4]+1; }
    // jika kalah menambah jumlah pertandingan kalah dan menambah skor kalah
    if ($status<0){ $_SESSION['klub'][$indeks][5]=$_SESSION['klub'][$indeks][5]+1; 
                    $_SESSION['klub'][$indeks][7]=$_SESSION['klub'][$indeks][7]+$skor1;}
    
    }

    //fungsi pemberitahuan bila data yang dimasukkan salah
    function DataSalah(){
        echo '<script>
        alert("Klub yang anda masukkan tidak ditemukan")
        window.location.href = "hal_inputskor.php";
        </script>';

    }

//fungsi pemberitahuan bila ada data pertandingan antar klub yang sama
    function DataPertandinganSama(){
        echo '<script>
        alert("Terdapat Data Pertandingan Yang Sama")
        window.location.href = "hal_inputskor.php";
        </script>';

    }