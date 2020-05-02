<?php if (session_id()=='')
session_start(); ?>
<?php
require "../connection.php";
$stringForum = $_POST['forumString'];
$dateForum = $_POST['mainDate'];
$ID_user =  $_SESSION['ID_user'];
$query = "INSERT INTO message (text_message, date_message, ID_user) VALUES ('$stringForum', '$dateForum', '$ID_user')";
$request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$selectMessage = "SELECT message.text_message, message.date_message, users.name, message.ID_user from message inner join users on message.ID_user=users.ID_user Order by message.date_message";
$resultMessage = mysqli_query($link, $selectMessage) or die("Ошибка " . mysqli_error($link));
$rowsMessage = mysqli_num_rows($resultMessage);
for ($i=0; $i < $rowsMessage ; $i++) { 
	$rowMessage = mysqli_fetch_row($resultMessage);
	
	
	if ($rowMessage[3]==$ID_user) {
	echo "<div class='forum-message1'>";
	echo $rowMessage[2]." ". $rowMessage[1];
	echo "<br>";
	echo "<div class='forum-message-me'>";
	echo $rowMessage[0];
	echo "</div>";
		echo "</div>";
	}
	else{
		echo "<div class='forum-message2'>";
		echo $rowMessage[2]." ". $rowMessage[1];
		echo "<br>";
		echo "<div class='forum-message-you'>";
	echo $rowMessage[0];
	echo "</div>";
		echo "</div>";
	}
	
	echo "<br>";
}
?>