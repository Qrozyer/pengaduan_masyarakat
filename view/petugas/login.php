<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('Location: index.php');
}else{
    echo "";
}
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
</head>
<body>
    <?php if (isset($_SESSION['notif'])){
        echo $_SESSION['notif'];
    }else{
        echo "";
    }?>
    <h1>Form Login</h1>
    <form action="../../petugascontroller.php" method="POST">
        <li><label for="username">Username</label></li>
        <li><input type="text" name="username" id="username" required></li>
        <li><label for="password">Password</label></li>
        <li><input type="password" name="password" id="password" required></li>
        <li><input type="submit" name="login" value="Masuk"></li>
    </form>
</body>
</html>