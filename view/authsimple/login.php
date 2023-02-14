<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
</head>
<body>
    <h1>Form Login</h1>
    <form action="../../authcontrollersimple.php" method="POST">
        <li><label for="nik">NIK</label></li>
        <li><input type="text" name="nik" id="nik" required></li>
        <li><label for="password">Password</label></li>
        <li><input type="password" name="password" id="password" required></li>
        <li><input type="submit" name="login" value="Masuk"></li>
    </form>
    <p>Belum punya akun, ingin daftar? >>><a href="register.php">Register</a></p>
</body>
</html>