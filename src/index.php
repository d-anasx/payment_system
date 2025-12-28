<?php
include './src/Repository/ClientRepository.php';
include './src/Repository/OrderRepository.php';
include_once 'src\Entity\Client.php';
include_once 'src\Entity\Paiement.php';
include "src\Repository\PaiementRepository.php";
include_once "src\Entity\Paypal.php";




class Index {
    private $clientRepo;
    private $orderRepo;
    private $paymentRepo;

    public function __construct()
    {
        $this->clientRepo = new ClientRepository();
        $this->orderRepo = new OrderRepository();
        $this->paymentRepo = new PaiementRepository();
    }

    public function getName(){
    return readline("enter the name : ");
}

public function getEmail(){
    return readline("enter the email : ");
}


public function getTotal(){
    return readline("enter the total amount : ");
}

public function getClientId(){
    $this->showClients();
    return readline("select the client id : ");
}

public function getOrderId(){
    $this->showOrders();
    return readline("select the order id : ");
}

public function showClients(){
    $DBclients = $this->clientRepo->getAll();
    $clients = [];
    foreach ($DBclients as $e) {
            array_push($clients, new Client($e["id"],$e["name"],$e["email"]));
        }
        echo "\n";
        foreach ($clients as $e) {
            echo "id : ".$e->id."   name : ".$e->name."   email : ".$e->email."\n";
        }
        echo "\n";
}

public function addClient(){
    $name = $this->getName();
    $email = $this->getEmail();
    $client = new Client(null, $name, $email);
    $this->clientRepo->addClient($client);
}

public function showOrders(){
    $DBOrders = $this->orderRepo->getAll();
    $orders = [];
    foreach ($DBOrders as $e) {
            $db_client = $this->clientRepo->getOne($e["client_id"]);
            $client = new Client($db_client["id"],$db_client["name"],$db_client["email"]);
            array_push($orders, new Order($e["id"],$e["total_amount"],$client));
        }
        echo "\n";
        foreach ($orders as $e) {
            echo "id : ".$e->id."   status : ".$e->status."   total : ".$e->totalAmount."   client : ".$e->client->name."\n";
        }
        echo "\n";
}

public function addOrder(){
    $clientId = $this->getClientId();
    $total = $this->getTotal();
    $db_client = $this->clientRepo->getOne($clientId);
    $client = new Client(null,$db_client["name"],$db_client["email"]);
    $order = new Order(null, $total, $client);
    $this->orderRepo->addOrder($order,$clientId);
}

public function showPayments(){
    $DBpayments = $this->paymentRepo->getAll();
    $payments = [];
    foreach ($DBpayments as $e) {
            $db_order = $this->orderRepo->getOne($e["order_id"]);
            $order = new Order($db_order["id"],$db_order["total_amount"],$db_order["status"]);
            if($e["payment_type"] == "paypal"){
                $paypalInfos = $this->paymentRepo->getPaymentInfos($e["id"],"paypal");
                
                $payments[] = [
            "infos" => new PayPal(
                $e["id"],
                $e["amount"],
                $order,
                $paypalInfos["email"],
                $paypalInfos["password"]
            ),
            "type" => "paypal"
        ];
            }
            if($e["payment_type"] == "bank_transfer"){
                $bankInfos = $this->paymentRepo->getPaymentInfos($e["id"],"bank_transfer");
                
                $payments[] = [
            "infos" => new Virement(
                $e["id"],
                $e["amount"],
                $order,
                $bankInfos["rib"]
            ),
            "type" => "bank_transfer"
        ];
            }
            if($e["payment_type"] == "card"){
                $bankInfos = $this->paymentRepo->getPaymentInfos($e["id"],"card");
                
                $payments[] = [
            "infos" => new BankCard(
                $e["id"],
                $e["amount"],
                $order,
                $bankInfos["card_number"]
            ),
            "type" => "card"
        ];
            }
        }
        echo "\n";
        foreach ($payments as $e) {
            echo "id : ".$e['infos']->id."   status : ".$e['infos']->status."   total : ".$e['infos']->amount."   payment_date : ".$e['infos']->payment_date."   type : ".$e['type']."\n";
        }
        echo "\n";
}

public function createPaypalPayment($order){
    $email = readline("enter your paypal email : ");
    $password = readline("enter your paypal password : ");
    $paypalObj = new PayPal(null,$order->totalAmount,$order,$email,$password);
    return $paypalObj;
}

public function createVirementPayment($order){
    $rib = readline("enter your rib : ");
    $virementObj = new Virement(null,$order->totalAmount,$order,$rib);
    return $virementObj;
}

public function createBankCardPayment($order){
    $card_num = readline("enter your card number : ");
    $bankCardObj = new BankCard(null,$order->totalAmount,$order,$card_num);
    return $bankCardObj;
}

public function addPayment(){
    $id = $this->getOrderId();
    $order = $this->orderRepo->getOne($id);
    $order = new Order($order["id"],$order["total_amount"],$order["status"]);

    $payment = match(readline("choose a payment method : \n1 - paypal\n2 - virement\n3 - bank card\n")) {
        "1" => $this->createPaypalPayment($order),
        "2" => $this->createVirementPayment($order),
        "3" => $this->createBankCardPayment($order)
};
    $this->paymentRepo->addPayment($payment);
}



public function run(){
    while(1==1){
    $a = readline("1 - show all clients\n2 - add client\n3 - show all orders\n4 - add order\n5 - show payments\n6 - add payment");
    switch ($a){
    case 1 :
        $this->showClients();
        break;
    case 2 :
        $this->addClient();
        break;
    case 3 :
        $this->showOrders();
        break;
    case 4 :
        $this->addOrder();
        break;
    case 5 :
        $this->showPayments();
        break;
    case 6 :
        $this->addPayment();
        break;
}  
}
}

}

$app = new Index();
$app->run();


?>