<?php
session_start();
require '../functions.php';

// cek cookie
// if (isset($_COOKIE["cookieLogin"])){
//     if($_COOKIE["cookieLogin"] == "ada"){
//         $_SESSION["login"] = true;
//     }
// }

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $result = mysqli_query($connection, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION["login"] = true;
    }
}

// cek session
if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
}

if (isset($_POST["loginnn"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "") {
        echo "
        <script>
        alert('username harus diisi');
        </script>
        ";
    }
    if ($password === "") {
        echo "
        <script>
        alert('password harus diisi');
        </script>
        ";
    }

    $result = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // create session

            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST["remember"])) {
                // set cookie
                // setcookie("cookieLogin", "ada", time()+120);

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username'], time()+60));
            }

            header("Location: ../index.php");
            exit;
        } else {
            echo "
            <script>
            alert('password anda salah');
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('User tidak ditemukan');
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
    <title>Login</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <h2>Login User</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <br>
            <button type="submit" name="loginnn" class="btn btn-primary">login</button>
            <a href="./registrasi.php" class="btn btn-info">registrasi</a>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>