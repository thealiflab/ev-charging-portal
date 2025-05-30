<?php
$title = "User Checkin | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/checkin.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'User') {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user']['UserID'];
$locationID = $_GET['id'];

$check = new Checkin();
$success = $check->checkin($userID, $locationID);

if ($success) {
    echo "Checked in successfully. <a href='dashboard_user.php'>Back</a>";
} else {
    echo "Check-in failed. You may already be checked in, or the location is full. <a href='dashboard_user.php'>Back</a>";
}
