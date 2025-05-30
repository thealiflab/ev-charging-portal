<?php
    $title = "Login | EasyEV-Charging";
    require_once '../includes/init.php';
    require_once '../classes/user.php';

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $user = new User();

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $login = $user->login($email, $password);

        if($login){
            header("Location: ../actions/dashboard_action.php"); //dashboard will decide the type of user: admin or user
            exit();
        }
        else{
            $error = "Invalid email or password";
        }
    }

    if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p style='color:green;'>Registration successful. Please login.</p>";
    }
?>


<?php
    require_once "../includes/head.php";
?>

<h2 class="mainindexheading">Login</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <div class="login-container">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </div>
    
</form>
<br><a href='../index.php'>Back</a>


<?php
    require "../includes/tail.php";
?>