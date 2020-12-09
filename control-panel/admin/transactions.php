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
                                    <th><a class="custom-link" href="tel:0999 999 999"><?php echo $value['phone']; ?></a></th>
                                    <th><?php echo $value['whatsapp']; ?></th>
                                    <th><?php echo $value['address']; ?></th>
                                    <th><?php echo $value['visa']; ?></th>
                                    <td class="flex-between">
                                        <a href="?do=edit&id=<?php echo $value['id']; ?>" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="تعديل"><i class="material-icons">edit</i></a>
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
    $prices = $stmt->fetch();
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
                <div class="row">
                    <p class="input-group-title">معلومات التأشيرة</p>
                    <div class="input-field col l6">
                        <select name="visa" id="visaList">
                            <option value=""  selected>اختر التأشيرة</option>
                            <?php
                                foreach ($visas as $visa) {?>
                                    <option value="<?php echo $visa['visaname']; ?>" data-price="<?php echo $visa['price']; ?>"><?php echo $visa['visaname']; ?></option>
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
                                    <span>المؤهلات العلمية</span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="qualifications_p" name="qualifications_p" value="5000" class="materialize-textarea">
                                <label for="qualifications_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="hospetal_s">
                                    <span>حجز مستشفى</span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="hospetal_p" name="hospetal_p" value="350" class="materialize-textarea">
                                <label for="hospetal_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="work_S">
                                    <span>عقد عمل (المهنة)</span>
                                </label>
                            </div>
                            <div class="input-field col l7">
                                <input type="text" id="work_p" name="work_p" value="1500" class="materialize-textarea">
                                <label for="work_p">سعر الخدمة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="row">
                            <div class="input-field col l5">
                                <label class="label-check">
                                    <input type="checkbox" name="fingerprint_s">
                                    <span>حجز بصمة</span>
                                </label>
                            </div>
                            <div class="input-field col l3">
                                <input type="text" id="fingerprint_p" name="fingerprint_p" value="100" class="materialize-textarea">
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
                            <div class="col l10"><span>أجرةالمكتب</span></div>
                            <div class="col l2">
                                <span><b><?php echo $prices['office_fare']; ?></b></span>
                                <input type="hidden" value="<?php echo $prices['office_fare']; ?>" name="office_fare">
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>سعر التأشيرة</span> <strong>(اسم التأشيرة)</strong></div>
                            <div class="col l2">
                                <span><b>7500</b></span>
                                <!-- <input type="hidden" value="7500" name="visa_price"> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>حجز المستشفى</span></div>
                            <div class="col l2">
                                <span><b>350</b></span>
                                <!-- <input type="hidden" value="350" name="hospital_price"> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>حجز بصمة</span></div>
                            <div class="col l2">
                                <span>100</span>
                                <!-- <input type="hidden" value="100" name="fingerprint_price"> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>ورقة النت</span></div>
                            <div class="col l2">
                                <span><?php echo $prices['netbook_paper']; ?></span>
                                <input type="hidden" value="<?php echo $prices['netbook_paper']; ?>" name="net_paper">
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>عقد عمل</span></div>
                            <div class="col l2">
                                <span>1500</span>
                                <!-- <input type="hidden" value="1500" name="work_papr"> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-line">
                        <div class="row m-0">
                            <div class="col l10"><span>تصديق المؤهلات العلمية</span></div>
                            <div class="col l2">
                                <span>300</span>
                                <!-- <input type="hidden" value="300" name="qualifications_i"> -->
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
                                <!-- <input type="hidden" value="2000" name="amounts_paid"> -->
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
} elseif ($do == "edit") {   // Edit Transactions
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between"><a href="?do=transactions" class="flex-between"><i class="material-icons">library_books</i> المعاملات</a> / </li>
            <li class="flex-between active"><i class="material-icons">edit</i> تعديل معاملة</li>
        </ul>
    </div>
</div>
<div class="container">
<div class="top-bar flex-between">
    <h1>تعديل معاملة</h1>
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك تعديل معلومات المعاملة من هنا, اختر ما تريد تعديله أولاً ثم قم بتعديل البيانات بالشكل المناسب</p>
</div>
</div>
<!-- Start Transactions Edit Form -->
<section class="add-transactions">
    <div class="container">
        <form method="post" action="">
            <div class="row m-0">
                <h5 class="m-0">معلومات أساسية</h5>
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
                        <input type="tel" id="whatsapp" name="whatsapp" class="materialize-textarea" required>
                        <label for="whatsapp">رقم الواتساب</label>
                    </div>
                    <div class="input-field col l4">
                        <input type="text" id="address" name="address" class="materialize-textarea" required>
                        <label for="address">العنوان الحالي</label>
                    </div>
                </div> 
                <h5 class="m-0">معلومات التأشيرة</h5>
                <div class="row" id="visaRow">
                    <div class="input-field col l6">
                        <select name="visa" id="visaList">
                            <option value="" disabled selected>اختر التأشيرة</option>
                            <option value="" data-price="3000">الخيار الأول</option>
                            <option value="" data-price="5500">الخيار الثاني</option>
                            <option value="" data-price="1500">الخيار الثالث</option>
                            <option value="" data-price="2000">الخيار الرابع</option>
                            <option value="" data-price="3500">الخيار الخامس</option>
                        </select>
                    </div>
                    <div class="input-field col l6">
                        <input type="number" id="price" name="price" value="" class="materialize-textarea">
                        <label for="price">السعر المتفق عليه</label>
                    </div>
                </div> 
                <h5 class="m-0">الملفات المطلوبة</h5>
                <div class="row">
                    <p class="input-group-title">جميع الملفات المطلوبة</p>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">payment</i></span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="idcard" type="text" placeholder="صورة عن البطاقة الشخصية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">person_outline</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="personimage" type="text" placeholder="صورة شخصية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">picture_as_pdf</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="qualifications" type="text" placeholder="ملف المؤهلات العلمية">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="notdoomed" type="text" placeholder="صورة عن الفيش الجنائي">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="netpaper" type="text" placeholder="صورة عن ورقة النت">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="hospetal" type="text" placeholder="صورة عن حجز مستشفى">
                        </div>
                    </div>
                    <div class="input-field file-field col l6">
                        <div class="btn">
                            <span><i class="material-icons">image</i></span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="fingerprint" type="text" placeholder="صورة بصمة">
                        </div>
                    </div>
                    <div class="input-field col l6">
                        <input type="text" id="work" name="work" class="materialize-textarea">
                        <label for="work">عقد عمل</label>
                    </div>
                </div> 
                <h5 class="m-0">ملاحظات عامة</h5>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <textarea id="notes" name="notes" class="materialize-textarea"></textarea>
                            <label for="notes">ملاحظات ..</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button type="submit" name="add_trans" class="btn main-dark waves-effect waves-light">إضافة</button>
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