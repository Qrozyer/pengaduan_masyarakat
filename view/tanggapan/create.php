<?php
session_start();
if (!$_SESSION['auth']) {
    header('Location: ../petugas/login.php');
}
$id_pengaduan = $_GET['id'];
$id_petugas = $_SESSION['id_petugas'];
// var_dump($_GET,$_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan</title>
</head>
<body>
    <h1>Tanggapan</h1>
    <br>
    <a href="../petugas/index.php">Kembali</a>
    <form action="../../tanggapancontroller.php" method="POST">
        <li><label for="tgl_tanggapan">Tanggal</label></li>
        <li><input type="date" name="tgl_tanggapan" id="tgl_tanggapan" autofocus required></li>
        <li><label for="tanggapan">Tanggapan</label></li>
        <li><input type="text" name="tanggapan" id="tanggapan" required></li>        
        <input type="hidden" name="id_pengaduan" id="id_pengaduan" value="<?= $id_pengaduan; ?>" required>
        <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $id_petugas; ?>" required>
        <br>
        <li><input type="submit" name="store" value="Tambah Tanggapan"></li>
    </form>
</body>
</html>