<?php
    ob_start();
    session_start();

    if(isset($_POST['choose_col'])){
        $array = "";
        if (isset($_POST['all']) && $_POST['all'] == "on") {
            $_SESSION['all'] = "true";
            for ($i=0; $i < 27; $i++) { 
                $chk = "chk" . $i;
                $_SESSION[$chk] = "true";
                $array .= $_SESSION[$chk] . ",";
            }
        }
        else {
            $_SESSION['all'] = "false";
            for ($i=0; $i < 27; $i++) { 
                $chk = "chk" . $i;
                if (isset($_POST[$chk]) && $_POST[$chk] == "on") {
                    $_SESSION[$chk] = "true";
                }
                else {
                    $_SESSION[$chk] = "false";
                    echo $_SESSION[$chk];
                }
                $array .= $_SESSION[$chk] . ",";
            }
        }
        $array .= $_SESSION['all'] . ",";
        if (isset($_COOKIE['admingeneral'])) {
            $array .= $_SESSION['admin'] . "," . $_SESSION['username'] . "," . $_SESSION['email'] . "," . $_SESSION['password'];
            setcookie("admingeneral", $array, time() + (7 * 24 * 60 * 60), "/");
        }else {
            $array .= $_SESSION['user'] . "," . $_SESSION['username'] . "," . $_SESSION['email'] . "," . $_SESSION['password'];
            setcookie("general", $array, time() + (7 * 24 * 60 * 60), "/");
        }
    }
    header("Location: ../admin/transactions.php");
    ob_end_flush();
?>

