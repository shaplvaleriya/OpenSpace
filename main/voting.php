<?php
if (session_id()=='');
    session_start();
?>
<?php
include '../connection.php';
?>
<?php 
	$select = "SELECT date_start, date_end, date_session from voting";
	$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_row($result1);
	$date=date("Y-m-d");
	$ID_user=$_SESSION['ID_user'];	
	if ($row[0] <= $date) {
	// if ($row[0] <= $date && $date < $row[1]) {
	$selectUser = "SELECT ID_user from voting_film where ID_user='$ID_user'";
	$resultUser = mysqli_query($link, $selectUser) or die("Ошибка " . mysqli_error($link));
	$rowUser = mysqli_fetch_row($resultUser);
	if (empty($rowUser[0])) {
		echo "active";
	}
	}
?>

<?php 
if ($date==$row[1]) {
$selectV =	"SELECT ID_film, count(*) as c from voting_film group by ID_film order by c desc limit 1";
$resultV = mysqli_query($link, $selectV) or die("Ошибка " . mysqli_error($link));
	$rowV = mysqli_fetch_row($resultV);
$selectS =	"SELECT date_session from sessions where date_session='$row[2]'";
$resultS = mysqli_query($link, $selectS) or die("Ошибка " . mysqli_error($link));
	$rowS = mysqli_fetch_row($resultS);

	if (!empty($rowS[0])) {
		$delete =	"DELETE from sessions where date_session='$rowS[0]'";
		$resultD = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
	}
	$query ="INSERT INTO sessions (ID_film, date_session) VALUES('$rowV[0]', '$rowS[0]')";
    $res = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    
}
 ?>