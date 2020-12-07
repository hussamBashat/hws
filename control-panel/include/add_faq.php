<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['publish'])) {

        $stmt = $con->prepare("INSERT INTO frequently_asked_questions(questions,answer)VALUES(:zq, :za)");
        $stmt->execute(array("zq" => $_POST['question'], "za" => $_POST['answer']));
    }
    header("refresh:0;url=../admin/ref.php");
    ob_end_flush();
?>