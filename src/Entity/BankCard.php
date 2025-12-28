<?php
include_once 'src\Entity\BankCard.php';

class BankCard extends Paiement {
    private $cardNum;

    public function __construct($id, $amount ,$order,$cardNum,$status = self::PENDING_STATUS)
    {
    parent::__construct($id, $amount , $order,$status);
    $this->cardNum = $cardNum;

    }
    public function __get($info)
    {
        return $this->$info;
    }
    
    public function __set($info, $value)
    {
        $this->$info = $value;
    }

    public function validatePayment($paymentId){

        echo "paid with bank card : ".substr($this->cardNum,0,5)."xxxxxxxx";
        $this->status = self::PAID_STATUS;
        $paymentRepo = new PaiementRepository();
        $paymentRepo->changeStatusToPaid($paymentId);
        

    }
}







?>