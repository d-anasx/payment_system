<?php

class Order {
    private $id;
    private $totalAmount;
    private $status;
    private $client;

    public function __construct($id, $totalAmount , $status, $client)
    {
        $this->id = $id;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
        $this->client = $client;
        
    }
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }
}





?>