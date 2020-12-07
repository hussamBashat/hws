<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "المرجع";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'ref';
    
    if ($do == "ref") {       // FAQ Page
        $stmt = $con->prepare("SELECT * FROM frequently_asked_questions ORDER BY id DESC");
        $stmt->execute();
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between active"><i class="material-icons">book</i> المرجع</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-bar flex-between">
            <h1>إدارة المرجع</h1>
            <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">add</i> إضافة جديد</a>
            <p>تعرض هذه الصفحة جميع المعلومات التي يحتاجها المسوق, يمكنك إضافة وتعديل وحذف معلومات المرجع من هنا..</p>
        </div>
    </div>
    <!-- Start REF -->
    <section class="faq-manage">
        <div class="container">
            <form method="post" action="../include/delete_faq.php">
                <input type="hidden" name="id" id="btnId">
                <table class="striped highlight responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th>الجواب</th>
                            <th>عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if ($stmt->rowCount() > 0) {
                                $data = $stmt->fetchAll();
                                foreach ($data as $value) {?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['questions']; ?></td>
                                        <td><?php echo $value['answer']; ?></td>
                                        <td class="flex-between">
                                            <a href="?do=edit&id=<?php echo $value['id']; ?>" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="تعديل"><i class="material-icons">edit</i></a>
                                            <button name="faqdel" data-id="<?php echo $value['id']; ?>" class="btn select-id btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="حذف"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else {?>
                                <tr>
                                    <td colspan="4" class="center-align" style="color: var(--second-color); font-weight: 600;">
                                        <i class="material-icons" style="transform: translateY(8px);">info</i> لم تتم إضافة أسئلة شائعة حتى الآن
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
    } elseif ($do == "add") {   // Add REF
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between"><a href="?do=ref" class="flex-between"><i class="material-icons">book</i> المرجع</a> / </li>
                <li class="flex-between active"><i class="material-icons">add</i> إضافة جديد</li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="top-bar flex-between">
        <h1>إضافة سؤال جديد</h1>
        <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
        <p>يمكنك إضافة سؤال جديد من هنا, جميع الحقول التالية مطلوبة.</p>
    </div>
    </div>
    <!-- Start FAQ Add Form -->
    <section class="add-faq">
        <div class="container">
            <form method="post" action="../include/add_faq.php">
                <div class="row m-0">
                    <div class="row m-0">
                        <div class="input-field col s12">
                            <input id="username" name="question" type="text" class="validate" required>
                            <label for="username">أضف السؤال</label>
                        </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" name="answer" class="materialize-textarea" required></textarea>
                        <label for="textarea1">أضف الجواب</label>
                      </div>
                    </div> 
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" name="publish" class="btn waves-effect waves-light"> نشر</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
    } elseif ($do == "edit") {   // Edit REF
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $stmt1 = $con->prepare("SELECT * FROM frequently_asked_questions WHERE id = ?");
        $stmt1->execute(array($id));
        if ($stmt1->rowCount() > 0) {
            $row = $stmt1->fetch();
            ?>
            <!-- Breadcrumb -->
            <div class="my-breadcrumb">
                <div class="container">
                    <ul class="list-item">
                        <li class="flex-between"><a href="?do=ref" class="flex-between"><i class="material-icons">book</i> المرجع</a> / </li>
                        <li class="flex-between active"><i class="material-icons">edit</i> تعديل المرجع</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="top-bar flex-between">
                    <h1>تعديل المرجع</h1>
                    <span onclick="window.history.back()" class="custom-link flex-between">رجوع <i class="material-icons">keyboard_arrow_left</i></span>
                    <p>يمكنك تعديل معلومات المرجع من هنا, قم بتعديل البيانات بالشكل المناسب</p>
                </div>
            </div>
            <!-- Start REF Edit Form -->
            <section class="add-faq">
                <div class="container">
                    <form method="post" action="../include/edit_faq.php">
                        <input type="hidden" name="id" value="<?php echo $id;?>" >
                        <div class="row m-0">
                            <div class="row m-0">
                                <div class="input-field col s12">
                                    <input id="username" name="question" type="text" class="validate" required value="<?php echo $row['questions'] ?>">
                                    <label for="username">تعديل السؤال</label>
                                </div>
                            </div>
                            <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" name="answer" class="materialize-textarea" required><?php echo $row['answer'] ?></textarea>
                                <label for="textarea1">تعديل الجواب</label>
                            </div>
                            </div> 
                            <div class="row">
                                <div class="col s12">
                                    <button type="submit" name="save" class="btn waves-effect waves-light"> حفظ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <?php
        }
        else {
            header("refresh:0;url=?do=ref");
        }
    }
    include "../include/footer.php";
    
}
else {
    header("refresh:0;url=../../index.php");
}
ob_end_flush();
?>