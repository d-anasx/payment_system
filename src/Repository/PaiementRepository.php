<?php
include_once 'src\Database\DatabaseConnect.php';
class PaiementRepository {
    
    public function getAll(){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from payments";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "\n";
        foreach ($result as $e) {
            echo "id : ".$e["id"]."   status : ".$e["status"]."   total : ".$e["amount"]."   payment_date : ".$e["payment_date"]."   type : ".$e["payment_type"]."\n";
        }
        echo "\n";
    }
}


?>