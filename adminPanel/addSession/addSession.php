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
    <title>Добавить фильм</title>
    <link rel="stylesheet" href="../css/registration.css">
    </head>
    <body>
        <main>  <h2>Добавить сеанс</h2>
             <div class="form-add-session">
            <form action="" method="POST">
          
            <div class="filter">

                <select name="film">
<?php 
    $queryFilm = "SELECT title, ID_film from films ORDER BY premiere DESC";
    $resultFilm = mysqli_query($link, $queryFilm) or die("Ошибка " . mysqli_error($link));
    $rowsFilm = mysqli_num_rows($resultFilm);
    for ($i = 0; $i < $rowsFilm; ++$i) {
    $rowFilm = mysqli_fetch_row($resultFilm);
    echo "<option value=".$rowFilm[1].">".$rowFilm[0]."</optin>";
}
 ?>
                </select></div>
                <br>
                <p>Дата сеанса:</p>
                <?php 
                echo " <input type='date' name='date' min=".date('Y-m-d').">";
                 ?>
                <br>
                <p>Время сеанса:</p>
                <input type="radio" name="time" value="18:00:00">18:00
                <input type="radio" name="time" value="21:00:00">21:00
                 <input type="radio" name="time" value="00:00:00">00:00
                <br>
                <div class="add-button">
                <input type="submit" value="Добавить сеанс" name="addSession" class="button">
            </div>
            </form>
        </div>
        </main>
    </body>
</html>

<?php
if(isset($_POST['addSession']))
{
if (isset($_POST['film'])) { $film = $_POST['film']; if ($film == '') { unset($film);} }

if (isset($_POST['date'])) { $date=$_POST['date']; if ($date =='') { unset($date);} }

if (isset($_POST['time'])) { $time=$_POST['time']; if ($time =='') { unset($time);} }

    $queryFilm = "SELECT films.premiere from films where films.ID_film='$film'";
    $resultFilm = mysqli_query($link, $queryFilm) or die("Ошибка " . mysqli_error($link));
    $rowFilm = mysqli_fetch_row($resultFilm);


if (empty($film)|| empty($date) || empty($time)) {
   echo "<script>;alert('Все поля должны быть заполнены'); location.href='http://localhost:83/OpenSpace/adminPanel/addSession/addSession.php';</script>;";
    mysqli_close($link);
}
elseif ($rowFilm[0]>=$date) {
    echo "<script>;alert('Дата премьеры еще не наступила'); location.href='http://localhost:83/OpenSpace/adminPanel/addSession/addSession.php';</script>;";
    mysqli_close($link);
}
else{
$date_session = $date." ".$time;
    $querySession = "SELECT ID_session from sessions where date_session='$date_session'";
    $resultSession = mysqli_query($link, $querySession) or die("Ошибка " . mysqli_error($link));
    $rowSession = mysqli_fetch_row($resultSession);
    if (!empty($rowSession[0])) {
         echo "<script>alert('Дата сеанса уже занята'); location.href='http://localhost:83/OpenSpace/adminPanel/addSession/addSession.php';;</script>";
        mysqli_close($link);
    }
    else{
        $queryAdd ="INSERT INTO sessions (ID_film, date_session) VALUES('$film', '$date_session')";
        $resultAdd = mysqli_query($link, $queryAdd) or die("Ошибка " . mysqli_error($link));
                if ($resultAdd)
                {             
                echo "<script>alert('сеанс добавлен'); location.href='http://localhost:83/OpenSpace/adminPanel/addSession/addSession.php';</script>";
                mysqli_close($link);
                }
                else {
                echo "<script>alert('Ошибка, сеанс не добавлен'); location.href='http://localhost:83/OpenSpace/adminPanel/addSession/addSession.php';</script>";
                mysqli_close($link);
                } 
    }
}
}

?>