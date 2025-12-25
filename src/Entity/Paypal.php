<?php
include './Paiement.php';

class Paypal extends Paiement {
    private $email;
    private $password;

    public function __construct($id, $amount , $statut, $date_paiement,$order,$email,$password)
    {
    parent::__construct($id, $amount , $statut, $date_paiement,$order);
    $this->email = $email;   
    $this->password = $password;   

    }
    public function handlePaiement(){

        return "paid with paypal with email : ".$this->email;

    }
}





?>