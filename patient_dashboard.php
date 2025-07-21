<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// DB Connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'medigo_website';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

// Latest appointment_id
$latest_id = 'N/A';
$stmt = $conn->prepare("SELECT appointment_id FROM appointment WHERE email_address = ? ORDER BY appointment_id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($latest_id);
$stmt->fetch();
$stmt->close();

// All appointments
$stmt = $conn->prepare("SELECT appointment_id, patient_name, email_address, phone_number, doctor_speciality, appointment_date, appointment_time, reason_for_visit 
                        FROM appointment WHERE email_address = ?");
$stmt->bind_param("s", $email);
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
    <title>Patient Dashboard</title>
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
        h2 {
            margin-bottom: 1rem;
        }
        a.logout {
            display: inline-block;
            margin-top: 1rem;
            color: #fff;
            text-decoration: underline;
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
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        tr:hover {
            background-color: #d1eaff;
        }
        .no-appointments {
            font-size: 1.1rem;
            color: #333;
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Welcome to the Patient Dashboard!</h1>
    <p>Your Appointment ID: <strong><?php echo $latest_id ?? 'N/A'; ?></strong></p>
    <a class="logout" href="logout.php">Logout</a>
</div>

<?php if (count($appointments) > 0): ?>
    <h2>Your Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Doctor Specialty</th>
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
                    <td><?php echo htmlspecialchars($a['doctor_speciality']); ?></td>
                    <td><?php echo htmlspecialchars($a['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($a['appointment_time']); ?></td>
                    <td><?php echo htmlspecialchars($a['reason_for_visit']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="no-appointments">You have no appointments yet.</p>
<?php endif; ?>

</body>
</html>
