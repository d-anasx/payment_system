<?php

abstract class Paiement {
    protected $id;
    protected $amount;
    protected $statut;
    protected $date_paiement;
    protected $order;

    public function __construct($id, $amount , $statut, $date_paiement,$order)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->statut = $statut;
        $this->date_paiement = $date_paiement;
        $this->order = $order;
        
    }

    abstract public function handlePaiement();
}









?>