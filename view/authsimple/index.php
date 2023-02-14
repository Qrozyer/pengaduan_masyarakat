<?php
session_start();
if (!$_SESSION['auth']) {
    header('Location: register.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
</head>
<body>
    <h1>ANDA BERHASIL LOGIN</h1>
    <?= "Selamat Datang, " . $_SESSION['auth'] ?>
    <p>Lanjut ke lembar pengaduan? >>> <a href="pengaduan/index.php">Lembar Pengaduan</a></p>
    <form action="../authcontroller.php" method="post">
        <input type="submit" name="logout" value="keluar">
    </form>
</body>
</html>