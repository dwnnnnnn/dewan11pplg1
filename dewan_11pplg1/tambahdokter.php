<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Simpan'])) {
    $idDokter = $_POST['idDokter'];
    $nmDokter = $_POST['nmDokter'];
    $spesialisasi = $_POST['spesialisasi'];
    $noTelp = $_POST['noTelp'];

    // Insert into the database
    $sql = "INSERT INTO dokter (idDokter, nmDokter, spesialisasi, noTelp) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $idDokter, $nmDokter, $spesialisasi, $noTelp);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data dokter telah ditambahkan"); window.location.href = "dokter.php";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '");</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '");</script>';
    }
    mysqli_close($konek);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Tambah Data Pasien</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: gray; /* Gray background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
        }

        .container {
            background-color: white; /* White background for the form */
            border-radius: 8px;
            padding: 20px; /* Add some padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add some shadow */
            max-width: 600px; /* Adjust max-width for the form */
        }

        .form-group label {
            margin-bottom: .5rem; /* Add space below labels */
        }

        .btn-block {
            width: 100%; /* Make the submit button full-width */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Tambah Data Dokter</h3>
        <form action="tambahdokter.php" method="POST">
            <div class="form-group">
                <label for="idDokter">ID Dokter</label>
                <input type="text" class="form-control mb-3" name="idDokter" placeholder="ID Dokter" required>
            </div>
            <div class="form-group">
                <label for="nmDokter">Nama Dokter</label>
                <input type="text" class="form-control mb-3" name="nmDokter" placeholder="Nama Dokter" required>
            </div>
            <div class="form-group mt-3">
                <label for="spesialisasi">spesialisasi</label>
                <textarea name="spesialisasi" id="spesialisasi" cols="5" rows="3" placeholder="spesialisasi" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="noTelp">Nomor Telepon</label>
                <textarea name="noTelp" id="noTelp" cols="5" rows="3" placeholder="Nomor Telepon" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary btn-block">
            </div>
        </form>
        <a href="dokter.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
