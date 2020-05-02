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
					<div>
						<div class="main-slider__slide">
							<div class="poster-image">
								<img src="../image/poster/2.jpg">
							</div>
							<div class="poster-info">
								<div class="poster-header">Заголовок первый</div>
								<div class="poster-description">Осание</div>
								<div class="poster-button"><button>Заказать</button></div>
							</div>
						</div>
					</div>
					<div>
						<div class="main-slider__slide">
							<div class="poster-image">
								<img src="../image/poster/1.jpg">
							</div>
							<div class="poster-info">
								<div class="poster-header">Заголовок второй</div>
								<div class="poster-description">Осание</div>
								<div class="poster-button"><button>Заказать</button></div>
							</div>
						</div>
					</div>
					<div>
						<div class="main-slider__slide">
							<div class="poster-image">
								<img src="../image/poster/3.jpg">
							</div>
							<div class="poster-info">
								<div class="poster-header">Заголовок третий</div>
								<div class="poster-description">Осание</div>
								<div class="poster-button"><button>Заказать</button></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="content-wrap">
			<div class="owl-carousel owl-theme secondary-slider">
				<div class="secondary-slider__slide">
					<h2>Дамбо</h2>
					<p>Семейный фильм, приключения, <br>фэнтези 6+</p>
					<button><a href="http://localhost/cinema/filmPage/filmPage.php?4">Купить билет</a></button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Аладдин</h2>
					<p>Семейный фильм, приключения, <br>фэнтези 6+</p>
					<button>Купить билет</button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Мстители</h2>
					<p>Фэнтези, боевик, фантастика, <br> приключения 16+</p>
					<button> <a href="http://localhost/cinema/filmPage/filmPage.php?8">Купить билет</a></button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Как приручить дракона</h2>
					<p>мультфильм, фэнтези, комедия,<br> приключения 6+</p>
					<button><a href="http://localhost/cinema/filmPage/filmPage.php?1">Купить билет</a></button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Аладдин</h2>
					<p>Семейный фильм, приключения, <br>фэнтези 6+</p>
					<button>Купить билет</button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Мстители</h2>
					<p>Фэнтези, боевик, фантастика, <br> приключения 16+</p>
					<button> <a href="http://localhost/cinema/filmPage/filmPage.php?8">Купить билет</a></button>
				</div>
				<div class="secondary-slider__slide">
					<h2>Аладдин</h2>
					<p>Семейный фильм, приключения, <br>фэнтези 6+</p>
					<button>Купить билет</button>
				</div>
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