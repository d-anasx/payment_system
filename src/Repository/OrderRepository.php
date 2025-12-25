<?php



include_once 'src\Database\DatabaseConnect.php';
include_once 'src\Entity\Order.php';

class OrderRepository {
    

    public function getAll(){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from orders";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "\n";
        foreach ($result as $e) {
            echo "id : ".$e["id"]."   status : ".$e["status"]."   total : ".$e["total_amount"]."   client : ".$e["client_id"]."\n";
        }
        echo "\n";
    }

    public function addOrder($order,$clientId){
        $status = $order->status;
        $total = $order->totalAmount;
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = 'INSERT into orders (status,total_amount,client_id) values (?,?,?) ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$total);
        $stmt->bindParam(3,$clientId);
        $stmt->execute();
    }

    

}


?>