<?php
if (session_id()=='');
    session_start();
?>
<?php
include '../connection.php';
?>

<?php 
	
	$voting=$_POST['votingValue'];
	$ID_user=$_SESSION['ID_user'];
	$select = "SELECT ID_voting from voting";
	$result = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
	$rowV = mysqli_fetch_row($result);
	$ID_voting = $rowV[0];

	$queryVoting = "INSERT INTO voting_film (ID_film, ID_voting, ID_user) values('$voting', '$ID_voting', '$ID_user')";
    $resultVoting = mysqli_query($link, $queryVoting) or die("Ошибка " . mysqli_error($link));
	


	$selectt = "SELECT ID_film from voting";
	$resultt = mysqli_query($link, $selectt) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_row($resultt);
	$ro = explode(',', $row[0]);
	$count = count($ro);

for ($p = 0; $p < $count - 1; $p++) 
{
$selectTitle = "SELECT title from films where ID_film='$ro[$p]'";
$resultTitle = mysqli_query($link, $selectTitle) or die("Ошибка " . mysqli_error($link));
$rowTitle = mysqli_fetch_row($resultTitle);

$select = "SELECT count(*) as c from voting_film  where ID_film='$ro[$p]'";
$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
    $roww = mysqli_fetch_row($result1);
    	echo $rowTitle[0];
		echo $roww[0];
		echo "<br>";
}
 ?>