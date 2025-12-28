<?php

class Order {
    private $id;
    private $totalAmount;
    private $status;
    private $client;
    private const PENDING_STATUS = "pending";
    private const DELIVERED_STATUS = "delivered";
    private const FAILED_STATUS = "failed";

    public function __construct($id, $totalAmount, $client, $status = self::PENDING_STATUS)
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
    
    public function deliver($orderId){
        echo "order delivered\n";
        $this->status = self::DELIVERED_STATUS;
        $orderRepo = new OrderRepository();
        $orderRepo->changeStatusToDelivered($orderId);
    }
}





?>