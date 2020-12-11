<!-- Start Navbar -->
<nav class="indigo lighten-2">
    <div class="container">
        <div class="nav-wrapper">
          <a href="/hws" class="brand-logo"><img src="/hws/images/logo.png" alt="Logo" class="responsive-img"></a>
          <ul class="left hide-on-small-only">
              <li><a class="dropdown-trigger" href="#" data-target="category">الفئات<i class="material-icons left">arrow_drop_down</i></a></li>
              <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'faq.php')) ? 'active' : ''; ?>"><a href="/hws/faq.php">الأسئلة الشائعة</a></li>
              <li><a href="#">حول</a></li>
              <li><a href="#">تواصل معنا</a></li>
              <?php
              if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
              ?>
              <li class="remove-on-small-only"><a href="#" data-target="slide-out" class="sidenav-trigger tooltipped" data-position="bottom" data-tooltip="قائمة المستخدم" style="
              display: block;
              margin: 0;
              text-align: center;
              "><i class="material-icons">menu</i></a></li>
              <?php
              } else {
              ?>
              <li class="remove-on-small-only"><a href="#login" class="tooltipped modal-trigger" data-position="bottom" data-tooltip="تسجيل الدخول"><i class="material-icons">person</i></a></li>
              <?php
              }
              ?>
          </ul>
          <?php
          if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
          ?>
          <li class="hide-on-med-and-up user-menu"><a href="#" data-target="slide-out" class="sidenav-trigger tooltipped" data-position="bottom" data-tooltip="قائمة المستحدم"><i class="material-icons">menu</i></a></li>
          <?php
          } else {
          ?>
          <li class="hide-on-med-and-up user-menu"><a href="#login" class="tooltipped modal-trigger" data-position="bottom" data-tooltip="تسجيل الدخول"><i class="material-icons">person</i></a></li>
          <?php
          }
          ?>
          <li id="navMenu" class="hide-on-med-and-up nav-menu"><a href="#" class="tooltipped" data-position="bottom" data-tooltip="روابط"><i class="material-icons">more_vert</i></a></li>
        </div>
    </div>
</nav>
<!-- Dropdown Category -->
<ul id="category" class="dropdown-content">
  <li><a href="#">دوام كامل</a></li>
  <li><a href="#">دوام جزئي</a></li>
  <li class="divider"></li>
  <li><a href="#">عمل حر</a></li>
</ul>
<?php
  if (isset($_COOKIE['login'])) {
    $Row = explode(",", $_COOKIE['login']);
  }
?>
<!-- Login Modal -->
<div id="login" class="modal login-modal">
  <div class="modal-content p-0 center-align">
    <form method="post" action="login.php">
      <h5>سجل دخولك الآن</h5>
      <div class="row m-0">
        <div class="input-field col s12">
          <input id="usermail" name="UOE" value="<?php echo (isset($Row) ? $Row[0] : ""); ?>" type="text" class="validate" required>
          <label for="usermail">اسم المستخدم أو البريد الإلكتروني</label>
        </div>
      </div>
      <div class="row m-0">
        <div class="input-field col s12">
          <input id="password" name="password" value="<?php echo (isset($Row) ? $Row[1] : ""); ?>" type="password" class="validate" required>
          <label for="password">كلمة المرور</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 right-align">
            <label>
                <input name="remmamber" type="checkbox" <?php echo (isset($Row) ? "checked" : "");?>>
                <span>تذكرني</span>
            </label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
            <button type="submit" name="login" class="waves-effect waves-light btn">دخول</button>
        </div>
      </div>
    </form>
  </div>
  <button type ="button" class="modal-close btn waves-effect waves-light btn-floating"><i class="material-icons">close</i></button>
</div>

<nav id="slide-out" class="sidenav">
  <ul>
    <li>
      <div class="user-view">
        <div class="background">
          <img src="/hws/images/bg2.jpg" alt="Background" width="100%" class="responsive-img">
        </div>
        <a href="#user"><img class="circle" src="/hws/images/admin.jpg" width="64" height="64" alt="User Image"></a>
        <a href="#"><span class="white-text name"><?php echo $_SESSION['username']; ?></span></a>
        <a href="#"><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
      </div>
    </li>
    <?php
      if (isset($_SESSION['admin'])) {?>
        <!-- Admin Link -->
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], '/admin/index.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/index.php"><i class="material-icons">dashboard</i>لوحة التحكم</a></li>
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'marketers.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/marketers.php"><i class="material-icons">supervisor_account</i>المسوقين</a></li>
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'transactions.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/transactions.php"><i class="material-icons">library_books</i>المعاملات</a></li>
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'pricelist.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/pricelist.php"><i class="material-icons">monetization_on</i>قائمة الأسعار</a></li>
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'ref.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/ref.php"><i class="material-icons">book</i>المرجع</a></li>
        <li><div class="divider"></div></li>
        <li><a href="/hws/include/logout.php"><i class="material-icons">weekend</i>خروج</a></li>
        <?php
      }elseif (isset($_SESSION['user'])) {?>
        <!-- User Link -->
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'transactions.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/transactions.php"><i class="material-icons">library_books</i>المعاملات</a></li>
        <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'ref.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/ref.php"><i class="material-icons">book</i>المرجع</a></li>
        <li><a href="/hws/include/logout.php"><i class="material-icons">weekend</i>خروج</a></li>
        <?php
      }
    ?>
  </ul>
</nav>
