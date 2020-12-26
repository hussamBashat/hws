<?php 
    ob_start();
    session_start();
    $Title = "خطأ";
    include "../../include/Functions.php";
    include "header.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

        $stmt = $con->prepare("SELECT * FROM admins WHERE password = ? AND username = ?");
        $stmt->execute(array($_POST['password'], $_POST['username']));
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $array = "";
            $_SESSION['admin'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['all'] = "true";
            for ($i=0; $i < 27; $i++) { 
                $chk = "chk" . $i;
                $_SESSION[$chk] = "true";
                $array .= $_SESSION[$chk] . ",";
            }
            $array .= $_SESSION['all'] . "," . $data['id'] . "," . $data['username'] . "," . $data['email'] . "," . $data['password'];
            setcookie("admingeneral", $array, time() + (7 * 24 * 60 * 60), "/");
            
            if (isset($_POST['remmamber']) && $_POST['remmamber'] == 'on') {
                $row = $_POST['username'] . "," . $data['password'];
                setcookie("adminlogin", $row, time() + (7 * 24 * 60 * 60), "/");
            }
            else if(isset($_COOKIE['adminlogin'])){
                setcookie("adminlogin", "", time() - (7 * 24 * 60 * 60), "/");
            }
            header("refresh:0;url=/hws/index.php");
        }
        else {
            ?>
            <div class="alert-message error-message">
                <div class="message-box">
                    <header class="header-message">
                        <i class="material-icons">report_problem</i>
                    </header>
                    <div class="body-message">
                        <h2>انتبه!</h2>
                        <p>
                        <i class="material-icons">info</i>
                            هناك خطأ في اسم المستخدم أو كلمة المرور.
                        </p>
                    </div>
                    <footer class="footer-message">
                        <button type="button" onclick="window.history.back()" class="waves-effect waves-light btn clasic-btn">حسناً</button>
                    </footer>
                </div>
            </div>
            <?php
            // header("refresh:2;url=/hws/index.php");
        }
    }
    else {
        header("Location: /hws/index.php");
    }
    include "footer.php";
    ob_end_flush();
?>