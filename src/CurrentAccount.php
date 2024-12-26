<?php 
include_once "account.php";
    class currentAccount extends account{
        private $overdraft_limit;

        public function __construct($_name,$email,$balance,$overdraft_limit)
        {
            parent::__construct($_name,$email,$balance);
            $this->overdraft_limit = $overdraft_limit;
        }
        public function getoverdraft_limit() {
            return $this->overdraft_limit;
        }
    }

?>
