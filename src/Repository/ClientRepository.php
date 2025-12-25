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

        foreach ($result as $e) {
            echo "id : ".$e["id"]."   name : ".$e["name"]."   email : ".$e["email"]."\n";
        }

    }

    public function addClient($client){
        $name = $client->name;
        $email = $client->email;
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = 'INSERT into clients (name,email) values (?,?) ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$name,PDO::PARAM_STR);
        $stmt->bindParam(2,$email,PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>