<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['del'])) {
            $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute(array($_POST['id']));
        }
        else if(isset($_POST['ben'])){
            $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            $status = $stmt->fetch();
            if ($status['Status'] == 1) {
                $stmt = $con->prepare("UPDATE users SET Status = 0 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
            else {
                $stmt = $con->prepare("UPDATE users SET Status = 1 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
        }
    }
    header("refresh:0;url=../admin/marketers.php");
    ob_end_flush();
?>