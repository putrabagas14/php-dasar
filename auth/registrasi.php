<?php
session_start();

if (isset($_SESSION["login"])){
    header("Location: ../index.php");
}

require "../functions.php";
if (isset($_POST["daftar"])){
    // var_dump($_POST);
    if($_POST["password"] == $_POST["konfirmasi_password"]){
        if(register($_POST) > 0){
            echo "
            <script>
                alert('user berhasil didaftarkan');
                document.location.href = '../index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('user gagal didaftarkan');
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Konfirmasi Password Anda Salah');
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <h2>Registrasi User</h2>
        <form action="" method="post">
        <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="">Level</label>
                <select class="form-control" name="level" id="">
                    <option value="">-- pilih level --</option>
                    <option value="owner">Owner</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" class="form-control" name="konfirmasi_password">
            </div>
            <br>
            <button type="submit" name="daftar" class="btn btn-primary">register</button>
            <a href="../index.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>