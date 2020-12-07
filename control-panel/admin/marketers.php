<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "المستخدمين";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'marketers';

    if ($do == "marketers") {       // Marketers Page
        $stmt = $con->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between active"><i class="material-icons">supervisor_account</i> المسوقين</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-bar flex-between">
            <h1>إدارة المسوقين.</h1>
            <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">person_add</i> إضافة جديد</a>
            <p>تعرض هذه الصفحة جميع معلومات المسوقين ، يمكنك إضافة أو حذف مسوق من هنا.</p>
        </div>
    </div>
    <!-- Start Users -->
    <section class="users">
        <div class="container">
            <form method="post" action="../include/user_operation.php">
                <input type="hidden" name="id" id="btnId">
                <table class="striped highlight responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المسوق</th>
                            <th>البريد الإلكتروني</th>
                            <th>أُضيف في</th>
                            <th>عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if ($stmt->rowCount() > 0) {
                                $data = $stmt->fetchAll();
                                foreach ($data as $value) {?>
                                    <tr class="<?php echo ($value['Status'] == 0 ? "ban tooltipped" : "") ?>" data-position="bottom" data-tooltip="محظور">
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['added_in']; ?></td>
                                        <td class="flex-between">
                                            <button name="del" data-id="<?php echo $value['id']; ?>" class="btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
                                            <button name="ben" data-id="<?php echo $value['id']; ?>" class="btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حظر / فك الحظر"><i class="material-icons">block</i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else {?>
                                <tr>
                                <td colspan="5" class="center-align" style="color: var(--second-color); font-weight: 600;">
                                    <i class="material-icons" style="transform: translateY(8px);">info</i> لم تتم إضافة مسوقين حتى الآن
                                </td>
                                </tr><?php
                            }
                        ?>
                        
                    </tbody>
                </table>
            </form>
        </div>
    </section>

    <?php
    } elseif ($do == "add") {   // Add New User
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between"><a href="marketers.php" class="flex-between"><i class="material-icons">supervisor_account</i> المسوقين</a> / </li>
                <li class="flex-between active"><i class="material-icons">person_add</i> إضافة جديد</li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="top-bar flex-between">
        <h1>إضافة مسوق جديد</h1>
        <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
        <p>يمكنك إضافة مسوق جديد من هنا ، جميع الحقول التالية مطلوبة.</p>
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
                            <label for="username">اسم المستخدم</label>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="email" class="validate" required>
                            <label for="email">البريد الإلكتروني</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" class="validate" required>
                            <label for="password">كلمة المرور</label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" name="add_user" class="btn waves-effect waves-light"> إضافة المسوق</button>
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