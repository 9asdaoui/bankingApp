<?php
include_once "Database.php";
include_once "SavingsAccount.php";
include_once "CurrentAccount.php";
include_once "BusinessAccount.php";

// types off constructers

class AccountManager
{
    private $dbh;
    
function __construct()
{
    $this->dbh=pdo;
}
public function fetchdata($table_name)
{
    $Data[]=0;
    switch($table_name){
        case "savingsaccount":
            $query="select customer.customer_id,_name,email,balance,account_id,interest_rate,minimum_balance
                    from savingsaccount
                    join customer on savingsaccount.customer_id=customer.customer_id;";
        break; 
        case "currentAccount":
            $query="select customer.customer_id,account_id,_name,email,balance,overdraft_limit
                    from customer
                    join currentaccount on currentaccount.customer_id=customer.customer_id;";
        break;
        case "businessAccount":
            $query="select customer.customer_id,account_id,_name,email,balance,credit_limit,transaction_fee
                    from customer
                    join businessaccount on businessaccount.customer_id=customer.customer_id;";
        break;
    }

    $result=$this->dbh->prepare($query);
    $result->execute();
    $results = $result ->fetchAll();
    
    switch($table_name){
        case "savingsaccount":
            foreach($results as $row){
                $obj = new SavingsAccount($row["_name"],$row["email"],$row["balance"],$row["account_id"],$row["interest_rate"],$row["minimum_balance"]);
                $obj->setCustomerId($row["customer_id"]);
                $Data[] = $obj;
            };
        break; 
        case "currentAccount":
            foreach($results as $row){
                $obj = new currentAccount($row["_name"],$row["email"],$row["balance"],$row["account_id"],$row["overdraft_limit"]);
                $obj->setCustomerId($row["customer_id"]);
                $Data[] = $obj;
            };
        break;
        case "businessAccount":
            foreach($results as $row){
                $obj = new businessAccount($row["_name"],$row["email"],$row["balance"],$row["account_id"],$row["credit_limit"],$row["transaction_fee"]);
                $obj->setCustomerId($row["customer_id"]);
                $Data[] = $obj;
            };
        break;
    }


    return $Data;
}
public function insert(Account $account) 
{

    $sqlAccount = "INSERT INTO customer( _name, email, balance) VALUES (:name,:email,:balanc)";
    $stmt = $this->dbh->prepare($sqlAccount);

    $stmt->execute([
        ":name" => $account->getName(),
        ":email" => $account->getEmail(),
        ":balanc" => $account->getBalance()
    ]);

    $lastid=$this->dbh->lastInsertId();

    if($account instanceof CurrentAccount){
    
        $query = "INSERT INTO `currentaccount`( `customer_id`, `overdraft_limit`) VALUES (:id,:overdraft_limit)";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$lastid,
            ":overdraft_limit" => $account->getoverdraft_limit(),
        ]);

    }else if($account instanceof businessAccount){

        $query = "INSERT INTO `businessaccount`( `customer_id`, `credit_limit`, `transaction_fee`) VALUES (:id,:credit_limit,:transaction_fee)";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$lastid,
            ":credit_limit" => $account->getcredit_limit(),
            ":transaction_fee" => $account->gettransaction_fee(),
        ]);

    }else if($account instanceof savingsAccount){

        $query = "INSERT INTO `savingsaccount`(`customer_id`, `interest_rate`, `minimum_balance`) VALUES (:id,:interest_rate,:minimum_balance)";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$lastid,
            ":interest_rate" => $account->getinterest_rate(),
            ":minimum_balance" => $account->getminimum_balance(),
        ]);
    }
  


}
public function modife(Account $account) 
{

    $sqlAccount = "UPDATE customer SET _name=:name, email=:email ,balance=:balanc  WHERE customer_id=:customer_id";
    $stmt = $this->dbh->prepare($sqlAccount);

    $stmt->execute([
        ":username" =>$account->getName(),
        ":email" => $account->getEmail(),
        ":balanc" => $account->getBalance(),
        ":customer_id" => $account->getCustomerId(),
    ]);
    if($account instanceof CurrentAccount){
    
        $query = "UPDATE currentaccount  SET  overdraft_limit = :overdraft_limit WHERE customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
            ":overdraft_limit" => $account->getoverdraft_limit(),
        ]);

    }else if($account instanceof businessAccount){

        $query = "UPDATE businessaccount  SET  credit_limit= :credit_limit, transaction_fee=:transaction_fee where customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
            ":credit_limit" => $account->getcredit_limit(),
            ":transaction_fee" => $account->gettransaction_fee(),
        ]);

    }else if($account instanceof savingsAccount){

        $query = "UPDATE savingsaccount  SET interest_rate=:interest_rate,minimum_balance=:minimum_balance WHERE customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
            ":interest_rate" => $account->getinterest_rate(),
            ":minimum_balance" => $account->getminimum_balance(),
        ]);
    }
}
public function delete(Account $account) 
{


    if($account instanceof CurrentAccount){
    
        $query = "DELETE FROM CurrentAccount where customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
        ]);

    }else if($account instanceof businessAccount){

        $query = "DELETE FROM businessAccount where customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
        ]);

    }else if($account instanceof savingsAccount){

        $query = "DELETE FROM savingsAccount where customer_id=:id";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            ":id" =>$account->getCustomerId(),
        ]);
    }

    $sqlAccount = "DELETE FROM Account where customer_id=:id";
    $stmt = $this->dbh->prepare($sqlAccount);

    $stmt->execute([
        ":customer_id" => $account->getCustomerId(),
    ]);
  


}
}
?>





      

<!-- $columns = implode(", ", array_keys($data)); -->
<!-- $placeholders = implode(", ", array_map(fn($col) => ":$col", array_keys($data))); -->


<!-- // include_once "SavingsAccount.php";

// class SavingsAccountRepository  

// {

//     public function insert(SavingsAccount $account)
//     {
        
//     }
//     public function select()
//     {
//         $accounts = [new SavingsAccount("", "")];
//         //fetch
//         return $accounts;
//         // $accounts[0]->_name;
//     }
// } -->