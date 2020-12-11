<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "قائمة الأسعار";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'pricelist';
    
if ($do == "pricelist") {       // Price List Page
    $stmt = $con->prepare("SELECT * FROM static_price");
    $stmt->execute();
    $prices = $stmt->fetchAll();
    $stmt1 = $con->prepare("SELECT * FROM visas");
    $stmt1->execute();
    $visas = $stmt1->fetchAll();
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between active"><i class="material-icons">monetization_on</i> قائمة الأسعار</li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top-bar flex-between">
        <h1>قائمة الأسعار</h1>
        <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">add</i> إضافة جديد</a>
        <p>يمكنك من هنا إضافة وتعديل أسعار الخدمات والتأشيرات.</p>
    </div>
</div>
<!-- Start Price List Show -->
<section class="transactions">
    <div class="container">
        <form method="post" action="../include/visa_operation.php">
            <input type="hidden" name="id" id="btnId">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>التأشيرات والخدمات</th>
                        <th>السعر</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This Row Outside Foreach -->
                    <?php
                        foreach ($prices as $price) {?>
                            <tr>
                                <td><?php echo $price['id']; ?></td>
                                <td><?php echo $price['service_name']; ?></td>
                                <td><?php echo $price['price']; ?></td>
                                <td class="flex-between">
                                    <a href="?do=edit&id=<?php echo $price['id']; ?>&type=service" class="btn ed-btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="تعديل"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    <!-- ------------------------ -->
                    <?php
                        foreach ($visas as $visa) {?>
                            <tr class="<?php echo ($visa['status'] == 1 ? "ban tooltipped" : "") ?>" data-position="bottom" data-tooltip="محظور">
                                <td><?php echo $visa['id']; ?></td>
                                <td><?php echo $visa['visaname']; ?></td>
                                <td><?php echo $visa['price']; ?></td>
                                <td class="flex-between">
                                    <a href="?do=edit&id=<?php echo $visa['id']; ?>&type=visa" class="btn ed-btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="تعديل"><i class="material-icons">edit</i></a>
                                    <button name="ben_visa" data-id="<?php echo $visa['id']; ?>" class="btn bl-btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="ايقاف / استئناف"><i class="material-icons">block</i></button>
                                    <button name="del_visa" data-id="<?php echo $visa['id']; ?>" class="btn del-btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
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
} elseif ($do == "add") {   // Price List Add Page
?>
<!-- Breadcrumb -->
<div class="my-breadcrumb">
    <div class="container">
        <ul class="list-item">
            <li class="flex-between"><a href="?do=pricelist" class="flex-between"><i class="material-icons">monetization_on</i> قائمة الأسعار</a> / </li>
            <li class="flex-between active"><i class="material-icons">add</i> إضافة جديد</li>
        </ul>
    </div>
</div>
<div class="container">
<div class="top-bar flex-between">
    <h1>إضافة تأشيرة جديدة</h1>
    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
    <p>يمكنك إضافة تأشيرة جديدة من هنا, جميع الحقول التالية مطلوبة.</p>
</div>
</div>
<!-- Start Price List Add Form -->
<section class="add-to-pricelist p-1">
    <div class="container">
        <form method="post" action="../include/add_visa.php">
            <div class="row m-0">
                <div class="row">
                    <p class="input-group-title">اكتب وصف وسعر التأشيرة.</p>
                    <div class="input-field col l6">
                        <input id="title" name="title" type="text" class="validate" required>
                        <label for="title">اكتب الوصف هنا</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="price" name="price" type="number" class="validate" required>
                        <label for="price">اكب السعر هنا</label>
                    </div>
                </div>
                <!-- <div class="row">
                    <p class="input-group-title" style="margin-bottom: 1.5rem">حدد النوع هل هي تأشيرة أم خدمة؟</p>
                    <div class="col s2">
                        <label>
                            <input name="type" type="radio" checked>
                            <span>تأشيرة</span>
                        </label>
                    </div>
                    <div class="col s2">
                        <label>
                            <input name="type" type="radio">
                            <span>خدمة</span>
                        </label>
                    </div>
                </div> -->
                <div class="row" style="margin-top: 2rem">
                    <button type="submit" name="add_data" class="btn main-dark waves-effect waves-light">إضافة البيانات</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
} elseif ($do == "edit") {   // Price List Edit Page
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    if ($type == "service") {
        $stmt1 = $con->prepare("SELECT * FROM static_price WHERE id = ?");
        $stmt1->execute(array($id));
    }
    elseif ($type == "visa") {
        $stmt1 = $con->prepare("SELECT * FROM visas WHERE id = ?");
        $stmt1->execute(array($id));
    }
    else {
        header('Location: ?do=pricelist');
    }
    if ($stmt1->rowCount() > 0) {
        $row = $stmt1->fetch();
        ?>
        <!-- Breadcrumb -->
        <div class="my-breadcrumb">
            <div class="container">
                <ul class="list-item">
                    <li class="flex-between"><a href="?do=pricelist" class="flex-between"><i class="material-icons">monetization_on</i> قائمة الأسعار</a> / </li>
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
        <section class="p-1">
            <div class="container">
                <form method="post" action="../include/edit_data.php">
                    <div class="row m-0">
                        <div class="row">
                            <p class="input-group-title">اكتب وصف وسعر التأشيرة أو الخدمة.</p>
                            <div class="input-field col l6">
                                <input id="title" name="title" value="<?php echo $row[1]; ?>" type="text" class="validate" required>
                                <label for="title">اكتب الوصف هنا</label>
                            </div>
                            <div class="input-field col l6">
                                <input id="price" name="price" value="<?php echo $row[2]; ?>" type="number" class="validate" required>
                                <label for="price">اكب السعر هنا</label>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <p class="input-group-title" style="margin-bottom: 1.5rem">حدد النوع هل هي تأشيرة أم خدمة؟</p>
                            <div class="col s2">
                                <label>
                                    <input name="type" type="radio" checked>
                                    <span>تأشيرة</span>
                                </label>
                            </div>
                            <div class="col s2">
                                <label>
                                    <input name="type" type="radio">
                                    <span>خدمة</span>
                                </label>
                            </div>
                        </div> -->
                        <input type="hidden" value="<?php echo $type; ?>" name="type">
                        <input type="hidden" name="id" value="<?php echo $id;?>" >
                        <div class="row" style="margin-top: 2rem">
                            <button type="submit" name="edit_data" class="btn main-dark waves-effect waves-light">تعديل البيانات</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <?php
    }
    else {
        header("refresh:0;url=?do=pricelist");
    }
}
include "../include/footer.php";
}
else {
    header("Location: hws/index.php");
}
ob_end_flush();
?>