<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>OpenSpace</title>
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="stylesheet" type="text/css" href="../css/poster.css" />
	</head>
	<body>		
		<?php
		include '../menu/menu.php';
		include '../connection.php';
		?>
		<main>
			<div class="morph-wrap" style="z-index: -1;">
				<svg class="morph" width="1400" height="770" viewBox="0 0 1400 770">
					<path d="M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z"/>
				</svg>
			</div>
			<div class="content-wrap">
				<div class="title"><h1>Афиша</h1></div> 

			<?php 
			$select = "SELECT `title`, `age_limit`, `rating`, `poster`, `ID_film`  FROM `films`";
			$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));

					echo "<div class='film_list'>";
					$rows = mysqli_num_rows($result1);
					for ($i = 0; $i < $rows; ++$i) {
						$row = mysqli_fetch_row($result1);
						echo "<div class='film_item wow fadeInUp' data-wow-delay='" . $i * 0.1 . "s'>";
						echo "<a  href=../filmPage/filmPage.php?" . $row[4] . ">";
						echo "<div class='film_photo'>";
						echo "<img src='$row[3]'>";
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
		</main>
		<?php
		include '../footer/footer.php';
		?>
	<script src="../js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
		<script src="../js/imagesloaded.pkgd.min.js"></script>
		<script src="../js/anime.min.js"></script>
		<script src="../js/scrollMonitor.js"></script>
		<script src="../js/background.js"></script>
	</body>
</html>
