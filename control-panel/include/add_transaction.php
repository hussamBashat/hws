<?php 
    ob_start();
    session_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_trans'])) {

        $fullname = $_POST['firstname'] . " " . $_POST['fathername'] . " " . $_POST['grandname'] . " " . $_POST['lastname'];
        $stmt = $con->prepare("INSERT INTO transactions(fullname, address, phone, whatsapp, visa, visa_price, marketer_id, passport, card, photograph, qualification, criminal_fisheye, netbook_paper, hospital_reservation, fingerprint_reservation, fingerprint, note, work_contract) 
        VALUES (:zf, :za, :zphone, :zwhats, :zvisa, :zvprice, :zmi, :zpasspo, :zcard , :zphoto, :zqual, :zcf, :znp, :zhr, :zfr, :zfinger, :znote, :zwork)");
        $stmt->execute(array(
            "zf" => $fullname,
            "za" => $_POST['address'],
            "zphone" => $_POST['mobile'],
            "zwhats" => $_POST['whatsapp'],
            "zvisa" => $_POST['visa'],
            "zvprice" => $_POST['orginal_price'],
            "zmi" => (isset($_SESSION['user']) ? $_SESSION['user'] : $_POST['marketer_id']),
            "zpasspo" => (!empty($_FILES['file7']['name']) ? $_FILES['file7']['name'] : ''),
            "zcard" => (!empty($_FILES['file0']['name']) ? $_FILES['file0']['name'] : ''),
            "zphoto" => (!empty($_FILES['file1']['name']) ? $_FILES['file1']['name'] : ''),
            "zqual" => (!empty($_FILES['file2']['name']) ? $_FILES['file2']['name'] : ''),
            "zcf" => (!empty($_FILES['file3']['name']) ? $_FILES['file3']['name'] : ''),
            "znp" => (!empty($_FILES['file4']['name']) ? $_FILES['file4']['name'] : ''),
            "zhr" => (!empty($_FILES['file5']['name']) ? $_FILES['file5']['name'] : ''),
            "zfr" => (isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_d'] : ''),
            "zfinger" => (!empty($_FILES['file6']['name']) ? $_FILES['file6']['name'] : ''),
            "znote" => $_POST['notes'],
            "zwork" => $_POST['work']
        ));

        $stmt2 = $con->prepare("SELECT id FROM transactions ORDER BY id DESC LIMIT 1");
        $stmt2->execute();
        $trans_id = $stmt2->fetchColumn();
        mkdir("../../images/transactions/" . $trans_id);
        for ($i=0; $i < 8; $i++) { 
            $file = "file" . $i;
            if (!empty($_FILES[$file]['name'])) {
                move_uploaded_file($_FILES[$file]['tmp_name'], "../../images/transactions/" . $trans_id . "/" . $_FILES[$file]['name']);
            }
        }
        
        $stmt1 = $con->prepare("INSERT INTO invoices(trans_id, office_fare, netbook_paper, qualification, fingerprint_reservation, hospital_reservation, work_contract, agreed_price, total, amount_paid) 
        VALUES (:zti , :zof, :znp, :zqual, :zfr, :zhr, :zwc, :zagp, :ztotal , :zap)");
        $stmt1->execute(array(
            "zti" => $trans_id,
            "zof" => $_POST['office_fare'],
            "znp" => $_POST['net_paper'],
            "zqual" => (isset($_POST['qualifications_s']) && $_POST['qualifications_s'] == 'on' ? $_POST['qualifications_p'] : ''),
            "zfr" => (isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_p'] : ''),
            "zhr" => (isset($_POST['hospetal_s']) && $_POST['hospetal_s'] == 'on' ? $_POST['hospetal_p'] : ''),
            "zwc" => (isset($_POST['work_S']) && $_POST['work_S'] == 'on' ? $_POST['work_p'] : ''),
            "zagp" => $_POST['price'],
            "ztotal" => $_POST['total'],
            "zap" => $_POST['amount_paid']
        ));
    }
    header("refresh:0;url=../admin/transactions.php");
    ob_end_flush();
?>