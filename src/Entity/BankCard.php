<?php
include_once 'src\Entity\BankCard.php';

class BankCard extends Paiement {
    private $cardNum;
    private $expDate;
    private $cvv;

    public function __construct($id, $amount ,$order,$cardNum)
    {
    parent::__construct($id, $amount , $order);
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

    public function validatePayment(){

        echo "paid with bank card : ".substr($this->cardNum,0,5)."xxxxxxxx";
        $this->status = self::PAID_STATUS;
        

    }
}







?>