<!-- Start Navbar -->
<nav class="indigo lighten-2">
    <div class="container">
        <div class="nav-wrapper">
          <a href="/hws" class="brand-logo"><i class="material-icons">flight_takeoff</i>HWS</a>
          <ul class="right hide-on-small-only">
              <li><a class="dropdown-trigger" href="#" data-target="category">Category<i class="material-icons right">arrow_drop_down</i></a></li>
              <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'faq.php')) ? 'active' : ''; ?>"><a href="/hws/faq.php" class="tooltipped" data-position="bottom" data-tooltip="Frequently Asked Questions">FAQ</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <?php
              $logedin = true;
              if ($logedin) {
              ?>
              <li class="remove-on-small-only"><a href="#" data-target="slide-out" class="sidenav-trigger tooltipped" data-position="bottom" data-tooltip="User menu" style="
              display: block;
              margin: 0;
              text-align: center;
              "><i class="material-icons">menu</i></a></li>
              <?php
              } else {
              ?>
              <li class="remove-on-small-only"><a href="#login" class="tooltipped modal-trigger" data-position="bottom" data-tooltip="Login"><i class="material-icons">person</i></a></li>
              <?php
              }
              ?>
          </ul>
          <?php
          if ($logedin) {
          ?>
          <li class="hide-on-med-and-up user-menu"><a href="#" data-target="slide-out" class="sidenav-trigger tooltipped" data-position="bottom" data-tooltip="User menu"><i class="material-icons">menu</i></a></li>
          <?php
          } else {
          ?>
          <li class="hide-on-med-and-up user-menu"><a href="#login" class="tooltipped modal-trigger" data-position="bottom" data-tooltip="Login"><i class="material-icons">person</i></a></li>
          <?php
          }
          ?>
          <li id="navMenu" class="hide-on-med-and-up nav-menu"><a href="#" class="tooltipped" data-position="bottom" data-tooltip="Nav menu"><i class="material-icons">more_vert</i></a></li>
        </div>
    </div>
</nav>
<!-- Dropdown Category -->
<ul id="category" class="dropdown-content">
  <li><a href="#">Parttime</a></li>
  <li><a href="#">Fulltime</a></li>
  <li class="divider"></li>
  <li><a href="#">Freelance</a></li>
</ul>

<!-- Login Modal -->
<div id="login" class="modal login-modal">
  <div class="modal-content p-0 center-align">
    <form method="post" action="">
      <h5>Login Now</h5>
      <div class="row m-0">
        <div class="input-field col s12">
          <input id="usermail" type="text" class="validate">
          <label for="usermail">Username or email</label>
        </div>
      </div>
      <div class="row m-0">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 left-align">
            <label>
                <input type="checkbox">
                <span>Remmamber me</span>
            </label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 left-align">
            <button class="waves-effect waves-light btn">Login</button>
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
          <img src="https://lorempixel.com/250/250/nature/2" width="100%" class="responsive-img">
        </div>
        <a href="#user"><img class="circle" src="https://lorempixel.com/250/250/nature/1"></a>
        <a href="#"><span class="white-text name">Hussam Bashat</span></a>
        <a href="#"><span class="white-text email">hmb.new@gmail.com</span></a>
      </div>
    </li>
    <!-- Addmin Link -->
    <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'index.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/index.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'users.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/users.php"><i class="material-icons">supervisor_account</i>Users</a></li>
    <li class="<?php echo (stripos($_SERVER['REQUEST_URI'], 'faq-manage.php')) ? 'active' : ''; ?>"><a href="/hws/control-panel/admin/faq-manage.php"><i class="material-icons">question_answer</i>FAQ</a></li>
    <li><div class="divider"></div></li>
    <li><a href="logout.php"><i class="material-icons">weekend</i>Logout</a></li>
  </ul>
</nav>