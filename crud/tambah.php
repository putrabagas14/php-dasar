<?php

session_start();
    if (!isset($_SESSION["login"])){
        header("Location: ../auth/login.php");
    }

//TANPA MENGGUNAKAN FUNCTION
//koneksi ke database
// $conn = mysqli_connect("localhost","root","","php_dasar");
// if (isset ($_POST["tambah"]) )
// {
//     $nama = $_POST["nama"];
//     $nim = $_POST["nrp"];
//     $email = $_POST["email"];
//     $jurusan = $_POST["jurusan"];
//     $gambar = $_POST["gambar"];
//     $query = " INSERT INTO mahasiswa VALUES (DEFAULT,'$nama','$nim','$email','$jurusan','$gambar') ";
//     mysqli_query($conn,$query);
//     if(mysqli_affected_rows($conn) > 0 )
//     {
//       echo "
//       <script>
//       alert('data berhasil ditambahkan');
//       document.location.href = '../index.php';
//       </script>
//       ";
//     }
//       else {
        // echo "
        // <script>
        //     alert('data gagal ditambahkan');
        //     document.location.href = '../index.php';
        // </script>
        // ";
//         // echo mysqli_error($conn);
//       }
//     }

require "../functions.php";
if (isset($_POST["tambah"])) {
    // var_dump($_FILES);
    if (add($_POST) > 0){
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = '../index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan');
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
    <title>Tambah Data Mahasiswa</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="nrp" class="col-sm-2 col-form-label">Nrp</label>
                        <input type="text" class="form-control" name="nrp" id="nrp">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="jurusan" class="col-sm-2 col-form-label">Major</label>
                        <input type="text" class="form-control" name="jurusan" id="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <input type="file" class="form-control" name="gambar" id="image">
                    </div>
                    <br>
                    <button type="submit" name="tambah" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>