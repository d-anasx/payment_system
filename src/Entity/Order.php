<?php

class Order {
    private $id;
    private $totalAmount;
    private $statut;
    private $client;

    public function __construct($id, $totalAmount , $statut, $client)
    {
        $this->id = $id;
        $this->totalAmount = $totalAmount;
        $this->statut = $statut;
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