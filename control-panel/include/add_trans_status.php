<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_status_data'])) {

        $stmt = $con->prepare("INSERT INTO trans_status(statue_name)VALUES(:zq)");
        $stmt->execute(array("zq" => $_POST['title']));
    }
    header("refresh:0;url=../admin/filterlist.php");
    ob_end_flush();
?>