<?php
include '../../pengaduancontroller.php';
include '../../petugascontroller.php';
include '../../tanggapancontroller.php';
session_start();
$id_petugas = $_SESSION['id_petugas'];
$id = $_GET['id'];

if (!$_SESSION['auth']) {
    header('Location: ../petugas/login.php');
}

if (isset($_SESSION['id_petugas'])){
    $data_petugas = $petugas->show($id_petugas);
}
$show = $pengaduan->show($id);
$data_tanggapan = $tanggapan->show($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tanggapan</title>
</head>
<body>
    <h1>Detail Tanggapan</h1>
    <a href="../petugas/index.php">Kembali</a>
    <br><br>
    <?php if ($show != null) : ?>
        <div>
            <li>Tanggal : <?= $show->tgl_pengaduan ?></li>            
            <li>NIK : <?= $show->nik ?></li>            
            <li>Laporan : <?= $show->isi_laporan ?></li>        
            <li>Foto : <?= $show->foto ?></li>            
            <li>Status : 
            <?php if ($show->status == 0) : ?>
                Belum diproses
            <?php elseif ($show->status == 'proses') : ?>
                Sedang diproses
            <?php elseif ($show->status == 'selesai') : ?>
                Selesai diproses
            <?php endif ; ?>  
            </li>
            <li>Nama Petugas : <?= $data_petugas->nama_petugas; ?></li>
            <li>Tanggapan : <?= $data_tanggapan->tanggapan; ?></li>
            <br>          
        </div>
    <?php else : ?>
        <h3>List Pengaduan Masih Kosong</h3>
    <?php endif; ?>
</body>
</html>