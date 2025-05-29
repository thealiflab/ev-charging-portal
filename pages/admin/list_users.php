<?php
require_once '../includes/init.php';
require_once '../classes/admin.php';

$admin = new Admin();
$result = $admin->getAllUsers();

echo "<h3>All Registered Users</h3>";
echo "<table border='1'><tr><th>Name</th><th>Email</th><th>Phone</th><th>Type</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Name']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['Phone']}</td>
        <td>{$row['Type']}</td>
    </tr>";
}
echo "</table><br><a href='dashboard_admin.php'>Back</a>";

?>