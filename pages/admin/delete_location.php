<?php
require_once '../includes/init.php';
require_once '../classes/database.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['Type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);
$db = Database::getInstance()->getConnection();

$db->query("DELETE FROM locations WHERE LocationID = $id");

header("Location: dashboard_admin.php");
exit();

?>
