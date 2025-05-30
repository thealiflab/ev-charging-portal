<?php
$title = "Modify Location | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/database.php';

$db = Database::getInstance()->getConnection();

if (isset($_POST['update'])) {
    $sql = "UPDATE locations SET Description=?, NumStations=?, CostPerHour=? WHERE LocationID=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sidi", $_POST['desc'], $_POST['stations'], $_POST['cost'], $_POST['id']); //string, int, decimal, int
    $stmt->execute();
    echo "Location updated. <a href='dashboard_admin.php'>Back</a>";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM locations WHERE LocationID=$id";
$row = $db->query($sql)->fetch_assoc();
?>

<?php
    require_once "../../includes/head.php";
?>

<h3 class="mainindexheading">Edit Location</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="text" name="desc" value="<?= $row['Description'] ?>"><br>
    <input type="number" name="stations" value="<?= $row['NumStations'] ?>"><br>
    <input type="number" step="0.01" name="cost" value="<?= $row['CostPerHour'] ?>"><br><br>
    <button name="update">Update</button>
</form>
<br>
<a href="dashboard_admin.php">Back</a>

<?php
    require_once "../../includes/tail.php";
?>
