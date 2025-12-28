<?php

abstract class Paiement {
    protected $id;
    protected $amount;
    protected $status;
    protected $payment_date;
    protected $order;
    protected const PENDING_STATUS = "pending";
    protected const PAID_STATUS = "paid";
    protected const FAILED_STATUS = "failed";

    public function __construct($id, $amount,$order)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->status = self::PENDING_STATUS;
        $now = new DateTime();
        $this->payment_date = $now->format("Y-m-d H:i:s");
        $this->order = $order;
        
    }

    abstract public function validatePayment();
}









?>