<?php
require_once 'database.php';

class User {
    protected $conn;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    public function register($name, $phone, $email, $password, $type){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (Name, Phone, Email, Password, Type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $phone, $email, $hashedPassword, $type); //string, string, string, string, string, 
        return $stmt->execute();
    }

    public function login($email, $password){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE EMAIL = ?");
        $stmt->bind_param("s", $email); //string
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user && password_verify($password, hash: $user['Password'])){
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function getUserById($userID) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE UserID = ?");
        $stmt->bind_param("i", $userID); //integer
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>