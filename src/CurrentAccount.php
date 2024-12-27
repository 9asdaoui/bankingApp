<?php 
include_once "account.php";
include_once "TableAttribute.php";

#[TableAttribute('CurrentAccount')]
class currentAccount extends account{

        #[TableAttribute('overdraft_limit')]
        private $overdraft_limit;
        

        public function __construct($_name,$email,$balance,$overdraft_limit)
        {
            parent::__construct($_name,$email,$balance);
            $this->overdraft_limit = $overdraft_limit;
        }
        
        public function getoverdraft_limit() {
            return $this->overdraft_limit;
        }
        public function setoverdraft_limit($overdraft_limit) {
            $this->overdraft_limit = $overdraft_limit;
        }

        public function save(PDO $db)
        {
            $lastID = parent::save($db);
            // print_r($this->prepareDataValues());die();
            $stmt = $db->prepare($this->prepareInsertQuery());
            $stmt->execute($this->prepareDataValues());
            
            return $lastID;
        }
    }

?>
