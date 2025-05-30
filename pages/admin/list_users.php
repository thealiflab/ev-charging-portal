<?php
$title = "List Users | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/admin.php';

$admin = new Admin();
$result = $admin->getAllUsers();

require_once "../../includes/head.php";

echo "<h3 class='mainindexheading'>All Registered Users</h3>";
echo "<table class='table-container' border='0'><tr><th>Name</th><th>Email</th><th>Phone</th><th>Type</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Name']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['Phone']}</td>
        <td>{$row['Type']}</td>
    </tr>";
}
echo "</table><br><a href='dashboard_admin.php'>Back</a>";

require_once "../../includes/tail.php";

?>