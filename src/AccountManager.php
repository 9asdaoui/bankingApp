<?php
require_once "Database.php";
require_once "SavingsAccount.php";
require_once "CurrentAccount.php";
require_once "BusinessAccount.php";

class AccountManager
{
    private $db;
    
    function __construct()
    {
        $this->db = Database::getInstance(); 
    }

    public function insert(Account $account) 
    {
        $account->save($this->db->getConnection());
    }
}

$sa = new currentAccount("azaz", "szdze", 22, 22);

$ac =new AccountManager();
$ac->insert($sa);

