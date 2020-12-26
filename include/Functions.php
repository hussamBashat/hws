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
        $_SESSION['user'] = $Rows[28];
        $_SESSION['username'] = $Rows[29];
        $_SESSION['email'] = $Rows[30];
        $_SESSION['password'] = $Rows[31];
        $_SESSION['all'] = $Rows[27];
        for ($i=0; $i < 27; $i++) { 
            $chk = "chk" . $i;
            $_SESSION[$chk] = $Rows[$i];
        }
    }

    if (isset($_COOKIE['admingeneral'])) {
      $Rows = explode(",", $_COOKIE['admingeneral']);
      $_SESSION['admin'] = $Rows[28];
      $_SESSION['username'] = $Rows[29];
      $_SESSION['email'] = $Rows[30];
      $_SESSION['password'] = $Rows[31];
      $_SESSION['all'] = $Rows[27];
      for ($i=0; $i < 27; $i++) { 
          $chk = "chk" . $i;
          $_SESSION[$chk] = $Rows[$i];
      }
  }

