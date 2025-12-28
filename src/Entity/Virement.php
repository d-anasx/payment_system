<?php
include_once 'src\Entity\Paiement.php';

class Virement extends Paiement {
    private $rib;

    public function __construct($id, $amount ,$order,$rib,$status = self::PENDING_STATUS)
    {
    parent::__construct($id, $amount ,$order,$status);
    $this->rib = $rib;

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

        echo "paid with bank tansfer with rib : ".substr($this->rib,0,5)."xxxxxxxx";
        $this->status = self::PAID_STATUS;
        $paymentRepo = new PaiementRepository();
        $paymentRepo->changeStatusToPaid($paymentId);
        

    }
}





?>