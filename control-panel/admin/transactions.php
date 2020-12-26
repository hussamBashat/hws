<?php
ob_start();
session_start();
if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    $Title = "المعاملات";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'transactions';
    if ($do == "add" || $do == "show") {
        $stmt = $con->prepare("SELECT * FROM static_price");
        $stmt->execute();
        $prices = $stmt->fetchAll();
        $stmt1 = $con->prepare("SELECT * FROM visas");
        $stmt1->execute();
        $visas = $stmt1->fetchAll();
    }
    $stmt2 = $con->prepare("SELECT * FROM users");
    $stmt2->execute();
    $users = $stmt2->fetchAll();
    $st = $con->prepare("SELECT * FROM trans_status");
    $st->execute();
    $trans_status = $st->fetchAll();
        
    if ($do == "transactions") {       // Transactions Page
        
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between active"><i class="material-icons">library_books</i> المعاملات</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-bar flex-between">
            <h1>إدارة المعاملات</h1>
            <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">add</i> إضافة جديد</a>
            <p>تعرض هذه الصفحة جميع المعاملات المسؤول عنها, يمكنك إضافة, تعديل وحذف معاملة من هنا..</p>
        </div>
    </div>
    <!-- Start Transactions -->
    <section class="transactions">
        <div class="container">
            
            <!-- Table Options -->
            <div class="table-option">
                <div class="row">
                    <!-- Columns Modal -->
                    <div class="col l2">
                        <button data-target="columns" class="btn waves-effect waves-light modal-trigger tooltipped" data-position="top" data-tooltip="تخصيص الأعمدة"><i class="material-icons">view_column</i></button>
                    </div>
                    <!-- Filter Modal -->
                    <div class="col l2">
                        <button data-target="filters" class="btn waves-effect waves-light modal-trigger tooltipped" data-position="top" data-tooltip="فلترة متقدمة"><i class="material-icons">filter_list</i></button>
                    </div>
                </div>
            </div>
            <!-- Columns Modal -->
            <div id="columns" class="modal table">
                <form action="../include/trans_operation.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header center-align">
                            <h6>تخصيص الأعمدة</h6>
                        </div>
                        <div class="modal-body">
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="all" id="checkAllColumns" <?php echo ($_SESSION['all'] == "true" ? "checked" : ""); ?>>
                                    <span>اختيار الكل</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk0" <?php echo ($_SESSION['chk0'] == "true" ? "checked" : ""); ?>>
                                    <span>الرقم التسلسلي</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk1" <?php echo ($_SESSION['chk1'] == "true" ? "checked" : ""); ?>>
                                    <span>اسم المسوق</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk2" <?php echo ($_SESSION['chk2'] == "true" ? "checked" : ""); ?>>
                                    <span>الحالة</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk3" <?php echo ($_SESSION['chk3'] == "true" ? "checked" : ""); ?>>
                                    <span>الاسم</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk4" <?php echo ($_SESSION['chk4'] == "true" ? "checked" : ""); ?>>
                                    <span>موبايل</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk5" <?php echo ($_SESSION['chk5'] == "true" ? "checked" : ""); ?>>
                                    <span>واتساب</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk6" <?php echo ($_SESSION['chk6'] == "true" ? "checked" : ""); ?>>
                                    <span>العنوان</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk7" <?php echo ($_SESSION['chk7'] == "true" ? "checked" : ""); ?>>
                                    <span>التأشيرة</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk8" <?php echo ($_SESSION['chk8'] == "true" ? "checked" : ""); ?>>
                                    <span>سعر التأشيرة</span>
                                </label>
                            </div>
                            <ul class="column collapsible m-0" id="filesCollapsible">
                                <li>
                                    <div class="collapsible-header flex-between p-0">
                                        <label class="label-check m-0">
                                            <input type="checkbox" name="chk25" id="checkAllFiles" <?php echo ($_SESSION['chk25'] == "true" ? "checked" : ""); ?>>
                                            <span>الملفات</span>
                                        </label>
                                        <i class="material-icons m-0 arrow">keyboard_arrow_left</i>
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk9" <?php echo ($_SESSION['chk9'] == "true" ? "checked" : ""); ?>>
                                                <span>صورة البطاقة</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk10" <?php echo ($_SESSION['chk10'] == "true" ? "checked" : ""); ?>>
                                                <span>صورة شخصية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk11" <?php echo ($_SESSION['chk11'] == "true" ? "checked" : ""); ?>>
                                                <span>المؤهلات العلمية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk12" <?php echo ($_SESSION['chk12'] == "true" ? "checked" : ""); ?>>
                                                <span>الفيش الجنائي</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk13" <?php echo ($_SESSION['chk13'] == "true" ? "checked" : ""); ?>>
                                                <span>ورقة النت</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk14" <?php echo ($_SESSION['chk14'] == "true" ? "checked" : ""); ?>>
                                                <span>حجز مستشفى</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk15" <?php echo ($_SESSION['chk15'] == "true" ? "checked" : ""); ?>>
                                                <span>البصمة</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk16" <?php echo ($_SESSION['chk16'] == "true" ? "checked" : ""); ?>>
                                                <span>جواز السفر</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk17" <?php echo ($_SESSION['chk17'] == "true" ? "checked" : ""); ?>>
                                                <span>عقد عمل</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="column collapsible m-0" id="servicesCollapsible">
                                <li>
                                    <div class="collapsible-header flex-between p-0">
                                        <label class="label-check m-0">
                                            <input type="checkbox" name="chk26" id="checkAllServices" <?php echo ($_SESSION['chk26'] == "true" ? "checked" : ""); ?>>
                                            <span>الخدمات</span>
                                        </label>
                                        <i class="material-icons m-0 arrow">keyboard_arrow_left</i>
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk18" <?php echo ($_SESSION['chk18'] == "true" ? "checked" : ""); ?>>
                                                <span>المؤهلات العلمية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk19" <?php echo ($_SESSION['chk19'] == "true" ? "checked" : ""); ?>>
                                                <span>حجز مستشفى</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk20" <?php echo ($_SESSION['chk20'] == "true" ? "checked" : ""); ?>>
                                                <span>عقد عمل</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="chk21" <?php echo ($_SESSION['chk21'] == "true" ? "checked" : ""); ?>>
                                                <span>حجز بصمة</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk22" <?php echo ($_SESSION['chk22'] == "true" ? "checked" : ""); ?>>
                                    <span>المبلغ المدفوع</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk23" <?php echo ($_SESSION['chk23'] == "true" ? "checked" : ""); ?>>
                                    <span>ملاحظات</span>
                                </label>
                            </div>
                            <div class="column">
                                <label class="label-check">
                                    <input type="checkbox" name="chk24" <?php echo ($_SESSION['chk24'] == "true" ? "checked" : ""); ?>>
                                    <span>عمليات</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footre">
                            <button type="submit" name="choose_col" class="btn main-dark waves-effect waves-light">حفظ</button>
                            <button type="button" class="modal-close btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Filter Modal -->
            <div id="filters" class="modal table">
                <form action="" method="post">
                    <div class="modal-content">
                        <div class="modal-header center-align">
                            <h6>الفلترة المتقدمة</h6>
                        </div>
                        <div class="modal-body">
                            <div class="filter effect">
                                <div class="input-field m-0 col l2">
                                    <input type="text" name="search" id="search" autocomplete="off" class="validate">
                                    <label for="search"><i class="material-icons" style="vertical-align: bottom;">search</i> اكتب كلمة البحث</label>                        
                                </div>
                            </div>
                            <?php
                                if (isset($_SESSION['admin'])) {?>
                                    <div class="filter effect">
                                        <div class="input-field m-0">
                                            <input type="text" name="marketer_id" list="marketer" id="marketerList" autocomplete="off" class="validate">
                                            <label for="marketerList">فلترة حسب المسوق</label>
                                        </div>
                                        <datalist id="marketer">
                                        <?php
                                            foreach ($users as $user) {?>
                                                <option value="<?php echo $user['id']; ?> - <?php echo $user['username']; ?>">
                                                <?php
                                            }
                                        ?>
                                        </datalist>
                                    </div>
                                    <?php
                                }
                            ?>
                            <div class="filter effect">
                                <select name="status" id="statusf">
                                    <option value="all">فلترة حسب الحالة</option>
                                    <?php
                                        foreach ($trans_status as $status) {?>
                                            <option value="<?php echo $status['statue_name']; ?>"><?php echo $status['statue_name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <ul class="filter collapsible m-0" id="filesCollapsibleF">
                                <li>
                                    <div class="collapsible-header flex-between p-0">
                                        <label class="label-check m-0">
                                            <input type="checkbox" name="files" id="checkAllFilesF" >
                                            <span>فلترة الملفات</span>
                                        </label>
                                        <i class="material-icons m-0 arrow">keyboard_arrow_left</i>
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch0" >
                                                <span>صورة البطاقة</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch1" >
                                                <span>صورة شخصية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch2" >
                                                <span>المؤهلات العلمية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch3" >
                                                <span>الفيش الجنائي</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch4" >
                                                <span>ورقة النت</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch5" >
                                                <span>حجز مستشفى</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch6" >
                                                <span>البصمة</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch7" >
                                                <span>جواز السفر</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ch8" >
                                                <span>عقد عمل</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="flex-between" style="margin-top: .5rem">
                                    <label>
                                        <input name="fileStatus" value="exist" type="radio" checked>
                                        <span>تم إدخالها</span>
                                    </label>
                                    <label>
                                        <input name="fileStatus" value="notexist" type="radio">
                                        <span>غير مدخلة</span>
                                    </label>
                                </li>
                            </ul>
                            <ul class="filter collapsible m-0" id="servicesCollapsibleF">
                                <li>
                                    <div class="collapsible-header flex-between p-0">
                                        <label class="label-check m-0">
                                            <input type="checkbox" name="service" id="checkAllServicesF" >
                                            <span>فلترة الخدمات</span>
                                        </label>
                                        <i class="material-icons m-0 arrow">keyboard_arrow_left</i>
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ck0">
                                                <span>المؤهلات العلمية</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ck1" >
                                                <span>حجز مستشفى</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ck2" >
                                                <span>عقد عمل</span>
                                            </label>
                                        </div>
                                        <div class="column">
                                            <label class="label-check">
                                                <input type="checkbox" name="ck3" >
                                                <span>حجز بصمة</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="flex-between" style="margin-top: .5rem">
                                    <label>
                                        <input name="serviceStatus" value="exist" type="radio" checked>
                                        <span>تم بيعها</span>
                                    </label>
                                    <label>
                                        <input name="serviceStatus" value="notexist" type="radio">
                                        <span>غير مباعة</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footre">
                            <button type="submit" name="search&filter" class="btn main-dark waves-effect waves-light">فلترة</button>
                            <button class="modal-close btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
            <form method="post" action="../include/delete_transaction.php">
                <input type="hidden" name="id" id="btnId">
                <table class="striped highlight responsive-table supernatural-table table-block">
                    <thead>
                        <tr>
                            <?php 
                                if($_SESSION['chk0'] == "true") {
                                    ?>
                                    <th>#</th>
                                    <?php
                                }
                                if($_SESSION['chk1'] == "true") {
                                    ?>
                                    <th>المسوق</th>
                                    <?php
                                }
                                if($_SESSION['chk2'] == "true") {
                                    ?>
                                    <th>الحالة</th>
                                    <?php
                                }
                                if($_SESSION['chk3'] == "true") {
                                    ?>
                                    <th>الاسم</th>
                                    <?php
                                }
                                if($_SESSION['chk4'] == "true") {
                                    ?>
                                    <th>موبايل</th>
                                    <?php
                                }
                                if($_SESSION['chk5'] == "true") {
                                    ?>
                                    <th>واتساب</th>
                                    <?php
                                }
                                if($_SESSION['chk6'] == "true") {
                                    ?>
                                    <th>العنوان</th>
                                    <?php
                                }
                                if($_SESSION['chk7'] == "true") {
                                    ?>
                                    <th>التأشيرة</th>
                                    <?php
                                }
                                if($_SESSION['chk8'] == "true") {
                                    ?>
                                    <th>سعر التأشيرة</th>
                                    <?php
                                }
                                if($_SESSION['chk9'] == "true") {
                                    ?>
                                    <th>البطاقة</th>
                                    <?php
                                }
                                if($_SESSION['chk10'] == "true") {
                                    ?>
                                    <th>الصورة</th>
                                    <?php
                                }
                                if($_SESSION['chk11'] == "true") {
                                    ?>
                                    <th>المؤهلات العلمية</th>
                                    <?php
                                }
                                if($_SESSION['chk12'] == "true") {
                                    ?>
                                    <th>الفيش الجنائي</th>
                                    <?php
                                }
                                if($_SESSION['chk13'] == "true") {
                                    ?>
                                    <th>ورقة النت</th>
                                    <?php
                                }
                                if($_SESSION['chk14'] == "true") {
                                    ?>
                                    <th>حجز مستشفى</th>
                                    <?php
                                }
                                if($_SESSION['chk15'] == "true") {
                                    ?>
                                    <th>البصمة</th>
                                    <?php
                                }
                                if($_SESSION['chk16'] == "true") {
                                    ?>
                                    <th>جواز السفر</th>
                                    <?php
                                }
                                if($_SESSION['chk17'] == "true") {
                                    ?>
                                    <th>عقد عمل</th>
                                    <?php
                                }
                                if($_SESSION['chk18'] == "true") {
                                    ?>
                                    <th>خدمة المؤهلات العلمية</th>
                                    <?php
                                }
                                if($_SESSION['chk19'] == "true") {
                                    ?>
                                    <th>خدمة حجز المستشفى</th>
                                    <?php
                                }
                                if($_SESSION['chk20'] == "true") {
                                    ?>
                                    <th>خدمة عقد عمل</th>
                                    <?php
                                }
                                if($_SESSION['chk21'] == "true") {
                                    ?>
                                    <th>خدمة حجز بصمة</th>
                                    <?php
                                }
                                if($_SESSION['chk22'] == "true") {
                                    ?>
                                    <th>المبلغ المدفوع</th>
                                    <?php
                                }
                                if($_SESSION['chk23'] == "true") {
                                    ?>
                                    <th>ملاحظات</th>
                                    <?php
                                }
                                if($_SESSION['chk24'] == "true") {
                                    ?>
                                    <th>عمليات</th>
                                    <?php
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if (isset($_POST['search&filter'])) {
                            $files = "";
                            $service = "";
                            if (!empty($_POST['search'])) {
                                $column = " AND CONCAT_WS('', transactions.id, fullname, address, phone, whatsapp, visa, visa_price, marketer_id, passport_img, card_img, photograph_img, qualification_img, criminal_fisheye_img, netbook_paper_img, hospital_reservation_img, fingerprint_reservation_date, fingerprint_img, note, work_contract, trans_status, invoices.id, trans_id, office_fare, netbook_paper, qualification, fingerprint_reservation, hospital_reservation, work_contract_service, agreed_price, total, amount_paid) like '%" . $_POST['search'] . "%'";
                            }
                            else {
                                $column = "";
                            }
                            if ($_POST['status'] == 'all') {
                                $status = "";
                            }
                            else {
                                $status = " AND trans_status = '" . $_POST['status'] . "'";
                            }
                            if (isset($_SESSION['admin'])) {
                                if (empty($_POST['marketer_id'])) {
                                    $marketer = "";
                                }
                                else {
                                    $marketer = " AND marketer_id = " . substr($_POST['marketer_id'], 0, 1);
                                }
                            }
                            else {
                                $marketer = " AND marketer_id = " . $_SESSION['user'];
                            }
                            if (isset($_POST['files']) && $_POST['files'] == "on") {
                                if ($_POST['fileStatus'] == "exist") {
                                    $files = " AND CONCAT_WS('', passport_img, card_img, photograph_img, qualification_img, criminal_fisheye_img, netbook_paper_img, hospital_reservation_img, fingerprint_img, work_contract) != ''";
                                }
                                else {
                                    $files = " AND CONCAT_WS('', passport_img, card_img, photograph_img, qualification_img, criminal_fisheye_img, netbook_paper_img, hospital_reservation_img, fingerprint_img, work_contract) = ''";
                                }
                            }
                            else {
                                for ($i=0; $i < 9; $i++) { 
                                    $ch = "ch" . $i;
                                    if (isset($_POST[$ch]) && $_POST[$ch] == "on") {
                                        switch ($i) {
                                            case 0:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND card_img != ''" : " AND card_img = ''");
                                                break;
                                            case 1:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND photograph_img != ''" : " AND photograph_img = ''");
                                                break;
                                            case 2:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND qualification_img != ''" : " AND qualification_img = ''");
                                                break;
                                            case 3:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND criminal_fisheye_img != ''" : " AND criminal_fisheye_img = ''");
                                                break;
                                            case 4:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND netbook_paper_img != ''" : " AND netbook_paper_img = ''");
                                                break;
                                            case 5:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND hospital_reservation_img != ''" : " AND hospital_reservation_img = ''");
                                                break;
                                            case 6:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND fingerprint_img != ''" : " AND fingerprint_img = ''");
                                                break;
                                            case 7:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND passport_img != ''" : " AND passport_img = ''");
                                                break;
                                            case 8:
                                                $files .= ($_POST['fileStatus'] == "exist" ?  " AND work_contract != ''" : " AND work_contract = ''");
                                                break;
                                        }
                                    }
                                }
                            }
                            if (isset($_POST['service']) && $_POST['service'] == "on") {
                                if ($_POST['serviceStatus'] == "exist") {
                                    $service = " AND CONCAT_WS('', qualification, hospital_reservation, work_contract_service, fingerprint_reservation) > 0";
                                }
                                else {
                                    $service = " AND CONCAT_WS('', qualification, hospital_reservation, work_contract_service, fingerprint_reservation) = 0";
                                }
                            }
                            else {
                                for ($i=0; $i < 4; $i++) { 
                                    $ck = "ck" . $i;
                                    if (isset($_POST[$ck]) && $_POST[$ck] == "on") {
                                        switch ($i) {
                                            case 0:
                                                $service .= ($_POST['fileStatus'] == "exist" ?  " AND qualification > 0" : " AND qualification = 0");
                                                break;
                                            case 1:
                                                $service .= ($_POST['fileStatus'] == "exist" ?  " AND hospital_reservation > 0" : " AND hospital_reservation = 0");
                                                break;
                                            case 2:
                                                $service .= ($_POST['fileStatus'] == "exist" ?  " AND work_contract_service > 0" : " AND work_contract_service = 0");
                                                break;
                                            case 3:
                                                $service .= ($_POST['fileStatus'] == "exist" ?  " AND fingerprint_reservation > 0" : " AND fingerprint_reservation = 0");
                                                break;
                                        }
                                    }
                                }
                            }
                            $stmt = $con->prepare("SELECT * FROM transactions, invoices WHERE transactions.id = invoices.trans_id" . $column . $status . $marketer . $files . $service . " ORDER BY transactions.id DESC");
                            $stmt->execute();
                            $data = ($stmt->rowCount() > 0 ? $stmt->fetchAll() : "false");
                        }
                        else {
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
                        if ($data != "false") {
                            foreach ($data as $value) {
                                $fullname = explode("-", $value['fullname']);
                                $q = $con->prepare("SELECT username FROM users WHERE id = ?");
                                $q->execute(array($value['marketer_id']));
                                $marketer_name = $q->fetchColumn();?>
                                <tr>
                                    <?php 
                                        if($_SESSION['chk0'] == "true") {
                                            ?>
                                            <td><?php echo $value[0]; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk1'] == "true") {
                                            ?>
                                            <td><?php echo $marketer_name; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk2'] == "true") {
                                            ?>
                                            <td><?php echo $value['trans_status']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk3'] == "true") {
                                            ?>
                                            <td><?php echo $fullname[0] . $fullname[1] . $fullname[2] . $fullname[3]; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk4'] == "true") {
                                            ?>
                                            <td><a href="tel:<?php echo $value['phone']; ?>" class="custom-link tooltipped" data-position="bottom" data-tooltip="<?php echo $value['phone']; ?>">اتصال</a></td>
                                            <?php
                                        }
                                        if($_SESSION['chk5'] == "true") {
                                            ?>
                                            <td><a href="https://wa.me/<?php echo $value['whatsapp']; ?>" class="custom-link tooltipped" data-position="bottom" data-tooltip="<?php echo $value['whatsapp']; ?>" target="_blank">مراسلة</a></td>
                                            <?php
                                        }
                                        if($_SESSION['chk6'] == "true") {
                                            ?>
                                            <td><?php echo $value['address']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk7'] == "true") {
                                            ?>
                                            <td><?php echo $value['visa']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk8'] == "true") {
                                            ?>
                                            <td><?php echo $value['agreed_price']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk9'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['card_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk10'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['photograph_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk11'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['qualification_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk12'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['criminal_fisheye_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk13'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['netbook_paper_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk14'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['hospital_reservation_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk15'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['fingerprint_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk16'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['passport_img']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk17'] == "true") {
                                            ?>
                                            <td><?php echo (!empty($value['work_contract']) ? '<i class="material-icons done">check_circle</i>': ""); ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk18'] == "true") {
                                            ?>
                                            <td><?php echo $value['qualification']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk19'] == "true") {
                                            ?>
                                            <td><?php echo $value['hospital_reservation']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk20'] == "true") {
                                            ?>
                                            <td><?php echo $value['work_contract_service']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk21'] == "true") {
                                            ?>
                                            <td><?php echo $value['fingerprint_reservation']; ?> / <?php echo $value['fingerprint_reservation_date']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk22'] == "true") {
                                            ?>
                                            <td><?php echo $value['amount_paid']; ?></td>
                                            <?php
                                        }
                                        if($_SESSION['chk23'] == "true") {
                                            ?>
                                            <td><?php echo substr($value['note'], 0, 35); ?> ...</td>
                                            <?php
                                        }
                                        if($_SESSION['chk24'] == "true") {
                                            ?>
                                            <td>
                                                <a href="?do=show&id=<?php echo $value[0]; ?>" class="btn btn-floating waves-effect waves-light flex-between tooltipped ed-btn" data-position="bottom" data-tooltip="عرض" style="margin: 8px;"><i class="material-icons">link</i></a>
                                                <?php
                                                    if (isset($_SESSION['admin'])) {?>
                                                        <button name="transactionsdel" data-id="<?php echo $value[0]; ?>" class="btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                        else {?>
                            <tr>
                                <td colspan="100%" class="center-align" style="color: var(--second-color); font-weight: 600;">
                                    <i class="material-icons" style="transform: translateY(8px);">info</i> لا يوجد معاملات
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
    
    <?php
    } elseif ($do == "add") {   // Add Transactions
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between"><a href="?do=transactions" class="flex-between"><i class="material-icons">library_books</i> المعاملات</a> / </li>
                <li class="flex-between active"><i class="material-icons">add</i> إضافة جديد</li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="top-bar flex-between">
        <h1>إضافة معاملة جديدة</h1>
        <a href="?do=transactions" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></a>
        <p>يمكنك إضافة معاملة جديدة من هنا, جميع الحقول التالية مطلوبة.</p>
    </div>
    </div>
    <!-- Start Transactions Add Form -->
    <section class="add-transactions">
        <div class="container">
            <form method="post" action="../include/add_transaction.php" enctype="multipart/form-data" id="addTrans">
                <div class="row m-0">
                    <div class="row">
                        <?php
                            if (isset($_SESSION['admin'])) {?>
                                <div class="col l6">
                                    <div class="input-field">
                                        <input type="text" name="marketer_id" list="marketer" id="marketerList" autocomplete="off" class="validate" required>
                                        <label for="marketerList">اختر المسوق (يمكنك البحث عن اسم أو رقم المسوق مباشرة)</label>
                                    </div>
                                    <datalist id="marketer">
                                    <?php
                                        foreach ($users as $user) {?>
                                            <option value="<?php echo $user['id']; ?> - <?php echo $user['username']; ?>">
                                            <?php
                                        }
                                    ?>
                                    </datalist>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="col <?php echo (isset($_SESSION['admin']) ? "l6" : "l12") ?>">
                            <div class="input-field validate">
                                <select name="status" id="status">
                                    <option value="" selected>اختر الحالة</option>
                                    <?php
                                        foreach ($trans_status as $status) {?>
                                            <option value="<?php echo $status['statue_name']; ?>" <?php echo ($status['status'] == 0 ? "disabled" : ''); ?>><?php echo $status['statue_name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h5>معلومات أساسية</h5>
                    <div class="row">
                        <p class="input-group-title">الاسم الكامل</p>
                        <div class="input-field col l3">
                            <input id="firstname" name="firstname" type="text" class="validate" required>
                            <label for="firstname">الاسم الأول</label>
                        </div>
                        <div class="input-field col l3">
                            <input id="fathername" name="fathername" type="text" class="validate">
                            <label for="fathername">اسم الأب</label>
                        </div>
                        <div class="input-field col l3">
                            <input id="grandname" name="grandname" type="text" class="validate">
                            <label for="grandname">اسم الجد</label>
                        </div>
                        <div class="input-field col l3">
                            <input id="lastname" name="lastname" type="text" class="validate">
                            <label for="lastname">الكنية</label>
                        </div>
                    </div>
                    <div class="row">
                        <p class="input-group-title">معلومات التواصل</p>
                        <div class="input-field col l4">
                            <input type="tel" id="mobile" name="mobile" class="validate" required>
                            <label for="mobile">رقم الموبايل</label>
                        </div>
                        <div class="input-field col l4">
                            <input type="tel" id="whatsapp" name="whatsapp" class="validate">
                            <label for="whatsapp">رقم الواتساب</label>
                        </div>
                        <div class="input-field col l4">
                            <input type="text" id="address" name="address" class="validate">
                            <label for="address">العنوان الحالي</label>
                        </div>
                    </div>
                    <h5 class="m-0">معلومات التأشيرة</h5>
                    <div class="row">
                        <p class="input-group-title">معلومات التأشيرة</p>
                        <div class="input-field col l6">
                            <select name="visa" id="visaList">
                                <option value="" selected>اختر التأشيرة</option>
                                <?php
                                    foreach ($visas as $visa) {?>
                                        <option value="<?php echo $visa['visaname']; ?>" data-price="<?php echo $visa['price']; ?>" <?php echo ($visa['status'] == 1 ? "disabled" : ''); ?>><?php echo $visa['visaname']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col l6">
                            <input type="number" id="price" name="price" value="" class="validate">
                            <label for="price">السعر المتفق عليه</label>
                        </div>
                    </div> 
                    <div class="row">
                        <p class="input-group-title">الملفات المطلوبة</p>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">payment</i></span>
                                <input type="file" name="file0" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة عن البطاقة الشخصية">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">person_outline</i></span>
                                <input type="file" name="file1" class="input-file photograph">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة شخصية">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">picture_as_pdf</i></span>
                                <input type="file" name="file2" class="input-file pdf">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="ملف المؤهلات العلمية">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> يجب أن ينتهي هذا الملف بإمتداد 'PDF' حصراً</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file3" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate"  type="text" placeholder="صورة عن الفيش الجنائي">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file4" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate"  type="text" placeholder="صورة عن ورقة النت">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file5" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة عن حجز مستشفى">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file6" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة بصمة">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file7" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة جواز السفر">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field file-field col l6">
                            <div class="btn">
                                <span><i class="material-icons">image</i></span>
                                <input type="file" name="file8" class="input-file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="صورة عقد عمل">
                            </div>
                            <p class="invalied-file hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                        </div>
                        <div class="input-field col l6">
                            <textarea id="notes" name="notes" class="materialize-textarea"></textarea>
                            <label for="notes">ملاحظات ..</label>
                        </div>
                    </div> 
                    <div class="row">
                        <h5>خدمات التوثيق</h5>
                        <p class="input-group-title">اختر الخدمات التي تريد توثيقها عن طريق تفعيل الخيار بجانب كل خدمة.</p>
                        <div class="col l6">
                            <div class="row">
                                <div class="input-field col l5">
                                    <label class="label-check">
                                        <input type="checkbox" name="qualifications_s" data-invoice="qualificationInvoice" data-orginalprice="<?php echo $prices[4]['price']; ?>">
                                        <span><?php echo $prices[4]['service_name']; ?></span>
                                    </label>
                                </div>
                                <div class="input-field col l7">
                                    <input type="number" id="qualifications_p" name="qualifications_p" disabled value="<?php echo $prices[4]['price']; ?>" class="validate">
                                    <label for="qualifications_p">سعر الخدمة</label>
                                </div>
                            </div>
                        </div>
                        <div class="col l6">
                            <div class="row">
                                <div class="input-field col l5">
                                    <label class="label-check">
                                        <input type="checkbox" name="hospetal_s" data-invoice="hospitalInvoice" data-orginalprice="<?php echo $prices[1]['price']; ?>">
                                        <span><?php echo $prices[1]['service_name']; ?></span>
                                    </label>
                                </div>
                                <div class="input-field col l7">
                                    <input type="number" id="hospetal_p" name="hospetal_p" disabled value="<?php echo $prices[1]['price']; ?>" class="validate">
                                    <label for="hospetal_p">سعر الخدمة</label>
                                </div>
                            </div>
                        </div>
                        <div class="col l6">
                            <div class="row">
                                <div class="input-field col l5">
                                    <label class="label-check">
                                        <input type="checkbox" name="work_S" class="work-chekbox" data-invoice="workInvoice" data-orginalprice="<?php echo $prices[5]['price']; ?>">
                                        <span><?php echo $prices[5]['service_name']; ?></span>
                                    </label>
                                </div>
                                <div class="input-field col l7">
                                    <input type="number" id="work_p" name="work_p" disabled value="<?php echo $prices[5]['price']; ?>" class="validate">
                                    <label for="work_p">سعر الخدمة</label>
                                </div>
                            </div>
                        </div>
                        <div class="col l6">
                            <div class="row">
                                <div class="input-field and-date col l5">
                                    <label class="label-check">
                                        <input type="checkbox" name="fingerprint_s" class="fingerprint" data-invoice="fingerprintInvoice" data-orginalprice="<?php echo $prices[2]['price']; ?>">
                                        <span><?php echo $prices[2]['service_name']; ?></span>
                                    </label>
                                </div>
                                <div class="input-field col l3">
                                    <input type="number" id="fingerprint_p" name="fingerprint_p" disabled value="<?php echo $prices[2]['price']; ?>" class="validate">
                                    <label for="fingerprint_p">سعر الخدمة</label>
                                </div>
                                <div class="input-field col l4">
                                    <input type="text" class="datepicker" id="fingerprint_d" name="fingerprint_d" disabled required>
                                    <label for="fingerprint_d">تاريخ الحجز</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="input-group-title">أدخل المبلغ المدفوع</p>
                        <div class="col l6">
                            <div class="input-field col l6">
                                <input type="number" id="amount_paid" name="amount_paid" value="0" class="validate" data-invoice="paidInvoice">
                                <label for="amount_paid">المبلغ المدفوع</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="orginal_price" id="orginlPrice">
                
                <!-- Modal Trigger -->
                <button data-target="invoice" class="modal-trigger btn-floating btn-large waves-effect waves-light main-dark cart-btn"><i class="material-icons">add_shopping_cart</i></button>
                <!-- Modal Structure -->
                <div id="invoice" class="modal cart-modal">
                    <div class="modal-content">
                        <div class="modal-header flex-between">
                            <h5 class="m-0">الفاتورة النهائية</h5>
                            <img src="../../images/logo.png" alt="Maysan Logo">
                        </div>
                        <div class="modal-line">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[0]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span><b class="sum"><?php echo $prices[0]['price']; ?></b></span>
                                    <input type="hidden" value="<?php echo $prices[0]['price']; ?>" name="office_fare">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-line hide">
                            <div class="row m-0">
                                <div class="col l10"><span>التأشيرة</span> <strong id="visaNameInvoice"></strong></div>
                                <div class="col l2">
                                    <span><b class="sum" id="visaPriceInvoice">0</b></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="modal-line">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[3]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span><b class="sum"><?php echo $prices[3]['price']; ?></b></span>
                                    <input type="hidden" value="<?php echo $prices[3]['price']; ?>" name="net_paper">
                                </div>
                            </div>
                        </div>
                        <div class="modal-line hide">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[4]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span class="sum" id="qualificationInvoice">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-line hide">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[1]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span class="sum" id="hospitalInvoice">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-line hide">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[5]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span class="sum" id="workInvoice">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-line hide">
                            <div class="row m-0">
                                <div class="col l10"><span><?php echo $prices[2]['service_name']; ?></span></div>
                                <div class="col l2">
                                    <span class="sum" id="fingerprintInvoice">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="modal-line">
                            <div class="row m-0">
                                <div class="col l10"><span><strong>المجموع</strong></span></div>
                                <div class="col l2">
                                    <span><b id="totalInvoice"></b></span>
                                    <input type="hidden" name="total">
                                </div>
                            </div>
                        </div>
                        <div class="modal-line">
                            <div class="row m-0">
                                <div class="col l10"><span>المبلغ المدفوع</span></div>
                                <div class="col l2">
                                    <span id="paidInvoice"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-line">
                            <div class="row m-0">
                                <div class="col l10"><span>المبلغ المتبقي</span></div>
                                <div class="col l2">
                                    <span id="restInvoice"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row center-align">
                            <button type="submit" name="add_trans" class="btn main-dark waves-effect waves-light">إتمام العملية</button>
                        </div>
                    </div>
                </div>
    
            </form>
        </div>
    </section>
    <?php
    } elseif ($do == "show") {   // Show Transactions
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $stmt2 = $con->prepare("SELECT * FROM transactions, invoices WHERE transactions.id = ? AND transactions.id = invoices.trans_id");
        $stmt2->execute(array($id));
        if ($stmt2->rowCount() > 0) {
            $trans = $stmt2->fetch();
            $fullname = explode("-", $trans['fullname']);
            ?>
            <!-- Breadcrumb -->
            <div class="my-breadcrumb">
                <div class="container">
                    <ul class="list-item">
                        <li class="flex-between"><a href="?do=transactions" class="flex-between"><i class="material-icons">library_books</i> المعاملات</a> / </li>
                        <li class="flex-between active"><i class="material-icons">person</i> معاملة <?php echo $fullname[0] . $fullname[1] . $fullname[2] . $fullname[3]; ?></li>
                    </ul>
                </div>
            </div>
            <div class="container">
            <div class="top-bar flex-between">
                <h1>عرض المعاملة</h1>
                <a href="?do=transactions" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></a>
                <p>يمكنك من هنا عرض وتعديل معلومات المعاملة, اختر ما تريد تعديله أولاً ثم قم بتعديل البيانات بالشكل المناسب</p>
            </div>
            </div>
            <!-- Start Transactions Edit Form -->
            <section class="show-transactions p-1">
                <div class="container">
                    <form method="post" action="../include/edit_transactios.php" id="addTrans" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $id; ?>" name="id">
                        <div class="row m-0">
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <?php
                                        if (isset($_SESSION['admin'])) {
                                        $stmt3 = $con->prepare("SELECT * FROM users WHERE id = ?");
                                        $stmt3->execute(array($trans['marketer_id']));
                                        $data = $stmt3->fetch();?>
                                        <div class="col l6">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>اسم المسوق: <span><?php echo $data['username']; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الرقم" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide flex-between">
                                                <div class="input-field col s7">
                                                        <div class="col l12">
                                                            <div class="input-field col l12">
                                                                <input type="text" name="marketer_id" list="marketer" value="<?php echo $data['id']; ?> - <?php echo $data['username']; ?>" id="marketerList" autocomplete="off" class="validate show-page" required>
                                                                <label for="marketerList">اختر المسوق</label>
                                                            </div>
                                                            <datalist id="marketer">
                                                            <?php
                                                                foreach ($users as $user) {?>
                                                                    <option value="<?php echo $user['id']; ?> - <?php echo $user['username']; ?>" <?php echo($user['id'] == $trans['marketer_id'] ? "selected" : "") ?>>
                                                                    <?php
                                                                }
                                                            ?>
                                                            </datalist>
                                                        </div>
                                                </div>
                                                <div class="col s5 left-align">
                                                    <button type="submit" name="change_marketer" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="col <?php echo (isset($_SESSION['admin']) ? "l6" : "l12") ?>">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>اسم الحالة: <span><?php echo $trans['trans_status']; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الحالة" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide flex-between">
                                                <div class="col l7">
                                                    <div class="input-field validate">
                                                        <select name="status" id="status">
                                                            <option value="">اختر الحالة</option>
                                                            <?php
                                                                foreach ($trans_status as $status) {?>
                                                                    <option value="<?php echo $status['statue_name']; ?>" <?php echo ($status['status'] == 0 ? "disabled" : ''); ?> <?php echo ($status['statue_name'] == $trans['trans_status'] ? "selected" : ""); ?>><?php echo $status['statue_name']; ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col s5 left-align">
                                                    <button type="submit" name="change_status" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Full Name And Image -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <div class="col s1 p-0 show-img-div">
                                            <img src="<?php echo (!empty($trans['photograph_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['photograph_img'] : "../images/default/manager.svg"); ?>" data-target="personalImage" alt="Person Image" class="modal-trigger m-0 p-0 responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل الصورة">
                                        </div>
                                        <!-- Personal Image Modal -->
                                        <div id="personalImage" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['photograph_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['photograph_img'] : "../images/default/manager.svg"); ?>" alt="Person Image" class="modal-img" width="150" height="200">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <h6>ملاحظات:</h6>
                                                        <p>لا تنسى يجب أن تكون الصورة بأبعاد [200*150].</p>
                                                        <p>لا تنسى يجب أن تكون الصورة بخلفية بيضاء.</p>
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">person_outline</i></span>
                                                                    <input type="file" name="file1" class="img-input input-file photograph">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة شخصية">
                                                                    <input type="hidden" value="<?php echo $trans['photograph_img']; ?>" name="photograph_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_person_img" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s11">
                                            <div class="text-label flex-between">
                                                <p class="black-text"><?php echo $fullname[0] . $fullname[1] . $fullname[2] . $fullname[3]; ?></p>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الاسم" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col l3">
                                                    <input id="firstname" name="firstname" type="text" value="<?php echo $fullname[0]; ?>" class="validate" required>
                                                    <label for="firstname">الاسم الأول</label>
                                                </div>
                                                <div class="input-field col l3">
                                                    <input id="fathername" name="fathername" type="text" value="<?php echo $fullname[1]; ?>" class="validate">
                                                    <label for="fathername">اسم الأب</label>
                                                </div>
                                                <div class="input-field col l3">
                                                    <input id="grandname" name="grandname" type="text" value="<?php echo $fullname[2]; ?>" class="validate">
                                                    <label for="grandname">اسم الجد</label>
                                                </div>
                                                <div class="input-field col l3">
                                                    <input id="lastname" name="lastname" type="text" value="<?php echo $fullname[3]; ?>" class="validate">
                                                    <label for="lastname">الكنية</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_name" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Info And Location -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <div class="col s4">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>موبايل: <a href="tel:<?php echo $trans['phone']; ?>" class="custom-link"><?php echo $trans['phone']; ?></a></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الرقم" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col s12">
                                                    <input type="tel" id="mobile" name="mobile" value="<?php echo $trans['phone']; ?>" class="validate" required>
                                                    <label for="mobile">رقم الموبايل</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_phone" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s4">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>واتساب: <a href="https://wa.me/<?php echo $trans['whatsapp']; ?>" class="custom-link"><?php echo $trans['whatsapp']; ?></a></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الرقم" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col s12">
                                                    <input type="tel" id="whatsapp" name="whatsapp" value="<?php echo $trans['whatsapp']; ?>" class="validate">
                                                    <label for="whatsapp">رقم الواتساب</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_whatsapp" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s4">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                <p>العنوان: <span><?php echo $trans['address']; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل العنوان" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col s12">
                                                    <input type="text" id="address" name="address" value="<?php echo $trans['address']; ?>" class="validate">
                                                    <label for="address">العنوان الحالي</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_location" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Select Visa  -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <div class="col s12">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>التأشيرة المختارة: <span><?php echo $trans['visa']; ?></span> <span><?php echo ($trans['agreed_price'] > 0) ? ' بسعر '.$trans['agreed_price'] : ""; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل التأشيرة" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col l6">
                                                    <select name="visa" id="visaList">
                                                        <option value="" selected>اختر التأشيرة</option>
                                                        <?php
                                                            foreach ($visas as $visa) {?>
                                                                <option value="<?php echo $visa['visaname']; ?>" data-price="<?php echo $visa['price']; ?>" <?php echo ($visa['status'] == 1 ? "disabled" : ''); ?> <?php echo ($trans['visa'] == $visa['visaname'] ? "selected" : ""); ?>><?php echo $visa['visaname']; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col l6">
                                                    <input type="number" id="price" name="price" value="<?php echo $trans['agreed_price']; ?>" class="validate">
                                                    <label for="price">السعر المتفق عليه</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_visa" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- All Files -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <!-- ID Card Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/card.svg" data-target="idPersonCard" alt="ID Card Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل صورة البطاقة">
                                            <?php echo (!empty($trans['card_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- ID Card Modal -->
                                        <div id="idPersonCard" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['card_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['card_img'] : "../images/default/card.svg"); ?>" alt="ID Card Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <h6>ملاحظات:</h6>
                                                        <p>يجب إدخال صورة واحدة فقط تحتوي على الجانبين للبطاقة الشخصية.</p>
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">payment</i></span>
                                                                    <input type="file" name="file0" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة عن البطاقة الشخصية">
                                                                    <input type="hidden" value="<?php echo $trans['card_img']; ?>" name="card_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_id_card" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Certifica File -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/certification.svg" data-target="certification" alt="certification File" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل ملف المؤهلات العلمية">
                                            <?php echo (!empty($trans['qualification_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Certifica Modal -->
                                        <div id="certification" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <iframe src="<?php echo (!empty($trans['qualification_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['qualification_img'] : ""); ?>" width="200" height="200" title="Certification File" style="
                                                        background-image: url('../images/default/certification.svg');
                                                        background-size: cover;
                                                        "></iframe>
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <h6>ملاحظات:</h6>
                                                        <ul>
                                                            <li>- يجب أن يكون هذا الملف من نوع PDF.</li>
                                                            <li>- يجب أن يحتوي هذا الملف  على الشهادات الحاصل عليها وبيان درجات للشهادة الجامعية.</li>
                                                        </ul>
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">picture_as_pdf</i></span>
                                                                    <input type="file" name="file2" class="img-input input-file pdf">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="ملف المؤهلات العلمية">
                                                                    <input type="hidden" value="<?php echo $trans['qualification_img']; ?>" name="qualification_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> يجب أن ينتهي هذا الملف بإمتداد 'PDF' حصراً</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_certifica" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Criminal Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/warning.svg" data-target="criminal" alt="Criminal Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل صورة الفيش الجنائي">
                                            <?php echo (!empty($trans['criminal_fisheye_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Criminal Modal -->
                                        <div id="criminal" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['criminal_fisheye_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['criminal_fisheye_img'] : "../images/default/warning.svg"); ?>" alt="Criminal Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file3" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة عن الفيش الجنائي">
                                                                    <input type="hidden" value="<?php echo $trans['criminal_fisheye_img']; ?>" name="criminal_fisheye_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_criminal" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Net Paper Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/document.svg" data-target="netPaper" alt="Net Paper Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل ورقة النت">
                                            <?php echo (!empty($trans['netbook_paper_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Net Paper Modal -->
                                        <div id="netPaper" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['netbook_paper_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['netbook_paper_img'] : "../images/default/document.svg"); ?>" alt="Net Paper Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file4" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة عن ورقة النت">
                                                                    <input type="hidden" value="<?php echo $trans['netbook_paper_img']; ?>" name="netbook_paper_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_net_paper" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hospital Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/medical-report.svg" data-target="hospital" alt="hospital Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل  حجز المستشفى">
                                            <?php echo (!empty($trans['hospital_reservation_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Hospital Modal -->
                                        <div id="hospital" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['hospital_reservation_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['hospital_reservation_img'] : "../images/default/medical-report.svg"); ?>" alt="Hospital Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file5" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة عن حجز مستشفى">
                                                                    <input type="hidden" value="<?php echo $trans['hospital_reservation_img']; ?>" name="hospital_reservation_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_hospital" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fingerprint Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/search.svg" data-target="fingerprint" alt="Fingerprint Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل صورة البصمة">
                                            <?php echo (!empty($trans['fingerprint_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Fingerprint Modal -->
                                        <div id="fingerprint" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['fingerprint_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['fingerprint_img'] : "../images/default/search.svg"); ?>" alt="Fingerprint Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file6" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate"  type="text" placeholder="صورة بصمة">
                                                                    <input type="hidden" value="<?php echo $trans['fingerprint_img']; ?>" name="fingerprint_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_fingerprint" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Passport Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/passport.svg" data-target="passport" alt="Passport Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل جواز السفر">
                                            <?php echo (!empty($trans['passport_img']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Passport Modal -->
                                        <div id="passport" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['passport_img']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['passport_img'] : "../images/default/passport.svg"); ?>" alt="Passport Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file7" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة جواز السفر">
                                                                    <input type="hidden" value="<?php echo $trans['passport_img']; ?>" name="passport_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_passport" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Contract Image -->
                                        <div class="col s1 p-0 file-type">
                                            <img src="../images/default/contract.svg" data-target="contract" alt="Contract Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل عقد العمل">
                                            <?php echo (!empty($trans['work_contract']) ? "<i class='material-icons'>check_circle</i>": ""); ?>
                                        </div>
                                        <!-- Contract Modal -->
                                        <div id="contract" class="modal">
                                            <div class="modal-content">
                                                <div class="row p-0 m-0">
                                                    <div class="col l4">
                                                        <img src="<?php echo (!empty($trans['work_contract']) ? "../../images/transactions/" . $trans['trans_id'] . "/" . $trans['work_contract'] : "../images/default/contract.svg"); ?>" alt="Contract Image" class="responsive-img">
                                                    </div>
                                                    <div class="col l8 p-img">
                                                        <!-- <h6>ملاحظات:</h6> -->
                                                        <!-- <p></p> -->
                                                        <div class="flex-between" style="margin-bottom:0">
                                                            <div class="input-field file-field col l8 p-0">
                                                                <div class="btn">
                                                                    <span><i class="material-icons">image</i></span>
                                                                    <input type="file" name="file8" class="img-input input-file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" placeholder="صورة عقد العمل">
                                                                    <input type="hidden" value="<?php echo $trans['work_contract']; ?>" name="contract_img">
                                                                </div>
                                                                <p class="invalied-file show hide"><i class="material-icons">error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')</p>
                                                            </div>
                                                            <div class="col l4">
                                                                <button type="submit" name="edit_contract" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                                <button type="button" class="btn modal-close bl-btn waves-effect waves-light">إلغاء</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Notes -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <div class="col s12">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>ملاحظات: <span><?php echo $trans['note']; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الملاحظات" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group hide">
                                                <div class="input-field col s12">
                                                    <textarea id="notes" name="notes" class="materialize-textarea"><?php echo $trans['note']; ?></textarea>
                                                    <label for="notes">ملاحظات ..</label>
                                                </div>
                                                <div class="col s12">
                                                    <button type="submit" name="edit_notes" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- All Services -->
                            <div class="col s12">
                                <div class="my-wrapper">
                                    <div class="card-panel z-depth-1">
                                        <div class="row valign-wrapper m-0">
                                            <div class="col s6">
                                                <div class="text-label flex-between">
                                                    <div class="black-text">
                                                        <p>
                                                            <?php echo ($trans['qualification'] > 0 ? "<i class='material-icons' style='vertical-align: middle;color: #26a69a;'>check</i>" :""); ?>
                                                            <?php echo $prices[4]['service_name']; ?> <span>  <?php echo ($trans['qualification'] > 0 ? "/ " . $trans['qualification'] :""); ?></span>
                                                        </p>
                                                    </div>
                                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الخدمة" data-position="bottom">تعديل</button>
                                                </div>
                                                <div class="input-group hide">
                                                    <div class="input-field col s12">
                                                        <div class="row">
                                                            <div class="input-field col l5">
                                                                <label class="label-check">
                                                                    <input type="checkbox" name="qualifications_s" class="qualifications checkchekbox" data-invoice="qualificationInvoice" data-orginalprice="<?php echo $prices[4]['price']; ?>" <?php echo ($trans['qualification'] > 0 ? "checked" : ""); ?>>
                                                                    <span><?php echo $prices[4]['service_name']; ?></span>
                                                                </label>
                                                            </div>
                                                            <div class="input-field col l7">
                                                                <input type="number" id="qualifications_p" name="qualifications_p" value="<?php echo ($trans['qualification'] > 0 ? $trans['qualification'] :$prices[4]['price'] ); ?>" class="validate">
                                                                <label for="qualifications_p">سعر الخدمة</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <button type="submit" name="edit_qualifications_p" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="text-label flex-between">
                                                    <div class="black-text">
                                                        <p>
                                                            <?php echo ($trans['hospital_reservation'] > 0 ? "<i class='material-icons' style='vertical-align: middle;color: #26a69a;'>check</i>" :""); ?>
                                                            <?php echo $prices[1]['service_name']; ?><span>  <?php echo ($trans['hospital_reservation'] > 0 ? "/ " . $trans['hospital_reservation'] :""); ?></span>
                                                        </p>
                                                    </div>
                                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الخدمة" data-position="bottom">تعديل</button>
                                                </div>
                                                <div class="input-group hide">
                                                    <div class="input-field col s12">
                                                        <div class="row">
                                                            <div class="input-field col l5">
                                                                <label class="label-check">
                                                                    <input type="checkbox" name="hospetal_s" class="hospital checkchekbox" data-invoice="hospitalInvoice" data-orginalprice="<?php echo $prices[1]['price']; ?>" <?php echo ($trans['hospital_reservation'] > 0 ? "checked" : ""); ?>>
                                                                    <span><?php echo $prices[1]['service_name']; ?></span>
                                                                </label>
                                                            </div>
                                                            <div class="input-field col l7">
                                                                <input type="number" id="hospetal_p" name="hospetal_p" value="<?php echo ($trans['hospital_reservation'] > 0 ? $trans['hospital_reservation'] :$prices[1]['price'] ); ?>" class="validate">
                                                                <label for="hospetal_p">سعر الخدمة</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <button type="submit" name="edit_hospetal_p" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-panel z-depth-1">
                                        <div class="row valign-wrapper m-0">
                                            <div class="col s6">
                                                <div class="text-label flex-between">
                                                    <div class="black-text">
                                                        <p>
                                                            <?php echo ($trans['work_contract_service'] > 0 ? "<i class='material-icons' style='vertical-align: middle;color: #26a69a;'>check</i>" :""); ?>
                                                            <?php echo $prices[5]['service_name']; ?><span>  <?php echo ($trans['work_contract_service'] > 0 ? "/ " . $trans['work_contract_service'] :""); ?></span>
                                                        </p>
                                                    </div>
                                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الخدمة" data-position="bottom">تعديل</button>
                                                </div>
                                                <div class="input-group hide">
                                                    <div class="input-field col s12">
                                                        <div class="row">
                                                            <div class="input-field col l5">
                                                                <label class="label-check">
                                                                    <input type="checkbox" name="work_S" class="work-chekbox checkchekbox" data-invoice="workInvoice" data-orginalprice="<?php echo $prices[5]['price']; ?>" <?php echo ($trans['work_contract_service'] > 0 ? "checked" : ""); ?>>
                                                                    <span><?php echo $prices[5]['service_name']; ?></span>
                                                                </label>
                                                            </div>
                                                            <div class="input-field col l7">
                                                                <input type="number" id="work_p" name="work_p" value="<?php echo ($trans['work_contract_service'] > 0 ? $trans['work_contract_service'] : $prices[5]['price']); ?>" class="validate">
                                                                <label for="work_p">سعر الخدمة</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <button type="submit" name="edit_work_p" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="text-label flex-between">
                                                    <div class="black-text">
                                                        <p>
                                                            <?php echo ($trans['fingerprint_reservation'] > 0 ? "<i class='material-icons' style='vertical-align: middle;color: #26a69a;'>check</i>" :""); ?>
                                                            <?php echo $prices[2]['service_name']; ?><span>  <?php echo ($trans['fingerprint_reservation'] > 0 ? "/ " . $trans['fingerprint_reservation'] . "</span> <span> / " . $trans['fingerprint_reservation_date'] . "</span>" :"</span>"); ?>
                                                        </p>
                                                    </div>
                                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الخدمة" data-position="bottom">تعديل</button>
                                                </div>
                                                <div class="input-group hide">
                                                    <div class="input-field col s12">
                                                        <div class="row">
                                                            <div class="input-field and-date col l5">
                                                                <label class="label-check">
                                                                    <input type="checkbox" name="fingerprint_s" class="fingerprint checkchekbox" data-invoice="fingerprintInvoice" data-orginalprice="<?php echo $prices[2]['price']; ?>" <?php echo ($trans['fingerprint_reservation'] > 0 ? "checked" : ""); ?>>
                                                                    <span><?php echo $prices[2]['service_name']; ?></span>
                                                                </label>
                                                            </div>
                                                            <div class="input-field col l3">
                                                                <input type="number" id="fingerprint_p" name="fingerprint_p" value="<?php echo ($trans['fingerprint_reservation'] > 0 ? $trans['fingerprint_reservation'] : $prices[2]['price']); ?>" class="validate">
                                                                <label for="fingerprint_p">سعر الخدمة</label>
                                                            </div>
                                                            <div class="input-field col l4">
                                                                <input type="text" class="datepicker" id="fingerprint_d" value="<?php echo $trans['fingerprint_reservation_date']; ?>" name="fingerprint_d">
                                                                <label for="fingerprint_d">تاريخ الحجز</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <button type="submit" name="edit_fingerprint_d" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Amount Paid  -->
                            <div class="col s12">
                                <div class="card-panel z-depth-1">
                                    <div class="row valign-wrapper m-0">
                                        <div class="col s12">
                                            <div class="text-label flex-between">
                                                <div class="black-text">
                                                    <p>المبلغ المدفوع: <span><?php echo $trans['amount_paid']; ?></span></p>
                                                </div>
                                                <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل المبلغ" data-position="bottom">تعديل</button>
                                            </div>
                                            <div class="input-group flex-between hide">
                                                <div class="input-field col l6">
                                                    <input type="text" id="amount_paid" name="amount_paid" value="<?php echo $trans['amount_paid']; ?>" class="validate" data-invoice="paidInvoice">
                                                    <label for="amount_paid">المبلغ المدفوع</label>
                                                </div>
                                                <div class="col l6">
                                                    <button type="submit" name="edit_amount_paid" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                    <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <input type="hidden" name="orginal_price" id="orginlPrice">
                        
                        <!-- Modal Trigger -->
                        <button data-target="invoice" class="modal-trigger btn-floating btn-large waves-effect waves-light main-dark cart-btn"><i class="material-icons">add_shopping_cart</i></button>
                        <!-- Modal Structure -->
                        <div id="invoice" class="modal cart-modal">
                            <div class="modal-content">
                                <div class="modal-header flex-between">
                                    <h5 class="m-0">الفاتورة النهائية</h5>
                                    <img src="../../images/logo.png" alt="Maysan Logo">
                                </div>
                                <div class="modal-line">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[0]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span><b class="sum"><?php echo $prices[0]['price']; ?></b></span>
                                            <input type="hidden" value="<?php echo $prices[0]['price']; ?>" name="office_fare">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal-line <?php// echo (!empty($trans['visa']) ? "" : "hide"); ?>">
                                    <div class="row m-0">
                                        <div class="col l10"><span>التأشيرة</span> <strong id="visaNameInvoice">(<?php// echo $trans['visa']; ?>)</strong></div>
                                        <div class="col l2">
                                            <span><b class="sum" id="visaPriceInvoice"><?php// echo $trans['agreed_price']; ?></b></span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="modal-line">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[3]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span><b class="sum"><?php echo $prices[3]['price']; ?></b></span>
                                            <input type="hidden" value="<?php echo $prices[3]['price']; ?>" name="net_paper">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line <?php echo (!empty($trans['qualification']) ? "" : "hide"); ?>">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[4]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span class="sum" id="qualificationInvoice"><?php echo $trans['qualification']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line <?php echo (!empty($trans['hospital_reservation']) ? "" : "hide"); ?>">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[1]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span class="sum" id="hospitalInvoice"><?php echo $trans['hospital_reservation']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line <?php echo (!empty($trans['work_contract_service']) ? "" : "hide"); ?>">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[5]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span class="sum" id="workInvoice"><?php echo $trans['work_contract_service']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line <?php echo (!empty($trans['fingerprint_reservation']) ? "" : "hide"); ?>">
                                    <div class="row m-0">
                                        <div class="col l10"><span><?php echo $prices[2]['service_name']; ?></span></div>
                                        <div class="col l2">
                                            <span class="sum" id="fingerprintInvoice"><?php echo $trans['fingerprint_reservation']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="modal-line">
                                    <div class="row m-0">
                                        <div class="col l10"><span><strong>المجموع</strong></span></div>
                                        <div class="col l2">
                                            <span><b id="totalInvoice"></b></span>
                                            <input type="hidden" name="total">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line">
                                    <div class="row m-0">
                                        <div class="col l10"><span>المبلغ المدفوع</span></div>
                                        <div class="col l2">
                                            <span id="paidInvoice"><?php echo $trans['amount_paid']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-line">
                                    <div class="row m-0">
                                        <div class="col l10"><span>المبلغ المتبقي</span></div>
                                        <div class="col l2">
                                            <span id="restInvoice"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </form>
                </div>
            </section>
            <?php
        }
        else {
            header("refresh:0;url=?do=transactions");
        }
    }
    include "../include/footer.php";
}

else {
    header("Location: hws/index.php");
}
ob_end_flush();
?>