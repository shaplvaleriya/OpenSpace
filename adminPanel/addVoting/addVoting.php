<?php
if (session_id()=='');
    session_start();
?>
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <title>Добавить голосование</title>
    <link rel="stylesheet" href="../css/registration.css">
    </head>
    <body>
        <main>
<form action="" method="post">
    выберите 4 фильма
    <?php 
    $queryFilm = "SELECT title, ID_film from films where voting=1";
    $resultFilm = mysqli_query($link, $queryFilm) or die("Ошибка " . mysqli_error($link));
    $rowsFilm = mysqli_num_rows($resultFilm);
    for ($i = 0; $i < $rowsFilm; ++$i) {
    $rowFilm = mysqli_fetch_row($resultFilm);
    echo "<input type='checkbox' name='filmVoting[]' value=".$rowFilm[1].">".$rowFilm[0];
    echo "<br>";
}
 ?>
<input type="submit" value="добавить голосование" name="voting">
</form>

        </main>
    </body>
</html>

<?php 
if (isset($_POST['voting'])) {

 $query = "SELECT ID_voting from voting";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row= mysqli_fetch_row($result);
if (!empty($row[0])) {
    echo "голосование в этом месяце уже добавлено, попробуйте в следующем";
}
else
{
if (!empty($_POST['filmVoting'])) {

$date=date("Y-m-d");
// echo $date;
$date_start = "2020-04-01";
echo $date_start;
echo "<br>";
$date_w = date("w", strtotime($date_start));
$date_d = date("d", strtotime($date_start));
$date_m = date("m", strtotime($date_start));
$date_Y = date("Y", strtotime($date_start));
echo $date_w;
echo "<br>";
switch ($date_w) {
    case 1:
        $date_d=$date_d+21;
    break;
    case 2:
        $date_d=$date_d+20;
    break;
    case 3:
        $date_d=$date_d+19;
    break;
    case 4:
        $date_d=$date_d+18;
    break;
    case 5:
        $date_d=$date_d+17;
    break;
    case 6:
        $date_d=$date_d+16;
    break;
    case 0:
        $date_d=$date_d+15;
    break;
}
$date_end=$date_Y."-".$date_m."-".$date_d;
echo "$date_end";
$date_session_d=$date_d+5;
$date_session=$date_Y."-".$date_m."-".$date_session_d. "21:00:00";

foreach ($_POST['filmVoting'] as $films) {
   $filmVoting.=$films;
   $filmVoting.=",";
}
echo "<br>";
 echo $filmVoting;

     $queryVoting = "INSERT INTO voting (date_start, date_end, date_session, ID_film) values('$date_start', '$date_end', '$date_session', '$filmVoting')";
    $resultVoting = mysqli_query($link, $queryVoting) or die("Ошибка " . mysqli_error($link));
    if ($resultVoting) {
        echo "Голосование добавлено";
    }
}
else
{
    echo "Выберите фильмы для голосования";
}
}
}
// $select = "SELECT ID_film, count(*) as c from voting_film group by ID_film order by c desc limit 1";
// $result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
//             $row = mysqli_fetch_row($result1);
//             echo $row[0];

 ?>
