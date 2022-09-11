<?php
session_start();
if (!isset($_SESSION["login"])){
    header("Location: ../auth/login.php");
}

require '../functions.php';
$id = $_GET["idEdit"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if(isset($_POST["ubah"])) {
    if (update($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href = '../index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diubah');
            document.location.href = '../index.php';
        </script>
        ";
        // echo mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
                    <div class="form-group">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $mhs["nama"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nrp" class="col-sm-2 col-form-label">Nrp</label>
                        <input type="text" class="form-control" name="nrp" id="nrp" value="<?= $mhs["nrp"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= $mhs["email"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jurusan" class="col-sm-2 col-form-label">Major</label>
                        <input type="text" class="form-control" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <input type="text" class="form-control" name="gambar" id="image" value="<?= $mhs["gambar"] ?>">
                    </div>
                    <br>
                    <button type="submit" name="ubah" class="btn btn-primary">EDIT</button>
                    <a href="../index.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>