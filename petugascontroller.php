<?php

include 'koneksi.php';

class PetugasController extends Koneksi {

    public function login($request) {
        $username   = $request['username'];
        $password   = $request['password'];
        
        $query = "SELECT * FROM petugas WHERE username = '$username'";
        $username_check = $this->pdo->prepare($query);
        $username_check->execute();
        $username_result = $username_check->fetch(PDO::FETCH_OBJ);

        if($username_result){
            if($username_result->password == $password){
                session_start();
                $_SESSION['auth'] = $username_result->nama_petugas;
                $_SESSION['id_petugas'] = $username_result->id_pengguna;
                $_SESSION['notif'] = "<h4>anda berhasil login</h4>";
                header('Location: view/petugas/index.php');
            }else{
                session_start();
                $_SESSION['notif'] = "<h4>password tidak sesuai</h4>";
                header('Location: view/petugas/login.php');
            }
        } else{
            session_start();
            $_SESSION['notif'] = "<h4>gagal login</h4>";
            header('Location: view/petugas/login.php');
        }                      
    }

    public function logout(){
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: view/petugas/login.php');
    }

    public function index(){
        $query = "SELECT * FROM pengaduan";
        $index = $this->pdo->prepare($query);
        $index->execute();
        $result = $index->fetchAll(PDO::FETCH_OBJ);



        return $result;
    }
}

$petugas = new PetugasController();

if (isset($_POST['login'])) {
    $petugas->login($_POST);
}

if (isset($_POST['logout'])) {
    $petugas->logout();
}

?>