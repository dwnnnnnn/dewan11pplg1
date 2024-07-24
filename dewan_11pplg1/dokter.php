<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Halaman Utama</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
  <style>

body {
            background-image: url('background1.jpg');
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-attachment: fixed; /* Fix the background image while scrolling */
            font-family: Arial, sans-serif; /* Set a default font */
            color: #333; /* Default text color */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            min-height: 100vh; /* Ensure the body takes up at least the full viewport height */
        }

        .delete-button {
            margin-left: 10px;
            background-color: red;
            color: white;
            border: none;
            padding: 2px 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-button:hover {
            background-color: darkred;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* Center the modal */
            padding: 20px; /* Adjusted padding */
            border: 1px solid #888;
            width: 320px; /* Fixed width for a square modal */
            border-radius: 12px; /* Semi-round corners */
            position: relative;
            text-align: center; /* Center text */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px; /* Adjusted padding */
            cursor: pointer;
            border-radius: 5px;
            width: 80%; /* 80% width of the modal content */
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        .modal-button2 {
            background-color: white;
            color: black;
            border: none;
            padding: 10px; /* Adjusted padding */
            cursor: pointer;
            border-radius: 5px;
            width: 80%; /* 80% width of the modal content */
            height: 40px; /* Adjusted height */
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        .modal-button:hover {
            background-color: darkred;
        }

        .modal-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 20px; /* Added space for buttons */
        }

        .warning-image {
            display: block; /* Ensures the image behaves as a block element */
            margin: 0 auto; /* Centers the image horizontally */
            width: 50px;
            height: 50px;
        }

        /* Style for the table */
        .table {
            table-layout: fixed;
            width: 100%; /* Full width */
        }

        .table th, .table td {
            text-align: center;
        }

        .jam-column {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .jam-column {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
  </style>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="kunjungan.php">kunjungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pasien.php">Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dokter.php">Dokter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row mt-3">
        <div class="col-sm">
            <h3>Tabel Dokter</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="tambahdokter.php" class="btn btn-primary btn-sm d-flex justify-content-center">Tambah Data</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover table-sm">
                <tr>
                    <th>No</th>
                    <th>ID Dokter</th>
                    <th>Nama Dokter</th>
                    <th>spesialisasi</th>
                    <th>No Telepon</th>
                    <th>Action</th>
                </tr>
                <?php
                include 'config.php';
                $no = 1;
                $hasil = $konek->query("SELECT * FROM dokter");
                while ($row = $hasil->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['idDokter']; ?></td>
                    <td><?= $row['nmDokter']; ?></td>
                    <td><?= $row['spesialisasi']; ?></td>
                    <td><?= $row['noTelp']; ?></td>
                    <td>
                        <a href="editdokter.php?edit=<?= $row['idDokter']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="deletedokter.php" style="display:inline;" onsubmit="return confirmDeletion(this);">
                            <input type="hidden" name="id" value="<?= $row['idDokter']; ?>">
                            <input type="submit" value="Delete" class="delete-button">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img src="warning.png" alt="Warning" class="warning-image">
        <p>Apakah Anda yakin ingin menghapus data Dokter ini ?</p>
        <div class="modal-container">
            <button class="modal-button" id="confirmDelete">Delete</button>
            <button class="modal-button2" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let deleteForm;

    function confirmDeletion(form) {
        deleteForm = form;
        document.getElementById('deleteModal').style.display = "block";
        return false; // Prevent the default form submission
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = "none";
    }

    document.getElementById('confirmDelete').onclick = function() {
        deleteForm.submit();
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target === document.getElementById('deleteModal')) {
            closeModal();
        }
    }
</script>

<script src="assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
