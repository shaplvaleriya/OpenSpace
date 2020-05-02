<?php
include '../menu/menu.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<title>OpenSpace</title>
	<link rel="stylesheet" type="text/css" href="../css/demo.css" />
</head>
<style>
	.mod {
		display: none;
	}

	.active {
		display: block;
	}
</style>

<body>
	<main>
			<div class="morph-wrap">
				<svg class="morph" width="1400" height="770" viewBox="0 0 1400 770">
					<path d="M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z"/>
				</svg>
			</div>
			<div class="content-wrap">

			</div>

			<div class="content-wrap">

			</div>

			<div class="content-wrap">

			</div>

			<section class="content content--related">
				
			</section>
		<?php
		include '../footer/footer.php';
		?>
	</main>
	<script>
		$(document).ready(function() {
			$.ajax({
				url: 'voting.php',
				success: function(data) {
					$('#modal').addClass(data);
				}
			});
		});


		document.getElementById('voting').addEventListener('click', (e) => {
			e.preventDefault();
			const radio = document.getElementsByClassName('radio-voting');
			console.log(radio);
			let checkCount = 0;
			for (var i = 0; i < radio.length; i++) {
				console.log(radio[i]);
				console.log(radio[i].value);
				console.log(radio[i].checked);

				if (radio[i].checked == true) {
					const votingValue = radio[i].value;
					$.post('addVoting.php', {
							votingValue
						})
						.done(res => {
							document.getElementById("modal").innerHTML = res;
						})
					checkCount++;
				}
			}
			if (checkCount) {
				$('#voting-form').css('display', 'none');
			}



		})
	</script>
		<script src="../js/imagesloaded.pkgd.min.js"></script>
		<script src="../js/anime.min.js"></script>
		<script src="../js/scrollMonitor.js"></script>
		<script src="../js/background.js"></script>
</body>

</html>