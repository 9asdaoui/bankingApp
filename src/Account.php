<?php

class account {
    protected $customer_id;
    protected $_name;
    protected $email;
    protected $balance;

    public function __construct($name, $email, $balance) {
        $this->_name = $name;
        $this->email = $email;
        $this->balance = $balance;
    }

    public function getCustomerId() {
        return $this->customer_id;
    }
    public function setCustomerId($customer_id) {
        if (!is_numeric($customer_id) || $customer_id <= 0) {
            echo "ivalid inputss";
        }else{
        $this->customer_id = $customer_id;
            }    }

    public function getName() {
        
        return $this->_name;
    }
    public function setName($_name) {
        if (empty($_name) || strlen($_name) < 3 || strlen($_name) > 50) {
            echo "ivalid inputss";

        }else{$this->_name = $_name;}
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
        }else{
        $this->email = $email;}
    
    }

    public function getBalance() {
        return $this->balance;
    }
    public function setBalance($balance) {
        if (!is_numeric($balance) || $balance < 0) {
              echo "ivalid inputs";}else{
        $this->balance = $balance;}
    }
}

?>
