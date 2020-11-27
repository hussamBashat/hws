<?php 
    ob_start();
    session_start();
    include "../../include/Functions.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

        $stmt = $con->prepare("SELECT * FROM admins WHERE password = ? AND username = ?");
        $stmt->execute(array($_POST['password'], $_POST['username']));
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $_SESSION['admin'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];

            $array = $data['id'] . "," . $data['username'] . "," . $data['email'] . "," . $data['password'];
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
            echo "Invalid login";
            header("refresh:2;url=/hws/index.php");
        }
    }
    else {
        header("Location: /hws/index.php");
    }
    ob_end_flush();
?>