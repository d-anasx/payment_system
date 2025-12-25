<?php

class Client {
    private $id;
    private $name;
    private $email;
    private $orders;

    public function __construct($id, $name , $email, $orders = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->orders = $orders;
        
    }
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }
}




?>