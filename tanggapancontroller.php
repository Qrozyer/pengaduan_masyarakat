<?php

include 'koneksi.php';

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

    public function create()
    {
        // Menampilkan form tambah data        
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
    }

    public function edit($id)
    {
        $query = "SELECT * FROM pengaduan WHERE id_pengaduan = $id";
        $edit = $this->pdo->prepare($query);
        $edit->execute();
        $result = $edit->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function update($request)
    {
        $id      = $request['id'];
        $tgl     = $request['tgl'];
        $nik     = $request['nik'];
        $laporan = $request['laporan'];
        $foto    = $request['foto'];
        $status  = $request['status'];

        $query = "UPDATE pengaduan SET tgl_pengaduan = '$tgl', nik = '$nik', isi_laporan = '$laporan', foto = '$foto', status = '$status' WHERE id_pengaduan = $id";
        $store = $this->pdo->prepare($query);
        $store->execute();

        echo "<script>
            alert('Berhasil mengubah pengaduan!')
            window.location.href='view/pengaduan/index.php'
            </script>";
    }

    public function destroy($id)
    {
        $query = "DELETE FROM pengaduan WHERE id_pengaduan = $id";
        $destroy = $this->pdo->prepare($query);
        $destroy->execute();

        echo "<script>
            alert('Berhasil menghapus pengaduan!')
            window.location.href='view/pengaduan/index.php'
            </script>";
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