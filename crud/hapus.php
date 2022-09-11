<?php
session_start();
if (!isset($_SESSION["login"])){
    header("Location: ../auth/login.php");
}

require '../functions.php';
$idHapus = $_GET["id"];
if (delete($idHapus) > 0){
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = '../index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = '../index.php';
        </script>
    ";
}

?>