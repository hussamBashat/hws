<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_status_data'])) {

        $stmt = $con->prepare("UPDATE trans_status SET statue_name = ? WHERE id = ?");
        $stmt->execute(array($_POST['title'], $_POST['id']));
    }
    header("refresh:0;url=../admin/filterlist.php");
    ob_end_flush();
?>