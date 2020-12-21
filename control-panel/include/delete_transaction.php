<?php 
    ob_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['transactionsdel'])) {

        $stmt = $con->prepare("SELECT * FROM transactions WHERE id = ?");
        $stmt->execute(array($_POST['id']));
        $row = $stmt->fetch();
        if (!empty($row['passport_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['passport_img']);
        }
        if (!empty($row['card_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['card_img']);
        }
        if (!empty($row['photograph_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['photograph_img']);
        }
        if (!empty($row['qualification_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['qualification_img']);
        }
        if (!empty($row['criminal_fisheye_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['criminal_fisheye_img']);
        }
        if (!empty($row['netbook_paper_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['netbook_paper_img']);
        }
        if (!empty($row['hospital_reservation_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['hospital_reservation_img']);
        }
        if (!empty($row['fingerprint_img'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['fingerprint_img']);
        }
        if (!empty($row['work_contract'])) {
            unlink("../../images/transactions/" . $_POST['id'] . "/" . $row['work_contract']);
        }
        rmdir("../../images/transactions/" . $_POST['id']);
        $stmt1 = $con->prepare("DELETE FROM transactions WHERE id = ?");
        $stmt1->execute(array($_POST['id']));
    }
    header("refresh:0;url=../admin/transactions.php");
    ob_end_flush();