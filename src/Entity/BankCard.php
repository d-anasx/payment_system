<?php
include './Paiement.php';

class BankCard extends Paiement {
    private $cardNum;
    private $expDate;
    private $cvv;

    public function __construct($id, $amount , $statut, $date_paiement,$order,$cardNum,$expDate,$cvv)
    {
    parent::__construct($id, $amount , $statut, $date_paiement, $order);
    $this->cardNum = $cardNum;   
    $this->expDate = $expDate;
    $this->cvv = $cvv;

    }
    public function handlePaiement(){

        echo "paid with bank card : ".substr($this->cardNum,0,5)."xxxxxxxx";

    }
}







?>