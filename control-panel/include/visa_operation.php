<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['del_visa'])) {
            $stmt = $con->prepare("DELETE FROM visas WHERE id = ?");
            $stmt->execute(array($_POST['id']));
        }
        else if(isset($_POST['ben_visa'])){
            $stmt = $con->prepare("SELECT * FROM visas WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            $status = $stmt->fetch();
            if ($status['status'] == 1) {
                $stmt = $con->prepare("UPDATE visas SET status = 0 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
            else {
                $stmt = $con->prepare("UPDATE visas SET status = 1 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
        }
    }
    header("refresh:0;url=../admin/pricelist.php");
    ob_end_flush();
?>