<?php
include './Paiement.php';

class Virement extends Paiement {
    private $rib;

    public function __construct($id, $amount , $statut, $date_paiement,$order,$rib)
    {
    parent::__construct($id, $amount , $statut, $date_paiement,$order);
    $this->rib = $rib;

    }
    public function handlePaiement(){

        return "paid with bank tansfer with rib : ".substr($this->rib,0,5)."xxxxxxxx";

    }
}





?>