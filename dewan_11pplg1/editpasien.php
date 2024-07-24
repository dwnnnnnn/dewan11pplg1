<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $idPasien = $_POST['idPasien'];
    $nmPasien = $_POST['nmPasien'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $konek->query("UPDATE pasien SET nmPasien='$nmPasien', jk='$jk', alamat='$alamat' WHERE idPasien='$idPasien'");
    header("Location: pasien.php");
    exit;
}

if (isset($_GET['edit'])) {
    $idPasien = $_GET['edit'];
    $panggil = $konek->query("SELECT * FROM pasien WHERE idPasien='$idPasien'");
} else {
    header("Location: pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Edit Data Pasien</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <style>
        .btn-block {
            width: 100%;
        }
    </style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Edit Data Pasien</h3>
                <?php while ($row = $panggil->fetch_assoc()) { ?>
                <form action="editpasien.php" method="POST">
                    <input type="hidden" name="idPasien" value="<?= $row['idPasien'] ?>">
                    <div class="form-group">
                        <label for="nmPasien">Nama Pasien</label>
                        <input type="text" class="form-control mb-3" name="nmPasien" placeholder="Nama Pasien" value="<?= $row['nmPasien'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="jk" value="Perempuan" <?php if (($row['jk']) === "Perempuan") { echo "checked"; } ?>> Perempuan
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="jk" value="Laki-laki" <?php if (($row['jk']) === "Laki-laki") { echo "checked"; } ?>> Laki-laki
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="5" rows="3" placeholder="Alamat"><?= $row['alamat'] ?></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" name="update" value="Simpan" class="form-control btn btn-primary">
                    </div>
                </form>
                <a href="pasien.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
