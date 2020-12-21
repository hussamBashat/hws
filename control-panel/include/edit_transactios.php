<?php 
    ob_start();
    session_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['edit_name'])) {
            $fullname = $_POST['firstname'] . " -" . $_POST['fathername'] . " -" . $_POST['grandname'] . " -" . $_POST['lastname'];
            $stmt = $con->prepare("UPDATE transactions SET fullname = ? WHERE id = ?");
            $stmt->execute(array($fullname, $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_person_img'])) {
            if (!empty($_FILES['file1']['name'])) {
                if (!empty($_POST['photograph_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['photograph_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file1']['name'];
                move_uploaded_file($_FILES['file1']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET photograph_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_id_card'])) {
            if (!empty($_FILES['file0']['name'])) {
                if (!empty($_POST['card_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['card_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file0']['name'];
                move_uploaded_file($_FILES['file0']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET card_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_certifica'])) {
            if (!empty($_FILES['file2']['name'])) {
                if (!empty($_POST['qualification_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['qualification_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file2']['name'];
                move_uploaded_file($_FILES['file2']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET qualification_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_criminal'])) {
            if (!empty($_FILES['file3']['name'])) {
                if (!empty($_POST['criminal_fisheye_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['criminal_fisheye_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file3']['name'];
                move_uploaded_file($_FILES['file3']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET criminal_fisheye_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_net_paper'])) {
            if (!empty($_FILES['file4']['name'])) {
                if (!empty($_POST['netbook_paper_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['netbook_paper_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file4']['name'];
                move_uploaded_file($_FILES['file4']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET netbook_paper_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_hospital'])) {
            if (!empty($_FILES['file5']['name'])) {
                if (!empty($_POST['hospital_reservation_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['hospital_reservation_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file5']['name'];
                move_uploaded_file($_FILES['file5']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET hospital_reservation_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_fingerprint'])) {
            if (!empty($_FILES['file6']['name'])) {
                if (!empty($_POST['fingerprint_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['fingerprint_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file6']['name'];
                move_uploaded_file($_FILES['file6']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET fingerprint_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_passport'])) {
            if (!empty($_FILES['file7']['name'])) {
                if (!empty($_POST['passport_img'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['passport_img']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file7']['name'];
                move_uploaded_file($_FILES['file7']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET passport_img = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_phone'])) {
            $stm = $con->prepare("SELECT * FROM transactions WHERE phone = ? AND id != ?");
            $stm->execute(array($_POST['mobile'], $_POST['id']));
            if ($stm->rowCount() == 0) {
                $stmt = $con->prepare("UPDATE transactions SET phone = ? WHERE id = ?");
                $stmt->execute(array($_POST['mobile'], $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_whatsapp'])) {
            $stmt = $con->prepare("UPDATE transactions SET whatsapp = ? WHERE id = ?");
            $stmt->execute(array($_POST['whatsapp'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_location'])) {
            $stmt = $con->prepare("UPDATE transactions SET address = ? WHERE id = ?");
            $stmt->execute(array($_POST['address'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_visa'])) {
            $stmt = $con->prepare("UPDATE transactions, invoices SET visa = ?, agreed_price = ?, total = ? WHERE transactions.id = ? AND trans_id = ?");
            $stmt->execute(array($_POST['visa'], $_POST['price'], $_POST['total'], $_POST['id'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_contract'])) {
            if (!empty($_FILES['file8']['name'])) {
                if (!empty($_POST['work_contract'])) {
                    unlink("../../images/transactions/" . $_POST['id'] . "/" . $_POST['work_contract']);
                }
                $imagename = rand(0, 10000000) . "_" . $_FILES['file8']['name'];
                move_uploaded_file($_FILES['file8']['tmp_name'], "../../images/transactions/" . $_POST['id'] . "/" . $imagename);
                $stmt = $con->prepare("UPDATE transactions SET work_contract = ? WHERE id = ?");
                $stmt->execute(array($imagename, $_POST['id']));
            }
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_notes'])) {
            $stmt = $con->prepare("UPDATE transactions SET note = ? WHERE id = ?");
            $stmt->execute(array($_POST['notes'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['change_status'])) {
            $stmt = $con->prepare("UPDATE transactions SET trans_status = ? WHERE id = ?");
            $stmt->execute(array($_POST['status'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_amount_paid'])) {
            $stmt = $con->prepare("UPDATE invoices SET amount_paid = ? WHERE trans_id = ?");
            $stmt->execute(array($_POST['amount_paid'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_qualifications_p'])) {
            $stmt = $con->prepare("UPDATE invoices SET qualification = ? WHERE trans_id = ?");
            $stmt->execute(array((isset($_POST['qualifications_s']) && $_POST['qualifications_s'] == 'on' ? $_POST['qualifications_p'] : 0), $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_hospetal_p'])) {
            $stmt = $con->prepare("UPDATE invoices SET hospital_reservation = ? WHERE trans_id = ?");
            $stmt->execute(array((isset($_POST['hospetal_s']) && $_POST['hospetal_s'] == 'on' ? $_POST['hospetal_p'] : 0), $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_work_p'])) {
            $stmt = $con->prepare("UPDATE invoices SET work_contract_service = ? WHERE trans_id = ?");
            $stmt->execute(array((isset($_POST['work_S']) && $_POST['work_S'] == 'on' ? $_POST['work_p'] : 0), $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['edit_fingerprint_d'])) {
            $stmt = $con->prepare("UPDATE transactions, invoices SET fingerprint_reservation = ?, fingerprint_reservation_date = ? WHERE transactions.id = ? AND trans_id = ?");
            $stmt->execute(array((isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_p'] : 0), (isset($_POST['fingerprint_s']) && $_POST['fingerprint_s'] == 'on' ? $_POST['fingerprint_d'] : ""), $_POST['id'], $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        elseif (isset($_POST['change_marketer'])) {
            $stmt = $con->prepare("UPDATE transactions SET marketer_id = ? WHERE id = ?");
            $stmt->execute(array(substr($_POST['marketer_id'], 0, 1), $_POST['id']));
            header("refresh:0;url=../admin/transactions.php?do=show&id=" . $_POST['id']);
        }
        
    }
    else{
        header("refresh:0;url=../admin/transactions.php");
    }
    ob_end_flush();
?>