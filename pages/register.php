<?php
    $title = "Register | EasyEV-Charging";
    require_once '../includes/init.php';
    require_once '../classes/user.php';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user = new User();

        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $type = $_POST['type'];

        //Validation
        if(empty($name) || empty($email) || empty($password) || empty($type)){
            $error = "All fields are required";
        } 
        else {
            $registered = $user->register($name, $phone, $email, $password, $type);
            if ($registered){
                header("Location: login.php?success=1");
                exit();
            }
            else {
                $error = "Registration failed. Email might already be taken.";
            }
        }
    }
?>

<?php
    require_once "../includes/head.php";
?>

<h2 class="mainindexheading">Register</h2>
<?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
<div class="register-container">
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="phone" placeholder="Phone">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="type" required>
      <option value="">-- Select Type --</option>
      <option value="User">User</option>
      <option value="Admin">Admin</option>
    </select>
    <button type="submit">Register</button>
  </form>
</div>

<br><a href='../index.php'>Back</a>