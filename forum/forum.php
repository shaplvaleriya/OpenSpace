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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<main>

        <div id="forum_list">
        	<?php 
$selectMessage = "SELECT message.text_message, message.date_message, users.name from message inner join users on message.ID_user=users.ID_user Order by message.date_message";
$resultMessage = mysqli_query($link, $selectMessage) or die("Ошибка " . mysqli_error($link));
$rowsMessage = mysqli_num_rows($resultMessage);
for ($i=0; $i < $rowsMessage ; $i++) { 
	$rowMessage = mysqli_fetch_row($resultMessage);
	echo $rowMessage[2]." ". $rowMessage[1];
	echo "<br>";
	echo $rowMessage[0];
	echo "<br>";
}
			
        	 ?>	
        	 	 </div>
        	 <form id="forum-form" method="POST">
                <input type="text" id="forum-input" name="search" placeholder="Поиск"/>
                <input type="submit">
           
        </form>
        </div>
	</main>

	<script src="forum.js"></script>
</body>
</html>

