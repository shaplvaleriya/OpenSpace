

					<?php 
					include '../connection.php';
					$selectSoon = "SELECT films.title, films.rating,  films.age_limit, films.poster, group_concat(distinct genres.genre separator ', '), films.ID_film from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre group by films.ID_film";
					$resultSoon = mysqli_query($link, $selectSoon) or die("Ошибка " . mysqli_error($link));
					$rowsSoon = mysqli_num_rows($resultSoon);
				for ($i = 0; $i < $rowsSoon; ++$i) {
					$rowSoon = mysqli_fetch_row($resultSoon);
					echo "<div class='secondary-slider__slide'>";
					echo "<img src='../image/poster/".$rowSoon[3].".jpg'>";
					echo "<h2>".$rowSoon[0]."</h2>";
					echo "<p>".$rowSoon[4]."</p>";
					echo "<div class='owl-button'><button><a href='http://localhost:83/OpenSpace/filmPage/filmPage.php?".$rowSoon[5]."'>Купить билет</a></button></div>";
					echo "</div>";
				}
					 ?>
