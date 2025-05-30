<?php
$title = "Users Checkout | EasyEV-Charging";
require_once '../../includes/init.php';
require_once '../../classes/checkin.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'User') {
    header("Location: ../login.php");
    exit();
}

$checkinID = $_GET['id'];

$check = new Checkin();
$check->checkout($checkinID);

echo "Checked out successfully! <a href='dashboard_user.php'>Go Back</a>";

