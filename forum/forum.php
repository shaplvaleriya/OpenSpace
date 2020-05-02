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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<main>
<div class="forum">
        <div id="forum_list">
        	<?php 

if ($_SESSION['username']=='') {
    echo "Зарегистрируйтесь,чтобы общаться на форуме";
}
else{
$ID_user=$_SESSION['ID_user'];
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
</div>
        	 <form id="forum-form" method="POST">
                <input type="text" id="forum-input" name="search" placeholder="Поиск"/>
                <input type="submit">
           
        </form>
    <?php } ?>
        </div>
	</main>

	<script src="forum.js"></script>
</body>
</html>

