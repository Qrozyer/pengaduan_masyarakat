<?php
session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
</head>
<body>
    <?php if ($_SESSION['notif']){
        echo $_SESSION['notif'];
    }else{
        echo "";
    }?>  
    <?= "Selamat Datang, " . $_SESSION['auth'] ?>
    <form action="../../petugascontroller.php" method="post">
        <input type="submit" name="logout" value="keluar">
    </form>
</body>
</html>