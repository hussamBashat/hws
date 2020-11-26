<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

        $stmt = $con->prepare("UPDATE frequently_asked_questions SET questions = ?, answer = ? WHERE id = ?");
        $stmt->execute(array($_POST['question'], $_POST['answer'], $_POST['id']));
    }
    header("refresh:0;url=../admin/faq-manage.php");
    ob_end_flush();
?>