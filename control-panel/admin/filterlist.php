<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "الحالات";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'filterlist';
    
if ($do == "filterlist") {       // Filter List Page
    $stmt1 = $con->prepare("SELECT * FROM trans_status");
    $stmt1->execute();
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between active"><i class="material-icons">filter_list</i> الحالات</li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top-bar flex-between">
        <h1>الحالات</h1>
        <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">add</i> إضافة جديد</a>
        <p>يمكنك من هنا إضافة وتعديل حالات المعاملة.</p>
    </div>
</div>
<!-- Start Price List Show -->
<section class="transactions">
    <div class="container">
        <form method="post" action="../include/status_operation.php">
            <input type="hidden" name="id" id="btnId">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الحالة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($stmt1->rowCount() > 0) {
                            $trans_status = $stmt1->fetchAll();
                            foreach ($trans_status as $statue) {?>
                                <tr class="visa-tr <?php echo ($statue['status'] == 0 ? "ban tooltipped" : "") ?>" data-position="bottom" data-tooltip="متوقفة">
                                    <td><?php echo $statue['id']; ?></td>
                                    <td><?php echo $statue['statue_name']; ?></td>
                                    <td class="flex-between">
                                        <a href="?do=edit&id=<?php echo $statue['id']; ?>" class="btn ed-btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="تعديل"><i class="material-icons">edit</i></a>
                                        <button name="ben_statue" data-id="<?php echo $statue['id']; ?>" class="btn bl-btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="ايقاف / استئناف"><i class="material-icons">block</i></button>
                                        <button name="del_statue" data-id="<?php echo $statue['id']; ?>" class="btn del-btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {?>
                            <tr>
                                <td colspan="7" class="center-align" style="color: var(--second-color); font-weight: 600;">
                                    <i class="material-icons" style="transform: translateY(8px);">info</i> لا يوجد حالات حتى الآن
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
} elseif ($do == "add") {   // Filter List Add Page
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between"><a href="?do=filterlist" class="flex-between"><i class="material-icons">filter_list</i> الحالات </a> / </li>
            <li class="flex-between active"><i class="material-icons">add</i> إضافة جديد</li>
        </ul>
    </div>
</div>
<div class="container">
<div class="top-bar flex-between">
    <h1>إضافة حالة جديدة</h1>
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك إضافة حالة جديدة من هنا, جميع الحقول التالية مطلوبة.</p>
</div>
</div>
<!-- Start Filter List Add Form -->
<section class="add-to-pricelist p-1">
    <div class="container">
        <form method="post" action="../include/add_trans_status.php">
            <div class="row m-0">
                <div class="row">
                    <p class="input-group-title">اكتب وصف الحالة.</p>
                    <div class="input-field col l6">
                        <input id="title" name="title" type="text" class="validate" required>
                        <label for="title">اكتب الوصف هنا</label>
                    </div>
                </div>
                <div class="row" style="margin-top: 2rem">
                    <button type="submit" name="add_status_data" class="btn main-dark waves-effect waves-light">إضافة البيانات</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
} elseif ($do == "edit") {   // Price List Edit Page
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt1 = $con->prepare("SELECT * FROM trans_status WHERE id = ?");
    $stmt1->execute(array($id));
    if ($stmt1->rowCount() > 0) {
        $row = $stmt1->fetch();
        ?>
        <!-- Breadcrumb -->
        <div class="my-breadcrumb">
            <div class="container">
                <ul class="list-item">
                    <li class="flex-between"><a href="?do=filterlist" class="flex-between"><i class="material-icons">filter_list</i>  الحالات</a> / </li>
                    <li class="flex-between active"><i class="material-icons">edit</i> تعديل</li>
                </ul>
            </div>
        </div>
        <div class="container">
        <div class="top-bar flex-between">
            <h1>تعديل المعلومات</h1>
            <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
            <p>يمكنك تعديل المعلومات  من هنا, قم بتعديل البيانات بالشكل المناسب</p>
        </div>
        </div>
        <!-- Start Price List Edit Form -->
        <section class="add-to-pricelist p-1">
            <div class="container">
                <form method="post" action="../include/edit_status_data.php">
                    <div class="row m-0">
                        <div class="row">
                            <p class="input-group-title">اكتب وصف الحالة.</p>
                            <div class="input-field col l6">
                                <input type="hidden" name="id" value="<?php echo $id;?>" >
                                <input id="title" name="title" type="text" value="<?php echo $row['statue_name']; ?>" class="validate" required>
                                <label for="title">اكتب الوصف هنا</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2rem">
                            <button type="submit" name="edit_status_data" class="btn main-dark waves-effect waves-light">تعديل البيانات</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <?php
    }
    else {
        header("refresh:0;url=?do=filterlist");
    }
}
include "../include/footer.php";
}
else {
    header("Location: hws/index.php");
}
ob_end_flush();
?>