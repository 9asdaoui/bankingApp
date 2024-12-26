<?php
include_once "Database.php";
include_once "SavingsAccount.php";
include_once "CurrentAccount.php";
include_once "BusinessAccount.php";

class DB_con
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
            $query="select customer.customer_id,account_id,_name,email,balance,credit_limit,transaction_fee
                    from customer
                    join businessaccount on businessaccount.customer_id=customer.customer_id;";
        break;
        case "businessAccount":
            $query="select customer.customer_id,account_id,_name,email,balance,overdraft_limit
                    from customer
                    join currentaccount on currentaccount.customer_id=customer.customer_id;";
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

                $obj = new currentAccount($row["_name"],$row["email"],$row["balance"],$row["account_id"],$row["credit_limit"],$row["transaction_fee"]);
                $obj->setCustomerId($row["customer_id"]);
                $Data[] = $obj;
            };
        break;
        case "businessAccount":
            foreach($results as $row){

                $obj = new businessAccount($row["_name"],$row["email"],$row["balance"],$row["account_id"],$row["overdraft_limit"]);
                $obj->setCustomerId($row["customer_id"]);
                $Data[] = $obj;
            };
        break;
    }


    return $Data;
}


// $repo->insert(new CurrentAccount("", "", ""))

public function insert(Account $account) {

    $sqlAccount = "INSERT INTO `customer`( `_name`, `email`, `balance`) VALUES (':name',':email',':balanc')";
    $stmt = $this->dbh->prepare($sqlAccount);

    $stmt->execute([
        "username" =>$account->getName(),
        "email" => $account->getEmail(),
        "balanc" => $account->getBalance()
    ]);
    $lastid=$this->dbh->lastInsertId();

    if($account instanceof CurrentAccount){
    
        $query = "INSERT INTO `currentaccount`( `customer_id`, `overdraft_limit`) VALUES (':id',':overdraft_limit')";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            "id" =>$lastid,
            "overdraft_limit" => $account->getoverdraft_limit(),
        ]);

    }else if($account instanceof businessAccount){

        $query = "INSERT INTO `businessaccount`( `customer_id`, `credit_limit`, `transaction_fee`) VALUES (':id',':credit_limit',':transaction_fee')";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            "id" =>$lastid,
            "credit_limit" => $account->getcredit_limit(),
            "transaction_fee" => $account->gettransaction_fee(),
        ]);

    }else if($account instanceof savingsAccount){

        $query = "INSERT INTO `savingsaccount`(`customer_id`, `interest_rate`, `minimum_balance`) VALUES (':id',':interest_rate',':minimum_balance')";
        $stmt = $this->dbh->prepare($query);

        $stmt->execute([
            "id" =>$lastid,
            "interest_rate" => $account->getinterest_rate(),
            "minimum_balance" => $account->getminimum_balance(),
        ]);
    }
  


}
}
// $con=new DB_con;
// print_r( $con->fetchdata("savingsaccount"));
?>





      

<!-- $columns = implode(", ", array_keys($data)); -->
<!-- $placeholders = implode(", ", array_map(fn($col) => ":$col", array_keys($data))); -->







<!-- 


public function update($fname,$lname,$emailid,$contactno,$address,$userid)
	{
	$updaterecord=mysqli_query($this->dbh,"update  tblusers set FirstName='$fname',LastName='$lname',EmailId='$emailid',ContactNumber='$contactno',Address='$address' where id='$userid' ");
	return $updaterecord;
	}
public function delete($rid)
	{
	$deleterecord=mysqli_query($this->dbh,"delete from tblusers where id=$rid");
	return $deleterecord;
	} -->





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