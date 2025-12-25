<?php
include './src/Repository/ClientRepository.php';
include 'src\Entity\Client.php';

$clientRepo = new ClientRepository();



function getName(){
    return readline("enter the name : ");
}

function getEmail(){
    return readline("enter the email : ");
}

while(1==1){
    $a = readline("1 - show all clients\n2 - add client\n");
    switch ($a){
    case 1 :
        $clientRepo->getAll();
        break;
    case 2 :
        $name = getName();
        $email = getEmail();
        $client = new Client(null, $name, $email);
        $clientRepo->addClient($client);

}
}

?>