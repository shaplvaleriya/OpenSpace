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
            <h2>Добавить голосование</h2>
            <div class="form-add-voting">
                <form action="" method="post">
                    <p>Выберите фильмы для голосования:</p>
                    <?php 
                    $queryFilm = "SELECT title, ID_film from films where voting=1";
                    $resultFilm = mysqli_query($link, $queryFilm) or die("Ошибка " . mysqli_error($link));
                    $rowsFilm = mysqli_num_rows($resultFilm);
                    for ($i = 0; $i < $rowsFilm; ++$i) {
                    $rowFilm = mysqli_fetch_row($resultFilm);
                    echo "<div>";
                    echo "<input type='checkbox' name='filmVoting[]' value=".$rowFilm[1].">".$rowFilm[0];
                    echo "</div>";
                }
                 ?>
                 <div class="add-button">
                <input type="submit" value="Добавить голосование" name="voting" class="button">
                </div>
                </form>
        </div>
    </main>
    </body>
</html>

<?php 
if (isset($_POST['voting'])) {

 $query = "SELECT ID_voting from voting";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row= mysqli_fetch_row($result);
if (!empty($row[0])) {
    echo "<div class='addvoting-result'>";
    echo "Голосование в этом месяце уже добавлено, попробуйте в следующем.";
    echo "</div>";

}
else
{
if (!empty($_POST['filmVoting'])) {

$date=date("Y-m-d");
$dateD = date("d", strtotime($date));
$dateM = date("m", strtotime($date));
$dateY = date("Y", strtotime($date));

if ($dateD==01) {
 $date_start=$date;  
}
else
{
    if ($dateM<9) {
        $dateM=$dateM+1;
        $date_start = $dateY."-0".$dateM."-01";
        // echo $date_start;
    }
    elseif ($dateM==12) {
        $dateY=$dateY+1;
        $date_start = $dateY."-01-01";
        // echo $date_start;
    }
    elseif($dateM>8 && $dateM<12)
    {
        $dateM=$dateM+1;
        $date_start = $dateY."-".$dateM."-01";
        // echo $date_start;
    }
}
// echo $date_start;
// echo "<br>";
$date_w = date("w", strtotime($date_start));
$date_d = date("d", strtotime($date_start));
$date_m = date("m", strtotime($date_start));
$date_Y = date("Y", strtotime($date_start));
// echo $date_w;
// echo "<br>";
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
// echo "$date_end";
$date_session_d=$date_d+5;
$date_session=$date_Y."-".$date_m."-".$date_session_d. " 21:00:00";
echo "$date_session";
foreach ($_POST['filmVoting'] as $films) {
   $filmVoting.=$films;
   $filmVoting.=",";
}


     $queryVoting = "INSERT INTO voting (date_start, date_end, date_session, ID_film) values('$date_start', '$date_end', '$date_session', '$filmVoting')";
    $resultVoting = mysqli_query($link, $queryVoting) or die("Ошибка " . mysqli_error($link));
    if ($resultVoting) {
      echo "<div class='addvoting-result'>";
        echo "Голосование добавлено. Оно начинается ".$date_start.". Результаты бдут подводиться ".$date_end.". Сеанс с фильмом победителем будет ".$date_session.".";
  echo "</div>";

    }
}
else
{
    echo "<div class='addvoting-result'>";
    echo "Выберите фильмы для голосования.";
    echo "</div>";

}
}
}

 ?>
