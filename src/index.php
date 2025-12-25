<?php
include './src/Repository/ClientRepository.php';
include './src/Repository/OrderRepository.php';
include_once 'src\Entity\Client.php';
include "src\Repository\PaiementRepository.php";

$clientRepo = new ClientRepository();
$orderRepo = new OrderRepository();
$paymentRepo = new PaiementRepository();



function getName(){
    return readline("enter the name : ");
}

function getEmail(){
    return readline("enter the email : ");
}

function getStatus(){
    return readline("enter the status : ");
}

function getTotal(){
    return readline("enter the total amount : ");
}

function getClientId(){
    return readline("enter the client id : ");
}



while(1==1){
    $a = readline("1 - show all clients\n2 - add client\n3 - show all orders\n4 - add order\n5 - show payments");
    switch ($a){
    case 1 :
        $clientRepo->getAll();
        break;
    case 2 :
        $name = getName();
        $email = getEmail();
        $client = new Client(null, $name, $email);
        $clientRepo->addClient($client);
        break;
    case 3 :
        $orderRepo->getAll();
        break;
    case 4 :
        $status = getStatus();
        $total = getTotal();
        $clientId = getClientId();
        $db_client = $clientRepo->getOne($clientId);
        $client = new Client(null,$db_client["name"],$db_client["email"]);
        $order = new Order(null, $total, $status, $client);
        $orderRepo->addOrder($order,$clientId);
        break;
    case 5 :
        $paymentRepo->getAll();
}  
}

?>