<?php
include_once 'src\Entity\Paiement.php';

class Paypal extends Paiement {
    private $email;
    private $password;

    public function __construct($id, $amount,$order,$email,$password)
    {
    parent::__construct($id, $amount ,$order);
    $this->email = $email;   
    $this->password = $password;  

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

        echo "paid with paypal with email : ".$this->email;
        $this->status = self::PAID_STATUS;
        

    }
}




?>