<?php

include_once 'koneksi.php';

class TanggapanController extends Koneksi {
    public function index()
    {
        /**
         * Menampilkan tanggapan
         */
        
        $query = "SELECT * FROM tanggapan";
        $index = $this->pdo->prepare($query);
        $index->execute();
        $result = $index->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
    
    public function store($request)
    {
        /**
         * Mengajukan tanggapan / logic tambah data (program)
         */

        $tgl_tanggapan = $request['tgl_tanggapan'];
        $tanggapan     = $request['tanggapan'];
        $id_pengaduan  = $request['id_pengaduan'];
        $id_petugas    = $request['id_petugas'];

        $query = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ($id_pengaduan, '$tgl_tanggapan', '$tanggapan', $id_petugas)";
        $store = $this->pdo->prepare($query);
        $store->execute();

        echo "<script>
            alert('Berhasil menanggapi!')
            window.location.href='view/petugas/index.php'
            </script>";
    }

    public function show($id)
    {
        // Menampilkan data tertentu
        $query = "SELECT * FROM tanggapan WHERE id_pengaduan = $id";
        $show = $this->pdo->prepare($query);
        $show->execute();
        $result = $show->fetch(PDO::FETCH_OBJ);

        return $result;
    }
}

$tanggapan = new TanggapanController();

if (isset($_POST['store'])) {
    $tanggapan->store($_POST);
}

if (isset($_POST['update'])) {       
    $tanggapan->update($_POST);
}

if (isset($_POST['destroy'])) {           
    $tanggapan->destroy($_POST['id']);
}

?>