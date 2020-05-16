<?php if (session_id()=='')
session_start(); ?>
<?php
require "../connection.php";
if ($_SESSION['ID_user']!=='') {

$ID_user = $_SESSION['ID_user'];
$tickets = $_POST['tickets'];
$count = count($tickets);
echo "<p>Выбрано:</p> ";
echo $count;
echo " билет(ов);";
echo "<br>";

$price=0;
for ($i=0; $i < $count; $i++) { 
    $queryNumber = "SELECT distinct places.price from places where places.ID_place='$tickets[$i]'";
    $resultNumber = mysqli_query($link, $queryNumber) or die("Ошибка " . mysqli_error($link));
    $seat = mysqli_fetch_row($resultNumber);
    $price+=$seat[0];
}

echo "<p>Сумма заказа:</p> ";
echo $price;
echo " руб.;";
echo "<br>";

 $queryUser = "SELECT users.discount from users where users.ID_user=$ID_user";
$resultUser = mysqli_query($link, $queryUser) or die("Ошибка " . mysqli_error($link));
$rowUser = mysqli_fetch_row($resultUser);
$price = $price - ($price * $rowUser[0] / 100);

echo "<p>Ваша скидка:</p> ";
echo $rowUser[0];
echo "%;";
echo "<br>";


echo "<p>Сумма заказа учитывая скидку:</p> ";
echo $price;
echo " руб.";
echo "<br>";
echo "<br>";

 if ($price >= 40) {
        echo "Вы получите в подарок попкорн";
    }

}

else {
    echo "авторизуйтесь, чтобы забронировать билет";
}
?>