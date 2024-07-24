<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $idDokter = $_POST['id'];
    $sql = "DELETE FROM dokter WHERE idDokter = ?";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $idDokter);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data Dokter telah dihapus"); window.location.href = "dokter.php";</script>';
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($konek);
    }

    mysqli_close($konek);
} else {
    echo '<script>alert("ID Dokter tidak ditemukan"); window.location.href = "dokter.php";</script>';
}
?>

