<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<head>
	<meta charset="UTF-8 without BOM" />
	<title>OpenSpace</title>
	<link rel="stylesheet" type="text/css" href="../css/poster.css" />
</head>

<body>
	<main>
		<div class="content-wrap">
			<div class="title">
				<h1>Список фильмов</h1>
			</div>
			<div>
				<?php
				$select = "SELECT films.title, films.rating, DATE_FORMAT(films.premiere, '%d.%m.%Y'), films.duration, films.age_limit, films.poster, films.description, group_concat(distinct genres.genre separator ', '), group_concat(distinct countries.country separator ', '), films.ID_film from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre inner join film_country on films.ID_film=film_country.ID_film inner join countries on film_country.ID_country=countries.ID_country group by films.ID_film";
				$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));

				echo "<div class='film_list'>";
				$rows = mysqli_num_rows($result1);
			
				for ($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result1);
					echo "<div class='film-page'>";
			echo "<div class='film-page-photo'>
                    <img src='../../image/poster/$row[5].jpg'>
                    </div>";

			echo "<div class='film-page-about'>";
			echo "<div class='film-page-name'><div>" . $row[0] . "<a href=../changeFilm/changeFilm.php?".$row[9]."><img src='../../image/edit.png'></a></div><div><input type='submit' name='deleteFilm' class='but-delete'></div></div>";
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
				}
				?>
			</div>
		</div>
	</main>
</body>

</html>