<?php

Class DatabaseConnect {
    private $host = 'localhost';
    private $dbname = 'payment_system';
    private $username = 'root';
    private $password = '';

    public function connect(){
        try{
            $conn = new PDO('mysql:host=localhost;dbname=payment_system',$this->username , $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected successfully";
            return $conn;
        }
        catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
            

    }

}

$conn = new DatabaseConnect("localhost", "payment_system" , "root", "");

?>