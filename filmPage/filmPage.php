<?php
include '../menu/menu.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<title>OpenSpace</title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css" />
	<link rel="stylesheet" href="../css/filmPage.css">
</head>

<body>

	<main>
		<div class="morph-wrap">
			<svg class="morph" width="1400" height="770" viewBox="0 0 1400 770">
				<path d="M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z" />
			</svg>
		</div>
		<div class="content-wrap">
			<?php
			$url = $_SERVER['REQUEST_URI'];
			$url = explode('?', $url);
			$url = $url[1];
			$_SESSION['idf'] = $url;
			$select = "SELECT films.title, films.rating, DATE_FORMAT(films.premiere, '%d.%m.%Y'), films.duration, films.age_limit, films.poster, films.description, group_concat(distinct genres.genre separator ', '), group_concat(distinct countries.country separator ', ') from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre inner join film_country on films.ID_film=film_country.ID_film inner join countries on film_country.ID_country=countries.ID_country WHERE films.ID_film ='$url' group by films.ID_film";
			$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
			$row = mysqli_fetch_row($result1);
			echo "<div class='film-page'>";
			echo "<div class='film-page-photo'>
                    <img src='../image/poster/$row[5].jpg'>
                    </div>";

			echo "<div class='film-page-about'>";
			echo "<div class='film-page-name'>" . $row[0] . "</div>";

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
			?>
		</div>
		<section class="content content--related">
			<?php
			$querySession = "SELECT `date_session`, `ID_session` FROM `sessions` WHERE sessions.ID_film='$url'";
			$requestSession = mysqli_query($link, $querySession) or die("Ошибка " . mysqli_error($link));
			$rows = mysqli_num_rows($requestSession);
			echo "<div class='session'>";
			for ($i = 0; $i < $rows; ++$i) {
				$date_now = date("Y-m-d H:i:s");
				$row = mysqli_fetch_row($requestSession);
				if ($date_now<$row[0]) {
				
				echo "<div class='session-block' date='$row[0]'>";
				echo "<a href=../sessionPage/sessionPage.php?" . $row[1] . ">";
				$date = explode(' ', $row[0]);
				echo "<div class='session-date'>";
				echo "<p>";
				echo $date[0];
				echo "</p>";
				echo "</div>";
				echo "<div class='session-time'>";
				echo "<p>";
				echo $date[1];
				echo "</p>";
				echo "</div>";
				echo "</a>";
				echo "</div>";
				}
			}
			echo "</div>";
			?>
		</section>
		<a href=""></a>
	</main>
	<?php
	include '../footer/footer.php';
	?>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="../js/weather.js"></script>
	<script src="../js/imagesloaded.pkgd.min.js"></script>
	<script src="../js/anime.min.js"></script>
	<script src="../js/scrollMonitor.js"></script>
	<script src="../js/background.js"></script>
</body>

</html>