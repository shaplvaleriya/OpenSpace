<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<head>
	<meta charset="UTF-8" />
	<title>OpenSpace</title>
</head>

<body>
	<main>
		<div class="content-wrap">
			<div class="title">
				<h1>Результаты голосования</h1>
			</div>
			<div>
				<?php
				
				$selectt = "SELECT ID_film, date_start, date_end, date_session from voting";
				$resultt = mysqli_query($link, $selectt) or die("Ошибка " . mysqli_error($link));
				$row = mysqli_fetch_row($resultt);
				
				if (!empty($row[0])) {
				echo "Голосование началось ".$date_start.".<br> Результаты бдут подводиться ".$date_end.".<br> Сеанс с фильмом победителем будет ".$date_session.".";
				$ro = explode(',', $row[0]);
				$count = count($ro);

				for ($p = 0; $p < $count - 1; $p++) 
				{
				$selectTitle = "SELECT title from films where ID_film='$ro[$p]'";
				$resultTitle = mysqli_query($link, $selectTitle) or die("Ошибка " . mysqli_error($link));
				$rowTitle = mysqli_fetch_row($resultTitle);

				$select = "SELECT count(*) as c from voting_film  where ID_film='$ro[$p]'";
				$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
			    $roww = mysqli_fetch_row($result1);
			    	echo $rowTitle[0];
			    	echo " - ";
					echo $roww[0];
					echo ";";
					echo "<br>";
			}
				}
				else
				{
					echo "В этом месяце голосование еще не добавлено. Успейте создать его вовремя!";
				}
				
							?>
			</div>
			<div class="rules-voting">
				<p>Правила голосования:</p>
				Раз в месяц есть возможность проводить голосование на фильм, который хотели бы увидеть пользователи в кинотеатре под открытым небом. Голосование может добавляться только при условии, если в этом месяце оно еще не проводится. Добавляя его первого числа, результат будет подсчитан в этом же месяце. Создание голосования в другой день предполагает его начало в следующем месяце. Таким образом, начиная с первого числа у пользователей появляется модальное окно с просьбой выбора фильма. В понедельник на третью неделю месяца подведутся итоги. Сеанс с фильмом победителем будет добавлен на субботу в 21:00 третьей недели месяца.
			</div>
		</div>
	</main>
</body>

</html>