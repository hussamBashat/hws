<?php
    if (isset($_COOKIE['general'])) {
        setcookie("general", "", time() - (30 * 24 * 60 * 60), "/");
    }
    session_start();
    
    session_unset();

    session_destroy();

    header("Location: /hws/index.php");
    
?>