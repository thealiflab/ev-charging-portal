<?php
$title = "Dashboard User | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/database.php';
require_once '../../classes/checkin.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'User') {
    header("Location: ../login.php");
    exit();
}

$db = Database::getInstance()->getConnection();

$userID = $_SESSION['user']['UserID'];

$sql = "SELECT c.CheckinID, l.Description, c.CheckinTime FROM checkins c JOIN locations l ON c.LocationID = l.LocationID WHERE c.UserID = ? AND c.CheckoutTime IS NULL";
$stmtCurrent = $db->prepare($sql);
$stmtCurrent->bind_param("i", $userID);
$stmtCurrent->execute();
$currentCheckin = $stmtCurrent->get_result()->fetch_assoc();


//Search Feature
$searchText = "";
if(isset($_GET['search'])){
    $searchText = trim($_GET['search']);
    $sqlSearch = "SELECT l.LocationID, l.Description, l.NumStations, l.CostPerHour, COUNT(c.CheckinID) AS Occupied FROM locations l LEFT JOIN checkins c ON l.LocationID = c.LocationID AND c.CheckoutTime IS NULL WHERE l.Description LIKE ? GROUP BY l.LocationID";
    $stmt = $db->prepare($sqlSearch);
    $like = "%" .$searchText. "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $locations = $stmt->get_result();
} else{
    $sqlSearch = "SELECT l.LocationID, l.Description, l.NumStations, l.CostPerHour, COUNT(c.CheckinID) AS Occupied FROM locations l LEFT JOIN checkins c ON l.LocationID = c.LocationID AND c.CheckoutTime IS NULL GROUP BY l.LocationID";
    $locations = $db->query($sqlSearch);
}


require_once "../../includes/head.php";


echo "<h2 class='mainindexheading'>Welcome, " . $_SESSION['user']['Name'] . "</h2>";

if ($currentCheckin) {
    echo "<h3 style='color:Green;'><strong>Currently Checked In</strong</h3>";
    echo "Location: <strong>{$currentCheckin['Description']}</strong><br>";
    echo "Check-in start from Time: {$currentCheckin['CheckinTime']}<br>";

    $check = new Checkin();
    $cost = $check->estimateCurrentCost($currentCheckin['CheckinID']);
    echo "Current Estimated Cost needs to pay (Updates every hour): <strong>$" . number_format($cost, 2) . "</strong><br><br>";
    echo "<a href='checkout_user.php?id={$currentCheckin['CheckinID']}'>Check Out</a><br><br><br><hr>";
} else {
    echo "<h3> You are not currently checked in.</h3><br><hr>";
}

echo "<h3 class='mainindexheading'>Search Charging Locations</h3>
<form method='GET' action='dashboard_user.php'>
    <input type='text' name='search' placeholder='Enter Location Keyword...' value='" . htmlspecialchars($searchText) . "'>
    <button type='submit'>Search</button>
    <a href='dashboard_user.php'><button type='button'>Reset</button></a>
</form>";

echo "<br><h3>Available Charging Stations:</h3>";
echo "<table class='table-container' border='0'>
<tr>
    <th>ID</th>
    <th>Description</th>
    <th>Stations</th>
    <th>Occupied</th>
    <th>Cost/hr</th>
    <th>Action</th>
</tr>";

if ($locations->num_rows > 0) {
    while ($row = $locations->fetch_assoc()) {
        $isFull = $row['Occupied'] >= $row['NumStations'];
        echo "<tr>
            <td>{$row['LocationID']}</td>
            <td>{$row['Description']}</td>
            <td>{$row['NumStations']}</td>
            <td>{$row['Occupied']}</td>
            <td>\${$row['CostPerHour']}</td>
            <td>";
        if ($isFull) {
            echo "<span style='color:red;'>Full</span>";
        } else {
            echo "<a href='checkin_user.php?id={$row['LocationID']}'>Check In</a>";
        }
        echo "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No locations found.</td></tr>";
}
echo "</table>";

echo "<br><a href='user_history.php'>View History</a> | ";
echo "<a href='../logout.php'>Logout</a>";

require_once "../../includes/head.php";

?>