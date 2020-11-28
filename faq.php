<?php
session_start(); 
$Title = "الأسئلة الشائعة";
include "include/Functions.php";
include "include/header.php";
include "include/navbar.php";
$stmt = $con->prepare("SELECT * FROM frequently_asked_questions ORDER BY id DESC");
$stmt->execute();
?>

<section class="faq">
  <div class="container">
    <h1 class="center-align">الأسئلة الشائعة</h1>
    <ul class="collapsible popout">
      <?php 
        if ($stmt->rowCount() > 0) {
          $data = $stmt->fetchAll();
          foreach ($data as $value) {?>
            <li>
              <div class="collapsible-header p-0"><span class="q letter heading-font">س.</span><?php echo $value['questions']; ?></div>
              <div class="collapsible-body p-0"><span class="a letter heading-font">ج.</span><span class="answer"><?php echo $value['answer'];?></span></div>
            </li>
            <?php
          }
        }
        else {?>
            <li>
              لم يتم إضافة أسئلة شائعة
            </li><?php
        }
      ?>
    </ul>
  </div>
</section>

<?php
include "include/footer-design.php";
include "include/footer.php";
?>