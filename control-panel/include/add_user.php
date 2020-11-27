<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {

        $stmt = $con->prepare("INSERT INTO users(email, username, password, added_in)VALUES(:ze, :zu, :zp, now())");
        $stmt->execute(array("ze" => $_POST['email'], "zu" => $_POST['username'], "zp" => $_POST['password']));
    }
    header("refresh:0;url=../admin/users.php");
    ob_end_flush();
?>