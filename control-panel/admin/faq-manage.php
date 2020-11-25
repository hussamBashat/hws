<?php
include "../include/header.php";
include "../../include/navbar.php";
$do = isset($_GET['do']) ? $_GET['do'] : 'faq';

if ($do == "faq") {       // FAQ Page
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
                <tr>
                    <td>1</td>
                    <td>Do I have to fill out all the sections of the application? Can’t I just attach my resume?</td>
                    <td>You may include your resume, but you need to complete the “Employment History” section so we have consistent information from all our applicants. A key part of your application is the “Job Questions” section, so take the time to give thorough but concise answers.</td>
                    <td class="flex-between">
                        <a href="?do=edit" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a>
                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>How do I know you received my application?</td>
                    <td>After you submit your online application, you will receive an email confirming we received it. Check your spam folder if you don’t find it shortly after you apply.</td>
                    <td class="flex-between">
                        <a href="?do=edit" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a>
                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>I don’t live in the greater Portland area. Should I still apply?</td>
                    <td>Yes. Some jobs may require familiarity with Portland and the region, but we consider applicants from all over the country (and world). Note: Travel Portland does not cover relocation expenses.</td>
                    <td class="flex-between">
                        <a href="?do=edit" class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a>
                        <button class="btn btn-floating waves-effect waves-light flex-between tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
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
        <form method="post" action="">
            <div class="row m-0">
                <div class="row m-0">
                    <div class="input-field col s12">
                        <input id="username" type="text" class="validate" required>
                        <label for="username">Add Question</label>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea" required></textarea>
                    <label for="textarea1">Add Answer</label>
                  </div>
                </div> 
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light"> Publish</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
} elseif ($do == "edit") {   // Edit FAQ
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
<!-- Start FAQ Add Form -->
<section class="add-faq">
    <div class="container">
        <form method="post" action="">
            <div class="row m-0">
                <div class="row m-0">
                    <div class="input-field col s12">
                        <input id="username" type="text" class="validate" required value="How do I know you received my application?">
                        <label for="username">Edit Question</label>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea" required>
                      After you submit your online application, you will receive an email confirming we received it. Check your spam folder if you don’t find it shortly after you apply.
                    </textarea>
                    <label for="textarea1">Edit Answer</label>
                  </div>
                </div> 
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light"> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
}
include "../include/footer.php";
?>