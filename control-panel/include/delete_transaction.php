<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['transactionsdel'])) {
        $stmt = $con->prepare("DELETE FROM transactions WHERE id = ?");
        $stmt->execute(array($_POST['id']));
    }
    // header("refresh:0;url=../admin/transactions.php");
    ob_end_flush();