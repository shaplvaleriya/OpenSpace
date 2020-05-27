<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<head>
	<meta charset="UTF-8 without BOM" />
	<title>OpenSpace</title>
	<link rel="stylesheet" href="../css/adminPanel.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
	<main>
		<div class="content-wrap">
			<div class="main-static">
				<div class="count-film">
					Количество фильмов:
					<div class="info">
						<div>
							<img src="../../image/film.png" alt="">
						</div>
						<div class="count">
					<?php 
						$selectFilm="SELECT count(*) from films where voting='0'";
						$resultFilm=mysqli_query($link, $selectFilm) or die("Ошибка " . mysqli_error($link));
						$rowFilm = mysqli_fetch_row($resultFilm);
						echo $rowFilm[0];
					 ?>						
					</div>
					</div>
				</div>

				<div class="count-session">
					Количество сеансов:
					<div class="info">
						<div>
							<img src="../../image/session.png" alt="">
						</div>
						<div class="count">
					<?php 
						$selectSession="SELECT count(*) from sessions  where date(date_session)>=date(now())";
						$resultSession=mysqli_query($link, $selectSession) or die("Ошибка " . mysqli_error($link));
						$rowSession = mysqli_fetch_row($resultSession);
						echo $rowSession[0];
					 ?>
					 </div>
					</div>
				</div>
				<div class="count-users">
					Количество пользователей:

					<div class="info">
						<div>
							<img src="../../image/users.png" alt="">
						</div>
						<div class="count">
					<?php 
						$selectUser="SELECT count(*) from users where role='user'";
						$resultUser=mysqli_query($link, $selectUser) or die("Ошибка " . mysqli_error($link));
						$rowUser = mysqli_fetch_row($resultUser);
						echo $rowUser[0];
					 ?>
				</div>
 </div>
					</div>
			</div>
			<div class="main-static">
			<div class="main-chart">
			<?php 
				include 'diagr.html';
			 ?>
			</div>
			<div class="main-info">
			<div class="main-voting">
			<?php 
				$queryCount = "SELECT count(*) from places";
				$requestCount= mysqli_query($link, $queryCount) or die("Ошибка " . mysqli_error($link));
				$count = mysqli_fetch_row($requestCount);

				$queryNow = "SELECT sessions.ID_session, date_format(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i') from sessions";
				$resultNow = mysqli_query($link, $queryNow) or die("Ошибка " . mysqli_error($link));
				$rowsNow = mysqli_num_rows($resultNow);
				    for ($j = 0; $j < $rowsNow; ++$j) {
				        $rowNow = mysqli_fetch_row($resultNow);
				        $date_now = date("d.m.Y");
				if ($date_now==$rowNow[1]) {
				$spur = "SELECT distinct `ID_place` from `purchases` where `ID_session`='$rowNow[0]'";
            	$purres = mysqli_query($link, $spur) or die("Ошибка " . mysqli_error($link));
            	$rowsp = mysqli_num_rows($purres);
            	$purchase = array();
            	for ($k = 0; $k < $rowsp; ++$k) {
                $pur = mysqli_fetch_row($purres);
                $pu = explode(',', $pur[0]);
                $countPu = count($pu);
                for ($p = 0; $p < $countPu - 1; $p++) {
                    $purchase[] = $pu[$p];
                }
           		}
           		$countBusy = count($purchase);
           		$busy=(($countBusy*100)/$count[0]);
           		$free=100-$busy;
           		echo "<div class='main-info-time'>";
           		echo $rowNow[2];
           		echo "</div>";
           		echo "<div class='session-slider'>";
				echo "<hr size='3' width='".$busy."%' class='busy-place'>";
				// echo "<hr size='3' width='".$free."%' class='free-place'>";
				echo "<p>";
				echo round($busy)."%";
				echo "</p>";

				echo "</div>";
				}
				}
					 ?>
		</div>
				<div class="main-weather">
					<?php 
			$dateNow=date("Y-m-d H:i:s");
			$urlforcast = "https://api.openweathermap.org/data/2.5/weather?q=Minsk&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c&units=metric";
    				$json = file_get_contents($urlforcast);
    		$data = json_decode($json, true);
            $degree = round($data['main']['temp'],0 );
            $icon=$data['weather'][0]['icon'];
            $weather=$data['weather'][0]['main'];

            echo "<img src='http://openweathermap.org/img/w/".$icon.".png'>";
echo "<div class='weather-info'>";
			echo "<div class='weather'>";
			echo $weather;
			echo "</div>";
			echo "<div class='degree'>";
			echo "".$degree."°";
			echo "</div>";
			echo "</div>";

					 ?>
				</div>
					
			</div>
				
			
		</div>
	</main>
</body>

</html>