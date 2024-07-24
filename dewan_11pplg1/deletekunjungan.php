<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $idKunjungan = $_POST['id'];

    // Prepare and execute the DELETE statement
    $sql = "DELETE FROM kunjungan WHERE idKunjungan = ?";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $idKunjungan);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Kunjungan telah dihapus"); window.location.href = "kunjungan.php";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '"); window.location.href = "kunjungan.php";</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '"); window.location.href = "kunjungan.php";</script>';
    }

    mysqli_close($konek);
} else {
    echo '<script>alert("ID kunjungan tidak ditemukan"); window.location.href = "kunjungan.php";</script>';
}
?>
