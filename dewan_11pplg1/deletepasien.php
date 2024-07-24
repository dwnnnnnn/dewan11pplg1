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
    $idPasien = $_POST['id'];
    $sql = "DELETE FROM pasien WHERE idPasien = ?";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $idPasien);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Pasien telah dihapus"); window.location.href = "pasien.php";</script>';
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($konek);
    }

    mysqli_close($konek);
} else {
    echo '<script>alert("ID pasien tidak ditemukan"); window.location.href = "pasien.php";</script>';
}
?>

