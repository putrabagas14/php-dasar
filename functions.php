<?php
    $connection = mysqli_connect("localhost", "root", "", "php_dasar");

    function query($query){
        global $connection;
        $result = mysqli_query($connection, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function search($request){
        $keyword = htmlspecialchars($request["keyword"]);
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'";
        return query($query);
    }

    function register($request){
        global $connection;
        $email = htmlspecialchars($request["email"]);
        $username = htmlspecialchars($request["username"]);
        $password = htmlspecialchars($request["password"]);
        $konfirmasi_psw = htmlspecialchars($request["konfirmasi_password"]);
        $level = htmlspecialchars($request["level"]);
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, username, password, level) VALUES ('$email', '$username', '$hash_password', '$level')";
        mysqli_query($connection, $query);
        return mysqli_affected_rows($connection);
    }

    function add($request){
        global $connection;
        $nama = htmlspecialchars($request["nama"]);
        $nrp = htmlspecialchars($request["nrp"]);
        $email = htmlspecialchars($request["email"]);
        $jurusan = htmlspecialchars($request["jurusan"]);
        // $gambar = htmlspecialchars($request["gambar"]);

        // var_dump($_FILES);
        $gambar = upload_image();
        // if ($gambar === false){
        if (!$gambar){
            return false;
        }

        $query = "INSERT INTO mahasiswa (nama, nrp, email, jurusan, gambar) VALUES ('$nama', '$nrp', '$email', '$jurusan', '$gambar')";
        mysqli_query($connection,$query);
        return mysqli_affected_rows($connection);
    }

    function upload_image(){
        $name_file = $_FILES["gambar"]["name"];
        $size_file = $_FILES["gambar"]["size"];
        $error_file = $_FILES["gambar"]["error"];
        $tmp_file = $_FILES["gambar"]["tmp_name"];

        // cek apakah ada gambar yang di upload
        if ($error_file === 4){
                echo "
                <script>
                alert('Pilih Gambar Terlebih Dahulu');
                </script>
                ";
                return false;
        }

        // cek apakah file yang di upload adalah gambar
        $ekstensiGambarValid = ["jpg", "jpeg", "png"];
        // nama gambar mengandung ekstensinya juga
        $arrayNamaGambar = explode(".", $name_file);
        // mengambil ekstensi gambar
        $ekstensiGambar = strtolower(end($arrayNamaGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "
            <script>
            alert('file yang anda pilih bukan gambar')
            </script>
            ";
            return false;
        }

        // cek ukuran gambar apakah terlalu besar

        if ($size_file > 2000000){
            echo "
            <script>
            alert('ukuran file yang anda pilih terlalu besar')
            </script>
            ";
            return false;
        }

        if (is_uploaded_file($_FILES["gambar"]["tmp_name"])){
            move_uploaded_file($tmp_file, '/opt/lampp/htdocs/php-mysql/uploads/' . $name_file);
            // var_dump(move_uploaded_file($tmp_file, '/opt/lampp/htdocs/php-mysql/uploads/' . $name_file));
            // die;
            // echo "file telah diupload";
        } else {
            echo "
            <script>
            alert('gambar gagal diupload');
            </script>
            ";
        }

        return $name_file;
    }

    function delete($id){
        global $connection;
        mysqli_query($connection, "DELETE FROM mahasiswa WHERE id = $id");
        return mysqli_affected_rows($connection);
    }

    function update($data){
        global $connection;
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]) ;
        $nrp = htmlspecialchars($data["nrp"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $gambar = htmlspecialchars($data["gambar"]);

        $query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";
        mysqli_query($connection, $query);
        return mysqli_affected_rows($connection);
    }
?>