<?php
require "../../connection.php";

$select = "SELECT distinct purchases.ID_session, time_format(sessions.date_session, '%H'), date_format(sessions.date_session, '%d-%m-%Y'), purchases.ID_purchase from purchases inner join sessions on purchases.ID_session=sessions.ID_session where purchases.status_purchase='booked'";
    $result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
    $rows = mysqli_num_rows($result1);
            $active='';
    for ($i = 0; $i < $rows; ++$i) {
       $row = mysqli_fetch_row($result1);
       if ($row[1]==00) {
        $date.= $row[2];
       $date.=' ';
       $date.='23:00:00';
       }
       else{
       $date.= $row[2];
       $date.=' ';
       $date.=$row[1]-1;
       $date.=':00:00';
   }
   $date_now=date("d-m-Y H:i:s");
   if (strtotime($date_now)>strtotime($date)) {
   $queryChange ="UPDATE purchases SET status_purchase='expired' where ID_purchase=$row[3]"; 
    $resultChange = mysqli_query($link, $queryChange) or die("Ошибка " . mysqli_error($link));
     if ($resultChange)
                {
                    $active='active';
                }
   }
       $date='';
   }
    echo $active;
   
   ?>
