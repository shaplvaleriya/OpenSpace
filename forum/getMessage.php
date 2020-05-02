<?php if (session_id()=='')
session_start(); ?>
<?php
require "../connection.php";
if ($_SESSION['username']=='') {
    echo "Зарегистрируйтесь,чтобы общаться на форуме";
}
else {
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
}
?>