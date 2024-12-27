<?php
require_once "Entity.php";
require_once "TableAttribute.php";

#[TableAttribute('customer')]
abstract class account extends entity {
    #[TableAttribute('customer_id')]
    protected $customer_id;

    #[TableAttribute('_name')]
    protected $_name;

    #[TableAttribute('email')]
    protected $email;
    
    #[TableAttribute('balance')]
    protected $balance;
    
    public function __construct($name, $email, $balance) {
        // parent::__construct();
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

    public function save(PDO $db)
    {
        $stmt = $db->prepare($this->prepareInsertQuery(account::class));
        $stmt->execute($this->prepareDataValues(account::class));

        $this->customer_id = $db->lastInsertId();
        return $this->customer_id;
    }
}

?>
