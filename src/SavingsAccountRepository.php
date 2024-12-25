<?php
include_once "Database.php";
include_once "SavingsAccount.php";

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
    foreach($results as $row){
        // $Data[] = [new SavingsAccount($row["teamid"],$row["teamname"],$row["teamlogo"])];
        $Data[] = $row;
    }
    return $Data;
}

}
$con=new DB_con;
print_r( $con->fetchdata("savingsaccount"));
?>










<!-- 

this function is righ need only the valeuss§§§§§!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	public function insert()
	{
        $query = "INSERT INTO users(usersname,email,roleid) VALUE(:namee,:email,:rolee)";
        $ret = $this->dbh->prepare($query);

        $ret->execute([
            ":namee"=>$name,
            ":email"=>$email,
            ":rolee"=>$role 
        ]);
	return $ret;
	} -->







<!-- 


public function fetchonerecord($userid)
	{
	$oneresult=mysqli_query($this->dbh,"select * from tblusers where id=$userid");
	return $oneresult;
	}
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