<?php
require_once 'database.php';

class Checkin{
    private $conn;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    public function checkin($userID, $locationID){
        $sql = "SELECT COUNT(*) AS count FROM chekins WHERE UserID = ? AND CheckoutTime IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if($result['count'] > 0){
            return false; // if false that means user is already check in somewhere
        }
        
        $sql = "SELECT (SELECT COUNT(*) FROM checkins WHERE LocationID = ? AND CheckoutTime IS NULL) AS current_occupancy, (SELECT NumStations FROM locations WHERE LocationID = ?) AS max_capacity";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $locationID, $locationID);
        $result = $stmt->get_result()->fetch_assoc();

        if($result['current_occupancy'] >= $result['max_capacity']){
            return false; //if false that means location is full
        }

        $sql = "INSERT INTO checkins(UserID, LocationID) VALUES = ? ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $userID, $locationID);
        return $stmt->execute(); //returns true if execute successfully
    }

    public function checkout($checkinID){
        $now = date("Y-m-d H:i:s");
        $cost = $this->calculateCost($checkinID, strtotime($now));

        $sql = "UPDATE checkins SET CheckoutTime = ?, TotalCost = ? WHERE CheckinID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdi", $now, $cost, $checkinID); //string, decimal, integer
        return $stmt->execute();
    }

    public function estimateCurrentCost($checkinID){
        return $this->calculateCost($checkinID, time());
    }

    private function calculateCost($checkinID, $endTimestamp){
        $sql = "SELECT c.CheckinTime, l.CostPerHour FROM checkins c JOIN locations l ON c.LocationID = l.LocationID WHERE c.CheckinID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $checkinID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if(!$result){
            return 0;
        }

        $start = strtotime($result['CheckinTime']);
        $hours = ceil(($endTimestamp - $start) / 3600);
        return $hours * $result['CostPerHour'];
    }

    public function getUserCheckins($userID){
        $sql = "SELECT c.CheckinTime, c.CheckoutTime, c.TotalCost, l.Description AS LocationName FROM checkins c JOIN locations l ON c.LocationID = l.LocationID WHERE c.UserID = ? ORDER BY c.CheckinTime DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        return $stmt->get_result();
    }

}



?>