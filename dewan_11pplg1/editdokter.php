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
    $idKunjungan = $_POST['idKunjungan'];
    $idDokter = $_POST['idDokter'];
    $idPasien = $_POST['idPasien'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];
    
    $sql = "UPDATE kunjungan SET idDokter=?, idPasien=?, tanggal=?, keluhan=? WHERE idKunjungan=?";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisss", $idDokter, $idPasien, $tanggal, $keluhan, $idKunjungan);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: kunjungan.php");
            exit;
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '");</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '");</script>';
    }
    mysqli_close($konek);
}

if (isset($_GET['edit'])) {
    $idKunjungan = $_GET['edit'];
    $sql = "SELECT * FROM kunjungan WHERE idKunjungan=?";
    $stmt = mysqli_prepare($konek, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idKunjungan);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Fetch doctors and patients for the dropdowns
    $doctors = mysqli_query($konek, "SELECT * FROM dokter");
    $patients = mysqli_query($konek, "SELECT * FROM pasien");

} else {
    header("Location: kunjungan.php");
    exit;
}
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
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Edit Data Kunjungan</h3>
                <form action="editkunjungan.php" method="POST">
                    <input type="hidden" name="idKunjungan" value="<?= htmlspecialchars($row['idKunjungan']) ?>">
                    <div class="form-group">
                        <label for="idDokter">Dokter</label>
                        <select name="idDokter" class="form-control" required>
                            <?php while ($doctor = mysqli_fetch_assoc($doctors)): ?>
                                <option value="<?= $doctor['idDokter'] ?>" <?= $doctor['idDokter'] == $row['idDokter'] ? 'selected' : '' ?>>
                                    <?= $doctor['nmDokter'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idPasien">Pasien</label>
                        <select name="idPasien" class="form-control" required>
                            <?php while ($patient = mysqli_fetch_assoc($patients)): ?>
                                <option value="<?= $patient['idPasien'] ?>" <?= $patient['idPasien'] == $row['idPasien'] ? 'selected' : '' ?>>
                                    <?= $patient['nmPasien'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control mb-3" name="tanggal" value="<?= htmlspecialchars($row['tanggal']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keluhan">Keluhan</label>
                        <textarea class="form-control" name="keluhan" id="keluhan" cols="5" rows="3" required><?= htmlspecialchars($row['keluhan']) ?></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" name="update" value="Simpan" class="btn btn-primary btn-block">
                    </div>
                </form>
                <a href="kunjungan.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
