<?php
require_once '../includes/init.php';
require_once '../classes/checkin.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'User') {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user']['UserID'];
$check = new Checkin();
$result = $check->getUserCheckins($userID);

echo "<h3>Charging History</h3>";
echo "<table border='1'>
<tr><th>Location</th><th>Check-in Time</th><th>Check-out Time</th><th>Total Cost</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['LocationName']}</td>
        <td>{$row['CheckinTime']}</td>
        <td>" . ($row['CheckoutTime'] ?? '-') . "</td>
        <td>" . (is_null($row['TotalCost']) ? '-' : '$' . number_format($row['TotalCost'], 2)) . "</td>
    </tr>";
}
echo "</table>";
echo "<br><a href='dashboard_user.php'>Back</a>";
