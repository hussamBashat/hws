<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Title = "ضبط الأسئلة الشائعة";
    include "../../include/Functions.php";
    include "../include/header.php";
    include "../../include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'faq';
    
    if ($do == "faq") {       // FAQ Page
        $stmt = $con->prepare("SELECT * FROM frequently_asked_questions ORDER BY id DESC");
        $stmt->execute();
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between active"><i class="material-icons">question_answer</i> FAQ</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-bar flex-between">
            <h1>FAQ management.</h1>
            <a href="?do=add" class="btn waves-effect waves-light flex-between"><i class="material-icons">add</i> Add New</a>
            <p>This page displays all FAQ, you can add or edit or delete a FAQ from here.</p>
        </div>
    </div>
    <!-- Start FAQ -->
    <section class="faq-manage">
        <div class="container">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
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
                                    <td><?php echo $value['questions']; ?></td>
                                    <td><?php echo $value['answer']; ?></td>
                                    <td class="flex-between">
                                        <a href="?do=edit&id=<?php echo $value['id']; ?>" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a>
                                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {?>
                            <tr>
                                <td>لم يتم إضافة أسئلة شائعة</td>
                            </tr><?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <?php
    } elseif ($do == "add") {   // Add FAQ
    ?>
    <!-- Breadcrumb -->
    <div class="my-breadcrumb">
        <div class="container">
            <ul class="list-item">
                <li class="flex-between"><a href="?do=faq" class="flex-between"><i class="material-icons">question_answer</i> FAQ</a> / </li>
                <li class="flex-between active"><i class="material-icons">add</i> Add New</li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="top-bar flex-between">
        <h1>Add new FAQ.</h1>
        <span onclick="window.history.back()" class="custom-link flex-between"><i class="material-icons">keyboard_arrow_left</i> Back</span>
        <p>You can add a new FAQ from here, all of the following fields are required</p>
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
                            <label for="username">Add Question</label>
                        </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" name="answer" class="materialize-textarea" required></textarea>
                        <label for="textarea1">Add Answer</label>
                      </div>
                    </div> 
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" name="publish" class="btn waves-effect waves-light"> Publish</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
    } elseif ($do == "edit") {   // Edit FAQ
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
                        <li class="flex-between"><a href="?do=faq" class="flex-between"><i class="material-icons">question_answer</i> FAQ</a> / </li>
                        <li class="flex-between active"><i class="material-icons">edit</i> Edit FAQ</li>
                    </ul>
                </div>
            </div>
            <div class="container">
            <div class="top-bar flex-between">
                <h1>Edit old FAQ.</h1>
                <span onclick="window.history.back()" class="custom-link flex-between"><i class="material-icons">keyboard_arrow_left</i> Back</span>
                <p>You can add a edit FAQ from here, Make the appropriate adjustments</p>
            </div>
            </div>
            <!-- Start FAQ Edit Form -->
            <section class="add-faq">
                <div class="container">
                    <form method="post" action="../include/edit_faq.php">
                        <input type="hidden" name="id" value="<?php echo $id;?>" >
                        <div class="row m-0">
                            <div class="row m-0">
                                <div class="input-field col s12">
                                    <input id="username" name="question" type="text" class="validate" required value="<?php echo $row['questions'] ?>">
                                    <label for="username">Edit Question</label>
                                </div>
                            </div>
                            <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" name="answer" class="materialize-textarea" required><?php echo $row['answer'] ?></textarea>
                                <label for="textarea1">Edit Answer</label>
                            </div>
                            </div> 
                            <div class="row">
                                <div class="col s12">
                                    <button type="submit" name="save" class="btn waves-effect waves-light"> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <?php
        }
        else {
            header("refresh:0;url=?do=faq");
        }
    }
    include "../include/footer.php";
    
}
else {
    header("refresh:0;url=../../index.php");
}
ob_end_flush();
?>