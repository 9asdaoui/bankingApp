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
        $this->customer_id = $customer_id;
    }
    public function getName() {
        return $this->_name;
    }
    public function setName($_name) {
        $this->_name = $_name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getBalance() {
        return $this->balance;
    }
    public function setBalance($balance) {
        $this->balance = $balance;
    }
}

?>
