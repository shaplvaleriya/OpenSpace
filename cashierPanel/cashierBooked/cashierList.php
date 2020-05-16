<!DOCTYPE html>
<html lang="en" class="no-js">
<?php
include '../../connection.php';
?>
<head>
	<meta charset="UTF-8 without BOM" />
	<title>OpenSpace</title>
	<link rel="stylesheet" href="../css/cashierPanel.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
	<main>
		<!-- <div class="content-cashier"> -->
			
			
<div class="date">
	<?php  
	$session_date='';
	$select = "SELECT distinct DATE_FORMAT(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i'), sessions.ID_session from sessions where date(date_session)>=date(now()) ORDER BY sessions.date_session";
				$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
				echo "<div class='session-list'>";
				echo "<div class='session-list-date'>";
				$rows = mysqli_num_rows($result1);
			
				for ($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result1);
				if ($session_date!==$row[0]) {
					$session_date='';
					echo "<div class='session-date' id_session='".$row[0]."'>";
						echo $row[0];
					echo "</div>";
					$session_date.=$row[0];
					}
				
				}

	?>
</div>
	<div class="cashier-out">
		<a href="../cashierBought/cashierBought.php">Купить билеты</a>

		<a href="../../registration/auth_out.php">Выйти</a>
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
   const sessionDate = $('.session-date');
   for (let i = 0; i < sessionDate.length; i++) {
   	console.log(sessionDate[i]);
   	sessionDate[i].addEventListener('click', () => {

   		 const sessionDateB = $('.session-date');
   		for (let y = 0; y < sessionDateB.length; y++) {
			sessionDateB[y].style.background = "#202127";
   		}
   		sessionDate[i].style.background = "#16161a";
   		console.log(sessionDate[i].getAttribute('id_session'))
   		$.post('getSessionFilm.php', {sessionId: sessionDate[i].getAttribute('id_session')})
   		.done(res => {
   			console.log(res)
        document.getElementById("film-name").innerHTML = res;

    const sessionFilm = $('.session-film');
   for (let i = 0; i < sessionFilm.length; i++) {
   	console.log(sessionFilm[i]);
   	sessionFilm[i].style.background = "#16161a";
   	sessionFilm[i].addEventListener('click', () => {

   	const sessionB= $('.session-film');
   	for (let k = 0; k < sessionB.length; k++) {
   	sessionB[k].style.background = "#16161a";
   	}
   		sessionFilm[i].style.background = "#000";

   		console.log(sessionFilm[i].getAttribute('session'))
   		$.post('getPurchase.php', {sessionId: sessionFilm[i].getAttribute('session')})
   		.done(res => {
   			console.log(res)
        document.getElementById("purchase").innerHTML = res;
   		})
   	})
   }
   		})
   	})
   }
</script>

<script>
  
</script>
