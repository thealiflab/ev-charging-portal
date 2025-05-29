<?php
require_once '../../includes/init.php';
require_once '../../classes/database.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['Type'] != 'Admin'){
    header("Location: ../login.php");
    exit();
}

$db = Database::getInstance()->getConnection();

//Search Feature

$searchText = "";
if(isset($_GET['search'])){
    $searchText = trim($_GET['search']);
    $sqlSearch = "SELECT l.LocationID, l.Description, l.NumStations, l.CostPerHour, COUNT(c.CheckinID) AS Occupied FROM locations l LEFT JOIN checkins c ON l.LocationID = c.LocationID AND c.CheckoutTime IS NULL WHERE l.Description LIKE ? GROUP BY l.LocationID";
    $stmt = $db->prepare($sqlSearch);
    $like = "%".$searchText."%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $locations = $stmt->get_result(); 
}
else{
    $sqlSearch = "SELECT l.LocationID, l.Description, l.NumStations, l.CostPerHour, COUNT(c.CheckinID) AS Occupied FROM locations l LEFT JOIN checkins c ON l.LocationID = c.LocationID AND c.CheckoutTime IS NULL GROUP BY l.LocationID";
    $locations = $db->query($sqlSearch);
}
?>

<h2>Welcome, <?= $_SESSION['user']['Name'] ?> (Admin)</h2>

<ul>
    <li><a href="add_location.php">Add New Location</a></li>
    <li><a href="edit_location_list.php">Edit/Delete Locations</a></li>
    <li><a href="list_users.php">List Users</a></li>
    <li><a href="users_checkedin.php">Users Currently Checked-In</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<hr>

<h3>Search Charging Locations</h3>
<form method="GET" action="dashboard_admin.php">
    <input type="text" name="search" placeholder="Enter Location Keyword..." value="<?= htmlspecialchars($searchText) ?>">
    <button type="submit">Search</button>
    <a href="dashboard_admin.php"><button type="button">Reset</button></a>
</form>

<br>

<h3>Charging Locations</h3>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Stations</th>
        <th>Occupied</th>
        <th>Cost/hour</th>
        <th>Action</th>
    </tr>
    <?php if ($locations->num_rows > 0): ?>
        <?php while ($row = $locations->fetch_assoc()): ?>
            <?php
                $isFull = $row['Occupied'] >= $row['NumStations'];
                $actionStatus = $isFull 
                    ? "<span style='color:red;'>❌ Full</span>" 
                    : "<span style='color:green;'>✅ Vacant</span>";
            ?>
            <tr>
                <td><?= $row['LocationID'] ?></td>
                <td><?= $row['Description'] ?></td>
                <td><?= $row['NumStations'] ?></td>
                <td><?= $row['Occupied'] ?></td>
                <td>$<?= $row['CostPerHour'] ?></td>
                <td><?= $actionStatus ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No locations found.</td></tr>
    <?php endif; ?>
</table>