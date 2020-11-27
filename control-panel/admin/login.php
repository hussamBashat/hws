<?php include "../include/header.php";?>
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
        <form method="post" action="">
            <div class="row m-0">
                <div class="input-field col s12">
                <input id="username" type="text" class="validate" required>
                <label for="username">Username</label>
                </div>
            </div>
            <div class="row m-0">
                <div class="input-field col s12">
                <input id="password" type="password" class="validate" required>
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
</section>

<?php
include "../include/footer.php";
?>