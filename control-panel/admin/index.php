<?php
session_start();
$Title = "لوحة التحكم";
include "../../include/Functions.php";
include "../include/header.php";
include "../../include/navbar.php";
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between active"><i class="material-icons">dashboard</i> Dashboard</li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top-bar flex-between">
        <h1>Admin Dashboard</h1>
        <a href="/hws" class="custom-link flex-between"><i class="material-icons">home</i> Home</a>
        <p>The dashboard shows some stats and some recent activity.</p>
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
            <span>3 Users</span>
          </div>
          <div class="footer flex-between">
            <a href="users.php" class="custom-link flex-between"><i class="material-icons">table</i> Show Table</a>
            <a href="users.php?do=add" class="custom-link flex-between"><i class="material-icons">person_add</i> Add New</a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l4">
        <div class="stat-box tow z-depth-2">
          <div class="header">
            <i class="material-icons">question_answer</i>
            <span>12 FAQ</span>
          </div>
          <div class="footer flex-between">
            <a href="faq-manage.php" class="custom-link flex-between"><i class="material-icons">table</i> Show Table</a>
            <a href="faq-manage.php?do=add" class="custom-link flex-between"><i class="material-icons">add</i> Add New</a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l4">
        <div class="stat-box three z-depth-2">
          <div class="header">
            <i class="material-icons">library_books</i>
            <span>26 Blog</span>
          </div>
          <div class="footer flex-between">
            <a href="#" class="custom-link flex-between"><i class="material-icons">table</i> Show Table</a>
            <a href="#" class="custom-link flex-between"><i class="material-icons">add</i> Add New</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include "../include/footer.php";
?>