<?php
$title = "ADD Location | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Admin();
    $added = $admin->addLocation($_POST['description'], $_POST['stations'], $_POST['cost']);
    echo $added ? "Location added successfully." : "Failed to add location.";
}
?>

<?php
    require_once "../../includes/head.php";
?>

<h3 class="mainindexheading">Add Charging Location</h3>
<form method="POST">
    <input type="text" name="description" placeholder="Location Description" required><br>
    <input type="number" name="stations" placeholder="Number of Stations" required><br>
    <input type="number" step="0.01" name="cost" placeholder="Cost Per Hour" required><br><br>
    <button type="submit">Add Location</button>
</form>

<a href="dashboard_admin.php">Back</a>

<?php
    require_once "../../includes/tail.php";
?>
