<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "المستخدمين";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'users';

    if ($do == "users") {       // Users Page
        $stmt = $con->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between active"><i class="material-icons">supervisor_account</i> Users</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-bar flex-between">
            <h1>Users management.</h1>
            <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">person_add</i> Add New</a>
            <p>This page displays all the user information, you can add or delete a user from here.</p>
        </div>
    </div>
    <!-- Start Users -->
    <section class="users">
        <div class="container">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Added in</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if ($stmt->rowCount() > 0) {
                            $data = $stmt->fetchAll();
                            foreach ($data as $value) {?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['username']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['added_in']; ?></td>
                                    <td class="flex-between">
                                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons">delete</i></button>
                                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Ban"><i class="material-icons">block</i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {?>
                            <tr>
                                <td>لم يتم إضافة مستخدمين</td>
                            </tr><?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </section>

    <?php
    } elseif ($do == "add") {   // Add New User
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between"><a href="users.php" class="flex-between"><i class="material-icons">supervisor_account</i> Users</a> / </li>
                <li class="flex-between active"><i class="material-icons">person_add</i> Add New</li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="top-bar flex-between">
        <h1>Add new user.</h1>
        <span onclick="window.history.back()" class="custom-link flex-between"><i class="material-icons">keyboard_arrow_left</i> Back</span>
        <p>You can add a new user from here, all of the following fields are required</p>
    </div>
    </div>
    <!-- Start User Add Form -->
    <section class="add-user">
        <div class="container">
            <form method="post" action="../include/add_user.php">
                <div class="row m-0">
                    <div class="row m-0">
                        <div class="input-field col s12">
                            <input id="username" name="username" type="text" class="validate" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="email" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" class="validate" required>
                            <label for="password">Password</label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" name="add_user" class="btn waves-effect waves-light"> Add User</button>
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
    header("refresh:0;url=../../index.php");
}
ob_end_flush();
?>