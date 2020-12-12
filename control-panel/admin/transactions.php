<?php
ob_start();
session_start();
if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    $Title = "المعاملات";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'transactions';
    
if ($do == "transactions") {       // Transactions Page
    if (isset($_SESSION['admin'])) {
        $stmt = $con->prepare("SELECT * FROM transactions ORDER BY id DESC");
        $stmt->execute();
    }
    else {
        $stmt = $con->prepare("SELECT * FROM transactions WHERE marketer_id = ? ORDER BY id DESC");
        $stmt->execute(array($_SESSION['user']));
    }
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
        <form method="post" action="">
            <input type="hidden" name="id" id="btnId">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>موبايل</th>
                        <th>واتساب</th>
                        <th>العنوان</th>
                        <th>التأشيرة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if ($stmt->rowCount() > 0) {
                            $data = $stmt->fetchAll();
                            foreach ($data as $value) {?>
                                <tr>
                                    <th><?php echo $value['id']; ?></th>
                                    <th><?php echo $value['fullname']; ?></th>
                                    <th><a class="custom-link" href="tel:<?php echo $value['phone']; ?>"><?php echo $value['phone']; ?></a></th>
                                    <th><?php echo $value['whatsapp']; ?></th>
                                    <th><?php echo $value['address']; ?></th>
                                    <th><?php echo $value['visa']; ?></th>
                                    <td class="flex-between">
                                    <a href="?do=show&id=<?php echo $value['id']; ?>" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="عرض"><i class="material-icons">link</i></a>
                                        <button name="transactionsdel" data-id="<?php echo $value['id']; ?>" class="btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {?>
                            <tr>
                                <td colspan="7" class="center-align" style="color: var(--second-color); font-weight: 600;">
                                    <i class="material-icons" style="transform: translateY(8px);">info</i> لا يوجد معاملات حتى الآن
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
    $stmt = $con->prepare("SELECT * FROM static_price");
    $stmt->execute();
    $prices = $stmt->fetchAll();
    $stmt1 = $con->prepare("SELECT * FROM visas");
    $stmt1->execute();
    $visas = $stmt1->fetchAll();
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
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك إضافة معاملة جديدة من هنا, جميع الحقول التالية مطلوبة.</p>
</div>
</div>
<!-- Start Transactions Add Form -->
<section class="add-transactions">
    <div class="container">
        <form method="post" action="../include/add_transaction.php" enctype="multipart/form-data">
            <div class="row m-0">
                <div class="row">
                    <div class="input-field col l12">
                        <input type="text" name="marketer_id" list="marketer" id="marketerList" class="validate" required>
                        <label for="marketerList">اختر المسوق (يمكنك البحث عن اسم أو رقم المسوق مباشرة)</label>
                    </div>
                    <datalist id="marketer">
                        <option value="1 حسام" selected>
                        <option value="2 وائل">
                        <option value="3 سعيد">
                    </datalist>
                </div>
                <h5>معلومات أساسية</h5>
                <div class="row">
                    <p class="input-group-title">الاسم الكامل</p>
                    <div class="input-field col l3">
                        <input id="firstname" name="firstname" type="text" class="validate" required>
                        <label for="firstname">الاسم الأول</label>
                    </div>
                    <div class="input-field col l3">
                        <input id="fathername" name="fathername" type="text" class="validate" required>
                        <label for="fathername">اسم الأب</label>
                    </div>
                    <div class="input-field col l3">
                        <input id="grandname" name="grandname" type="text" class="validate" required>
                        <label for="grandname">اسم الجد</label>
                    </div>
                    <div class="input-field col l3">
                        <input id="lastname" name="lastname" type="text" class="validate" required>
                        <label for="lastname">الكنية</label>
                    </div>
                </div>
                <div class="row">
                    <p class="input-group-title">معلومات التواصل</p>
                    <div class="input-field col l4">
                        <input type="tel" id="mobile" name="mobile" class="materialize-textarea" required>
                        <label for="mobile">رقم الموبايل</label>
                    </div>
                    <div class="input-field col l4">
                        <input type="tel" id="whatsapp" name="whatsapp" class="materialize-textarea" >
                        <label for="whatsapp">رقم الواتساب</label>
                    </div>
                    <div class="input-field col l4">
                        <input type="text" id="address" name="address" class="materialize-textarea" >
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
                        <input type="number" id="price" name="price" value="" class="materialize-textarea">
                        <label for="price">السعر المتفق عليه</label>
                    </div>
                </div> 
                <div class="row">
                    <p class="input-group-title">الملفات المطلوبة</p>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">payment</i></span>
                            <input type="file" name="file0">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة عن البطاقة الشخصية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">person_outline</i></span>
                            <input type="file" name="file1">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة شخصية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">picture_as_pdf</i></span>
                            <input type="file" name="file2">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="ملف المؤهلات العلمية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file" name="file3">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة عن الفيش الجنائي">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file" name="file4">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة عن ورقة النت">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file" name="file5">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة عن حجز مستشفى">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file" name="file6">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text" placeholder="صورة بصمة">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file" name="file7">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="صورة جواز السفر">
                        </div>
                    </div>
                    <div class="input-field col l6">
                        <input type="text" id="work" name="work" class="materialize-textarea">
                        <label for="work">عقد عمل (المسمى الوظيفي)</label>
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
                                    <input type="checkbox" name="qualifications_s">
                                    <span><?php echo $prices[4]['service_name']; ?></span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="qualifications_p" name="qualifications_p" value="<?php echo $prices[4]['price']; ?>" class="materialize-textarea">
                                <label for="qualifications_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="hospetal_s">
                                    <span><?php echo $prices[1]['service_name']; ?></span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="hospetal_p" name="hospetal_p" value="<?php echo $prices[1]['price']; ?>" class="materialize-textarea">
                                <label for="hospetal_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="work_S">
                                    <span><?php echo $prices[5]['service_name']; ?></span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="work_p" name="work_p" value="<?php echo $prices[5]['price']; ?>" class="materialize-textarea">
                                <label for="work_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="fingerprint_s">
                                    <span><?php echo $prices[2]['service_name']; ?></span>
                                </label>
                            </div>
                            <div class="input-field col l3">
                                <input type="text" id="fingerprint_p" name="fingerprint_p" value="<?php echo $prices[2]['price']; ?>" class="materialize-textarea">
                                <label for="fingerprint_p">سعر الخدمة</label>
                            </div>
                            <div class="input-field col l4">
                                <input type="text" class="datepicker" id="fingerprint_d" name="fingerprint_d">
                                <label for="fingerprint_d">تاريخ الحجز</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p class="input-group-title">أدخل المبلغ المدفوع</p>
                    <div class="col l6">
                        <div class="input-field col l6">
                            <input type="text" id="amount_paid" name="amount_paid" class="materialize-textarea">
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
                                <span><b><?php echo $prices[0]['price']; ?></b></span>
                                <input type="hidden" value="<?php echo $prices[0]['price']; ?>" name="office_fare">
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>سعر التأشيرة</span> <strong>(اسم التأشيرة)</strong></div>
                            <div class="col l2">
                                <span><b>7500</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><?php echo $prices[1]['service_name']; ?></span></div>
                            <div class="col l2">
                                <span><b><?php echo $prices[1]['price']; ?></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><?php echo $prices[2]['service_name']; ?></span></div>
                            <div class="col l2">
                                <span><?php echo $prices[2]['price']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><?php echo $prices[3]['service_name']; ?></span></div>
                            <div class="col l2">
                                <span><?php echo $prices[3]['price']; ?></span>
                                <input type="hidden" value="<?php echo $prices[3]['price']; ?>" name="net_paper">
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><?php echo $prices[5]['service_name']; ?></span></div>
                            <div class="col l2">
                                <span><?php echo $prices[5]['price']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><?php echo $prices[4]['service_name']; ?></span></div>
                            <div class="col l2">
                                <span><?php echo $prices[4]['price']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span><strong>المجموع</strong></span></div>
                            <div class="col l2">
                                <span><b>11750</b></span>
                                <input type="hidden" value="11750" name="total">
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>المبلغ المدفوع</span></div>
                            <div class="col l2">
                                <span>2000</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>المبلغ المتبقي</span></div>
                            <div class="col l2">
                                <span>9750</span>
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
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between"><a href="?do=transactions" class="flex-between"><i class="material-icons">library_books</i> المعاملات</a> / </li>
            <li class="flex-between active"><i class="material-icons">person</i> معاملة اسم صاحب المعاملة</li>
        </ul>
    </div>
</div>
<div class="container">
<div class="top-bar flex-between">
    <h1>عرض المعاملة</h1>
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك من هنا عرض وتعديل معلومات المعاملة, اختر ما تريد تعديله أولاً ثم قم بتعديل البيانات بالشكل المناسب</p>
</div>
</div>
<!-- Start Transactions Edit Form -->
<section class="show-transactions p-1">
    <div class="container">
        <form method="post" action="">
            <div class="row m-0">
                
                <div class="col s12">
                    <div class="card-panel z-depth-1">
                        <div class="row valign-wrapper m-0">
                            <div class="col s1 p-0">
                                <img src="../../images/person/1.jpg" data-target="personalImage" alt="Person Image" class="modal-trigger responsive-img prwaz tooltipped" data-position="bottom" data-tooltip="تعديل الصورة">
                            </div>
                            <!-- Modal Structure -->
                            <div id="personalImage" class="modal">
                                <div class="modal-content">
                                    <div class="row p-0 m-0">
                                        <div class="col l4">
                                            <img src="../../images/person/1.jpg" alt="Person Image" width="152" height="200" class="">
                                        </div>
                                        <div class="col l8 p-img">
                                            <h6>ملاحظات:</h6>
                                            <p>لا تنسى يجب أن تكون الصورة بأبعاد 200*152.</p>
                                            <p>لا تنسى يجب أن تكون الصورة بخلفية بيضاء.</p>
                                            <div class="flex-between" style="margin-bottom:0">
                                                <div class="input-field file-field col l8 p-0">
                                                    <div class="btn">
                                                        <span><i class="material-icons">person_outline</i></span>
                                                        <input type="file" name="file1" class="img-input">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="صورة شخصية">
                                                    </div>
                                                </div>
                                                <div class="col l4">
                                                    <button type="submit" name="edit_name" class="btn main-dark waves-effect waves-light">حفظ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s11">
                                <div class="text-label flex-between">
                                    <p class="black-text">ناظم أحمد حمد أبو الخل </p>
                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الاسم" data-position="bottom">تعديل</button>
                                </div>
                                <div class="input-group hide">
                                    <div class="input-field col l3">
                                        <input id="firstname" name="firstname" type="text" class="validate" required>
                                        <label for="firstname">الاسم الأول</label>
                                    </div>
                                    <div class="input-field col l3">
                                        <input id="fathername" name="fathername" type="text" class="validate" required>
                                        <label for="fathername">اسم الأب</label>
                                    </div>
                                    <div class="input-field col l3">
                                        <input id="grandname" name="grandname" type="text" class="validate" required>
                                        <label for="grandname">اسم الجد</label>
                                    </div>
                                    <div class="input-field col l3">
                                        <input id="lastname" name="lastname" type="text" class="validate" required>
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

                <div class="col s12">
                    <div class="card-panel z-depth-1">
                        <div class="row valign-wrapper m-0">
                            <div class="col s4">
                                <div class="text-label flex-between">
                                    <div class="black-text">
                                        <p>موبايل: <a href="tel:999999999" class="custom-link">999 999 999</a></p>
                                    </div>
                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الرقم" data-position="bottom">تعديل</button>
                                </div>
                                <div class="input-group hide">
                                    <div class="input-field col s12">
                                        <input type="tel" id="mobile" name="mobile" class="validate" required>
                                        <label for="mobile">رقم الموبايل</label>
                                    </div>
                                    <div class="col s12">
                                        <button type="submit" name="edit_name" class="btn main-dark waves-effect waves-light">حفظ</button>
                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="text-label flex-between">
                                    <div class="black-text">
                                        <p>واتساب: <a href="https://wa.me/999999999" class="custom-link">999 999 999</a></p>
                                    </div>
                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل الرقم" data-position="bottom">تعديل</button>
                                </div>
                                <div class="input-group hide">
                                    <div class="input-field col s12">
                                        <input type="tel" id="whatsapp" name="whatsapp" class="validate">
                                        <label for="whatsapp">رقم الواتساب</label>
                                    </div>
                                    <div class="col s12">
                                        <button type="submit" name="edit_name" class="btn main-dark waves-effect waves-light">حفظ</button>
                                        <button type="button" class="btn cancel-btn bl-btn waves-effect waves-light">إلغاء</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="text-label flex-between">
                                    <div class="black-text">
                                    <p>العنوان: <span>حمص - سوريا</span></p>
                                    </div>
                                    <button type="button" class="btn edit-text-btn tooltipped" data-tooltip="تعديل العنوان" data-position="bottom">تعديل</button>
                                </div>
                                <div class="input-group hide">
                                    <div class="input-field col s12">
                                        <input type="text" id="address" name="address" class="validate">
                                        <label for="address">العنوان الحالي</label>
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

            </div>
        </form>
    </div>
</section>
<?php
}
include "../include/footer.php";
}
else {
    header("Location: hws/index.php");
}
ob_end_flush();
?>