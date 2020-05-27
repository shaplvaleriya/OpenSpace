<?php if (session_id()=='')
session_start(); ?>
<?php
include '../menu/menu.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<title>Форум</title>
	<link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/forum.css">
	<link rel="stylesheet" href="../css/media-quaries.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<main>
<div class="forum">
	<div class="message">
        <div id="forum_list">
        	
        	<?php 

if ($_SESSION['username']=='') {
    echo "Зарегистрируйтесь,чтобы общаться на форуме";
}
else{
$ID_user=$_SESSION['ID_user'];
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
			</div>
			<div class="text-message">
 	 <form id="forum-form" method="POST">
                <input type="text" id="forum-input" name="search" placeholder="Введите сообщение"/>
                <input type="submit">
           
        </form></div>
    <?php } ?>
</div>
       
        </div>
	</main>
<script>
var objDiv = document.getElementById("forum_list");
objDiv.scrollTop = objDiv.scrollHeight;
</script>
	<script src="forum.js"></script>
	<script type="text/javascript" src="../js/slick.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.main-slider').slick({
				autoplay: true,
				autoplaySpeed: 5000,
				arrows: false,
				dots: true,
				fade: true,
			});
		</script>
</body>
</html>

