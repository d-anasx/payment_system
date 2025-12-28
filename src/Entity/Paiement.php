<?php

include_once "src\Interface\PaiementInterface.php";

abstract class Paiement implements PaiementInterface {
    protected $id;
    protected $amount;
    protected $status;
    protected $payment_date;
    protected $order;
    protected const PENDING_STATUS = "pending";
    protected const PAID_STATUS = "paid";
    protected const FAILED_STATUS = "failed";

    public function __construct($id, $amount ,$order,$status = self::PENDING_STATUS)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->status = $status;
        $now = new DateTime();
        $this->payment_date = $now->format("Y-m-d H:i:s");
        $this->order = $order;
        
    }

    abstract public function validatePayment($paymentId);
}









?>