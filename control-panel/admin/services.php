<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "إدارة الحجوزات";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'services';
    
if ($do == "services") {       // Transactions Page
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between active"><i class="material-icons">settings</i> إدارة الحجوزات</li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top-bar flex-between">
        <h1>إدارة الحجوزات</h1>
        <p>يمكنك من هنا الوصول الى التأشيرات والخدمات</p>
    </div>
</div>
<!-- Start Transactions -->
<section class="transactions">
    <div class="container">
        
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
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك إضافة معاملة جديدة من هنا, جميع الحقول التالية مطلوبة.</p>
</div>
</div>
<!-- Start Transactions Add Form -->
<section class="add-transactions">
    
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
<section>

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