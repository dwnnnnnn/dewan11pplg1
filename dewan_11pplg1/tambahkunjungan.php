<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $idKunjungan = $_POST['idKunjungan'];
    $idDokter = $_POST['idDokter'];
    $idPasien = $_POST['idPasien'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    // Insert into the database
    $sql = "INSERT INTO kunjungan (idKunjungan, idDokter, idPasien, tanggal, keluhan) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiiss", $idKunjungan, $idDokter, $idPasien, $tanggal, $keluhan);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data kunjungan telah ditambahkan"); window.location.href = "kunjungan.php";</script>';
        } else {
            echo '<script>alert("pasien atau dokter sudah ada di daftar kunjungan"); window.location.href = "tambahkunjungan.php";</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '");</script>';
    }
    mysqli_close($konek);
}

// Fetch doctors
$doctors = mysqli_query($konek, "SELECT idDokter, nmDokter FROM dokter");
$patients = mysqli_query($konek, "SELECT idPasien, nmPasien FROM pasien");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Tambah Data Kunjungan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: gray;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
        }

        .form-group label {
            margin-bottom: .5rem;
        }

        .btn-block {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Tambah Data Kunjungan</h3>
        <form action="tambahkunjungan.php" method="POST">
        <div class="form-group">
                <label for="idKunjungan">ID Kunjungan</label>
                <input type="text" class="form-control mb-3" name="idKunjungan" placeholder="ID Kunjungan" required>
            </div>
        <div class="form-group">
    <label for="idDokter">Dokter</label>
    <select name="idDokter" class="form-control" required>
        <option value="" disabled selected>Pilih Dokter</option>
        <?php while ($doctor = mysqli_fetch_assoc($doctors)): ?>
            <option value="<?php echo $doctor['idDokter']; ?>"><?php echo $doctor['nmDokter']; ?></option>
        <?php endwhile; ?>
    </select>
</div>
<div class="form-group">
    <label for="idPasien">Pasien</label>
    <select name="idPasien" class="form-control" required>
        <option value="" disabled selected>Pilih Pasien</option>
        <?php while ($patient = mysqli_fetch_assoc($patients)): ?>
            <option value="<?php echo $patient['idPasien']; ?>"><?php echo $patient['nmPasien']; ?></option>
        <?php endwhile; ?>
    </select>
</div>

            <div class="form-group mt-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control mb-3" name="tanggal" required>
            </div>
            <div class="form-group mt-3">
                <label for="keluhan">Keluhan</label>
                <textarea name="keluhan" id="keluhan" cols="5" rows="3" placeholder="Keluhan" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary btn-block">
            </div>
        </form>
        <a href="kunjungan.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
