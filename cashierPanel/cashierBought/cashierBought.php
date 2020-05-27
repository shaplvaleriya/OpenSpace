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

		<?php

		?>
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
				if ($date_now < $row[0]) {

					$queryCount = "SELECT count(*) from places";
					$requestCount = mysqli_query($link, $queryCount) or die("Ошибка " . mysqli_error($link));
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
					$busy = (($countBusy * 100) / $count[0]);
					$free = 100 - $busy;
					echo "<div class='session-block' id_session='" . $row[1] . "'>";
					$date = explode(' ', $row[0]);
					echo "<div class='date-session'>";
					echo "<p>";
					echo $date[0];
					echo "</p>";
					echo "<div class='session-time'>";
					echo $date[1];
					echo "</div>";
					echo "<div class='session-slider'>";
					echo "<hr size='3' width='" . $busy . "%' class='busy-place'>";
					echo "<hr size='3' width='" . $free . "%' class='free-place'>";
					echo "</div>";
					echo "</div>";

					echo "</div>";
				}
			}
			?>
		</div>
		<div class="cashier-out">
			<a href="../cashierBooked/cashierList.php">Бронированные билеты</a>
			<br>
			<a href="../../registration/auth_out.php">Выйти</a>
		</div>
		</div>

		<div id="session-page">

		</div>
		<div id="modal">
			<button id="close">X</button>
			На ближайший сеанс выявлены билеты с просроченной брони. Их статус обновлен, а билеты снова доступны к покупке.
		</div>
	</main>
</body>

</html>

<script>
	$(function(){
    $('button').bind('click', function(){
	$('#modal').removeClass('active');
	    });
});
</script>
<script>
			$(document).ready(function() {
			$.ajax({
				url: '../cashierBooked/expired.php',
				success: function(data) {
					console.log(data);
					$('#modal').addClass(data);
				}
			});
		});
</script>
<script>
	const sessionDate = $('.session-block');
	for (let i = 0; i < sessionDate.length; i++) {
		sessionDate[i].addEventListener('click', () => {

			const sessionDateB = $('.session-block');
			for (let y = 0; y < sessionDateB.length; y++) {
				sessionDateB[y].style.background = "#202127";
			}
			sessionDate[i].style.background = "#000";
			$.post('getSession.php', {
					sessionId: sessionDate[i].getAttribute('id_session')
				})
				.done(res => {
					document.getElementById("session-page").innerHTML = res;
					const checkboxList = document.getElementsByClassName('ticket-check');
					console.log(checkboxList);
					let tickets = [];
					for (let i = 0; i < checkboxList.length; i++) {
						checkboxList[i].addEventListener('click', (e) => {
							if (checkboxList[i].checked === true) {
								tickets.push(checkboxList[i].value);
							} else {
								tickets = tickets.filter(ticket => {
									return ticket != checkboxList[i].value
								})
							}
							$.post('getPrice.php', {
									tickets
								})
								.done(res => {
									document.getElementById("price").innerHTML = res;
								})
							// console.log(tickets);
						})

					}
					document.getElementById("bought-tickets").addEventListener('click', () => {
						$.post('ticketsBought.php', {
								tickets,
								sessionId: sessionDate[i].getAttribute('id_session')
							})
							.done(res => {
								document.getElementById("session-page").innerHTML = res;
								
							})
					})



				})
		})
	}
</script>

<script>

</script>