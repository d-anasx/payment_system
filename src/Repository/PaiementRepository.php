<?php
include_once 'src\Database\DatabaseConnect.php';
include_once 'src\Entity\Paiement.php';
include_once 'src\Entity\Paypal.php';
include_once 'src\Entity\Virement.php';
include_once 'src\Entity\BankCard.php';

class PaiementRepository {
    
    public function getAll(){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from payments";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getOne($paymentId){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from payments where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$paymentId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getPaymentInfos($paymentId, $type){
        if($type=="paypal") $table = 'paypal_payments';
        if($type=="bank_transfer") $table = 'bank_transfer_payments';
        if($type=="card") $table = 'bank_card_payments';
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = "SELECT * from $table where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$paymentId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function addPayment($payment){
        $type = null;
        $paymentId = null;
        $orderId = $payment->order->id;
        $amount = $payment->amount;
        $db = new DatabaseConnect();
        $conn = $db->connect();

        $sql = 'INSERT into payments (order_id,amount) values (?,?) ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$orderId);
            $stmt->bindParam(2,$amount);
            $stmt->execute();
        $paymentId = $conn->lastInsertId();

        if ($payment instanceof PayPal){
            $email = $payment->email;
            $password = $payment->password;
            $type = "paypal";
            $sql = 'INSERT into paypal_payments (id,email,password) values (?,?,?) ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$paymentId);
            $stmt->bindParam(2,$email);
            $stmt->bindParam(3,$password);
            $stmt->execute();
        }
        if ($payment instanceof Virement){
            $type = "bank_transfer";
            $rib = $payment->rib;
            $sql = 'INSERT into bank_transfer_payments (id,rib) values (?,?) ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$paymentId);
            $stmt->bindParam(2,$rib);
            $stmt->execute();
        }
        if ($payment instanceof BankCard){
            $type = "card";
            $cardNum = $payment->cardNum;
            $sql = 'INSERT into bank_card_payments (id,card_number) values (?,?) ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$paymentId);
            $stmt->bindParam(2,$cardNum);
            $stmt->execute();
        }

        $sql = 'UPDATE payments set payment_type=? where id=? ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$type);
            $stmt->bindParam(2,$paymentId);
            $stmt->execute();

    }

    public function changeStatusToPaid($paymentId){
        $db = new DatabaseConnect();
        $conn = $db->connect();
        $sql = 'UPDATE payments set status="paid" where id=? ';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$paymentId);
            $stmt->execute();
    }
    
}


?>