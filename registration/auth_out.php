<?php
if (session_id()=='');
        session_start();

     $_SESSION['role']="";
     $_SESSION['username']="";
     $_SESSION['ID_user']="";
?>
<?php
include("registration.php");
?>
