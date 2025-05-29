<?php
require_once '../includes/init.php';
require_once '../classes/database.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

$db = Database::getInstance()->getConnection();
$locations = $db->query("SELECT * FROM locations");
?>

<h2>Edit Charging Locations</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Stations</th>
        <th>Cost/hour</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $locations->fetch_assoc()): ?>
        <tr>
            <td><?= $row['LocationID'] ?></td>
            <td><?= $row['Description'] ?></td>
            <td><?= $row['NumStations'] ?></td>
            <td>$<?= $row['CostPerHour'] ?></td>
            <td>
                <a href="edit_location.php?id=<?= $row['LocationID'] ?>">Edit</a> |
                <a href="delete_location.php?id=<?= $row['LocationID'] ?>"
                   onclick="return confirm('Are you sure you want to delete this location?');">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br><a href="dashboard_admin.php">Back to Dashboard</a>
