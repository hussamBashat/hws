<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_data'])) {

        if ($_POST['type'] == 'service') {
            $stmt = $con->prepare("UPDATE static_price SET service_name = ?, price = ? WHERE id = ?");
            $stmt->execute(array($_POST['title'], $_POST['price'], $_POST['id']));
        }
        else {
            $stmt = $con->prepare("UPDATE visas SET visaname = ?, price = ? WHERE id = ?");
            $stmt->execute(array($_POST['title'], $_POST['price'], $_POST['id']));
        }
    }
    header("refresh:0;url=../admin/pricelist.php");
    ob_end_flush();
?>