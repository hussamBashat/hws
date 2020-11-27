<?php
$Title = "تسجيل الدخول";
include "../../include/Functions.php";
include "../include/header.php";
if (isset($_COOKIE['adminlogin'])) {
    $Row = explode(",", $_COOKIE['adminlogin']);
}
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb" style="margin-top: 1rem;">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between active"><i class="material-icons">login</i> Login</li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top-bar flex-between">
        <h1>Login To Dashboard.</h1>
        <a href="/hws" class=" custom-link flex-between"><i class="material-icons">home</i> Home</a>
        <p>Hello Admin, you can login to dashboard from this page.</p>
    </div>
</div>
<!-- Start Admin Login -->
<section class="admin-login">
    <div class="container">
        <form method="post" action="../include/login.php">
            <div class="row m-0">
                <div class="input-field col s12">
                <input id="username" name="username" type="text" value="<?php echo (isset($Row) ? $Row[0] : ""); ?>" class="validate" required>
                <label for="username">Username</label>
                </div>
            </div>
            <div class="row m-0">
                <div class="input-field col s12">
                <input id="password" name="password" type="password" value="<?php echo (isset($Row) ? $Row[1] : ""); ?>" class="validate" required>
                <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 left-align">
                    <label>
                        <input type="checkbox" name="remmamber" <?php echo (isset($Row) ? "checked" : "");?>>
                        <span>Remmamber me</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 left-align">
                    <button type="submit" name="login" class="waves-effect waves-light btn">Login</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include "../include/footer.php";
?>