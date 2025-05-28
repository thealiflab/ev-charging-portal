<?php
require_once "user.php";

class Admin extends User {
    public function addLocation($description, $stations, $cost){
        $stmt = $this->conn->prepare("INSERT INTO locations (Description, NumStations, CostPerHour) VALUES (?,?,?)");
        $stmt->bind_param("sid", $description, $stations, $cost); //string, int, decimal
        return $stmt->execute();
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM users";
        return $this->conn->query($sql);
    }

    #retrieves a list of users who are currently checked in
    public function getCheckedInUsers(){
        $sql = "
        SELECT c.UserID, u.Name AS UserName, c.LocationID, l.Description AS LocationName, c.CheckinTime
        FROM checkins c
        JOIN users u ON c.UserID = u.UserID
        JOIN locations l ON c.LocationID = l.LocationID
        WHERE c.CheckoutTime IS NULL
        ORDER BY c.CheckinTime DESC";

        return $this->conn->query($sql);
    }

    public function getAllLocations(){
        $sql = "SELECT * FROM locations";
        return $this->conn->query($sql);
    }

}

?>