<?php 

    include "connect.php";

    function getTitle(){
		global $Title;
		if (isset($Title)) {
			echo $Title;
		}

    }
    
    if (isset($_COOKIE['general'])) {
        $Rows = explode(",", $_COOKIE['general']);
        $_SESSION['user'] = $Rows[0];
        $_SESSION['username'] = $Rows[1];
        $_SESSION['email'] = $Rows[2];
        $_SESSION['password'] = $Rows[3];
    }