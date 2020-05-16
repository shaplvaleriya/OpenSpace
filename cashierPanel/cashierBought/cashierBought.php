<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
include '../../connection.php';
?>
<head>
	<meta charset="UTF-8 without BOM" />
	<title>OpenSpace</title>
	<link rel="stylesheet" href="../../css/sessionPage.css">
	<link rel="stylesheet" href="../css/cashierPanel.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
	<main>
		<!-- <div class="content-cashier"> -->
			
			
<div class="date">
		<?php
			$querySession = "SELECT `date_session`, `ID_session` FROM `sessions` where date(date_session)>=date(now()) ORDER BY sessions.date_session";
			$requestSession = mysqli_query($link, $querySession) or die("Ошибка " . mysqli_error($link));
			$rows = mysqli_num_rows($requestSession);
			echo "<div class='session-list'>";
				echo "<div class='session-list-date'>";
			for ($i = 0; $i < $rows; ++$i) {
				$date_now = date("Y-m-d H:i:s");
				$row = mysqli_fetch_row($requestSession);
				if ($date_now<$row[0]) {
				
				$queryCount = "SELECT count(*) from places";
				$requestCount= mysqli_query($link, $queryCount) or die("Ошибка " . mysqli_error($link));
				$count = mysqli_fetch_row($requestCount);

				$spur = "SELECT distinct `ID_place` from `purchases` where `ID_session`='$row[1]'";
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
				echo "<div class='session-block' id_session='".$row[1]."'>";
				$date = explode(' ', $row[0]);
				echo "<div class='session-date'>";
				echo "<p>";
				echo $date[0];
				echo "</p>";
				echo "<p>";
				echo $date[1];
				echo "</p>";
				echo "<div class='session-slider'>";
				echo "<hr size='3' width='".$busy."%' class='busy-place'>";
				echo "<hr size='3' width='".$free."%' class='free-place'>";
				echo "</div>";
				echo "</div>";

				echo "</div>";
				}
			}
			echo "</div>";
			?>


	<div class="cashier-out">
		<a href="../cashierBooked/cashierList.php">Забронированные билеты</a>
		<a href="../../registration/auth_out.php">Выйти</a>
	</div>
</div>
</div>

<div id="film-name">
	
</div>
<div id="purchase">
	
</div>
		<!-- </div> -->
	</main>
</body>
</html>
<script>
   const sessionDate = $('.session-block');
   for (let i = 0; i < sessionDate.length; i++) {
   	console.log(sessionDate[i]);
   	sessionDate[i].addEventListener('click', () => {

   		 const sessionDateB = $('.session-block');
   		for (let y = 0; y < sessionDateB.length; y++) {
			sessionDateB[y].style.background = "#202127";
   		}
   		sessionDate[i].style.background = "#16161a";
   		console.log(sessionDate[i].getAttribute('id_session'))
   		$.post('getSession.php', {sessionId: sessionDate[i].getAttribute('id_session')})
   		.done(res => {
   			console.log(res)
        document.getElementById("film-name").innerHTML = res;

   //  const sessionFilm = $('.session-film');
   // for (let i = 0; i < sessionFilm.length; i++) {
   // 	console.log(sessionFilm[i]);
   // 	sessionFilm[i].style.background = "#16161a";
   // 	sessionFilm[i].addEventListener('click', () => {

   // 	const sessionB= $('.session-film');
   // 	for (let k = 0; k < sessionB.length; k++) {
   // 	sessionB[k].style.background = "#16161a";
   // 	}
   // 		sessionFilm[i].style.background = "#000";

   // 		console.log(sessionFilm[i].getAttribute('session'))
   // 		$.post('getPurchase.php', {sessionId: sessionFilm[i].getAttribute('session')})
   // 		.done(res => {
   // 			console.log(res)
   //      document.getElementById("purchase").innerHTML = res;
   // 		})
   // 	})
   // }
   		})
   	})
   }
</script>

<script>
  
</script>
