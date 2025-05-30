<?php
    $title = "EasyEV-Charging";
    require_once 'includes/init.php';

    if (isset($_SESSION['user'])) {
        header("Location: pages/dashboard.php");
        exit();
}
?>

<?php
    require_once "./includes/head.php";
?>

    <h1 class="mainindexheading">Welcome to EasyEV-Charging</h1>
    <h3>Please Login or Register to the site</h3>
    <div class="button-container">
        <button class="btn register-btn"><a href="pages/register.php">Register</a></button>
        <button class="btn login-btn"><a href="pages/login.php">Login</a></button>
    </div>
    

    
<?php
    require "./includes/tail.php";
?>