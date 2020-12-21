<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['del_statue'])) {
            $stmt = $con->prepare("DELETE FROM trans_status WHERE id = ?");
            $stmt->execute(array($_POST['id']));
        }
        else if(isset($_POST['ben_statue'])){
            $stmt = $con->prepare("SELECT * FROM trans_status WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            $status = $stmt->fetch();
            if ($status['status'] == 0) {
                $stmt = $con->prepare("UPDATE trans_status SET status = 1 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
            else {
                $stmt = $con->prepare("UPDATE trans_status SET status = 0 WHERE id = ?");
                $stmt->execute(array($_POST['id']));
            }
        }
    }
    header("refresh:0;url=../admin/filterlist.php");
    ob_end_flush();
?>