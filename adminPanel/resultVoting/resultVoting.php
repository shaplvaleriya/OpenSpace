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
				
				$selectt = "SELECT ID_film from voting";
				$resultt = mysqli_query($link, $selectt) or die("Ошибка " . mysqli_error($link));
				$row = mysqli_fetch_row($resultt);
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
					echo $roww[0];
					echo "<br>";
			}
							?>
			</div>
		</div>
	</main>
</body>

</html>