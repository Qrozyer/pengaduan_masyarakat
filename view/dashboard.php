<?php
session_start();
if (!$_SESSION['auth']) {
    header('Location: masyarakat/register.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($_SESSION['level'] == 'admin') : ?>
        <title>Dashboard Admin</title>
    <?php else : ?>
        <title>Dashboard Petugas</title>
    <?php endif ?>
</head>
<body>
    <?= "Selamat Datang, " . $_SESSION['auth'] ?>
    <p>Lanjut ke lembar pengaduan? >>> <a href="pengaduan/index.php">Lembar Pengaduan</a></p>
    <form action="../authcontroller.php" method="post">
        <input type="submit" name="logout" value="keluar">
    </form>
</body>
</html>