<?php 

    include "connect.php";

    function getTitle(){
		global $Title;
		if (isset($Title)) {
			echo $Title;
		}

    }

    function countItems($item, $table){
      global $con;
        $stmt20 = $con->prepare("SELECT COUNT($item) FROM $table");
        $stmt20->execute();
        return $stmt20->fetchColumn();
    }
    
    if (isset($_COOKIE['general'])) {
        $Rows = explode(",", $_COOKIE['general']);
        $_SESSION['user'] = $Rows[0];
        $_SESSION['username'] = $Rows[1];
        $_SESSION['email'] = $Rows[2];
        $_SESSION['password'] = $Rows[3];
        $_SESSION['all'] = "true";
        for ($i=0; $i < 27; $i++) { 
            $chk = "chk" . $i;
            $_SESSION[$chk] = "true";
        }
    }

    if (isset($_COOKIE['admingeneral'])) {
      $Rows = explode(",", $_COOKIE['admingeneral']);
      $_SESSION['admin'] = $Rows[0];
      $_SESSION['username'] = $Rows[1];
      $_SESSION['email'] = $Rows[2];
      $_SESSION['password'] = $Rows[3];
      $_SESSION['all'] = "true";
      for ($i=0; $i < 27; $i++) { 
          $chk = "chk" . $i;
          $_SESSION[$chk] = "true";
      }
  }

