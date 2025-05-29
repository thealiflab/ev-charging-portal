<?php
require_once '../../includes/init.php';
require_once '../../classes/admin.php';

$admin = new Admin();
$result = $admin->getCheckedInUsers();

echo "<h3>Currently Checked-In Users</h3>";
echo "<table border='1'>
<tr>
    <th>User ID</th>
    <th>Name</th>
    <th>Location ID</th>
    <th>Location Name</th>
    <th>Check-in Time</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['UserID']}</td>
        <td>{$row['UserName']}</td>
        <td>{$row['LocationID']}</td>
        <td>{$row['LocationName']}</td>
        <td>{$row['CheckinTime']}</td>
    </tr>";
}

echo "</table><br><a href='dashboard_admin.php'>Back</a>";