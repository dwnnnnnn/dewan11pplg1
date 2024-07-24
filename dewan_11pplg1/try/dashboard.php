<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . ($_SESSION['role'] == 'doctor' ? 'Doctor' : 'Patient');
?>
<a href="kunjungan.php">Record Visit</a>
