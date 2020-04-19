<?php
if (session_id()=='');
    session_start();
?>
<?php
include '../connection.php';
?>
<?php 
	$select = "SELECT date_start, date_end from voting";
	$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_row($result1);
	$date=date("Y-m-d");
	$ID_user=$_SESSION['ID_user'];
	if ($row[0] <= $date && $date < $row[1]) {
	$selectUser = "SELECT ID_user from voting_film where ID_user='$ID_user'";
	$resultUser = mysqli_query($link, $selectUser) or die("Ошибка " . mysqli_error($link));
	$rowUser = mysqli_fetch_row($resultUser);
	if (empty($rowUser[0])) {
		echo "active";
	}
	}
?>