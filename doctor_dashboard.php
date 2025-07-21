<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

// DB connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'medigo_website';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get doctor's specialty
$stmt = $conn->prepare("SELECT specialty FROM doctors WHERE id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$stmt->bind_result($doctor_specialty);
$stmt->fetch();
$stmt->close();

// get appointments where doctor_speciality matches
$stmt = $conn->prepare("SELECT appointment_id, patient_name, email_address, phone_number, patient_age, patient_gender, appointment_date, appointment_time, reason_for_visit FROM appointment WHERE doctor_speciality = ?");
$stmt->bind_param("s", $doctor_specialty);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row; 
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 2rem;
            font-family: Arial, sans-serif;
            background-color: rgb(240, 248, 255);
        }
        .box {
            background-color: rgb(68, 170, 243);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }
        h1, p {
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0077cc;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a.logout {
            display: inline-block;
            margin-top: 1rem;
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Welcome to the Doctor Dashboard!</h1>
    <p>Your session is active. Your ID: <strong><?php echo $doctor_id; ?></strong></p>
    <p>Your Specialty: <strong><?php echo htmlspecialchars($doctor_specialty); ?></strong></p>
    <a class="logout" href="logout.php">Logout</a>
</div>

<?php if (count($appointments) > 0): ?>
    <h2>Appointments under your specialty</h2>
    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $a): ?>
                <tr>
                    <td><?php echo htmlspecialchars($a['appointment_id']); ?></td>
                    <td><?php echo htmlspecialchars($a['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($a['email_address']); ?></td>
                    <td><?php echo htmlspecialchars($a['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($a['patient_age']); ?></td>
                    <td><?php echo htmlspecialchars($a['patient_gender']); ?></td>
                    <td><?php echo htmlspecialchars($a['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($a['appointment_time']); ?></td>
                    <td><?php echo htmlspecialchars($a['reason_for_visit']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No appointments found for your specialty.</p>
<?php endif; ?>

</body>
</html>
