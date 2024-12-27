<?php 
include "header.php";
include_once "../src/AccountManager.php";

$data = new AccountManager;
$busdata = $data->fetchdata("businessAccount");
$curdata = $data->fetchdata("currentAccount");
$savdata = $data->fetchdata("savingsaccount");
?>

    <main>
        

    <h2><?php print_r($busdata[1]->getCustomerId());?></h2>
    <h2><?php print_r($busdata[1]->getName());?></h2>
    <h2><?php print_r($busdata[1]->getEmail());?></h2>
    <h2><?php print_r($busdata[1]->getcredit_limit());?></h2>
    <h2><?php print_r($busdata[1]->gettransaction_fee());?></h2>


    </main>

<?php include "footer.php"?>