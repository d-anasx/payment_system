<?php
include_once 'src\Entity\Paiement.php';
include_once 'src\Repository\PaiementRepository.php';

class Paypal extends Paiement {
    private $email;
    private $password;

    public function __construct($id, $amount,$order,$email,$password,$status = self::PENDING_STATUS)
    {
    parent::__construct($id, $amount ,$order,$status);
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

    public function validatePayment($paymentId){

        echo "paid with paypal with email : ".$this->email;
        $this->status = self::PAID_STATUS;
        $paymentRepo = new PaiementRepository();
        $paymentRepo->changeStatusToPaid($paymentId);

    }
}




?>