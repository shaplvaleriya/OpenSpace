<?php
require "../connection.php";
$stringSearch = $_GET['searchString'];
$query = "SELECT films.title, films.age_limit, films.rating, films.poster, films.ID_film from films where films.title like '%$StringSearch%'";
$request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($request);
echo $rows;
for ($i = 0; $i < $rows; ++$i) {
    $column = mysqli_fetch_row($request);
    echo "<div class='film_item wow fadeInUp' data-wow-delay='" . $i * 0.1 . "s'>";
    echo "<a  href=../filmPage/filmPage.php?" . $column[4] . ">";
    echo "<div class='film_photo'>";
    echo "<img src='$column[3]'>";
    echo "</div>";
    echo "<p class='film_category'>";
    echo $column[1], " / ", $column[2];
    echo "</p>";
    // $countryQuery = "SELECT group_concat(distinct genres.genre separator ', '), group_concat(distinct countries.country separator ', ') from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre inner join film_country on films.ID_film=film_country.ID_film inner join countries on film_country.ID_country=countries.ID_country WHERE films.ID_film ='$column[4]' group by films.ID_film";
    // $countryRequest = mysqli_query($link, $countryQuery) or die("Ошибка " . mysqli_error($link));
    // $countryRows = mysqli_num_rows($countryRequest);
    // for ($i = 0; $i < $countryRows; ++$i) {
    //     $countryColumn = mysqli_fetch_row($countryRequest);
    //     echo $countryColumn[0];
    //     echo $countryColumn[1];
    // }
    echo "<p class='film_name'>";
    echo $column[0];
    echo "</p>";
    echo "</a>";
    echo "</div>";
}
