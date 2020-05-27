<?php
require "../../connection.php";
$sessionId = $_POST['sessionId'];
$query = "SELECT films.title, films.age_limit, films.rating, films.poster, films.ID_film, DATE_FORMAT(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i'), sessions.ID_session from sessions inner join films on films.ID_film=sessions.ID_film";
$request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($request);

for ($i = 0; $i < $rows; ++$i) {
    $column = mysqli_fetch_row($request);
    if ($column[5]==$sessionId) {
        $time_now=date("H:i");
        $date_now=date("d.m.Y");  
        if (($time_now<$column[6]&& $date_now==$column[5]) || $date_now<$column[5]) {
        echo "<div class='session-film' session='".$column[7]."'>";
        echo "<div class='session-film-photo'>";
        echo "<img src='../../image/poster/".$column[3].".jpg'>";
        echo "</div>";
        echo "<div class='session-film-about'>";
        echo "<div class='session-name'>";
        echo $column[0];
        echo "</div>";
        echo "<div class='film_date'>";
        echo "".$column[2]."/".$column[1]."";
        echo "</div>";
        echo "<div class='film_date'>";
        echo $column[6];
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    }
    
}
