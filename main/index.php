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
	<script src="../js/header.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/slick.css" />
	<link rel="stylesheet" type="text/css" href="../css/slick-theme.css" />

	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/owl.theme.default.css">
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
		<div class="morph-wrap" style="z-index: -100">
			<svg class="morph" width="1400" height="770" viewBox="0 0 1400 770">
				<path d="M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z" />
			</svg>
		</div>
		<div class="content-wrap">
			<div class="first-slider">
				<div class="main-slider">
				<?php 
					$select = "SELECT films.title, films.rating,  films.age_limit, films.poster, group_concat(distinct genres.genre separator ', '), films.ID_film from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre group by films.ID_film";
					$result = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
					$rows = mysqli_num_rows($result);
			
				for ($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result);
				?>
				<div>
					<div class="main-slider__slide">
						<div class="poster-image">
							<?php 
							echo "<img src='../image/poster/".$row[3].".jpg'>";
							 ?>
						</div>
						<div class="poster-info">
							<div class="poster-header">
								<?php echo $row[0] ?>
							</div>
							<div class="poster-description">
								<?php echo $row[4]; echo "<br>";  echo $row[2]; echo "/"; echo $row[1]; ?>
							</div>
							<div class="poster-button">
								<?php echo "<button><a href='http://localhost:83/OpenSpace/filmPage/filmPage.php?".$row[5]."'>Купить билет</a></button>"; 
								?>
							</div>
						</div>
					</div>
					</div>

				<?php
				}
				?>
					
				</div>
			</div>
		</div>



		<div class="content-wrap">
	<form method="POST">
        <div class="input">
          <div class="inputGroup">
            <input type="radio" name="film" id="now" value="now" checked/>
            <label for="now">Сейчас в кино</label>
          </div>
          <div class="inputGroup">
            <input type="radio" name="film" id="soon" value="soon" />
            <label for="soon">Скоро в кино</label>
          </div>
        </div>
        <div class="form-line">
          <hr size="1" align="center">
        </div>
      </form>
      <div class="owl-carousel owl-theme secondary-slider" id="now-content">
					<?php 
					$selectSession="SELECT ID_film from sessions where date(sessions.date_session)>date(now())";
					$resultSession = mysqli_query($link, $selectSession) or die("Ошибка " . mysqli_error($link));
					$rowsSession = mysqli_num_rows($resultSession);
					for ($k=0; $k < $rowsSession; $k++) { 
					$rowSession = mysqli_fetch_row($resultSession);

					$selectSoon = "SELECT films.title, films.rating,  films.age_limit, films.poster, group_concat(distinct genres.genre separator ', '), films.ID_film from films inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre group by films.ID_film";
					$resultSoon = mysqli_query($link, $selectSoon) or die("Ошибка " . mysqli_error($link));
					$rowsSoon = mysqli_num_rows($resultSoon);
				for ($i = 0; $i < $rowsSoon; ++$i) {
					$rowSoon = mysqli_fetch_row($resultSoon);
					if ($rowSession[0]==$rowSoon[5]) {
					echo "<div class='secondary-slider__slide'>";
					echo "<img src='../image/poster/".$rowSoon[3].".jpg'>";
					echo "<h2>".$rowSoon[0]."</h2>";
					echo "<p>".$rowSoon[4]."</p>";
					echo "<div class='owl-button'><button><a href='http://localhost:83/OpenSpace/filmPage/filmPage.php?".$rowSoon[5]."'>Купить билет</a></button></div>";
					echo "</div>";
					}
					
				}
				}
					 ?>

		</div>
			<div class="owl-carousel owl-theme secondary-slider" id="soon-content">
					<?php 
					$selectSoon = "SELECT distinct films.title, films.rating,  films.age_limit, films.poster from films left join (select * from (select * from sessions order by date_session desc) d group by ID_film) s on films.ID_film=s.ID_film where s.ID_session is null or date(s.date_session)<date(now())";
					$resultSoon = mysqli_query($link, $selectSoon) or die("Ошибка " . mysqli_error($link));
					$rowsSoon = mysqli_num_rows($resultSoon);
				for ($i = 0; $i < $rowsSoon; ++$i) {
					$rowSoon = mysqli_fetch_row($resultSoon);
					echo "<div class='secondary-slider__slide'>";
					echo "<img src='../image/poster/".$rowSoon[3].".jpg'>";
					echo "<h2>".$rowSoon[0]."</h2>";
					echo "<p>".$rowSoon[4]."</p>";
					echo "<div class='owl-button'><button><a href='http://localhost:83/OpenSpace/filmPage/filmPage.php?".$rowSoon[5]."'>Купить билет</a></button></div>";
					echo "</div>";
				}
					 ?>
		</div>
		      
	</div>
		<div class="content-wrap">

		</div>

		<section class="content content--related">

		</section>
		<?php
		include '../footer/footer.php';
		?>
	</main>
	<script type="text/javascript">
    // $('html').keydown(function(e){
      // if (e.keyCode == 116) {
        // e.preventDefault();
      // }
    // });
    $(() => {
      $('#soon').removeAttr('checked');
      $('#now').attr('checked', true);
      $('#now-content').css({'display':'block'});
      $('#soon-content').css({'display':'none'});
    });
    $('#now').click(() => {
      $('#soon').removeAttr('checked');
      $('#now').attr('checked', true);
      $('#now-content').css({'display':'block'});
      $('#soon-content').css({'display':'none'});
    });
    $('#soon').click(() => {
      $('#now').removeAttr('checked');
      $('#soon').attr('checked', true);
      $('#now-content').css({'display':'none'});
      $('#soon-content').css({'display':'block'});
    });

  </script>
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
	<script type="text/javascript" src="../js/slick.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.main-slider').slick({
				autoplay: true,
				autoplaySpeed: 5000,
				arrows: false,
				dots: true,
				fade: true,
			});

			$(".owl-carousel").owlCarousel({
				loop: true,
				nav: true,
				margin: 10,
				autoplay: 2000,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 3
					},
					960: {
						items: 3
					},
					1200: {
						items: 4
					}
				},
			});

		});
	</script>
</body>

</html>