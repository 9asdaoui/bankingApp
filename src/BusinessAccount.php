<?php 
include_once "account.php";
    class businessAccount extends account{
        
        private $credit_limit;
        private $trans_fee;

        public function __construct($_name,$email,$balance,$credit_limit,$trans_fee)
        {
            parent::__construct($_name,$email,$balance);
            $this->credit_limit = $credit_limit;
            $this->trans_fee = $trans_fee;
        }
   
        public function getcredit_limit(){
            return $this->credit_limit;
        }
        public function setcredit_limit($credit_limit) {
            $this->credit_limit = $credit_limit;
        }
        public function gettransaction_fee(){
            return $this->trans_fee;
        }
        public function settrans_fee($trans_fee) {
            $this->trans_fee = $trans_fee;
        }

        public function getInsertQuery()
        {
            return "INSERT INTO `businessaccount`( `customer_id`, `credit_limit`, `transaction_fee`) VALUES (:id,:credit_limit,:transaction_fee)";
        }

        public function getInsertBindParams($mergedData)
        {
            return array_merge([
                ":overdraft_limit" => $this->getoverdraft_limit(),
            ], $mergedData);
        }
}
?>
