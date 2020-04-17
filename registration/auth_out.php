<?php
if (session_id()=='');
        session_start();

     $_SESSION['role']="";
     $_SESSION['username']="";
     $_SESSION['idu']="";
?>
<?php
include("registration.php");
?>
