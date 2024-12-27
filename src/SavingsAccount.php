<?php 
include_once "account.php";

    class savingsAccount extends account{
        
        private $interest_rate;
        private $min_balance;

        public function __construct($_name,$email,$balance,$min_balance,$interest_rate)
        {
            parent::__construct($_name,$email,$balance);
            $this->min_balance = $min_balance;
            $this->interest_rate = $interest_rate;
        }
        public function getinterest_rate(){
            return $this->interest_rate;
        }
        public function setinterest_rate($interest_rate) {
            $this->interest_rate = $interest_rate;
        }
        public function getminimum_balance(){
            return $this->min_balance;

        }
        public function setmin_balance($minimum_balance) {
            $this->min_balance = $minimum_balance;
        }
    }

?>