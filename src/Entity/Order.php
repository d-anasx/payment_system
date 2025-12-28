<?php

class Order {
    private $id;
    private $totalAmount;
    private $status;
    private $client;
    private const PENDING_STATUS = "pending";
    private const PAID_STATUS = "paid";
    private const FAILED_STATUS = "failed";

    public function __construct($id, $totalAmount, $client)
    {
        $this->id = $id;
        $this->totalAmount = $totalAmount;
        $this->status = self::PENDING_STATUS;
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