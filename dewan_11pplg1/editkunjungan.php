<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update process
if (isset($_POST['update'])) {
    $idKunjungan = $_POST['idKunjungan'];
    $idDokter = $_POST['idDokter'];
    $idPasien = $_POST['idPasien'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    // Update query
    $sql = "UPDATE kunjungan SET idDokter = ?, idPasien = ?, tanggal = ?, keluhan = ? WHERE idKunjungan = ?";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $idDokter, $idPasien, $tanggal, $keluhan, $idKunjungan);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data kunjungan telah diperbarui"); window.location.href = "kunjungan.php";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '"); window.location.href = "kunjungan.php";</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '"); window.location.href = "kunjungan.php";</script>';
    }
}

// Fetch the record to edit
if (isset($_GET['edit'])) {
    $idKunjungan = $_GET['edit'];
    $result = $konek->query("SELECT * FROM kunjungan WHERE idKunjungan = '$idKunjungan'");
    $row = $result->fetch_assoc();
} else {
    header("Location: kunjungan.php");
    exit;
}

// Fetch options for Dokter and Pasien
$doctors = $konek->query("SELECT idDokter, nmDokter FROM dokter");
$patients = $konek->query("SELECT idPasien, nmPasien FROM pasien");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Edit Data Kunjungan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <style>
        .btn-block {
            width: 100%;
        }
    </style>
    <div class="container mt-4">
        <h3>Edit Data Kunjungan</h3>
        <form action="editkunjungan.php" method="POST">
            <input type="hidden" name="idKunjungan" value="<?= $row['idKunjungan'] ?>">
            <div class="form-group">
                <label for="idDokter">Dokter</label>
                <select class="form-control" name="idDokter" id="idDokter" required>
                    <?php while ($doctor = $doctors->fetch_assoc()) { ?>
                        <option value="<?= $doctor['idDokter'] ?>" <?= $doctor['idDokter'] == $row['idDokter'] ? 'selected' : '' ?>>
                            <?= $doctor['nmDokter'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idPasien">Pasien</label>
                <select class="form-control" name="idPasien" id="idPasien" required>
                    <?php while ($patient = $patients->fetch_assoc()) { ?>
                        <option value="<?= $patient['idPasien'] ?>" <?= $patient['idPasien'] == $row['idPasien'] ? 'selected' : '' ?>>
                            <?= $patient['nmPasien'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $row['tanggal'] ?>" required>
            </div>
            <div class="form-group mt-3">
                <label for="keluhan">Keluhan</label>
                <textarea class="form-control" name="keluhan" id="keluhan" cols="5" rows="3" required><?= $row['keluhan'] ?></textarea>
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="update" value="Simpan" class="btn btn-primary btn-block">
            </div>
        </form>
        <a href="kunjungan.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
