<?php
include "src\Database\DatabaseConnect.php";

class ClientRepository {
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getAll(){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from clients";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    }

    public function addClient($client){
        $name = $client->name;
        $email = $client->email;
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = 'INSERT into clients (name,email) values (?,?) ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$email);
        $stmt->execute();
    }

    public function getOne($clientId){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from clients where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$clientId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }
}

?>