<?php
require_once '../includes/init.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$type = $_SESSION['user']['Type'];
if ($type == 'Admin') {
    header("Location: dashboard_admin.php");
} else {
    header("Location: dashboard_user.php");
}
exit();