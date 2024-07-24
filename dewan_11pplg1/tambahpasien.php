<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $idPasien = $_POST['idPasien'];
    $nmPasien = $_POST['nmPasien'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    // Insert into the database
    $sql = "INSERT INTO pasien (idpasien, nmpasien, jk, alamat) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $idPasien, $nmPasien, $jk, $alamat);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data pasien telah ditambahkan"); window.location.href = "pasien.php";</script>';
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
        <h3 class="text-center">Tambah Data Pasien</h3>
        <form action="tambahpasien.php" method="POST">
            <div class="form-group">
                <label for="idPasien">ID Pasien</label>
                <input type="text" class="form-control mb-3" name="idPasien" placeholder="ID Pasien" required>
            </div>
            <div class="form-group">
                <label for="nmPasien">Nama Pasien</label>
                <input type="text" class="form-control mb-3" name="nmPasien" placeholder="Nama Pasien" required>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jk" value="Perempuan" required> Perempuan
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jk" value="Laki-laki" required> Laki-laki
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" cols="5" rows="3" placeholder="Alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary btn-block">
            </div>
        </form>
        <a href="pasien.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
