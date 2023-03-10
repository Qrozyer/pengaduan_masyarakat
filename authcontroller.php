<?php

include 'koneksi.php';

class AuthController extends Koneksi {
    public function register($request) {
        /**
         * Request Data
         */
        $nik                = $request['nik'];
        $nama               = $request['nama'];
        $username           = $request['username'];
        $password           = $request['password'];
        $confirm_password   = $request['confirm_password'];
        $telp               = $request['telp'];

        /**
         * Kita cek apakah nik yang akan di daftarkan sudah ada atau belum
         */
        $query = "SELECT * FROM masyarakat WHERE nik = '$nik'";
        $nik_check = $this->pdo->prepare($query);
        $nik_check->execute();

        $nik_status = $nik_check->fetch(PDO::FETCH_OBJ);

        if ($nik_status) {
            echo "<script>
                    alert('NIK sudah terdaftar!')
                    window.location.href='view/masyarakat/register.php'
                    </script>";
        } else {
            /**
             * Kita cek apakah username yang akan di daftarkan sudah ada atau belum
             */
            $query = "SELECT * FROM masyarakat WHERE username = '$username'";
            $username_check = $this->pdo->prepare($query);
            $username_check->execute();

            $user = $username_check->fetch(PDO::FETCH_OBJ);

            if ($user) {
                echo "<script>
                    alert('Username sudah ada!')
                    window.location.href='view/masyarakat/register.php'
                    </script>";
            } else {
                /**
                 * Cek konfirmasi password
                 */
                if ($password == $confirm_password) {

                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                    $encrypted_password = crypt($password, $hash_password);

                    $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) VALUES ('$nik', '$nama', '$username', '$hash_password', '$telp')";
                    $register = $this->pdo->prepare($query);
                    $register->execute();

                    echo "<script>
                    alert('Berhasil mendaftarkan user')
                    window.location.href='view/masyarakat/login.php'
                    </script>";
                } else {
                    echo "<script>
                    alert('Konfirmasi password tidak sesuai!')
                    window.location.href='view/masyarakat/register.php'
                    </script>";
                }
            }
        }
    }

    public function login($request) {
        $nik        = $request['nik'];
        $password   = $request['password'];

        // Check NIK
        $query = "SELECT * FROM masyarakat WHERE nik = '$nik'";
        $nik_check = $this->pdo->prepare($query);
        $nik_check->execute();
        $nik_result = $nik_check->fetch(PDO::FETCH_OBJ);

        if (!$nik_result) {
            echo "<script>
                alert('NIK yang anda masukan tidak sesuai!')
                window.location.href='view/masyarakat/login.php'
                </script>";
        } else {
            if (password_verify($password, $nik_result->password)) {
                session_start();
                $_SESSION['auth'] = $nik_result->nama;
                header('Location: view/dashboard.php');
            } else {
                echo "<script>
                alert('Password yang anda masukan tidak sesuai!')
                </script>";
            }
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        
        echo "<script>
            alert('Telah berhasil logout!')
            window.location.href='view/masyarakat/login.php'
            </script>";
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