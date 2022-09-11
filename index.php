<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ./auth/login.php");
}

require "functions.php";
$mahasiswa = query("SELECT * FROM mahasiswa");

if(isset($_POST["cari"])){
    $mahasiswa = search($_POST);
}

$batas = 3;
$halaman = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0 ;

$prev = $halaman - 1;
$next = $halaman + 1;

$data_m = mysqli_query($connection, "SELECT * FROM mahasiswa");
$jumlah_data = mysqli_num_rows($data_m);
$total_halaman = ceil($jumlah_data / $batas);

$data_mahasiswa = query("select * from mahasiswa limit $halaman_awal, $batas");
$nomor = $halaman_awal+1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Mahasiswa</title>

    <!-- css -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="crud/tambah.php" class="btn btn-primary">Add Data</a>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <a href="./auth/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <br>
        <div class="row">
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Input..." name="keyword" aria-label="Recipient's username">
                    <button class="btn btn-outline-secondary" type="submit" name="cari">Search</button>
                    <a class="btn btn-outline-secondary" href="./index.php">Reset</a>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Nrp</th>
                            <th>Email</th>
                            <th>Major</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($data_mahasiswa) === 0) { ?>
                            <tr>Data Kosong...</tr>
                        <?php } else {?>
                        <?php $no = 1; ?>
                        <?php foreach ($data_mahasiswa as $data) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data["nama"]; ?></td>
                                <td><?= $data["nrp"]; ?></td>
                                <td><?= $data["email"]; ?></td>
                                <td><?= $data["jurusan"]; ?></td>
                                <td><img src="<?= 'uploads/'.$data['gambar']; ?>" alt="gambar rusak atau tidak ditemukan" class="img-fluid"></td>
                                <td>
                                    <a href="./crud/ubah.php?idEdit=<?= $data["id"] ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a>
                                    <a href="./crud/hapus.php?id=<?= $data["id"] ?>" onclick="return confirm('anda yakin ingin menghapus data?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>
                <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$prev'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>