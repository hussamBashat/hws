<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['faqdel'])) {
        $stmt = $con->prepare("DELETE FROM frequently_asked_questions WHERE id = ?");
        $stmt->execute(array($_POST['id']));
    }
    header("refresh:0;url=../admin/faq-manage.php");
    ob_end_flush();