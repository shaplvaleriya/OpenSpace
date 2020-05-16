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
				<h1>Сеансы</h1>
			</div>
			<div>
				<?php
				$select = "SELECT distinct  DATE_FORMAT(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i'), films.title, films.poster from sessions inner join films on sessions.ID_film=films.ID_film where date(date_session)>=date(now()) ORDER BY sessions.date_session";
				$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
				echo "<div class='session-list'>";
				$rows = mysqli_num_rows($result1);
			
				for ($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result1);
					echo "<div class='session-page'>";
					echo "<div class='session-page-photo'><img src='../../image/poster/".$row[3].".jpg'></div>";
					echo "<div class='session-page-about'>";
					echo "<div class='session-name'>";
					echo $row[2];
					echo "</div>";
					echo "<div class='film_date'>";
					echo $row[0];
					echo "</div>";
					echo "<div class='film_date'>";
					echo $row[1];
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