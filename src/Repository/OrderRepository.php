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
        return $result;
    }

    public function addOrder($order,$clientId){
        $status = $order->status;
        $total = $order->totalAmount;
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = 'INSERT into orders (total_amount,client_id) values (?,?) ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$total);
        $stmt->bindParam(2,$clientId);
        $stmt->execute();
    }

    public function getOne($orderId){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from orders where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$orderId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }

    

}


?>