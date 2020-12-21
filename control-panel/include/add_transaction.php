<?php 
    ob_start();
    session_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_trans'])) {

        $stm = $con->prepare("SELECT * FROM transactions WHERE phone = ?");
        $stm->execute(array($_POST['mobile']));
        if ($stm->rowCount() == 0) {
            $fullname = $_POST['firstname'] . " -" . $_POST['fathername'] . " -" . $_POST['grandname'] . " -" . $_POST['lastname'];
            $Files = array();
            for ($i=0; $i < 9; $i++) { 
                $file = "file" . $i;
                if (!empty($_FILES[$file]['name'])) {
                    $Files[$i] = rand(0, 10000000) . "_" . $_FILES[$file]['name'];
                }
                else {
                    $Files[$i] = "";
                }
            }
            $stmt = $con->prepare("INSERT INTO transactions(fullname, address, phone, whatsapp, visa, visa_price, marketer_id, passport_img, card_img, photograph_img, qualification_img, criminal_fisheye_img, netbook_paper_img, hospital_reservation_img, fingerprint_reservation_date, fingerprint_img, note, work_contract, trans_status) 
            VALUES (:zf, :za, :zphone, :zwhats, :zvisa, :zvprice, :zmi, :zpasspo, :zcard , :zphoto, :zqual, :zcf, :znp, :zhr, :zfr, :zfinger, :znote, :zwork, :zstatus)");
            $stmt->execute(array(
                "zf" => $fullname,
                "za" => $_POST['address'],
                "zphone" => $_POST['mobile'],
                "zwhats" => $_POST['whatsapp'],
                "zvisa" => $_POST['visa'],
                "zvprice" => (!empty($_POST['orginal_price']) ? $_POST['orginal_price']: 0),
                "zmi" => (isset($_SESSION['user']) ? $_SESSION['user'] : substr($_POST['marketer_id'], 0, 1)),
                "zpasspo" => $Files[7],
                "zcard" => $Files[0],
                "zphoto" => $Files[1],
                "zqual" => $Files[2],
                "zcf" => $Files[3],
                "znp" => $Files[4],
                "zhr" => $Files[5],
                "zfr" => (isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_d'] : ''),
                "zfinger" => $Files[6],
                "znote" => $_POST['notes'],
                "zwork" => $Files[8],
                "zstatus" => $_POST['status']
            ));
    
            $stmt2 = $con->prepare("SELECT id FROM transactions ORDER BY id DESC LIMIT 1");
            $stmt2->execute();
            $trans_id = $stmt2->fetchColumn();
            mkdir("../../images/transactions/" . $trans_id);
            for ($i=0; $i < 9; $i++) { 
                $file = "file" . $i;
                if (!empty($_FILES[$file]['name'])) {
                    move_uploaded_file($_FILES[$file]['tmp_name'], "../../images/transactions/" . $trans_id . "/" . $Files[$i]);
                }
            }
            
            $stmt1 = $con->prepare("INSERT INTO invoices(trans_id, office_fare, netbook_paper, qualification, fingerprint_reservation, hospital_reservation, work_contract_service, agreed_price, total, amount_paid) 
            VALUES (:zti , :zof, :znp, :zqual, :zfr, :zhr, :zwc, :zagp, :ztotal , :zap)");
            $stmt1->execute(array(
                "zti" => $trans_id,
                "zof" => $_POST['office_fare'],
                "znp" => $_POST['net_paper'],
                "zqual" => (isset($_POST['qualifications_s']) && $_POST['qualifications_s'] == 'on' ? $_POST['qualifications_p'] : 0),
                "zfr" => (isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_p'] : 0),
                "zhr" => (isset($_POST['hospetal_s']) && $_POST['hospetal_s'] == 'on' ? $_POST['hospetal_p'] : 0),
                "zwc" => (isset($_POST['work_S']) && $_POST['work_S'] == 'on' ? $_POST['work_p'] : 0),
                "zagp" => (!empty($_POST['price']) ? $_POST['price']: 0),
                "ztotal" => $_POST['total'],
                "zap" => $_POST['amount_paid']
            ));
            header("refresh:0;url=../admin/transactions.php");
        }
        else {
            ?>
            <div style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #333;
            ">
                <p style="
                    margin: 0;
                    padding: 1rem;
                    font-size: 18px;
                    font-family: tahoma, serif;
                    color: #721c24;
                    background-color: #f8d7da;
                    border-color: #f5c6cb;
                    border-radius: .25rem;
                ">
                    رقم الموبايل الذي أدخلته موجود بالفعل. 
                    <span onclick="window.history.back()" style="
                        cursor: pointer;
                        padding: .5rem 1rem;
                        border-radius: .25rem;
                        background-color: #3f51b5;
                        color: #fff;
                    ">رجوع</span>
                </p>
            </div>
            <?php
        }
    }
    else {
        header("refresh:0;url=../admin/transactions.php");
    }
    ob_end_flush();
?>