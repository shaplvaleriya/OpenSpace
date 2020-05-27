<?php if (session_id()=='')
session_start(); ?>
<?php
require "../connection.php";
$stringForum = $_POST['forumString'];
$dateForum = $_POST['mainDate'];
$ID_user =  $_SESSION['ID_user'];
if (!empty($stringForum)) 
{
$query = "INSERT INTO message (text_message, date_message, ID_user) VALUES ('$stringForum', '$dateForum', '$ID_user')";
$request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
}

$selectMessage = "SELECT * from (SELECT message.text_message, message.date_message, users.name, message.ID_user, date_format(message.date_message, '%d %M, %Y'), time_format(message.date_message, '%H:%i') from message inner join users on message.ID_user=users.ID_user Order by message.date_message  desc limit 100) a Order by a.date_message";
$resultMessage = mysqli_query($link, $selectMessage) or die("Ошибка " . mysqli_error($link));
$rowsMessage = mysqli_num_rows($resultMessage);
$date='';
for ($i=0; $i < $rowsMessage ; $i++) { 
	$rowMessage = mysqli_fetch_row($resultMessage);
	if ($date!==$rowMessage[4]) {
		$date='';
		echo "<div class='forum-date'><p>".$rowMessage[4]."</p></div>";
		$date.=$rowMessage[4];
	}
	if ($rowMessage[3]==$ID_user) {
	echo "<div class='forum-message1'>";
	// echo $rowMessage[2];
	echo "<div class='forum-time'><p>";
	echo $rowMessage[5];
	echo "</p><div class='forum-message-me'>";
	echo $rowMessage[0];
	echo "</div>";
		echo "</div>";
		echo "</div>";
	}
	else{
		echo "<div class='forum-message2'><p class='forum-name'>";
		echo $rowMessage[2];
		echo "</p><div class='forum-time'>";
	echo "<div class='forum-message-you'>";
	echo $rowMessage[0];
	echo "</div><p>";	
	echo $rowMessage[5];
		echo "</p></div>";
		echo "</div>";
	}
	
	echo "<br>";
}

?>