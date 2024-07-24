<?php
include 'config.php';

$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$visit_date = $_POST['visit_date'];
$notes = $_POST['notes'];

$query = "INSERT INTO kunjungan (patient_id, doctor_id, visit_date, notes) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiss", $patient_id, $doctor_id, $visit_date, $notes);
$stmt->execute();

echo "Visit recorded successfully.";
?>
