<?php
include 'config.php';

// Fetch patients
$queryPatients = "SELECT * FROM patients";
$patients = $conn->query($queryPatients);

// Fetch doctors
$queryDoctors = "SELECT * FROM doctors";
$doctors = $conn->query($queryDoctors);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Visit</title>
</head>
<body>

<h2>Record Visit</h2>

<form action="record_kunjungan.php" method="post">
    <h3>Select Patient:</h3>
    <?php while ($patient = $patients->fetch_assoc()): ?>
        <input type="radio" name="patient_id" value="<?php echo $patient['id']; ?>" required>
        <label><?php echo $patient['name']; ?></label><br>
    <?php endwhile; ?>

    <h3>Select Doctor:</h3>
    <?php while ($doctor = $doctors->fetch_assoc()): ?>
        <input type="radio" name="doctor_id" value="<?php echo $doctor['id']; ?>" required>
        <label><?php echo $doctor['name']; ?></label><br>
    <?php endwhile; ?>

    <label for="visit_date">Visit Date:</label>
    <input type="date" name="visit_date" required><br><br>

    <label for="notes">Notes:</label><br>
    <textarea name="notes" placeholder="Visit notes" rows="4" cols="50"></textarea><br><br>

    <button type="submit">Record Visit</button>
</form>

</body>
</html>
