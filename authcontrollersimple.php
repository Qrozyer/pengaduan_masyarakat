<?php

include 'koneksi.php';

class AuthController extends Koneksi {
    public function register($request) {       
        $nik                = $request['nik'];
        $nama               = $request['nama'];
        $username           = $request['username'];
        $password           = $request['password'];
        $confirm_password   = $request['confirm_password'];
        $telp               = $request['telp'];

        if($password == $confirm_password){
            $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) VALUES ('$nik', '$nama', '$username', '$password', '$telp')";
            $register = $this->pdo->prepare($query);
            $register->execute();      
            session_start();         
            $_SESSION['notif'] = "<h4>berhasil register</h4>";
            header('Location: view/authsimple/login.php');
        }else{
            session_start();
            $_SESSION['notif'] = "<h4>password tidak sesuai</h4>";
            header('Location: view/authsimple/register.php');
        }
    }

    public function login($request) {
        $nik        = $request['nik'];
        $password   = $request['password'];
        
        $query = "SELECT * FROM masyarakat WHERE nik = '$nik'";
        $nik_check = $this->pdo->prepare($query);
        $nik_check->execute();
        $nik_result = $nik_check->fetch(PDO::FETCH_OBJ);

        if($nik_result){
            if($nik_result->password == $password){
                session_start();
                $_SESSION['auth'] = $nik_result->nama;
                $_SESSION['notif'] = "<h4>anda berhasil login</h4>";
                header('Location: view/authsimple/index.php');
            }else{
                session_start();
                $_SESSION['notif'] = "<h4>password tidak sesuai</h4>";
                header('Location: view/authsimple/login.php');
            }
        } else{
            session_start();
            $_SESSION['notif'] = "<h4>gagal login</h4>";
            header('Location: view/authsimple/login.php');
        }                      
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: view/authsimple/login.php');
    }
}

$masyarakat = new AuthController();

if (isset($_POST['register'])) {
    $masyarakat->register($_POST);
}

if (isset($_POST['login'])) {
    $masyarakat->login($_POST);
}

if (isset($_POST['logout'])) {
    $masyarakat->logout();
}

?>