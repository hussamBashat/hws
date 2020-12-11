<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_data'])) {

        $stmt = $con->prepare("INSERT INTO visas(visaname, price)VALUES(:zq, :za)");
        $stmt->execute(array("zq" => $_POST['title'], "za" => $_POST['price']));
    }
    header("refresh:0;url=../admin/pricelist.php");
    ob_end_flush();
?>