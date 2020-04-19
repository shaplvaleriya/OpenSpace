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
				<h1>Афиша</h1>
			</div>
			<div>
				<?php
				$select = "SELECT distinct sessions.date_session, films.title from sessions inner join films on sessions.ID_film=films.ID_film where date(date_session)>=date(now())";
				$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));

				echo "<div class='film_list'>";
				$rows = mysqli_num_rows($result1);
			
				for ($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result1);
					echo "<div>";
					echo "<div class='film_photo'>";
					echo "</div>";
					echo "<p class='film_category'>";
					echo $row[1], " / ", $row[2];
					echo "</p>";
					echo "<p class='film_name'>";
					echo $row[0];
					echo "</p>";
					echo "</a>";
					echo "</div>";
				}
				?>
			</div>
		</div>
	</main>
</body>

</html>