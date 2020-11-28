<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
  $Title = "لوحة التحكم";
  include "../../include/Functions.php";
  include "../include/header.php";
  include "../../include/navbar.php";
  ?>
  <!-- Breadcrumb -->
  <div class="my-breadcrumb">
      <div class="container">
          <ul class="list-item">
              <li class="flex-between active"><i class="material-icons">dashboard</i> لوحة التحكم</li>
          </ul>
      </div>
  </div>
  <div class="container">
      <div class="top-bar flex-between">
          <h1>لوحة تحكم المشرف</h1>
          <a href="/hws" class="custom-link flex-between"><i class="material-icons">home</i> الرئيسية</a>
          <p>تعرض لوحة التحكم بعض الإحصائيات وبعض الأنشطة الحديثة.</p>
      </div>
  </div>
  <!-- Start Dashboard -->
  <section class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col s12 m6 l4">
          <div class="stat-box one z-depth-2">
            <div class="header">
              <i class="material-icons">person_outline</i>
              <span><?php echo countItems("id", "users"); ?> مستخدم</span>
            </div>
            <div class="footer flex-between">
              <a href="users.php" class="custom-link flex-between"><i class="material-icons">table</i> عرض الجدول</a>
              <a href="users.php?do=add" class="custom-link flex-between"><i class="material-icons">person_add</i> إضافة جديد</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l4">
          <div class="stat-box tow z-depth-2">
            <div class="header">
              <i class="material-icons">question_answer</i>
              <span><?php echo countItems("id", "frequently_asked_questions"); ?> سؤال شائع</span>
            </div>
            <div class="footer flex-between">
              <a href="faq-manage.php" class="custom-link flex-between"><i class="material-icons">table</i> عرض الجدول</a>
              <a href="faq-manage.php?do=add" class="custom-link flex-between"><i class="material-icons">add</i> إضافة جديد</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l4">
          <div class="stat-box three z-depth-2">
            <div class="header">
              <i class="material-icons">library_books</i>
              <span>26 تدوينة</span>
            </div>
            <div class="footer flex-between">
              <a href="#" class="custom-link flex-between"><i class="material-icons">table</i> عرض الجدول</a>
              <a href="#" class="custom-link flex-between"><i class="material-icons">add</i> إضافة جديد</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  include "../include/footer.php";  
}
else {
    header("refresh:0;url=../../index.php");
}
ob_end_flush();
?>