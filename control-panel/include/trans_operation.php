<?php

include "../../include/Functions.php";

$result = array();
if (isset($_GET['display'])) { 
    if (isset($_GET['defualt'])) {
        if (isset($_SESSION['admin'])) {
            $stmt = $con->prepare("SELECT * FROM transactions, invoices WHERE transactions.id = invoices.trans_id ORDER BY transactions.id DESC");
            $stmt->execute();
            $data = ($stmt->rowCount() > 0 ? $stmt->fetchAll() : "false");
        }
        else {
            $stmt = $con->prepare("SELECT * FROM transactions, invoices WHERE marketer_id = ? AND transactions.id = invoices.trans_id ORDER BY transactions.id DESC");
            $stmt->execute(array($_SESSION['user']));
            $data = ($stmt->rowCount() > 0 ? $stmt->fetchAll() : "false");
        }
    }
    elseif (isset($_GET['search&filter'])) {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $column = " AND CONCAT_WS('', transactions.id, fullname, address, phone, whatsapp, visa, visa_price, marketer_id, passport_img, card_img, photograph_img, qualification_img, criminal_fisheye_img, netbook_paper_img, hospital_reservation_img, fingerprint_reservation_date, fingerprint_img, note, work_contract, trans_status, invoices.id, trans_id, office_fare, netbook_paper, qualification, fingerprint_reservation, hospital_reservation, work_contract_service, agreed_price, total, amount_paid) like '%" . $_GET['search'] . "%'";
        }
        else {
            $column = "";
        }
        if ($_GET['status'] == 'all') {
            $status = "";
        }
        else {
            $status = " AND trans_status = '" . $_GET['status'] . "'";
        }
        if (isset($_SESSION['admin'])) {
            if ($_GET['marketer'] == 'all') {
                $marketer = "";
            }
            else {
                $marketer = " AND marketer_id = " . $_GET['marketer'];
            }
        }
        if ($_GET['opfilter'] == "non") {
            $opfilter = "";
        }
        elseif ($_GET['opfilter'] == "exist") {
            $opfilter = "";
            for ($i=0; $i < 13; $i++) { 
                $ck = "ck" . $i;
                if ($_GET[$ck] == "on") {
                    switch ($i) {
                        case 0:
                            $opfilter .= " AND card_img != ''";
                            break;
                        case 1:
                            $opfilter .= " AND photograph_img != ''";
                            break;
                        case 2:
                            $opfilter .= " AND qualification_img != ''";
                            break;
                        case 3:
                            $opfilter .= " AND criminal_fisheye_img != ''";
                            break;
                        case 4:
                            $opfilter .= " AND netbook_paper_img != ''";
                            break;
                        case 5:
                            $opfilter .= " AND hospital_reservation_img != ''";
                            break;
                        case 6:
                            $opfilter .= " AND fingerprint_img != ''";
                            break;
                        case 7:
                            $opfilter .= " AND passport_img != ''";
                            break;
                        case 8:
                            $opfilter .= " AND work_contract != ''";
                            break;
                        case 9:
                            $opfilter .= " AND qualification > 0";
                            break;
                        case 10:
                            $opfilter .= " AND hospital_reservation > 0";
                            break;
                        case 11:
                            $opfilter .= " AND work_contract_service > 0";
                            break;
                        case 12:
                            $opfilter .= " AND fingerprint_reservation > 0";
                            break;
                    }
                }
            }
        }
        elseif ($_GET['opfilter'] == "notexist") {
            $opfilter = "";
            for ($i=0; $i < 13; $i++) { 
                $ck = "ck" . $i;
                if ($_GET[$ck] == "on") {
                    switch ($i) {
                        case 0:
                            $opfilter .= " AND card_img = ''";
                            break;
                        case 1:
                            $opfilter .= " AND photograph_img = ''";
                            break;
                        case 2:
                            $opfilter .= " AND qualification_img = ''";
                            break;
                        case 3:
                            $opfilter .= " AND criminal_fisheye_img = ''";
                            break;
                        case 4:
                            $opfilter .= " AND netbook_paper_img = ''";
                            break;
                        case 5:
                            $opfilter .= " AND hospital_reservation_img = ''";
                            break;
                        case 6:
                            $opfilter .= " AND fingerprint_img = ''";
                            break;
                        case 7:
                            $opfilter .= " AND passport_img = ''";
                            break;
                        case 8:
                            $opfilter .= " AND work_contract = ''";
                            break;
                        case 9:
                            $opfilter .= " AND qualification = 0";
                            break;
                        case 10:
                            $opfilter .= " AND hospital_reservation = 0";
                            break;
                        case 11:
                            $opfilter .= " AND work_contract_service = 0";
                            break;
                        case 12:
                            $opfilter .= " AND fingerprint_reservation = 0";
                            break;
                    }
                }
            }
        }
        if (isset($_SESSION['admin'])) {
            $stmt = $con->prepare("SELECT * FROM transactions, invoices WHERE transactions.id = invoices.trans_id" . $column . $status . $marketer . $opfilter . " ORDER BY transactions.id DESC");
            $stmt->execute();
            $data = ($stmt->rowCount() > 0 ? $stmt->fetchAll() : "false");
        }
        else{
            $stmt = $con->prepare("SELECT * FROM transactions, invoices WHERE marketer_id = ? AND transactions.id = invoices.trans_id" . $column . $status . $opfilter . " ORDER BY transactions.id DESC");
            $stmt->execute(array($_SESSION['user']));
            $data = ($stmt->rowCount() > 0 ? $stmt->fetchAll() : "false");
        }
    }
    if (!isset($_GET['choose_col'])) {
        if ($data != "false") {
            $i = 0;
            foreach ($data as $value) {
                $fullname = explode("-", $value['fullname']);
                $q = $con->prepare("SELECT username FROM users WHERE id = ?");
                $q->execute(array($value['marketer_id']));
                $marketer_name = $q->fetchColumn();
                $result[$i]['Did'] = $_SESSION['chk0'];
                $result[$i]['id'] = $value[0];
                $result[$i]['marketer_name'] = $marketer_name;
                $result[$i]['Dmarketer_name'] = $_SESSION['chk1'];
                $result[$i]['trans_status'] = $value['trans_status'];
                $result[$i]['Dtrans_status'] = $_SESSION['chk2'];
                $result[$i]['name'] = $fullname[0] . $fullname[1] . $fullname[2] . $fullname[3];
                $result[$i]['Dname'] = $_SESSION['chk3'];
                $result[$i]['phone'] = $value['phone'];
                $result[$i]['Dphone'] = $_SESSION['chk4'];
                $result[$i]['whatsapp'] = $value['whatsapp'];
                $result[$i]['Dwhatsapp'] = $_SESSION['chk5'];
                $result[$i]['address'] = $value['address'];
                $result[$i]['Daddress'] = $_SESSION['chk6'];
                $result[$i]['Dvisa'] = $_SESSION['chk7'];
                $result[$i]['agreed_price'] = $value['agreed_price'];
                $result[$i]['Dagreed_price'] = $_SESSION['chk8'];
                $result[$i]['card_img'] = $value['card_img'];
                $result[$i]['Dcard_img'] = $_SESSION['chk9'];
                $result[$i]['photograph_img'] = $value['photograph_img'];
                $result[$i]['Dphotograph_img'] = $_SESSION['chk10'];
                $result[$i]['qualification_img'] = $value['qualification_img'];
                $result[$i]['Dqualification_img'] = $_SESSION['chk11'];
                $result[$i]['criminal_fisheye_img'] = $value['criminal_fisheye_img'];
                $result[$i]['Dcriminal_fisheye_img'] = $_SESSION['chk12'];
                $result[$i]['netbook_paper_img'] = $value['netbook_paper_img'];
                $result[$i]['Dnetbook_paper_img'] = $_SESSION['chk13'];
                $result[$i]['fingerprint_img'] = $value['fingerprint_img'];
                $result[$i]['Dfingerprint_img'] = $_SESSION['chk15'];
                $result[$i]['passport_img'] = $value['passport_img'];
                $result[$i]['Dpassport_img'] = $_SESSION['chk16'];
                $result[$i]['work_contract'] = $value['work_contract'];
                $result[$i]['Dwork_contract'] = $_SESSION['chk17'];
                $result[$i]['hospital_reservation_img'] = $value['hospital_reservation_img'];
                $result[$i]['Dhospital_reservation_img'] = $_SESSION['chk14'];
                $result[$i]['qualification'] = $value['qualification'];
                $result[$i]['Dqualification'] = $_SESSION['chk18'];
                $result[$i]['hospital_reservation'] = $value['hospital_reservation'];
                $result[$i]['Dhospital_reservation'] = $_SESSION['chk19'];
                $result[$i]['work_contract_service'] = $value['work_contract_service'];
                $result[$i]['Dwork_contract_service'] = $_SESSION['chk20'];
                $result[$i]['fingerprint_reservation'] = $value['fingerprint_reservation'];
                $result[$i]['Dfingerprint_reservation'] = $_SESSION['chk21'];
                $result[$i]['amount_paid'] = $value['amount_paid'];
                $result[$i]['Damount_paid'] = $_SESSION['chk22'];
                $result[$i]['note'] = substr($value['note'], 0, 35);
                $result[$i]['Dnote'] = $_SESSION['chk23'];
                $result[$i]['fingerprint_reservation_date'] = $value['fingerprint_reservation_date'];
                $result[$i]['SESSION'] = (isset($_SESSION['admin']) ? "true" : "false");
                $result[$i]['DSESSION'] = $_SESSION['chk24'];
                $i++;
            }
        }
        else {
            $result = false;
        }
    }
}
else if(isset($_POST['choose_col'])){
            
    if (isset($_POST['all']) && $_POST['all'] == "on") {
        $_SESSION['all'] = "true";
        for ($i=0; $i < 27; $i++) { 
            $chk = "chk" . $i;
            $_SESSION[$chk] = "true";
            $result[$chk] = $_SESSION[$chk];
        }
    }
    else {
        for ($i=0; $i < 27; $i++) { 
            $chk = "chk" . $i;
            if (isset($_POST[$chk]) && $_POST[$chk] == "on") {
                $_SESSION[$chk] = "true";
                $result[$chk] = $_SESSION[$chk];
            }
            else {
                $_SESSION[$chk] = "false";
            }
        }
    }
}
echo json_encode($result);