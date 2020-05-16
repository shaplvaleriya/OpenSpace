<?php
require "../../connection.php";
$film_ID= $_POST['filmString'];

$delete = "DELETE from films where ID_film=$film_ID";
$resultDelete = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
$deleteSession = "DELETE from sessions where ID_film=$film_ID";
$resultDeleteSession = mysqli_query($link, $deleteSession) or die("Ошибка " . mysqli_error($link));
$deleteGenre = "DELETE from film_genre where ID_film=$film_ID";
$resultDeleteGenre = mysqli_query($link, $deleteGenre) or die("Ошибка " . mysqli_error($link));
$deleteCountry = "DELETE from film_country where ID_film=$film_ID";
$resultDeleteCountry = mysqli_query($link, $deleteCountry) or die("Ошибка " . mysqli_error($link));


$select = "SELECT films.title, films.rating, DATE_FORMAT(films.premiere, '%d.%m.%Y'), films.duration, films.age_limit, films.poster, films.description, group_concat(distinct genres.genre separator ', '), group_concat(distinct countries.country separator ', '), films.ID_film from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre inner join film_country on films.ID_film=film_country.ID_film inner join countries on film_country.ID_country=countries.ID_country group by films.ID_film";
                $result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));

              
                $rows = mysqli_num_rows($result1);
            
                for ($i = 0; $i < $rows; ++$i) {
                    $row = mysqli_fetch_row($result1);
                    echo "<form method='POST'>";
                    echo "<div class='film-page'>";
                    
            echo "<div class='film-page-photo'>
                    <img src='../../image/poster/$row[5].jpg'>
                    </div>";

            echo "<div class='film-page-about'>";
            echo "<div class='film-page-name'><div>" . $row[0] . "<a href=../changeFilm/changeFilm.php?".$row[9]."><img src='../../image/edit.png'></a></div><div><input type='submit' name='deleteFilm' value='".$row[9]."' class='but-delete id='film-delete' '></div></div>";
            echo "<div class='film-page-category'>";
            echo "<p> Рейтинг: " . $row[1] . "</p>";
            echo "<p> Премьера: " . $row[2] . "</p>";
            echo "<p> Длительность: " . $row[3] . " мин" . "</p>";
            echo "<p> Возрастное ограничение: " . $row[4] . "</p>";
            echo "<p> Жанры: " . $row[7] . "</p>";
            echo "<p> Страна: " . $row[8] . "</p>";
            echo "</div>";

            echo "<div class='film-page-description'>";
            echo $row[6];
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
                }
