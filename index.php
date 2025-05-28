<?php
    $title = "EasyEV-Charging";
    require_once "includes/head.php";
    require_once 'includes/init.php';

    if (isset($_SESSION['user'])) {
        header("Location: pages/dashboard.php");
        exit();
}
?>

    <h1>Welcome to EasyEV-Charging</h1>
    <a href="pages/register.php">Register</a> |
    <a href="pages/login.php">Login</a>

    
<?php
    require "./includes/tail.php";
?>